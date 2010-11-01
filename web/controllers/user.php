<?php
class User extends Controller {
  function __construct() {
    parent::Controller();
    $this->load->model("UserModel");
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
  }
  
  function index() {
   //call or redirect to yellowbot API for user profile or something
  }
  
  function signup() {
    //signup form
  }  
  
// Protected DB Calls
  protected function insert($data) {
    $this->UserModel->add_user($data);
    redirect('/user');
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
