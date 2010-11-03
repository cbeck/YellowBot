<?php
class BusinessModel extends Model {
  function BusinessModel() {
    parent::Model();
  }
  
  function get_business_by_id($id) {
    $query = $this->db->get_where('business', array('id' => $id), 1);
    return $query->result();
  }
  
  function get_user_by_phone($phone) {
    $query = $this->db->get_where('business', array('email' => $email), 1);
    return $query->result();
  }
  
  function add_business($data) {
    $this->db->insert('business', $data);
  }
  
  function update_business($id, $data) {
    $this->db->where('id',$id);
    $this->db->update('user', $data);
  }
  
  function delete_business($id) {
    $this->db->where('id', $id);
    $this->db->delete('user');
  }
}
?>