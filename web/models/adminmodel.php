<?php
class AdminModel extends Model {
	function AdminModel() {
		parent::Model();
	}
	
	function get_admins() {
		$query = $this->db->get('admin');
		return $query->result();
	}
	
	function authenticate_admin($username, $password) {
		$query = $this->db->get_where('admin', array('username' => $username,'password' => md5($password)));
		if($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	function insert_admin($username, $password) {
		$this->db->set('username', $username);
		$this->db->set('datetime', 'md5($password)');
		$this->db->insert('admin');
	}		
}
?>