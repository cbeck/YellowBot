<?php
class UserModel extends Model {
	function UserModel() {
		parent::Model();
	}
	
  /*
   * SELECT Methods
   */
	function get_users() {
		$query = $this->db->get('user');
		return $query->result();
	}
  
  function get_unregistered_users() {
    $query = $this->db->get_where('user', array('registered_business' => 0));
    return $query->result();
  }
	
  function get_user_by_id($id) {
    $query = $this->db->get_where('user', array('id' => $id), 1);
    return $query->result();
  }
  
  function get_user_by_email($email) {
    $query = $this->db->get_where('user', array('email' => $email), 1);
    if ($query->num_rows() > 0) {
      $row = $query->row();
      return $row;
    } else {
      return null;
    }    
  }
  
  function get_user_id($email) {
    $this->db->select('id');
    $query = $this->db->get_where('user', array('email' => $email), 1);    
    if ($query->num_rows() > 0) {
      $row = $query->row();
      return $row->id;
    } else {
      return false;
    }    
  }
  
  /*
   * Other CRUD Methods
   */    
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
    
  /*
   * Utility Functions
   */  
  function user_exists($email) {
    $query = $this->db->get_where('user', array('email' => $email), 1);
    if($query->num_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }  
  
  function user_has_unregistered_business($email) {
    $query = $this->db->get_where('user', array('email' => $email,'registered_business' => 0));
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