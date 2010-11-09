<?php
class YellowbotModel extends Model {
  var $base_url;  
  var $api_key;
  var $api_secret;
  var $ch;
  
  function YellowbotModel() {
    parent::Model();
    $this->base_url = $this->config->item('api_url');
    $this->api_key = $this->config->item('api_key');
    $this->api_secret = $this->config->item('api_secret');
    
    $this->ch = curl_init();
    curl_setopt($this->ch, CURLOPT_HEADER, 0);  
    curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
  } 
  
  function repman_register_user($name, $email) {
    $operation = "/api/reputation_management/register_user?";
    $query = array(
      "api_key" => $this->api_key,
      "name" => $name,
      "email" => $email,
      "api_ts" => time(),
      "api_user_identifier" => md5($email));
     
    $query_string = $this->generate_query($query).$this->generate_sig($query); 
    return $this->curl_request($query_string, $operation);
  }
  
  ///api/reputation_management/register_location
  function repman_register_location_by_data($data) {
    $operation = "/api/reputation_management/register_location?";
    $query = array(
      "api_key" => $this->api_key,      
      "name" => $data['name'],
      "address" => $data['address1'].' '.$data['address2'],
      "city_name" => $data['city_name'],
      "state" => $data['state'],
      "zip" => $data['zip'],
      "phone_number" => $data['phone_number'],
      "email" => $data['email'],
      "api_ts" => time(),
      "api_user_identifier" => md5($data['email']));
     
    $query_string = $this->generate_query($query).$this->generate_sig($query); 
    return $this->curl_request($query_string, $operation);    
  }
  
  function repman_register_location_by_id($business_name, $email, $location) {
    $operation = "/api/reputation_management/register_location?";
    $query = array(
      "api_key" => $this->api_key,      
      "name" => $business_name,
      "location" => $location,
      "api_ts" => time(),
      "api_user_identifier" => md5($email));
     
    $query_string = $this->generate_query($query).$this->generate_sig($query); 
    return $this->curl_request($query_string, $operation);   
  }
  
  ///api/reputation_management/update_location
  function repman_update_location($data, $location_id) {
    $operation = "/api/reputation_management/update_location?";
    $query = array(
      "api_key" => $this->api_key,
      "location" => $location_id,      
      "name" => $data['name'],
      "address" => $data['address1'].' '.$data['address2'],
      "city_name" => $data['city_name'],
      "state" => $data['state'],
      "zip" => $data['zip'],
      "phone_number" => $data['phone_number'],
      "email" => $data['email'],
      "api_ts" => time(),
      "api_user_identifier" => md5($data['email']));
     
    $query_string = $this->generate_query($query).$this->generate_sig($query); 
    return $this->curl_request($query_string, $operation);   
  }  
  
  ///api/reputation_management/unregister_location
  function repman_unregister_location($email, $location_id) {
    $operation = "/api/reputation_management/unregister_location?";
    $query = array(
      "api_key" => $this->api_key,
      "location" => $location_id,
      "api_ts" => time(),
      "api_user_identifier" => md5($email));
    
    $query_string = $this->generate_query($query).$this->generate_sig($query); 
    return $this->curl_request($query_string, $operation);    
  }
  
  function  repman_search_locations($zip, $phone) {
    $operation = "/api/search/locations?";
    $query = array(
      "api_key" => $this->api_key,
      "place" => $zip,
      "q" => $phone);
     
    $query_string = $this->generate_query($query).$this->generate_sig($query); 
    return $this->curl_request($query_string, $operation, FALSE);    
  }
  
  function repman_location_exists($zip, $phone) {
    $result = $this->repman_search_locations($zip, $phone);
    if(empty($result['locations'])) {
      return false;
    } else {
      return $result['locations'][0]; 
    }
  }
  
  function repman_list_locations($email) {
    $operation = "/api/reputation_management/list_locations?";
    $query = array(
      "api_key" => $this->api_key,
      "api_ts" => time(),
      "api_user_identifier" => md5($email));
     
    $query_string = $this->generate_query($query).$this->generate_sig($query); 
    return $this->curl_request($query_string, $operation, FALSE); 
    
  }
  
  function repman_partner_signin($email) {
    $operation = "/signin/partner?";
    $query = array(
      "api_key" => $this->api_key,
      "api_ts" => time(),
      "api_user_identifier" => md5($email));
     
    $query_string = $this->generate_query($query).$this->generate_sig($query); 
    $url = $this->base_url.$operation.$query_string;
    redirect($url);    
  }   
  
  //Protected utility functions
  protected function curl_request($query, $operation, $validate = TRUE) {    
    $curl_url = $this->base_url.$operation.$query;    
    curl_setopt($this->ch, CURLOPT_URL, $curl_url); 
    $response = curl_exec($this->ch);
    if($validate) {
      return $this->validate_response($this->response_parse($response));
    } else {
      return $this->response_parse($response);
    }
  }
  
  protected function validate_response($response) {
    if(isset($response['ok']) && $response['ok'] == "ok") {
      return true;
    } else {
      return false;
    }
  }
  
  protected function generate_query($data) {
    $query = "";
    foreach($data as $key => $value) {
      $query .= $key."=".str_replace (" ", "%20", $value)."&";
    }
    return $query;
  }
  
  protected function generate_sig($data) {
    $sig = "";  
    ksort($data);
    foreach($data as $key => $value) {
      $sig .= $key.$value;
    }
    return "api_sig=".hash_hmac("sha256", $sig, $this->api_secret);
  }
  
  protected function response_parse($response) {
    return json_decode($response, TRUE);
  }  
}
?>