
			<?if($type=='admin'){?>
			<?$d['elm']='nomery_i_tsiny';?>
			<?$this->load->view("/system/admin_edit",$d);?>
			<?}?>
			<div class="content_title"><?=$page?></div>
					<div class="menu_decor" align=center>
					 <img src="/images/button_separator_gold.png" width=30%>
					</div>
			<div id="block_nomery_i_tsiny">
			<?$this->load->view("/nomery_i_tsiny/content_nomery_i_tsiny_".$lang."_view")?></div>