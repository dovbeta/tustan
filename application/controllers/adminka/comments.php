<?
class Comments extends MY_Controller{
	
	public function __construct(){
		parent::__construct();
		if(!isset($this->data['user'][0]->type)){
			header('Location:/user/login_form');
		}else if($this->data['user'][0]->type!='admin'){
			header('Location:/user/login_form');
		}
		$this->load->model('comments_model');
	}
	
	public function comments_info($start=0,$count=30){
		$xml = xml_parser_create();    
		xml_parser_set_option($xml, XML_OPTION_SKIP_WHITE, 1); 
		xml_parse_into_struct($xml, file_get_contents("components/comments_v_1_0_1.xml"), $element, $index);
		xml_parser_free($xml);  
		$data['name'] = $element[$index['NAME'][0]]['value']; 
		$data['version'] = $element[$index['VERSION'][0]]['value']; 
		$data['start'] = $start;
		$data['count'] = $count;
		$data['comments_count'] = $this->comments_model->comments_count();
		$data['comments'] = $this->comments_model->get_all_comments($start,$count);
		$this->load->view('/adminka/comments_list_view',$data);
	}
	
	public function get_comments($start=0,$count=30){
		$tmp['start'] = $start;
		$tmp['count'] = $count;
		$tmp['comments_count'] = $this->comments_model->comments_count();
		$tmp['comments'] = $this->comments_model->get_all_comments($start,$count);
		$this->load->view('/adminka/comments_list_view',$tmp);
	}
	
	
	function dell_comments(){
		$this->comments_model->dell_comments($this->input->post('id'));
		$this->get_comments();
	}
	function dell_comments_forewer(){	
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
		
	}
	
	function restore_comments(){
		$this->comments_model->restore_comments($this->input->post('id'));
		$this->get_comments();
	}
	
	function update_comments(){
		$this->load->library('textarea');
		$text = $this->textarea->to_html($this->input->post('new_data'));
		$this->comments_model->update_comments_text($this->input->post('id'),$text);
		$comments = $this->comments_model->get_comments($this->input->post("whot"),$this->input->post("whot_id"));
		$this->load->helper('comments_helper');
		update_comment($comments,$this->input->post("whot"),$this->input->post("whot_id"));
	}
	
}
?>