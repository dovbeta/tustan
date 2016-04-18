
			<?if($type=='admin'){?>
			<?$d['elm']='lechenye';?>
			<?$this->load->view("/system/admin_edit",$d);?>
			<?}?>
			<div class="content_title"><?=$page?></div>
					<div class="menu_decor" align=center>
					 <img src="/images/button_separator_gold.png" width=30%>
					</div>
			<div id="block_lechenye">
			<?$this->load->view("/lechenye/content_lechenye_".$lang."_view")?></div>