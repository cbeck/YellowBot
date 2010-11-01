<?php
class AdminModel extends Model {
	function AdminModel() {
		parent::Model();
	}
	
	function get_admin_by_id($id) {
		$query = $this->db->get_where('admin', array('id' => $id), 1);
		return $query->result();
	}
	
	function get_admins() {
		$query = $this->db->get('admin');
		return $query->result();
	}
	
	function insert_admin($data) {
		$this->db->insert('admin', $data);
	}
	
	function delete_admin($id) {
		$this->db->where('id', $id);
		$this->db->delete('admin');
	}
	
	function authenticate_admin($username, $password) {
		$query = $this->db->get_where('admin', array('username' => $username,'password' => md5($password)));
		if($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}		
}
?>