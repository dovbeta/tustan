<?php
class Adminka extends CI_Controller{

            function __construct(){
                parent::__construct();
                $this->load->library("session");
				$this->load->helper("str_helper");
				$this->load->helper("file_helper");
            }

            function index($lang='ua'){
                $data['title'] = "adminka";
				$data['user'] = $this->session->userdata('user');
				$data['type'] = "user";
				$data['lang'] = "ua";
				$this->load->model("news_model");
				$data['news'] = $this->news_model->get_news($lang);
				$this->load->model("adminka_model");
				$data['langs'] = $langs = $this->adminka_model->get_lang();
				if(isset($data['user'][0]['type'])){
					$data['type'] = $data['user'][0]['type'];
				}
                $this->load->model('comments_model');
                $data['comments_count'] = $this->comments_model->comments_count();
                $data['comments'] = $this->comments_model->get_all_comments(0,100);
                $this->load->view("/system/header_view",$data);
                $this->load->view("/system/adminka_view",$data);
                $this->load->view("/system/footer_view");
            }
			function set_mail(){
				$email = $this->input->post("email");
				$file = fopen("application/views/system/email.php", "w");
				$data = '<? $emailadmin = \''.$email.'\'; ?>';
				fwrite ($file, $data);
				header("Location:/");
			}
			
			function update_menu($lang,$lid){
					$menu = $this->adminka_model->get_menu($lid);
					$file_data = '';		
					for($i=0;$i<count($menu);$i++){
						$file_data.="<img src='/images/button_separator_norm.png' class=menu_separator id='menu_separator_".((($i+1)*2)-2)."'>";
						$file_data.="<div class='menu_item' onmouseover='mouseOver(".((($i+1)*2)-1).")' onmouseout='mouseLeave(".((($i+1)*2)-1).")'>";
						$file_data.="<a href='/".$menu[$i]['href']."/lang/".strtolower($menu[$i]['lang'])."'>".$menu[$i]['name']."</a>";
						$file_data.="</div>";
						if($i==count($menu)-1){
							$file_data.="<img src='/images/button_separator_norm.png' class='menu_separator' id='menu_separator_".(($i+1)*2)."'>";
							
						}
					}
					$file = fopen("application/views/system/menu_item_".$lang."_view.php", "w");
					fwrite ($file, $file_data);
			}
			
