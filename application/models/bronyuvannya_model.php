<?php
class Bronyuvannya_model extends CI_model{

	function __construct(){
        parent::__construct();
        $this->load->database();
    }
	
	function create_bron($id,$type_room,$date_start,$end_date){
		$data = array(
			'id'		=>	'NULL',
			'user_id'	=>	$id,
			'type_room'	=>	$type_room,
			'start_date'=>	$date_start,
			'end_date'	=>	$end_date,
			'status'	=> 	'1'
		);
		$this->db->insert('ht_bron',$data);
	}
	
}?>