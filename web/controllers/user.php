<?php
class User extends Controller {
  function __construct() {
    parent::Controller();
    $this->load->model("UserModel");
    $this->load->model("YellowbotModel");
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
  }
  
  function index($uri = NULL) {
    $this->signup();
  }
  
  function signup() {
    $data = array();
    
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
    
    //Not dealing with payments just yet
    //$this->form_validation->set_rules('cc_name', 'Name on Credit Card', 'required');
    //$this->form_validation->set_rules('cc_type', 'Credit Card Type', 'required');
    //$this->form_validation->set_rules('cc_num', 'Credit Card Number', 'required|numeric');
    //$this->form_validation->set_rules('cc_exp_month', 'Credit Card Expiration Month', 'required|numeric|exact_length[2]');
    //$this->form_validation->set_rules('cc_exp_year', 'Credit Card Expiration Year', 'required|numeric|exact_length[2]');

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('usersignup', $data);
    } else {
      //TODO:Process payment
     
      if(!$this->UserModel->user_exists($this->input->post('email'))) {
        //Create Yellowbot User
        $this->YellowbotModel->repman_register_user($this->input->post('name'), $this->input->post('email'));
        
        //Insert into DB
        $db_data = array(
          "name" => $this->input->post('name'),
          "address1" => $this->input->post('address1'),
          "address2" => $this->input->post('address2'),
          "city" => $this->input->post('city'),
          "state" => $this->input->post('state'),
          "zip" => $this->input->post('zip'),
          "email" => $this->input->post('email'),
          "password" => md5($this->input->post('password')),
          "cc_number" => "",
          "cc_type" => "",
          "cc_exp" => "",
          "cc_name" => "",
          "cc_cvv" => "",
          "payment_key" => "",
          "yellowbot_user_identifier" => md5($this->input->post('email')),
          "cost" => 0.00
        );
        $this->insert($db_data);
        $this->session->set_flashdata('success', 'User account created, please login.');
        $this->load->view('userlogin');        
      } else {
        $this->form_validation->_error_array[] = "This email address already exists in our records.";
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
 
// Protected DB Calls
  protected function insert($data) {
    $this->UserModel->add_user($data);
  }
  
  protected function update($id, $data) {
    if($this->session->userdata('admin_logged_in')) {
      $this->UserModel->update_user($id, $data);
      $this->session->set_flashdata('db', 'Updated user record '.$id);
    }
    redirect('/admin');
  }
  
  protected function delete($id) {
    if($this->session->userdata('admin_logged_in')) {
      $this->UserModel->delete_user($id);
      $this->session->set_flashdata('db', 'Removed user record '.$id);
    }
    redirect('/admin');
  }
}
?>
