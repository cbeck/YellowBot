<?php
class PaymentModel extends Model {
  var $soap_client;
  var $wsdl;
  var $soap_url;
  
  
  function PaymentModel() {
    parent::Model();
    $this->base_url = $this->config->item('payment_service_url');
        
    $this->ch = curl_init();
    curl_setopt($this->ch, CURLOPT_HEADER, 0);  
    curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
  }

  function process_payment($data) {
    $operation = "/submit?";    
    $query_string = $this->generate_query($data); 
    return $this->curl_request($query_string, $operation);
  }
  
  
  function calculate_frequency($int) {
    switch($int) {
      case 52:
        return "weekly";
        break;
      case 26:
        return "bi-weekly";
        break;
      case 24:
        return "semi-monthly";
        break;
      case 12:
        return "monthly";
        break;
      case 13:
        return "quad-weekly";
        break;
      case 4:
        return "quarterly";
        break;
      case 1:
        return "annually";
        break;
      default:
        return "monthly";
        break;
    }    
  }
  
  protected function curl_request($query, $operation) {    
    $curl_url = $this->base_url.$operation.$query;    
    curl_setopt($this->ch, CURLOPT_URL, $curl_url); 
    $response = curl_exec($this->ch);
    return $this->validate_response($response);
  }
  
  protected function generate_query($data) {
    $query = "";
    foreach($data as $key => $value) {
      $query .= $key."=".str_replace (" ", "%20", $value)."&";
    }
    return $query;
  }
  
  protected function validate_response($response) {
    $response = html_entity_decode($response);
    $xmlobject = new SimpleXMLElement($response);
    $xmlobject = (array)$xmlobject->Response;
    
    return $xmlobject;
  }
}
?>