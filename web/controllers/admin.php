<?php
class Admin extends Controller {
  var $view_data;
  
  function __construct() {
    parent::Controller();
	  $this->load->model("AdminModel");
    $this->load->model("UserModel");
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    
    $this->view_data = array(
        'admin_table' => $this->AdminModel->get_admins(),
        'user_table' => $this->UserModel->get_users());   
  }
  
  function index() {
    if($this->session->userdata('admin_logged_in')) {
      $this->load->view('adminview', $this->view_data);
    } else {
      $this->load->view('adminlogin');
    }
  }
  
  function login() {
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
			
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('adminlogin');
		} else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
	  	if($this->AdminModel->authenticate_admin($username, $password)) {
			  $this->session->set_userdata(array('admin_logged_in' => TRUE, 'username' => $username));
	  		$this->load->view('adminview', $this->view_data);
	  	} else {
	  		$this->form_validation->_error_array[] = "Authentication failure.";
			  $this->load->view('adminlogin');
	  	}  		
		}
	}
  
  function logout() {
    $this->session->unset_userdata(array('admin_logged_in' => '', 'username' => ''));
    redirect('/admin');
  }
  
  function add() {
    $this->form_validation->set_rules('new_username', 'Username', 'required');
    $this->form_validation->set_rules('new_password', 'Password', 'required|matches[new_password_confirm]');
    $this->form_validation->set_rules('new_password_confirm', 'Password Confirmation', 'required');
    
    if ($this->form_validation->run() == TRUE) {
      $username = $this->input->post('new_username');
      $password = $this->input->post('new_password');
      $this->insert($username, $password);
    } else {
      $this->load->view('adminview', $this->view_data);
    }
  }  
  
  function remove($id) {
    $this->delete($id);
  }  
  
// Protected DB Calls 
  protected function delete($id) {
  	if($this->session->userdata('admin_logged_in')) {
  		$this->AdminModel->delete_admin($id);
		  $this->session->set_flashdata('db', 'Removed admin record '.$id);
  	}
    redirect('/admin');
  }
  
  protected function insert($username, $password) {
  	if($this->session->userdata('admin_logged_in')) {
  		$data = array('username' => $username, 'password' => md5($password));
		  $this->AdminModel->insert_admin($data);
		  $this->session->set_flashdata('db', 'Inserted admin '.$username);	
  	}
    redirect('/admin');
  }
}
?>
