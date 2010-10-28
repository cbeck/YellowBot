<?php
class Pages extends Controller {
  function __construct() {
    parent::Controller();
  }
  
  function index($uri = NULL) {
  	if($uri != NULL) {
  		$data['uri'] = $uri;
	} else {
		$data['uri'] = 'home';
	}
	$this->load->view('pageview', $data);
  }


}
?>