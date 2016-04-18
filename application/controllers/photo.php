<?
class Photo extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
        $this->load->library("session");
        
        
        $this->data['user'] = $this->session->userdata('user');
        
		if(!isset($this->data['user'][0]['type'])){
            header('Location:/user/login_form');
        }else if($this->data['user'][0]['type']!='admin'){
            header('Location:/user/login_form');
        }
	}
	
     
    
	public function photo_info($album='none'){
		$xml = xml_parser_create();    
		xml_parser_set_option($xml, XML_OPTION_SKIP_WHITE, 1); 
		xml_parse_into_struct($xml, file_get_contents("components/upload_images_v_1_0_1.xml"), $element, $index);
		xml_parser_free($xml);  
		$data['name'] = $element[$index['NAME'][0]]['value']; 
		$data['version'] = $element[$index['VERSION'][0]]['value']; 
		$this->load->model('album_model');
		$data['album'] = $this->album_model->get_album();
		$data['select_album'] = $album;
		$this->load->view('/adminka/photo_view',$data);
	}
	
	function chek_updates(){
		$xml = xml_parser_create();    
		xml_parser_set_option($xml, XML_OPTION_SKIP_WHITE, 1); 
		xml_parse_into_struct($xml, file_get_contents("http://iterum.com.ua/xml/components_list.xml"), $element, $index);
		xml_parser_free($xml); 
		for($j=0;$j<count($index["COMPONENT"])/2;$j++){
			if(($element[$index['NAME'][$j]]['value']==$this->input->post("name"))){
				if($element[$index['VERSION'][$j]]['value']>$this->input->post("version")){
					$update_path = $element[$index['PATH'][$j]]['value'];
				}
			}
		}
		if(isset($update_path)){
			Header("Location: /adminka/components/install_component/".str_replace("/","%7C",$update_path));
		}else{
			echo "no update";
		}
	}
	
	function photo_view($album='none'){
		$this->load->model('album_model');
		$tmp['album'] = $this->album_model->get_album();
		$tmp['select_album'] = $album;
		$this->load->view('/adminka/photo_view',$tmp);
	}
	
	function load_form($album='none',$whot_id='',$lang='ua'){
		$this->lang->load('photo',$lang);
		$this->load->view('/adminka/load_photo_form_view',array('album'=>$album,'whot_id'=>$whot_id,'lang'=>$lang));
	}
	
	function upload_images($album='none',$whot_id='',$lang='ua'){
		$this->lang->load('photo',$lang);
		$path = "./images/upload/".date("Y_m_d")."/";
		if(!file_exists($path)){
			mkdir($path);
		}
		$path = "./images/upload/".date("Y_m_d")."/".rand(10,55)."/";
		if(!file_exists($path)){
			mkdir($path);
		}
		
		$images = $this->upload($path);
		$i=0;
		foreach($images as $img){
			if($img['size']>2097152){
				$img_res[$i]['original'] = $this->resize($path,$img['name'],$img['type'],'',850,850);
			}else{
				$img_res[$i]['original'] = substr($path,1).$img['name'].$img['type'];
			}

			$img_res[$i]['500'] = $this->resize($path,$img['name'],$img['type'],'small500',500,500);
			$img_res[$i]['250'] = $this->resize($path,$img['name'],$img['type'],'small250',250,250);
			
			
			$i++;
		}
		$this->load->view('/adminka/upload_success_view',array('images'=>$img_res,'whot_id'=>$whot_id,'alt'=>$this->input->post('alt')));
		
	}
	

	function upload($path){
		for($i=0;$i<count($_FILES['file']['tmp_name']);$i++){
			$type = '.jpg';
			switch($_FILES['file']['type'][$i]){
				case 'image/jpeg': $type='.jpg';
				case 'image/bmp': $type='.bmp';
				case 'image/png': $type='.png';
				case 'image/gif': $type='.gif';
			}
			$file_name = md5($_FILES['file']['name'][$i]).rand(1110,9990).date("i_s_H");
			if(move_uploaded_file($_FILES['file']['tmp_name'][$i],$path.$file_name.$type)) {
				$result[$i]['name'] = $file_name;
				$result[$i]['size'] = $_FILES['file']['size'][$i];
				$result[$i]['type'] = $type;
			}
		}
		return $result;
	}
	
	function resize($path,$img_name,$img_ext,$sub_name,$width,$height){
		$this->load->library("image_lib");
		$config['image_library'] = 'gd2';
		$config['source_image']	= $path.$img_name.$img_ext;
		$config['create_thumb'] = FALSE;
		$config['maintain_ratio'] = TRUE;
		$config['master_dim'] = 'width';
		$config['width']	 = $width;
		$config['height']	= $height;
		$config['new_image']	= $path.$sub_name.$img_name.$img_ext;
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
		return substr($path,1).$sub_name.$img_name.$img_ext;
	}
				
	function watermark($path_to_img,$text){
		$this->load->library("image_lib");
		$configs['source_image']	= $path_to_img;
		$configs['wm_text'] = $text;
		$configs['wm_type'] = 'text';
		$configs['wm_font_path'] = './css/STACKZ.TTF';
		$configs['wm_font_size']	= '16';
		$configs['wm_font_color'] = 'ffffff';
		$configs['wm_vrt_alignment'] = 'top';
		$configs['wm_hor_alignment'] = 'right';
		$configs['wm_hor_offset'] = '-25';
		$this->image_lib->initialize($configs); 
		$this->image_lib->watermark();
	}
}
	

?>