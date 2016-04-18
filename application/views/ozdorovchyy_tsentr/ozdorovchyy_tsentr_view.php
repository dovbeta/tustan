
			<?if($type=='admin'){?>
			<?$d['elm']='ozdorovchyy_tsentr';?>
			<?$this->load->view("/system/admin_edit",$d);?>
			<?}?>
			<div class="content_title"><?=$page?></div>
					<div class="menu_decor" align=center>
					 <img src="/images/button_separator_gold.png" width=30%>
					</div>
			<div id="block_ozdorovchyy_tsentr">
			<?$this->load->view("/ozdorovchyy_tsentr/content_ozdorovchyy_tsentr_".$lang."_view")?></div>