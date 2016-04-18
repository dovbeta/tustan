
			<?if($type=='admin'){?>
			<?$d['elm']='restoran__bar';?>
			<?$this->load->view("/system/admin_edit",$d);?>
			<?}?>
			<div class="content_title"><?=$page?></div>
					<div class="menu_decor" align=center>
					 <img src="/images/button_separator_gold.png" width=30%>
					</div>
			<div id="block_restoran__bar">
			<?$this->load->view("/restoran__bar/content_restoran__bar_".$lang."_view")?></div>