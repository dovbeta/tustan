<?php
class Registration extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->library("session");
		$this->load->helper("str_helper");
	}

	function lang($lang='ua'){
		$data['title'] = "Готель ТуСтань";
		$data['user'] = $this->session->userdata('user');
		$data['type'] = "user";
		$data['lang'] = $lang;
		$this->lang->load('words', $lang);
		$data['page'] = "";
		$this->load->model("news_model");
		$data['news'] = $this->news_model->get_news($lang);
		if(isset($data['user'][0]['type'])){
			$data['type'] = $data['user'][0]['type'];
		}
		$this->load->view("/system/header_view",$data);
		$this->load->view("/system/registration_view");
		$this->load->view("/system/footer_view");
	}
	
	function registr($lang='ua'){
		$this->load->model("login_model");
		$this->lang->load('words', $lang);
		$data['result'] = '';
		$login = $this->input->post("login");
		if(strlen($login)<1){
			$data['result'].= $this->lang->line("is_empty")." ".$this->lang->line("login"). "<br>";
		}
		$pass = $this->input->post("pass");
		if(strlen($pass)<1){
			$data['result'].= $this->lang->line("is_empty")." ".$this->lang->line("pass"). "<br>";
		}
		$full_name = $this->input->post("full_name");
		if(strlen($full_name)<1){
			$data['result'].= $this->lang->line("is_empty")." ".$this->lang->line("full_name"). "<br>";
		}
		$email = $this->input->post("email");
		if(strlen($full_name)<1){
			$data['result'].= $this->lang->line("is_empty")." ".$this->lang->line("email"). "<br>";
		}
		$tell = $this->input->post("phone_number");
		if(strlen($tell)<1){
			$data['result'].= $this->lang->line("is_empty")." ".$this->lang->line("phone_number"). "<br>";
		}
		//echo $tell."<br>";
		$tell = str_replace(" ","",$tell); 
		$tell = str_replace("-","",$tell); 
		$tell = str_replace("+","",$tell); 
		$tell = str_replace("(","",$tell); 
		$tell = str_replace(")","",$tell); 
		//echo $tell." ".strlen($tell)."<br>";
		if((strlen($tell)<=4) || (strlen($tell)>=15) || (!is_numeric($tell))) {
			$data['result'].= $this->lang->line("bad_phone"). "<br>";	
			
		}
		$one = $this->input->post("one");
		$two = $this->input->post("two");
		$fax = $this->input->post("fax");
		$result = $this->input->post("result");

		if(($one+$two)==$result){
			if(strlen($data['result'])<2){
				$isr = $this->login_model->chek_register_user($tell);
				if($isr['c']>0){			
					$data['result'].= $this->lang->line('bron_is_reg')."<br>";
				}else{
					$fname='';
					$lname='';
					$p=1;
					for($i=0;$i<strlen($full_name);$i++){
						if($full_name[$i]==' '){
							$p=0;
						}else if($p==1){
							$fname.=$full_name[$i];
						}else{
							$lname.=$full_name[$i];
						}
					}
					$this->login_model->create_user($login,$pass,$fname,$lname,$tell,$fax,$email);
					$data['result'].= $this->lang->line("successful_reg_user")."<br>".
							$this->lang->line("login").": $login<br>".
							$this->lang->line("pass").": $pass";
				}
			}
		}else{
			$data['result'].= "$one  + $two ".$this->lang->line('not_equal')." $result <br>";
		}
		$data['title'] = "Готель ТуСтань";
		$data['user'] = $this->session->userdata('user');
		$data['type'] = "user";
		$data['lang'] = $lang;
		$this->lang->load('words', $lang);
		$data['page'] = "";
		$this->load->model("news_model");
		$data['news'] = $this->news_model->get_news($lang);
		if(isset($data['user'][0]['type'])){
			$data['type'] = $data['user'][0]['type'];
		}
		$this->load->view("/system/header_view",$data);
		$this->load->view("/system/registration_view");
		$this->load->view("/system/footer_view");
	}

}
?>