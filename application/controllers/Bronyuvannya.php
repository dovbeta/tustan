<?php
class Bronyuvannya extends CI_Controller{

	function __construct(){
        parent::__construct();
        $this->load->library("session");
		$this->load->helper("str_helper");
    }

    function lang($lang){
        $data['title'] = "Готель ТуСтань";
		$data['user'] = $this->session->userdata('user');
		$data['type'] = "user";
		$data['lang'] = $lang;
		$data['page'] = "";
		$this->load->model("news_model");
		$data['news'] = $this->news_model->get_news($lang);
		$this->lang->load('words', $lang);
		if(isset($data['user'][0]['type'])){
			$data['type'] = $data['user'][0]['type'];
		}
        $this->load->view("/system/header_view",$data);
        $this->load->view("/Bronyuvannya/Bronyuvannya_view");
        $this->load->view("/system/footer_view");
    }
			
	function online_bron($lang='ua'){
		$this->load->model("login_model");
		$this->load->model("bronyuvannya_model");
		$this->lang->load('words', $lang);
		$data['result'] = '';
		$date_start = $this->input->post("date_start");
		if(!is_numeric($date_start[1])){
			$data['result'].= $this->lang->line("is_empty")." ".$this->lang->line("date_from"). "<br>";
		}
		$date_end = $this->input->post("date_end");
		if(!is_numeric($date_end[1])){
			$data['result'].= $this->lang->line("is_empty")." ".$this->lang->line("date_on"). "<br>";
		}
		if($date_end<$date_start){
			$data['result'].= $this->lang->line("encorrect_date")."<br>";
		}
		$one = $this->input->post("one");
		$two = $this->input->post("two");
		$result = $this->input->post("result");
		$name = $this->input->post("name");
		$fax = $this->input->post("fax");
		$email = $this->input->post("email");
		if(strlen($name)<1){
			$data['result'].= $this->lang->line("is_empty")." ".$this->lang->line("full_name"). "<br>";
		}
		if(strlen($email)<1){
			$data['result'].= $this->lang->line("is_empty")." ".$this->lang->line("email"). "<br>";
		}
		$tell  = $this->input->post("tell");
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
		
		$type_room  = $this->input->post("type_room");
		
		if(($one+$two)==$result){
		
			if(strlen($data['result'])<2){	
			
				$sql_date_start = to_sql_date($date_start);
				$sql_date_end =  to_sql_date($date_end);
				$user = $this->session->userdata('user');
				if(isset($user[0]['firstname'])){
					$uname = $user[0]['firstname']." ".$user[0]['lastname'];
					if(($name==($uname))&&($tell==$user[0]['tell'])){
						
						$this->bronyuvannya_model->create_bron($user[0]['id'],$type_room,$sql_date_start,$sql_date_end);
						$mess = "Користувач ".$user[0]['firstname']." ".$user[0]['lastname']." хоче забронювати номер типу:".$this->lang->line($type_room)."
	з $sql_date_start по $sql_date_end. 
	Контектні дані користувача:
		телефон:$tell
		електроний адрес:$email
		факс:$fax";
						$mess = iconv('UTF-8','windows-1251',$mess);
						include("./application/views/system/email.php");
						mail($emailadmin, "Нове бронювання!", $mess,"From:admin@hoteltustan.com.ua");
						$data['result'].= $this->lang->line("successful_bron")."<br>";
					}else{
						$data['result'].= $this->lang->line("bron_not_this_user")."<br>";
					}
				}else{
					$isr = $this->login_model->chek_register_user($tell);
					if($isr['c']>0){			
						$data['result'].= $this->lang->line('bron_is_reg')."<br>";
					}else{
						$fname='';
						$lname='';
						$p=1;
						for($i=0;$i<strlen($name);$i++){
							if($name[$i]==' '){
								$p=0;
							}else if($p==1){
								$fname.=$name[$i];
							}else{
								$lname.=$name[$i];
							}
						}
						$uid = $this->login_model->create_user($tell,'1111',$fname,$lname,$tell,$fax,$email);
						$this->bronyuvannya_model->create_bron($uid,$type_room,$sql_date_start,$sql_date_end);
						$mess = "Користувач $fname $lname хоче забронювати номер типу:".$this->lang->line($type_room)."
	з $sql_date_start по $sql_date_end. 
	Контектні дані користувача:
		телефон:$tell
		електроний адрес:$email
		факс:$fax";
						include("./application/views/system/email.php");
						$mess = iconv('UTF-8','windows-1251',$mess);
						mail($emailadmin, "Нове бронювання!", $mess,"From:admin@hoteltustan.com.ua");
						$data['result'].= $this->lang->line("successful_bron")." <br>". 
							$this->lang->line("successful_reg_user")."<br>".
							$this->lang->line("login").": $tell<br>".
							$this->lang->line("pass").": 1111";
					}
				}
			}
			
			
		}else{
			$data['result'].= "$one  + $two ".$this->lang->line('bron_is_reg')." $result <br>";
		}
		$data['title'] = "Готель ТуСтань";
		$data['user'] = $this->session->userdata('user');
		$data['type'] = "user";
		$data['lang'] = $lang;
		$data['page'] = "";
		$this->load->model("news_model");
		$data['news'] = $this->news_model->get_news($lang);
		$this->lang->load('words', $lang);
		if(isset($data['user'][0]['type'])){
			$data['type'] = $data['user'][0]['type'];
		}
        $this->load->view("/system/header_view",$data);
        $this->load->view("/Bronyuvannya/Bronyuvannya_view");
        $this->load->view("/system/footer_view");
		
	}	

}
?>