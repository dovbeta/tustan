
			<?if($type=='admin'){?>
			<?$d['elm']='aktsiya';?>
			<?$this->load->view("/system/admin_edit",$d);?>
			<?}?>
			<div class="content_title"><?=$page?></div>
					<div class="menu_decor" align=center>
					 <img src="/images/button_separator_gold.png" width=30%>
					</div>
			<div id="block_aktsiya">
			<?$this->load->view("/aktsiya/content_aktsiya_".$lang."_view")?></div>