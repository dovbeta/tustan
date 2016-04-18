
			<?if($type=='admin'){?>
			<?$d['elm']='luks_d';?>
			<?$this->load->view("/system/admin_edit",$d);?>
			<?}?>
			<div class="content_title"><?=$page?></div>
					<div class="menu_decor" align=center>
					 <img src="/images/button_separator_gold.png" width=30%>
					</div>
			<div id="block_luks_d">
			<?$this->load->view("/luks_d/content_luks_d_".$lang."_view")?></div>