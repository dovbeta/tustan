<?php
class Dryzi_model extends CI_model{

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

}
?>