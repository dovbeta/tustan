
			<?if($type=='admin'){?>
			<?$d['elm']='luxb';?>
			<?$this->load->view("/system/admin_edit",$d);?>
			<?}?>
			<div class="content_title"><?=$page?></div>
					<div class="menu_decor" align=center>
					 <img src="/images/button_separator_gold.png" width=30%>
					</div>
			<div id="block_luxb">
			<?$this->load->view("/luxb/content_luxb_".$lang."_view")?></div>