
			<?if($type=='admin'){?>
			<?$d['elm']='Nomera_i_tsiny';?>
			<?$this->load->view("/system/admin_edit",$d);?>
			<?}?>
			<div class="content_title"><?=$page?></div>
					<div class="menu_decor" align=center>
					 <img src="/images/button_separator_gold.png" width=30%>
					</div>
			<div id="block_Nomera_i_tsiny">
			<?$this->load->view("/Nomera_i_tsiny/content_Nomera_i_tsiny_".$lang."_view")?></div>