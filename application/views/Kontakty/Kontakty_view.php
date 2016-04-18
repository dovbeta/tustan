
			<?if($type=='admin'){?>
			<?$d['elm']='Kontakty';?>
			<?$this->load->view("/system/admin_edit",$d);?>
			<?}?>
			<div class="content_title"><?=$page?></div>
					<div class="menu_decor" align=center>
					 <img src="/images/button_separator_gold.png" width=30%>
					</div>
			<div id="block_Kontakty">
			<?$this->load->view("/Kontakty/content_Kontakty_".$lang."_view")?></div>
	