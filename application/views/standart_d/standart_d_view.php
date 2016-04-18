
			<?if($type=='admin'){?>
			<?$d['elm']='standart_d';?>
			<?$this->load->view("/system/admin_edit",$d);?>
			<?}?>
			<div class="content_title"><?=$page?></div>
					<div class="menu_decor" align=center>
					 <img src="/images/button_separator_gold.png" width=30%>
					</div>
			<div id="block_standart_d">
			<?$this->load->view("/standart_d/content_standart_d_".$lang."_view")?></div>