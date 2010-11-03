<?php
class UserModel extends Model {
	function UserModel() {
		parent::Model();
	}
	
	function get_user_by_id($id) {
		$query = $this->db->get_where('user', array('id' => $id), 1);
		return $query->result();
	}
	
	function get_user_by_email($email) {
		$query = $this->db->get_where('user', array('email' => $email), 1);
		return $query->result();
	}
	
	function get_users() {
		$query = $this->db->get('user');
		return $query->result();
	}
	
	function add_user($data) {
		$this->db->insert('user', $data);
	}
	
	function update_user($id, $data) {
		$this->db->where('id',$id);
		$this->db->update('user', $data);
	}
	
	function delete_user($id) {
		$this->db->where('id', $id);
		$this->db->delete('user');
  }
  
  function user_exists($email) {
    $query = $this->db->get_where('user', array('email' => $email), 1);
    if($query->num_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }
  
  function authenticate_user($email, $password) {
    $query = $this->db->get_where('user', array('email' => $email,'password' => md5($password)));
    if($query->num_rows() > 0) {
      return true;
    } else {
      return false;
    }
  } 
}
?>