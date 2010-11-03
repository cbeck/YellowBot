<?php
class YellowbotModel extends Model {
  var $base_url;  
  var $api_key;
  var $api_secret;
  var $ch;
  
  function YellowbotModel() {
    parent::Model();
    $this->base_url = "http://rep.ubl.org";
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
      "name" => str_replace (" ", "", $name),
      "email" => $email,
      "api_ts" => time(),
      "api_user_identifier" => md5($email));
     
    $query_string = $this->generate_query($query).$this->generate_sig($query); 
    $curl_url = $this->base_url.$operation.$query_string;
    
    curl_setopt($this->ch, CURLOPT_URL, $curl_url); 
    $response = curl_exec($this->ch);  
    
    return $this->response_parse($response);
  }
  
  function  repman_search_location($zip, $phone) {
    $operation = "/api/search/locations?";
    $query = array(
      "api_key" => $this->api_key,
      "place" => $zip,
      "q" => $phone);
     
    $query_string = $this->generate_query($query).$this->generate_sig($query); 
    $curl_url = $this->base_url.$operation.$query_string;
    
    curl_setopt($this->ch, CURLOPT_URL, $curl_url); 
    $response = curl_exec($this->ch);  
    
    return $this->response_parse($response);    
  }
  
  function repman_list_locations($email) {
    $operation = "/api/reputation_management/list_locations?";
    $query = array(
      "api_key" => $this->api_key,
      "api_ts" => time(),
      "api_user_identifier" => md5($email));
     
    $query_string = $this->generate_query($query).$this->generate_sig($query); 
    $curl_url = $this->base_url.$operation.$query_string;
    
    curl_setopt($this->ch, CURLOPT_URL, $curl_url); 
    $response = curl_exec($this->ch);  
    
    return $this->response_parse($response); 
    
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
  
  ///api/reputation_management/register_location
  function repman_register_location($data) {
    $data = $this->encode_array($data);
    $operation = "/api/reputation_management/register_location?";
    $query = array(
      "api_key" => $this->api_key,      
      "name" => $data['name'],
      "address" => $data['address1'].' '.$data['address2'],
      "city_name" => $data['city_name'],
      "state" => $data['state'],
      "zip" => $data['zip'],
      "country" => "USA",
      "phone_number" => $data['phone_number'],
      "fax_number" => $data['fax_number'],
      "tollfree_number" => $data['tollfree_number'],
      "payment" => "",
      "hours_open" => "",
      "email" => urlencode($data['email']),
      "website" => $data['website'],
      "api_ts" => time(),
      "api_user_identifier" => md5($data['email']));
     
    $query_string = $this->generate_query($query).$this->generate_sig($query); 
    $curl_url = $this->base_url.$operation.$query_string;
    
    curl_setopt($this->ch, CURLOPT_URL, $curl_url); 
    $response = curl_exec($this->ch);  
    
    return $this->response_parse($response);    
  }

  ///api/reputation_management/update_location
  function repman_update_location($data, $location_id) {
    $data = $this->encode_array($data);
    $operation = "/api/reputation_management/update_location?";
    $query = array(
      "api_key" => $this->api_key,
      "location_id" => $location_id,
      "name" => $data['name'],
      "address" => $data['address1'].' '.$data['address2'],
      "city_name" => $data['city'],
      "state" => $data['state'],
      "zip" => $data['zip'],
      "country" => "USA",
      "phone_number" => $data['phone'],
      "fax_number" => $data['fax'],
      "tollfree_number" => $data['tollfree'],
      "payment" => "",
      "hours_open" => "",
      "email" => $data['email'],
      "website" => $data['website'],
      "api_ts" => time(),
      "api_user_identifier" => md5($data['email']));
     
    $query_string = $this->generate_query($query).$this->generate_sig($query); 
    $curl_url = $this->base_url.$operation.$query_string;
    
    curl_setopt($this->ch, CURLOPT_URL, $curl_url); 
    $response = curl_exec($this->ch);  
    
    return $this->response_parse($response);    
  }  
  
  ///api/reputation_management/unregister_location
  function repman_unregister_location($location_id) {
    $operation = "/api/search/locations?";
    $query = array(
      "api_key" => $this->api_key,
      "location_id" => $location_id,
      "api_ts" => time(),
      "api_user_identifier" => md5($email));
     
    $query_string = $this->generate_query($query).$this->generate_sig($query); 
    $curl_url = $this->base_url.$operation.$query_string;
    
    curl_setopt($this->ch, CURLOPT_URL, $curl_url); 
    $response = curl_exec($this->ch);  
    
    return $this->response_parse($response);
  }
  
  
  //Protected utility functions
  protected function generate_query($data) {
    $query = "";
    foreach($data as $key => $value) {
      $query .= $key."=".$value."&";
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
  
  protected function encode_array($ary) {
    foreach($ary as $key => $value) {
      $ary[$key] = urlencode($value);
    }
    return $ary;
  }
  
  protected function response_parse($response) {
    return json_decode($response, TRUE);
  }
  
  
}
?>