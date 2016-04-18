<?
class Comments_model extends CI_Model{
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	function add_comment($whot,$whot_id,$text,$uid,$user_name,$user_mail,$parent_id=0,$date){
		$data = array(
			'id'	=>	'NULL',
			'parent_id'	=>	$parent_id,
			'date'	=>	$date,
			'whot'	=>	$whot,
			'whot_id'=>	$whot_id,
			'user_id'=>	$uid,
			'user_name'=>	$user_name,
			'user_mail'=>	$user_mail,
			'text'	=>	$text,
			'status'=>	'active'
		);
		$this->db->insert('comments',$data);
		return $this->db->insert_id();
	}
	
	function get_comments($whot,$whot_id){
		$query = $this->db->select('comments.*')->from('comments')->where('comments.status','active')->where('whot',$whot)->where('whot_id',$whot_id)->order_by('comments.date','DESC')->get();
		return $query->result();
	}
	
	function get_all_comments($start,$count){
		$query = $this->db->select('comments.*')->from('comments')->limit($count,$start)->order_by('comments.date','DESC')->get();//->join('users','users.id=comments.user_id')
		return $query->result();
	}
	
	function comments_count(){
		$query = $this->db->select('count(*) as "c"')->from('comments')->get();//->join('users','users.id=comments.user_id')
		$res = $query->result();
		return $res[0]->c;
	}
	
	function dell_comments($id){
		$this->db->where('id',$id)->update('comments',array('status'=>'dell'));
	}
	function dell_comments_forewer($id){
		$this->db->delete('comments',array('id'=>$id));
	}
	
	function get_child_comments($id){
		$query = $this->db->select('*')->from('comments')->where('parent_id',$id)->get();
		$res = $query->result();
		return $res;
	}
	
	function restore_comments($id){
		$this->db->where('id',$id)->update('comments',array('status'=>'active'));
	}
	
	function update_comments($id,$whot,$new_data){
		$this->db->where('id',$id)->update('comments',array($whot=>$new_data));
	}
	
	function update_comments_text($id,$new_data){
		$this->db->where('id',$id)->update('comments',array('text'=>$new_data));
	}
	
	function get_comment_info($id){
		$query = $this->db->select("*")->from("comments")->where('id',$id)->get();
		return $query->result();
	}
}
?>