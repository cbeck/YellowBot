<?php
class BusinessModel extends Model {
  function BusinessModel() {
    parent::Model();
  }
  
  function get_businesses() {
    $query = $this->db->get('business');
    return $query->result();
  }
  
  function get_businesses_by_user($id) {
    $query = $this->db->get_where('business', array('user_id' => $id));
    return $query->result();
  }
  
  function add_business($data) {
    $this->db->insert('business', $data);
  }
  
  function update_business($id, $data) {
    $this->db->where('id',$id);
    $this->db->update('business', $data);
  }
  
  function delete_business($id) {
    $this->db->where('id', $id);
    $this->db->delete('business');
  }
}
?>