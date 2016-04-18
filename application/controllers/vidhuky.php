<?php
class Vidhuky extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->library("session");
		$this->load->helper("str_helper");
        
        $this->load->model("comments_model");
	}
	function index($lang='ua'){
        header("Location:/lang/index/$lang");
	}
	function lang($lang='ua'){
		$data['title'] = "Готель ТуСтань";
		$data['user'] = $this->session->userdata('user');
		$data['type'] = "user";
		$data['lang'] = $lang;
		$this->lang->load('words', $lang);
		$data['page'] = "";
		$this->load->model('news_model');
		$data['news'] = $this->news_model->get_news($lang);
		if(isset($data['user'][0]['type'])){
			$data['type'] = $data['user'][0]['type'];
		}
		$this->load->view("/system/header_view",$data);
		$this->load->view("/vidhuky/vidhuky_view");
		$this->load->view("/system/footer_view");
	}
    
    
    
    public function add_comment(){
            
            $this->data['user'] = $this->session->userdata('user');
            
            if(isset($this->data['user'][0]->id)&&isset($this->data['user'][0]->login)&&isset($this->data['user'][0]->email)){
                $user_id = $this->data['user'][0]->id;
                $user_name = $this->data['user'][0]->login;
                $user_mail = $this->data['user'][0]->email;
            }else{
                $user_id = 0;
                $user_name = $this->session->userdata('not_login_user_name');
                if(strlen($user_name)==0){
                    $user_name = $this->input->post("user_name");
                    $this->session->set_userdata('not_login_user_name',$user_name);
                }
                $user_mail = $this->input->post("user_mail");
            }
            if(strlen($user_mail)<3){
                $user_mail = "notemail@thisua.com";
            }
            
            $text = $this->input->post("text");
            
            if((strlen($text)>1)&&(strlen($user_name)>2)&&(strlen($user_mail)>5)&&(filter_var($user_mail, FILTER_VALIDATE_EMAIL))){
                
                $parent_id = $this->input->post("parent_id");
                $id = $this->comments_model->add_comment($this->input->post("whot"),$this->input->post("whot_id"),$text,$user_id,$user_name,$user_mail,$parent_id,$this->input->post("date"));              
                
                $comments = $this->comments_model->get_comments($this->input->post("whot"),$this->input->post("whot_id"));
                $this->load->helper('comments_helper');
                update_comment($comments,$this->input->post("whot"),$this->input->post("whot_id"));
                
                
                echo $user_name."[%%%|%%%]".date("H:i:s d-m-Y")."[%%%|%%%]".$text;
            
            }else{
               
                $this->lang->load('comments',$this->input->post('lang'));
                echo $this->lang->line('comments_error');
            }
        
    }
    
    
    function dell_comments_forewer(){
        $data2 = $this->comments_model->get_comment_info($this->input->post('id'));
        $data['user'] = $this->session->userdata('user');
        if(($data2[0]->user_id==$data['user'][0]['id'])||($data['user'][0]['type']=='admin')){
            $del_comm_arr[]=$this->input->post('id');
            $n=true;
            while($n){
                foreach($del_comm_arr as $dca){
                    $child_comments = $this->comments_model->get_child_comments($dca);
                    if(count($child_comments)>0){
                        foreach($child_comments as $c){
                            if(!in_array($c->id,$del_comm_arr)){
                                $del_comm_arr[] = $c->id;
                            }
                        }
                    }else{
                        $n=false;
                    }
                }
            }
            foreach($del_comm_arr as $dca){
                $this->comments_model->dell_comments_forewer($dca);
            }
            $comments = $this->comments_model->get_comments($this->input->post("whot"),$this->input->post("whot_id"));
            $this->load->helper('comments_helper');
            update_comment($comments,$this->input->post("whot"),$this->input->post("whot_id"));
            echo 1;
        }else{
            echo 0;
        }
    }
    
    
    function update_comments(){
        $this->data['user'] = $this->session->userdata('user');
        $data = $this->comments_model->get_comment_info($this->input->post('id'));
        if(($data[0]->user_id==$this->data['user'][0]['id'])||($this->data['user'][0]['type']=='admin')){
            $this->comments_model->update_comments_text($this->input->post('id'),$this->input->post('new_data'));
            $comments = $this->comments_model->get_comments($this->input->post("whot"),$this->input->post("whot_id"));
            $this->load->helper('comments_helper');
            update_comment($comments,$this->input->post("whot"),$this->input->post("whot_id"));
        }
    }
    
    function sync_comments(){
        $comments = $this->comments_model->get_comments($this->input->post("whot"),$this->input->post("whot_id"));
        $this->load->helper('comments_helper');
        update_comment($comments,$this->input->post("whot"),$this->input->post("whot_id"));
    }
    

}
?>