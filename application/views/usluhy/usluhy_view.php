
			<?if($type=='admin'){?>
			<?$d['elm']='usluhy';?>
			<?$this->load->view("/system/admin_edit",$d);?>
			<?}?>
			<div class="content_title"><?=$page?></div>
					<div class="menu_decor" align=center>
					 <img src="/images/button_separator_gold.png" width=30%>
					</div>
			<div id="block_usluhy">
			<?$this->load->view("/usluhy/content_usluhy_".$lang."_view")?></div>