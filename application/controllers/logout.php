<?php
class Logout extends Controller {
  function __construct() {
    parent::Controller();
  }
  function index() {


	$this->session->unset_userdata('admin_id');
	redirect("");
  }

}
?>