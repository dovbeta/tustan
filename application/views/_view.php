
			<?if($type=='admin'){?>
			<?$d['elm']='';?>
			<?$this->load->view("/system/admin_edit",$d);?>
			<?}?>
			<div class="content_title"><?=$page?></div>
					<div class="menu_decor" align=center>
					 <img src="/images/button_separator_gold.png" width=30%>
					</div>
			<div id="block_">
			<?$this->load->view("//content__".$lang."_view")?></div>