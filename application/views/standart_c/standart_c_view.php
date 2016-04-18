
			<?if($type=='admin'){?>
			<?$d['elm']='standart_c';?>
			<?$this->load->view("/system/admin_edit",$d);?>
			<?}?>
			<div class="content_title"><?=$page?></div>
					<div class="menu_decor" align=center>
					 <img src="/images/button_separator_gold.png" width=30%>
					</div>
			<div id="block_standart_c">
			<?$this->load->view("/standart_c/content_standart_c_".$lang."_view")?></div>