<?php
class Admin extends Controller {
  function __construct() {
    parent::Controller();
    $this->load->model("AdminModel");
    
  }
  
  function index() {
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
			
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('submit', 'Submit', 'callback_authentication');
			
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('adminlogin');
		} else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
		  	if($this->AdminModel->authenticate_admin($username, $password)) {
		  		$data['admin_table'] = $this->AdminModel->get_admins();
				$data['user_table'] = $this->UserModel->get_users();
		  		$this->load->view('adminview', $data);
		  	} else {
		  		$this->form_validation->_error_array[] = "Authentication failure.";
				$this->load->view('adminlogin');
		  	}  		
		}
	}
  
  function remove($id) {
  	//remove admin
  }
  
  function insert($username, $password) {
  	//insert admin
  }
}
?>
