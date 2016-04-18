
			<?if($type=='admin'){?>
			<?$d['elm']='spa___tsentr';?>
			<?$this->load->view("/system/admin_edit",$d);?>
			<?}?>
			<div class="content_title"><?=$page?></div>
					<div class="menu_decor" align=center>
					 <img src="/images/button_separator_gold.png" width=30%>
					</div>
			<div id="block_spa___tsentr">
			<?$this->load->view("/spa___tsentr/content_spa___tsentr_".$lang."_view")?></div>