<?php
class Login_model extends CI_model{

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

	function login($login,$pass){
		$select = "SELECT * FROM `ht_users` WHERE `login`='$login' and `pass`=md5('$pass')";
		$query = $this->db->query($select);
		$res = $query->result_array();
		return $res;
	}
	
	function user_info($id){
		$select = "SELECT * FROM `ht_users` WHERE `id`='$id'";
		$query = $this->db->query($select);
		$res = $query->result_array();
		return $res;
	}
	
	function chek_register_user($tell='',$login='',$firstname='',$lastname=''){
		$select = "SELECT count(*) as 'c' FROM `ht_users` WHERE 1 ";
		if(strlen($login)>1){
			$select.="and `login`='$login' ";
		}
		if(strlen($firstname)>1){
			$select.="and `firstname`='$firstname' ";
		}
		if(strlen($lastname)>1){
			$select.="and `lastname`='$lastname' ";
		}
		if(strlen($tell)>1){
			$select.="and `tell`='$tell' ";
		}
		$query = $this->db->query($select);
		$res = $query->result_array();
		return $res[0];
	}
	
	function create_user($login,$pass,$fname,$lname,$tell,$fax,$email){
		$data = array(
			'id'		=>	'NULL',
			'login'		=>	$login,
			'pass'		=>	md5($pass),
			'firstname'	=>	$fname,
			'lastname'	=>	$lname,
			'tell'		=>	$tell,
			'type'		=>	'user',
			'fax'		=>	$fax,
			'email'		=>	$email
		);
		$this->db->insert('ht_users',$data);
		return $this->db->insert_id();
	}
	
	function update_pass($id,$pass){
		$data['pass'] = md5($pass);
		$this->db->where('id', $id);
		$this->db->update('ht_users', $data); 
	}
	
	function update_data($id,$name,$tell){
		$data['firstname'] = $name;
		$data['tell'] = $tell;
		$this->db->where('id', $id);
		$this->db->update('ht_users', $data); 
	}
}
?>