<?php
class _model extends CI_model{

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

}
?>