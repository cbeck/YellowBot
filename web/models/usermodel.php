<?php
class UserModel extends Model {
	function UserModel() {
		parent::Model();
	}
	
	function get_users() {
		$query = $this->db->get('user');
		return $query->result();
	}
}
?>