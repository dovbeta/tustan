<?php
class News extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->library('session');
    }

    function index(){
		header("Location:/lang/index/ua");
    }
	
	function show_news($lang='ua',$id){
		$data['title'] = "Готель ТуСтань";
		$data['user'] = $this->session->userdata('user');
		$data['type'] = "user";
		$data['lang'] = $lang;
		$data['page'] = '';
		$this->load->model("news_model");
		$data['news'] = $this->news_model->get_news($lang);
		$data['new'] = $this->news_model->get_new($id);
		$this->lang->load('words', $lang);
		if(isset($data['user'][0]['type'])){
			$data['type'] = $data['user'][0]['type'];
		}
        $this->load->view("/system/header_view",$data);
		$this->load->view("/system/show_news_view",$data);
		$this->load->view("/system/footer_view");
	}
	
	function edit_form($lang='ua',$id){
		$data['title'] = "Готель ТуСтань";
		$data['user'] = $this->session->userdata('user');
		$data['type'] = "user";
		$data['lang'] = $lang;
		$data['page'] = '';
		$data['id'] = $id;
		$this->load->model("news_model");
		$data['news'] = $this->news_model->get_news($lang);
		$data['new'] = $this->news_model->get_new($id);
		$this->lang->load('words', $lang);
		if(isset($data['user'][0]['type'])){
			$data['type'] = $data['user'][0]['type'];
		}
        $this->load->view("/system/header_view",$data);
		$this->load->view("/system/news_edit_view",$data);
		$this->load->view("/system/footer_view");
	}
	
	function edit_news(){
		$config['upload_path'] = './images/news/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '3000';
		$config['max_width']  = '4024';
		$config['max_height']  = '3768';			
		$this->load->library('upload', $config);
		$this->upload->do_upload();	
		$data = $this->upload->data();				
		$title = $this->input->post("title");
		$news = $this->input->post("news");
		$id = $this->input->post("id");
		$this->load->model("news_model");		
		$this->news_model->edit_news($id,$title,$news,$data['file_name']);				
		header("Location:/");
			
	}
	
	function dell_news(){
		$id = $this->input->post("nid");
		$this->load->model("news_model");
		$this->news_model->dell_news($id);
		
	}
	
	function get_news($lang='ua',$start='0'){
		$this->load->model("news_model");
		$data['lang'] = $lang;
		$data['news'] = $this->news_model->get_news($lang,$start);
		$this->load->view("/system/content_news_view",$data);
	}
	

}
?>