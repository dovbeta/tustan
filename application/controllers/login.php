<?php
class Login extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->library('session');
    }

    function index(){
		$this->load->model("login_model");
		$login = $this->input->post("login");
		$pass  = $this->input->post("pass");
		$data['user'] = $this->login_model->login($login,$pass);
		$this->session->set_userdata($data);
        header("Location:/");
    }
	
	function logout(){
		 $this->session->sess_destroy();
		 header("Location:/");
	}
	
	function settings($lang='ua'){
		$data['title'] = "Готель ТуСтань";
		$data['user'] = $this->session->userdata('user');
		$data['type'] = "user";
		$data['lang'] = $lang;
		$data['page'] = '';
		$this->load->model("news_model");
		$data['news'] = $this->news_model->get_news($lang);
		$this->lang->load('words', $lang);
		if(isset($data['user'][0]['type'])){
			$data['type'] = $data['user'][0]['type'];
		}
        $this->load->view("/system/header_view",$data);
        $this->load->view("/system/settings_view");
        $this->load->view("/system/footer_view");
	}
	
	function change(){
		$this->load->model("login_model");
		$old_pass = $this->input->post("pass_old");
		$new_pass = $this->input->post("pass_new");
		$lang = $this->input->post("lang");
		$this->lang->load('words', $lang);
		if(strlen($new_pass)<2){
			$data['res'] = $this->lang->line("is_empty")." ".$this->lang->line("new")." ".$this->lang->line("pass"). "<br>";
		}else{
			$user = $this->session->userdata('user');
			$chek_user = $this->login_model->login($user[0]['login'],$old_pass);
			if(isset($chek_user[0])){
				$this->login_model->update_pass($chek_user[0]['id'],$new_pass);
				$data['res'] = $this->lang->line("pass")." ".$this->lang->line("changed")."<br>";
			}else{
				$data['res'] = $this->lang->line("not_true")." ".$this->lang->line("old")." ".$this->lang->line("pass"). "<br>";
			}
		}
		$data['title'] = "Готель ТуСтань";
		
		$data['user'] = $this->session->userdata('user');
		$data['type'] = "user";
		$data['lang'] = $lang;
		$data['page'] = '';
		$this->load->model("news_model");
		$data['news'] = $this->news_model->get_news($lang);
		$this->lang->load('words', $lang);
		if(isset($data['user'][0]['type'])){
			$data['type'] = $data['user'][0]['type'];
		}
        $this->load->view("/system/header_view",$data);
        $this->load->view("/system/settings_view",$data);
        $this->load->view("/system/footer_view");
	}
	
	function change_data(){
		$this->load->model("login_model");
		$name = $this->input->post("name");
		$tell = $this->input->post("tell");
		$lang = $this->input->post("lang");
		$this->lang->load('words', $lang);
		$data['user'] = $this->session->userdata('user');
		$is_u = $this->login_model->chek_register_user($tell);
		if(($data['user'][0]['tell']!=$tell)&&($is_u['c']>0)){
			$data['res'] = $this->lang->line("bad_tell")."<br>";
		}else{
			$this->login_model->update_data($data['user'][0]['id'],$name,$tell);
			$data['res'] = $this->lang->line("data")." ".$this->lang->line("changed")."<br>";
			$dt['user'] = $this->login_model->user_info($data['user'][0]['id']);
			$this->session->set_userdata($dt);
		}
		$data['user'] = $this->session->userdata('user');
		$data['title'] = "Готель ТуСтань";	
		$data['type'] = "user";
		$data['lang'] = $lang;
		$data['page'] = '';
		$this->load->model("news_model");
		$data['news'] = $this->news_model->get_news($lang);
		$this->lang->load('words', $lang);
		if(isset($data['user'][0]['type'])){
			$data['type'] = $data['user'][0]['type'];
		}
        $this->load->view("/system/header_view",$data);
        $this->load->view("/system/settings_view",$data);
        $this->load->view("/system/footer_view");
	}
}
?>