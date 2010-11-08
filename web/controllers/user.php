<?php
class User extends Controller {
  function __construct() {
    parent::Controller();
    $this->load->model("UserModel");
    $this->load->model("YellowbotModel");
    $this->load->model("PaymentModel");
    
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
  }
  
  function index($uri = NULL) {
    $this->signup();
  }
  
  function signup() {    
    $this->form_validation->set_rules('name', 'Name', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required');
    $this->form_validation->set_rules('passwordconf', 'Password Confirmation', 'required|matches[password]');
    $this->form_validation->set_rules('business_name', 'Business Name', 'required');
    $this->form_validation->set_rules('address1', 'Address', 'required');
    $this->form_validation->set_rules('city', 'City', 'required');
    $this->form_validation->set_rules('state', 'State', 'required');
    $this->form_validation->set_rules('zip', 'Zip', 'required');
    $this->form_validation->set_rules('phone', 'Phone', 'required|numeric');
    $this->form_validation->set_rules('cc_name', 'Name on Credit Card', 'required');
    $this->form_validation->set_rules('cc_type', 'Credit Card Type', 'required');
    $this->form_validation->set_rules('cc_num', 'Credit Card Number', 'required|numeric');
    $this->form_validation->set_rules('cc_exp_month', 'Credit Card Expiration Month', 'required|numeric|exact_length[2]');
    $this->form_validation->set_rules('cc_exp_year', 'Credit Card Expiration Year', 'required|numeric|exact_length[4]');
    $this->form_validation->set_rules('cc_cvv', 'Credit Card verifaction number', 'required|numeric');

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('usersignup');
    } else {
      // setup payment request
      $name = explode(' ', $this->input->post('cc_name'), 2);
      $payment = array(
        "FirstName" => $name[0],
        "LastName" => $name[1],
        "Email" => $this->input->post('email'),
        "Address" => $this->input->post('address1'). ' '.$this->input->post('address2'),
        "City" => $this->input->post('city'),
        "State" => $this->input->post('state'),
        "ZipCode" => $this->input->post('zip'),
        "Price" => '$'.$this->config->item('default_price'),
        "Frequency" => $this->PaymentModel->calculate_frequency($this->config->item('default_frequency')),
        "CardNumber" => $this->input->post('cc_num'),
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
        // if user isn't already registered internally 
        if(!$this->UserModel->user_exists($this->input->post('email'))) {
          // register new user
          if(!$this->YellowbotModel->repman_register_user($this->input->post('name'), $this->input->post('email'))) {         
            // get the location id if it exists  
            if($location = $this->YellowbotModel->repman_location_exists($this->input->post('zip'), $this->input->post('phone'))) {
              // register the existing business to the new user  
              if(!$this->YellowbotModel->repman_register_location_by_id($location['name'], $this->input->post('email'), $location['uid'])) {  
                $registered_business = 1;
              }  
            } else {
              //register a brand new business with YB             
            }
          
          //insert data into user db 
          $db_data = array(
            "name" => $this->input->post('name'),
            "business_name" => $this->input->post('business_name'),
            "address1" => $this->input->post('address1'),
            "address2" => $this->input->post('address2'),
            "city" => $this->input->post('city'),
            "state" => $this->input->post('state'),
            "zip" => $this->input->post('zip'),
            "phone" => $this->input->post('phone'),
            "email" => $this->input->post('email'),
            "password" => md5($this->input->post('password')),
            "cc_number" => $this->input->post('cc_num'),
            "cc_type" => $this->input->post('cc_type'),
            "cc_exp" => $this->input->post('cc_exp_month').'-'.$this->input->post('cc_exp_year'),
            "cc_name" => $this->input->post('cc_name'),
            "cc_cvv" => $this->input->post('cc_cvv'),
            "payment_key" => $payment_result['Details'],
            "yellowbot_user_identifier" => md5($this->input->post('email')),
            "cost" => $this->config->item('default_price'),
            "registered_business" => $registered_business,
            "recurring_frequency" => $this->config->item('default_frequency'));
          $this->UserModel->add_user($db_data);
          $data['success'] = 'Payment processed with confirmation number: '.$payment_result['Details'].'<br />User account created, please login.';
          $this->load->view('userlogin', $data);
            
          } else {
            $this->form_validation->_error_array[] = "This email address already appears to be registered.";
            $this->load->view('usersignup');
          }                
        } else {
          $this->form_validation->_error_array[] = "This email address already exists in our records.";
          $this->load->view('usersignup');
        }
      } else {
        $this->form_validation->_error_array[] = "There was a problem processing your payment: ".$payment_result['Details'];;
        $this->load->view('usersignup');
      }                  
    }
  }  

  function login() {
    $this->form_validation->set_rules('email', 'Email', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');
      
    if ($this->form_validation->run() == FALSE) {
      $this->load->view('userlogin');
    } else {
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      
      if($this->UserModel->authenticate_user($email, $password)) {
        $this->YellowbotModel->repman_partner_signin($email);        
      } else {
        $this->form_validation->_error_array[] = "Authentication failure.";
        $this->load->view('userlogin');
      }     
    }
  }
  
  function locations() {
    print_r($this->YellowbotModel->repman_list_locations("test009@jcbarry.com"));
  }
  
  function searchtest() {
    print_r($this->YellowbotModel->repman_search_locations("28210", "7043759715"));
  }
}
?>
