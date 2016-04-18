
			<?if($type=='admin'){?>
			<?$d['elm']='odnomisnyy';?>
			<?$this->load->view("/system/admin_edit",$d);?>
			<?}?>
			<div class="content_title"><?=$page?></div>
					<div class="menu_decor" align=center>
					 <img src="/images/button_separator_gold.png" width=30%>
					</div>
			<div id="block_odnomisnyy">
			<?$this->load->view("/odnomisnyy/content_odnomisnyy_".$lang."_view")?></div>