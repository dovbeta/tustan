<?
	function build_tree($data){
    	$tree = array();
		foreach($data as $id => &$row){
			if(empty($row['parent_id'])){
				$tree[$id] = &$row;
			}
			else{
				$data[$row['parent_id']]['childs'][$id] = &$row;
			}
		}
		return $tree;
	}

	function out_comments($comments,$lvl=0,$html=''){
		foreach($comments as $comment){
			$html.="<div class='branch";
			if($lvl>0){
				$html.="_ansver";
			}
			$html.="'>".$comment['comment'];
			$html.='<div class="answer';
			if($lvl%2==0){
				$html.='_odd';
			}else{
				$html.='_evan';
			}
			$html.='">';	
			if(isset($comment['childs'])&&(count($comment['childs'])>0)){	
				$html.=out_comments($comment['childs'],$lvl+1);
				
			}
			$html.='</div>';
			$html.='</div>';
			
		}
		return $html;
	}
	
	function update_comment($comments,$whot,$whot_id){
		if(!file_exists("comments/".$whot)){
			mkdir("comments/".$whot);
		}
		$file = fopen("comments/".$whot."/".$whot_id."_view.php", "w");
		$comments_view = file_get_contents('application/views/comments/comments_view.php');
		$tmp_content='';
		$hidden_comments=0;
		if(count($comments)>10){
			$tmp_content.='<div id="hidden_comments" style="display:none">
			<script type="text/javascript">
			$(document).ready(function(){
	$(".comment").hover(function(){
		$(this).css("background","#e2e2e2");
	},
	function(){
		$(this).css("background","none");
	});
});
			</script>';
			$hidden_comments=1;
		}
		$count_comments=0;

		
		foreach($comments as $c){
			$tmp = $comments_view;
			$tmp = str_replace('[%%%id%%%]',$c->id,$tmp);
			$tmp = str_replace('[%%%user_name%%%]',$c->user_name,$tmp);
			$tmp = str_replace('[%%%user_id%%%]',$c->user_id,$tmp);
			$tmp = str_replace('[%%%date%%%]',$c->date,$tmp);
			$tmp = str_replace('[%%%text%%%]',$c->text,$tmp);
			$tmp = str_replace('[%%%whot_id%%%]',$c->whot_id,$tmp);
			$tree_comments[$c->id]['parent_id'] = $c->parent_id;
			$tree_comments[$c->id]['comment'] = $tmp;
		}
		$tmp_arr = build_tree($tree_comments);
		unset($tree_comments);
		$tmp_arr = out_comments($tmp_arr);
		//$tmp_arr = getCommentsTemplate($tmp_arr);
		/*
		foreach($tree_comments as $key=>$c){
			if($c['parent']==0){
				$tmp_content.=$c['comment'];
				$count_comments++;
			}
			if(($hidden_comments==1)&&($count_comments==count($comments)-9)){
				$tmp_content.='</div><div id="comments_show_all_of" onclick="$(\'#hidden_comments\').slideToggle();$(this).remove()"><?=$this->lang->line("comments_show_all")?> ('.count($comments).')</div>';
			}
		}
		*/
		$content = '<div class="comments">'.$tmp_arr.'</div>';
		fwrite ($file, $content);
		return 1;
	}
?>