			function add_lang(){
				$lang = $this->input->post("lang");
				$this->load->model("adminka_model");
				$langs = $this->adminka_model->get_all_lang();
				$iss=false;
				foreach($langs as $l){
					if($l['name']!=$lang){
						$iss=true;
					}
				}
				if($iss){
					$lid = $this->adminka_model->add_lang(translitIt_to_eng($lang));
					$this->update_lang();
					$this->update_menu(strtolower($lang),$lid);
					if(!file_exists("application/language/".$lang)){
						mkdir("application/language/".$lang);
					}
					if(!file_exists("application/language/".$lang."/words_lang.php")){	
						$file = fopen("application/language/".$lang."/words_lang.php", "w");
						fwrite ($file, "<?php
						
?>");
					}
				}
				header("Location:/");
			}
			
			function update_lang(){
				$langs = $this->adminka_model->get_lang();
				$file_data='';
				for($i=0;$i<count($langs);$i++){
					$file_data.="<a href='/lang/index/".strtolower($langs[$i]['name'])."'><img class='lang' src='/images/lang/".strtolower($langs[$i]['img'])."' alt='' width='20px' height='15px'>".strtoupper($langs[$i]['name'])."</a>";
					if($i<(count($langs)-1)){
						$file_data.=" | ";
					}
				}
				$file = fopen("application/views/system/lang_view.php", "w");
				fwrite ($file, $file_data);
			}
			
			function add_menu(){
				$this->load->model("adminka_model");
				$name = $this->input->post("name");
                $path = $this->input->post("path");
				$s_lang = $this->input->post("lang");
				$view_name = $name;
				$name = translitIt_to_eng($name);
				$name = strtolower($name);
				$wh = array("-","!","@","#",",","."," ","%","^","&","*","(",")","?","<",">","|","`","~");
				$name = str_replace($wh,"_",$name);
				$lang = $this->adminka_model->get_lang();
				$c=0;
			
				if(strlen($path)<2){
					$path=$name;
					$c=1;
				}
				
				foreach($lang as $l){
					if($s_lang==$l['name']||$s_lang=='all'){
					    $this->adminka_model->add_menu($view_name,$path,$l['id']);
					    $this->update_menu(strtolower($l['name']),$l['id']);
                    }
				}
				if($c==1){	
					$this->add_page($name);	
					
				}
				header("Location:/");
				
					
			}
			
			function add_page($name=''){
				if(strlen($name)<2){
					$name = $this->input->post("name");
				}
				$name = translitIt_to_eng($name);
				$name = strtolower($name);
				$wh = array("-","!","@","#",",","."," ","%","^","&","*","(",")","?","<",">","|","`","~");
				$name = str_replace($wh,"_",$name);
				$this->load->model("adminka_model");
				$lang = $this->adminka_model->get_lang();
				create_page($name,'',$lang);	
				$data['title'] = "adminka";
				$data['user'] = $this->session->userdata('user');
				$data['type'] = "user";
				$data['lang'] = "ua";
				$data['res'] = $name." - шлях до створеної сторінки";
				$this->load->model("news_model");
				$data['news'] = $this->news_model->get_news('ua');
				if(isset($data['user'][0]['type'])){
					$data['type'] = $data['user'][0]['type'];
				}
                $this->load->view("/system/header_view",$data);
                $this->load->view("/system/adminka_view",$data);
                $this->load->view("/system/footer_view");
				//header("Location:/");
			}
			
			function add_view($lang='ua'){
				$name = $this->input->post("name");
				$lang = $this->input->post("lang");
				$name = translitIt_to_eng($name);
				create_view($name,$lang);	
				header("Location:/");
			}
			
			function get_menu(){
				$this->load->model("adminka_model");
				$data['menu'] = $this->adminka_model->get_all_menu();
				$this->load->view("/system/admins/menu_edit_view",$data);
			}
			
			function edit_menu(){
				$this->load->model("adminka_model");
				$menu = $this->adminka_model->get_all_menu();
				foreach($menu as $m){
					$tmp_name = $this->input->post("name".$m['id']);
					$tmp_display = $this->input->post("display".$m['id']);
					$tmp_id = $this->input->post("id".$m['id']);
					
					if(($m['name']!=$tmp_name)||($m['display']!=$tmp_display)||($m['id']!=$tmp_id)){
						if($m['id']!=$tmp_id){
							$t = $this->adminka_model->edit_menu($m['id'],$tmp_name,$tmp_display,'none',$tmp_id);
						}else{
							$t = $this->adminka_model->edit_menu($m['id'],$tmp_name,$tmp_display,'none');
						}

					}
				}
				$lang = $this->adminka_model->get_lang();
				foreach($lang as $l){
					$this->update_menu(strtolower($l['name']),$l['id']);
				}
				header("Location:/");
			}
			
			function dell_menu(){
				$this->load->model("adminka_model");
				$id = $this->input->post("mid");
				$this->adminka_model->dell_menu($id);
				$lang = $this->adminka_model->get_lang();
				foreach($lang as $l){
					$this->update_menu(strtolower($l['name']),$l['id']);
				}
				$this->get_menu();
			}
			
			function add_news(){
			
						
					$title = $this->input->post("title");
					$new = $this->input->post("new");
					$this->load->model("news_model");	
					$this->load->model("adminka_model");
					$lang = $this->adminka_model->get_lang();	
					foreach($lang as $l){	
						$this->news_model->add_news($this->input->post('photo'),$title,$new,$l['id']);
					}					
					header("Location:/");
					
		
			}
			
			function add_photo(){
			    ini_set("memory_limit", "32M");
				$config['upload_path'] = './images/news/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '8000';
				$config['max_width']  = '8024';
				$config['max_height']  = '8068';			
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload()){
					$error = array('error' => $this->upload->display_errors());
					print_r($error);
				}	
				else{
					$dt = $this->upload->data();	
                    unset($config);
                    $this->load->library("image_lib");
                    $config['image_library'] = 'gd2';
                    $config['source_image']    = "./images/news/".$dt['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['master_dim'] = 'width';
                    $config['width']     = 800;
                    $config['height']    = 600;
                    $config['new_image']    = "./images/news/small_".$dt['file_name'];
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();			
					$data['res'] = "шлях до фото: /images/news/".$dt['file_name']."<br>фото зменшене: /images/news/small_".$dt['file_name'];
					
					$data['title'] = "adminka";
					$data['user'] = $this->session->userdata('user');
					$data['type'] = "user";
					$data['lang'] = "ua";
					$this->load->model("news_model");
					$data['news'] = $this->news_model->get_news('ua');
					if(isset($data['user'][0]['type'])){
						$data['type'] = $data['user'][0]['type'];
					}
					$this->load->view("/system/header_view",$data);
					$this->load->view("/system/adminka_view",$data);
					$this->load->view("/system/footer_view");
				}	
		
			}
			
			function get_news(){
				$this->load->model("news_model");
				$lang = $this->adminka_model->get_lang();
				$out="<form action='/adminka/edit_news' method='post' enctype='multipart/form-data'/><table>";
				foreach($lang as $l){
					$news = $this->news_model->get_news(strtolower($l['name']),0,30);
					foreach($news as $n){
					$out.="<tr>
					<td><img src='/images/news/".$n['img']."' width='55px'><input type='file' size='1' name='userfile".$n['id']."'></td>
					<td><input type='text' name='title".$n['id']."' value='".$n['title']."'></td>
					<td><textarea cols='50'  name='new".$n['id']."' rows='13'>".$n['new']."</textarea></td> 
					<td>
						<select name='lang".$n['id']."'>";
							foreach($lang as $lg){
								$out.="<option";
								if($n['lang']==$lg['name']){
									$out.=" selected='selected' ";
								}
								$out.= "value='".strtolower($lg['name'])."'>".$lg['name']."</option>";
							}		
						$out.= "</select>
					</td>
					<td><span style='color:red;cursor:pointer' onclick='dell_elm_news(".$n['id'].")'>видалити</span></td>
					</tr>";
					}
				}
				$out.="<tr><td><input type='submit' value='зберегти зміни'></td></tr></table></form>";
				echo $out;
			}
			
			function dell_news(){
				$this->load->model("news_model");
				$id = $this->input->post("nid");
				$this->news_model->dell_news($id);
				$this->get_news();
			}
			
			/*function edit_news(){
				$this->load->model("news_model");
				$menu = $this->news_model->get_all_menu();
				foreach($menu as $m){
					$tmp_name = $this->input->post("name".$m['id']);
					$tmp_display = $this->input->post("display".$m['id']);
					if(($m['name']!=$tmp_name)||($m['display']!=$tmp_display)){
						$this->news_model->edit_menu($m['id'],$tmp_name,$tmp_display);
					}
				}
				$lang = $this->adminka_model->get_lang();
				foreach($lang[0] as $l){
					$this->update_menu(strtolower($l['name']));
				}
				header("Location:/");
			}*/

			
			function get_bron($start='0',$count='30'){
				$this->load->model("adminka_model");
				$data['bron'] = $this->adminka_model->get_bron($start,$count);
				$this->load->view("/system/admins/bron_view",$data);
				
			}
			
			function get_user(){
				$this->load->model("adminka_model");
				$data['user'] = $this->adminka_model->get_user();
				$this->load->view("/system/admins/user_view",$data);
				
				
			}
			
			function get_lang(){
				$this->load->model("adminka_model");
				$data['lang'] = $this->adminka_model->get_all_lang();
				$this->load->view("/system/admins/lang_edit_view",$data);
			}
			
			function edit_lang(){
				$this->load->model("adminka_model");
				$lang = $this->adminka_model->get_all_lang();
				foreach($lang as $l){	
					$config['upload_path'] = './images/lang/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']	= '3000';
					$config['max_width']  = '4024';
					$config['max_height']  = '3768';			
					$this->load->library('upload', $config);
					if($this->upload->do_upload("userfile".$l['id'])){
						$dt = $this->upload->data();
						$img = $dt['file_name'];
						unset($dt);					
					}else{
						$img='';
					}
					$vis = $this->input->post("vis".$l['id']);
					$nname = $this->input->post("name".$l['id']);
					if( ($vis!=$l['display'])||($nname!=$l['name'])||(strlen($img)>5) ){
						$this->adminka_model->edit_lang($l['id'],$nname,$vis,$img);	
						rdir(strtolower($l['name']),strtolower($nname));
						rdir(strtolower($l['name']),strtolower($nname),false,true,'application/language/');
					}
					unset($img);
				}
				$this->update_lang();
				$lang = $this->adminka_model->get_lang();
				foreach($lang as $l){
					$this->update_menu(strtolower($l['name']),$l['id']);
				}
				header("Location:/");
			}
			
