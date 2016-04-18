<?php
    function save_to_file($file_name,$data){
        $file = fopen("application/$file_name", "w");
        fwrite ($file, $data);
    }
	
	
	function rdir ($whot,$more,$fl=true,$fd=false,$path2dir='application/views/') {
			$d = dir($path2dir);  
			while (false !== ($entry = $d->read())) {  
				if ($entry!='.' && $entry!='..' && $entry!='' ) {
					$all_path = $path2dir.$entry;	
					if(!is_file($all_path)){  
						$all_path = $all_path.'/';  
						if($fd){
							$new_name_path = $path2dir.str_replace($whot,$more,$entry);		
						}
					}else{	
						if($fl){
							$new_name_path = $path2dir.str_replace($whot,$more,$entry);				
						}
					}
					$new_path = $all_path;
					if (!is_file($all_path)) {
						if (!rdir($whot,$more,$fl,$fd,$new_path)) {	
							return false;
						}
					}
					if(isset($new_name_path)){
						//echo $new_name_path."<br>";
						//echo $all_path." -> ".$new_name_path."<br>";
						//echo $all_path[strlen($all_path)-1]." $all_path<br>";
						if($all_path[strlen($all_path)-1]==$new_name_path[strlen($new_name_path)-1]){
							rename($all_path,$new_name_path);	
						}
						if($fd){
							rename($all_path,$new_name_path);
						}
					}
				}
				
			}
			return true;
	}
	
	function create_view($name,$lang='ua',$content=''){
		$name = strtolower($name);
		if(!file_exists("application/views/".$name)){
			mkdir("application/views/".$name);
		}
		if(!file_exists("application/views/".$name."/content_".$name."_".$lang."_view.php")){	
			$file = fopen("application/views/".$name."/content_".$name."_".$lang."_view.php", "w");
			fwrite ($file, $content);
		}
              
	}
	
	function create_page($name,$content='',$langs){
		
		/*if(!file_exists("application/controllers/".$name.".php")){
			touch("application/controllers/".$name.".php");
		}
        if(!file_exists("application/models/".$name."_model.php")){
			touch("application/models/".$name."_model.php");
		}    */   
		foreach($langs as $l){
			 create_view($name,strtolower($l['name']),$content);
		}
		if(!file_exists("application/views/".$name."/".$name."_view.php")){
			$file = fopen("application/views/".$name."/".$name."_view.php", "w");
			$view = '
			<?if($type==\'admin\'){?>
			<?$d[\'elm\']=\''.$name.'\';?>
			<?$this->load->view("/system/admin_edit",$d);?>
			<?}?>
			<div class="content_title"><?=$page?></div>
					<div class="menu_decor" align=center>
					 <img src="/images/button_separator_gold.png" width=30%>
					</div>
			<div id="block_'.$name.'">
			<?$this->load->view("/'.$name.'/content_'.$name.'_".$lang."_view")?></div>';
			fwrite ($file, $view);
		} 
        $new_name = ucwords($name);
		if(!file_exists("application/controllers/".$name.".php")){
			$file = fopen("application/controllers/$name.php", "w");
			$controller = '<?php
class '.$new_name.' extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->library("session");
		$this->load->helper("str_helper");
	}
	function index($lang=\'ua\'){
        header("Location:/lang/index/$lang");
	}
	function lang($lang=\'ua\'){
		$data[\'title\'] = "Готель ТуСтань";
		$data[\'user\'] = $this->session->userdata(\'user\');
		$data[\'type\'] = "user";
		$data[\'lang\'] = $lang;
		$this->lang->load(\'words\', $lang);
		$data[\'page\'] = "";
		$this->load->model(\'news_model\');
		$data[\'news\'] = $this->news_model->get_news($lang);
		if(isset($data[\'user\'][0][\'type\'])){
			$data[\'type\'] = $data[\'user\'][0][\'type\'];
		}
		$this->load->view("/system/header_view",$data);
		$this->load->view("/'.$name.'/'.$name.'_view");
		$this->load->view("/system/footer_view");
	}

}
?>';
			fwrite ($file, $controller);
		}
        
		if(!file_exists("application/models/".$name."_model.php")){
			$file = fopen("application/models/".$name."_model.php", "w");
			$model = '<?php
class '.$new_name.'_model extends CI_model{

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

}
?>';
			fwrite ($file, $model);
		}
        
	}
?>