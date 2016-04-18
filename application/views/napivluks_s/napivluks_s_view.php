
			<?if($type=='admin'){?>
			<?$d['elm']='napivluks_s';?>
			<?$this->load->view("/system/admin_edit",$d);?>
			<?}?>
			<div class="content_title"><?=$page?></div>
					<div class="menu_decor" align=center>
					 <img src="/images/button_separator_gold.png" width=30%>
					</div>
			<div id="block_napivluks_s">
			<?$this->load->view("/napivluks_s/content_napivluks_s_".$lang."_view")?></div>