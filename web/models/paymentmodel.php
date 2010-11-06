<?php
class PaymentModel extends Model {
  var $soap_client;
  var $wsdl;
  var $soap_url;
  
  
  function PaymentModel() {
    parent::Model();
    $this->wsdl = $this->config->item('payment_service_wsdl');
    $this->soap_url = $this->config->item('payment_service_url');  
    $this->soap_client = new SoapClient($this->wsdl);
  }
  
  function process_payment($data) {
    $result = $this->soap_client->ProcessPayment($this->generate_request($data));
    return $this->validate_response($result); 
  }
  
  protected function generate_request($ary) {
    $request = "<CcPaymentRequest>";  
    foreach($ary as $key => $value) {
      $request .= "<".$key.">".$value."</".$key.">";
    }
    $request .= "</CcPaymentRequest>";
    return $request;
  }
  
  protected function validate_response($response) {
    $xmlobject = new SimpleXMLElement($response->ProcessPaymentResult);
    if($xmlobject->Status == "Unsuccessful") {
      return false;
    } else {
      //Get payment number
      return true;
    }
  }
}
?>