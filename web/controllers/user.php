<?php
class User extends Controller {
  function __construct() {
    parent::Controller();
    $this->load->model("UserModel");
    $this->load->model("YellowbotModel");
    $this->load->model("PaymentModel");
    
    $this->load->helper(array('form', 'url'));
    $this->load->library(array('form_validation', 'email'));
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
        "UserGuid" => $this->getGuid(),
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
          $this->confirmation_email($this->input->post('email'), $payment_result['Details']);
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
        if($this->UserModel->user_has_unregistered_business($email)) {
          $this->form_validation->_error_array[] = $this->config->item('unregistered_business_label');
          $this->load->view('userlogin');
        } else {
          $this->YellowbotModel->repman_partner_signin($email);  
        }                
      } else {
        $this->form_validation->_error_array[] = "Authentication failure.";
        $this->load->view('userlogin');
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
  
  /*
   * Client Inserted Code Begins Here
   */
  function allowChars($strValue, $strChars, $blnCaseSense) {
    $strResult = "";
    if ($blnCaseSense) {
      for ($i = 0; $i < strlen($strValue); $i++) {
        $strChar = substr($strValue, $i, 1);
        if (is_numeric(strpos($strChars, $strChar))) {
          $strResult .= $strChar; 
        }
      }
    } else {
      $strChars = strtoupper($strChars);
      for ($i = 0; $i < strlen($strValue); $i++) {
        $strChar = substr($strValue, $i, 1);
        if (is_numeric(strpos($strChars, strtoupper($strChar)))) {
          $strResult .= $strChar; 
        }
      }
    }
    return $strResult;
  }

  function getGuid() {
    // First try and use the Windows-specific guaranteed method
    if (!$objGuid = @new COM("Scriptlet.TypeLib")) {
      // Couldn't create the object (non-Windows server) so use the other method
      $strGuid = md5(uniqid(rand(), 1));
    } else {
      // Created the object so use the GUID property and strip unwanted chars
      $strGuid = $this->allowChars(strtolower($objGuid->GUID()), "0123456789abcdef", false);
    }
    $objGuid = null;
    return $strGuid;
  }  
}
?>
