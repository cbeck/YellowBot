<?php
class Business extends Controller {
  var $view_data;
  
  function __construct() {
    parent::Controller();
    $this->load->model("UserModel");
    $this->load->model("BusinessModel");
    $this->load->model("YellowbotModel");
    $this->load->model("PaymentModel");
    
    $this->load->helper(array('form', 'url'));
    $this->load->library(array('form_validation', 'email'));
  }
  
  function index($uri = NULL) {
    $this->add();
  }
  
  function add() {    
    $this->form_validation->set_rules('business_name', 'Business Name', 'required');
    $this->form_validation->set_rules('address1', 'Address', 'required');
    $this->form_validation->set_rules('city', 'City', 'required');
    $this->form_validation->set_rules('state', 'State', 'required');
    $this->form_validation->set_rules('zip', 'Zip', 'required');
    $this->form_validation->set_rules('phone', 'Phone', 'required|numeric');
    
    $this->form_validation->set_rules('cc_name', 'Name on Credit Card', 'required');
    $this->form_validation->set_rules('cc_address1', 'Billing Address', 'required');
    $this->form_validation->set_rules('cc_city', 'Billing City', 'required');
    $this->form_validation->set_rules('cc_state', 'Billing State', 'required');
    $this->form_validation->set_rules('cc_zip', 'Billing Zip', 'required|numeric');
    $this->form_validation->set_rules('cc_phone', 'Billing Phone', 'required|numeric');
    
    $this->form_validation->set_rules('cc_type', 'Credit Card Type', 'required');
    $this->form_validation->set_rules('cc_num', 'Credit Card Number', 'required|numeric');
    $this->form_validation->set_rules('cc_exp_month', 'Credit Card Expiration Month', 'required|numeric|exact_length[2]');
    $this->form_validation->set_rules('cc_exp_year', 'Credit Card Expiration Year', 'required|numeric|exact_length[4]');
    $this->form_validation->set_rules('cc_cvv', 'Credit Card verifaction number', 'required|numeric');

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('businessadd');
    } else {
      // setup payment request
      $name = explode(' ', $this->input->post('cc_name'), 2);
      $payment = array(
        "FirstName" => $name[0],
        "LastName" => $name[1],
        "Email" => $this->session->userdata('email'),
        "Address" => $this->input->post('cc_address1'). ' '.$this->input->post('cc_address2'),
        "City" => $this->input->post('cc_city'),
        "State" => $this->input->post('cc_state'),
        "ZipCode" => $this->input->post('cc_zip'),
        "Price" => '$'.$this->config->item('default_price'),
        "Frequency" => $this->PaymentModel->calculate_frequency($this->config->item('default_frequency')),
        "CardNumber" => $this->input->post('cc_num'),
        "CardType" => $this->input->post('cc_type'),
        "CcvCode" => $this->input->post('cc_cvv'),
        "Country" => "United States",
        "Month" => $this->input->post('cc_exp_month'),
        "Year" => $this->input->post('cc_exp_year'),
        "ClientIP" => $this->input->ip_address());    
      // initiate payment request 
      $payment_result = $this->PaymentModel->process_payment($payment);
     
      // if payment succeeds
      if($payment_result['Status'] == "Successful") {
        $registered_business = 0;
        if($location = $this->YellowbotModel->repman_location_exists($this->input->post('zip'), $this->input->post('phone'))) {        
          if(!$this->YellowbotModel->repman_register_location_by_id($location['name'], $this->session->userdata('email'), $location['uid'])) {  
            $registered_business = 1;
          }  
        }

        $db_data = array("user_id" => $this->session->userdata('user_id'),
                        "name" => $this->input->post('business_name'),
                        "address1" => $this->input->post('address1'),
                        "address2" => $this->input->post('address2'),
                        "city" => $this->input->post('city'),
                        "state" => $this->input->post('state'),
                        "zip" => $this->input->post('zip'),
                        "phone" => $this->input->post('phone'),                        
                        "payment_key" => $payment_result['Details'],
                        "registered_business" => $registered_business);
          
        $this->BusinessModel->add_business($db_data);        
        $this->session->set_flashdata('success', 'Payment processed with confirmation number: '.$payment_result['Details']);        
        redirect('/user/dashboard');
      } else {
        $this->form_validation->_error_array[] = "There was a problem processing your payment: ".$payment_result['Details'];;
        $this->load->view('businessadd');
      }                  
    }
  }

  function confirmation_email($email, $confirmation_number) {
    $this->email->initialize(array('mailtype' => 'html'));    
    $this->email->from($this->config->item('confirmation_email_from'), $this->config->item('confirmation_email_name'));
    $this->email->to($email);
    $this->email->subject($this->config->item('confirmation_email_subject').$confirmation_number);
    $this->email->message($this->config->item('confirmation_email_body'));
    $this->email->send();
  }
}
?>
