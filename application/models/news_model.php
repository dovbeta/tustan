<?php
class News_model extends CI_model{

	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	function get_news($lang,$start='0',$count='3'){
		$select = "SELECT `ht_news`.`id`,`ht_news`.`title`,`ht_news`.`new`,`ht_news`.`date`,`ht_news`.`img`
			FROM  `ht_news` 
			inner join `ht_lang` on `ht_lang`.`id`=`ht_news`.`lang_id`
			WHERE  `ht_news`.`display` =  '1'
			AND  `name` =  '$lang'
			ORDER BY  `ht_news`.`date` DESC 
			LIMIT $start , $count";
		$query = $this->db->query($select);
		$res = $query->result_array();
		$select = "SELECT count(*) as 'c' 
			FROM  `ht_news` 
			inner join `ht_lang` on `ht_lang`.`id`=`ht_news`.`lang_id`
			WHERE  `ht_news`.`display` =  '1'
			AND  `name` =  '$lang'";
		$query = $this->db->query($select);
		$res['c'] = $query->result_array();
		return $res;
	}
	
	function get_new($id){
		$select = "SELECT `ht_news`.`id`,`ht_news`.`title`,`ht_news`.`new`,`ht_news`.`date`,`ht_news`.`img`
			FROM  `ht_news` 
			WHERE  `display` =  '1'
			and `id`='$id'";
		$query = $this->db->query($select);
		return $query->result_array();
	}
	
	function get_all_menu(){
		$select = "SELECT * 
			FROM  `ht_news` 
			ORDER BY  `ht_news`.`date` DESC ";
		$query = $this->db->query($select);
		return $query->result_array();
	}
	
	function add_news($img,$title,$new,$lang_id){
		$date = date("Y-m-d H:i");
		$data = array(
			'id'	=>	'NULL',
			'title'	=>	$title,
			'new'	=>	$new,
			'date'	=>	$date,
			'img'	=>	$img,
			'lang_id'	=>	$lang_id,
			'display'=>	'1'
		);
		$this->db->insert('ht_news',$data);
	}
	
	function dell_news($id){
		$this->db->delete('ht_news', array('id' => $id)); 
	}
	
	function edit_news($id,$title,$new,$img=''){
		$data = array(
            'title' => $title,
            'new' 	=> $new           
        );
		if(strlen($img)>2){
			$data['img'] = $img;
		}
		$this->db->where('id', $id);
		$this->db->update('ht_news', $data); 
	}
	
	

}
?>