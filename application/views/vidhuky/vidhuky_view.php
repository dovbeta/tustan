
			<?if($type=='admin'){?>
			<?$d['elm']='vidhuky';?>
			<?$this->load->view("/system/admin_edit",$d);?>
			<?}?>
			<div class="content_title"><?=$page?></div>
					<div class="menu_decor" align=center>
					 <img src="/images/button_separator_gold.png" width=30%>
					</div>
			<div id="block_vidhuky">
			<?$this->load->view("/vidhuky/content_vidhuky_".$lang."_view")?></div>
            <?$this->load->view("/comments/comments_list_view",array(
    'type'=>'not_login',
    'whot'=>'vidhuki', 
    'whot_id'=>'1', 
    'text'=>"Додати відгук"
))?>
