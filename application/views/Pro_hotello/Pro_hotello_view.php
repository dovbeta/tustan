
			<?if($type=='admin'){?>
			<?$d['elm']='Pro_hotello';?>
			<?$this->load->view("/system/admin_edit",$d);?>
			<?}?>
			<div class="content_title"><?=$page?></div>
					<div class="menu_decor" align=center>
					 <img src="/images/button_separator_gold.png" width=30%>
					</div>
			<div id="block_Pro_hotello">
			<?$this->load->view("/Pro_hotello/content_Pro_hotello_".$lang."_view")?></div>