			function dell_lang(){
				$lid = $this->input->post("lid");
				$this->load->model("adminka_model");
				$this->adminka_model->dell_lang($lid);
				$this->update_lang();
			}
			
			function dell_user(){
				$uid = $this->input->post("uid");
				$this->load->model("adminka_model");
				$this->adminka_model->dell_user($uid);
			}
			
			function dell_bron(){
				$bid = $this->input->post("bid");
				$this->load->model("adminka_model");
				$this->adminka_model->dell_bron($bid);
			}
			
			function edit_langue(){
				$lang = $this->input->post("lg");
				$data['langue'] = file("application/language/".strtolower($lang)."/words_lang.php");
				$this->load->view("/system/admins/langue_view",$data);
			}
			
			function save_langue(){
				$lang = $this->input->post("lg");
				$data = trim($this->input->post("langue".$lang));
				$data = str_replace("	","",$data);
				$file = fopen("application/language/".strtolower($lang)."/words_lang.php", "w");
				fwrite ($file, $data);
				header("Location:/");
			}
			
			function get_view(){
				$name = $this->input->post("view");
				$lang = $this->input->post("lg");
                //$data['file'] = file("application/views/".$name."/content_".$name."_".$lang."_view.php");
				$filename = "application/views/".$name."/content_".$name."_".$lang."_view.php";
                $handle = fopen($filename, "r");
                $contents = '';
                if(filesize($filename)>0){
                    $contents = fread($handle, filesize($filename));
                }
                fclose($handle);
                $data['contents'] = $contents;
				$this->load->view("/system/admins/edit_view",$data);
			}
			
			function get_slide(){
				$data['slide'] = file("application/views/system/slide.php");
				$this->load->view("/system/admins/slide_view",$data);
			}
			
			function save_slide(){
				$data = trim($this->input->post("slide"));
				$data = str_replace("	","",$data);
				$file = fopen("application/views/system/slide.php", "w");
				fwrite ($file, $data);
				header("Location:/");
			}
        }
        ?>