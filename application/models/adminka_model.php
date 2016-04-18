<?php
class Adminka_model extends CI_model{

    function __construct(){
        parent::__construct();
        $this->load->database();
    }
	
	function get_menu($lang='1'){
		$select = "SELECT `ht_menu`.`id`,`ht_menu`.`name`,`ht_menu`.`href`,`ht_menu`.`lang_id`,`ht_lang`.`name` as 'lang'
		FROM `ht_menu` 
		inner join `ht_lang` on `ht_lang`.`id`=`ht_menu`.`lang_id`
		WHERE `ht_menu`.`display`='1' and `ht_lang`.`id`='$lang'
		order by `ht_menu`.`id` ASC";
		$query = $this->db->query($select);
		$res = $query->result_array();
		return $res;
	}
	
	function get_all_menu(){
		$select = "SELECT `ht_lang`.`name` as 'lang',`ht_menu`.`id`,`ht_menu`.`name`,`ht_menu`.`href`,`ht_menu`.`lang_id`,`ht_menu`.`display`    
		FROM `ht_menu` 
		inner join `ht_lang` on `ht_lang`.`id`=`ht_menu`.`lang_id`
		WHERE 1";
		$query = $this->db->query($select);
		$res = $query->result_array();
		return $res;
	}
	
	function get_lang(){
		$select = "SELECT * FROM `ht_lang` WHERE display='1'";
		$query = $this->db->query($select);
		$res = $query->result_array();
		return $res;
	}
	
	function get_all_lang(){
		$select = "SELECT * FROM `ht_lang` WHERE 1";
		$query = $this->db->query($select);
		$res = $query->result_array();
		return $res;
	}
	
	function add_lang($lang,$img=''){
		$data = array(
			'id'		=>	'NULL',
			'name'		=>	$lang,
			'img'		=>	$img,
			'display'	=>	1
		);
		$this->db->insert('ht_lang', $data); 
		return $this->db->insert_id();
	}
	
	function edit_lang($id,$name,$vis,$img){
		$data['name'] = $name;
		$data['display'] = $vis;
		if(strlen($img)>2){
			$data['img'] = $img;
		}
		$this->db->where('id', $id);
		$this->db->update('ht_lang', $data); 
	}
	function dell_lang($id){
		$this->db->delete('ht_lang', array('id' => $id)); 
	}
	
	function edit_menu($id,$name,$display,$path='none',$nid='none'){
		$select = "SELECT count(*) as 'c' FROM `ht_menu` WHERE `id`='$nid'";
		$query = $this->db->query($select);
		$res = $query->result_array();
		if($res[0]['c']==0){
			$select = "UPDATE `ht_menu` SET 
			`name` = '$name', 
			`display` = '$display'";
			if($path!='none'){
				$select.=",`href`='$path'";
			}
			if($nid!='none'){
				$select.=",`id`='$nid'";			
			}
			$select.="WHERE `id` = '$id'";
			$query = $this->db->query($select);
		}else{
			$data['id'] = 0;
			$this->db->where('id', $nid);
			$this->db->update('ht_menu', $data); 
			unset($data);
			$data['name'] = $name;
			$data['display'] = $display;
			if($path!='none'){
				$data['href'] = $path;
			}
			$data['id'] = $nid;
			$this->db->where('id', $id);
			$this->db->update('ht_menu', $data); 
			unset($data);
			$data['id'] = $id;
			$this->db->where('id', '0');
			$this->db->update('ht_menu', $data); 
		}
	}
	
	function add_menu($name,$path,$lang='1'){
		$data = array(
               'id' => 'NULL' ,
               'name' => $name ,
               'href' => $path ,
			   'lang_id' => $lang ,
			   'display' => '1'
            );

		$this->db->insert('ht_menu', $data); 
		return $this->db->insert_id();
	}
	
	function dell_menu($id){
		$this->db->delete('ht_menu', array('id' => $id)); 
	}
	
	function dell_user($id){
		$this->db->delete('ht_users', array('id' => $id)); 
	}
	
	function dell_bron($id){
		$this->db->delete('ht_bron', array('id' => $id)); 
	}
	
	function get_bron($start='0',$count='30'){
		$select = "SELECT `type_room` , `start_date` , `end_date` , `firstname` , `lastname` , `tell`,`ht_bron`.`id`
				FROM `ht_bron`
				INNER JOIN `ht_users` ON `ht_users`.`id` = `user_id`
				WHERE `status` = '1'
				ORDER BY `ht_bron`.`start_date` DESC
				LIMIT $start , $count";
		$query = $this->db->query($select);
		$res = $query->result_array();
		return $res;
	}
	
	function get_user(){
		$select = "SELECT * FROM `ht_users`";
		$query = $this->db->query($select);
		$res = $query->result_array();
		return $res;
	}

}
?>