<?php
class Ob_otele extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->library("session");
		$this->load->helper("str_helper");
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
		$this->load->view("/ob_otele/ob_otele_view");
		$this->load->view("/system/footer_view");
	}

}
?>