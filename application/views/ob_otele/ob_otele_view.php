
			<?if($type=='admin'){?>
			<?$d['elm']='ob_otele';?>
			<?$this->load->view("/system/admin_edit",$d);?>
			<?}?>
			<div class="content_title"><?=$page?></div>
					<div class="menu_decor" align=center>
					 <img src="/images/button_separator_gold.png" width=30%>
					</div>
			<div id="block_ob_otele">
			<?$this->load->view("/ob_otele/content_ob_otele_".$lang."_view")?></div>