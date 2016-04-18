<?php
class File_work extends CI_Controller{

    function __construct(){
        parent::__construct();
    }

    function index(){

    }

    function save(){
        $file_name = $this->input->post("ids");
        $data = $this->input->post("data");
        $lang = $this->input->post("lg");
		$file = fopen("application/views/".$file_name."/content_".$file_name."_".$lang."_view.php", "w");
        fwrite ($file, $data);
        echo "content_".$file_name."_".$lang."_view.php";
    }



}