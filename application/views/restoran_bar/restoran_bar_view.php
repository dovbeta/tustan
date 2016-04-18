
			<?if($type=='admin'){?>
			<?$d['elm']='restoran_bar';?>
			<?$this->load->view("/system/admin_edit",$d);?>
			<?}?>
			<div class="content_title"><?=$page?></div>
					<div class="menu_decor" align=center>
					 <img src="/images/button_separator_gold.png" width=30%>
					</div>
			<div id="block_restoran_bar">
			<?$this->load->view("/restoran_bar/content_restoran_bar_".$lang."_view")?></div>