
			<?if($type=='admin'){?>
			<?$d['elm']='kurort_skhidnytsya';?>
			<?$this->load->view("/system/admin_edit",$d);?>
			<?}?>
			<div class="content_title"><?=$page?></div>
					<div class="menu_decor" align=center>
					 <img src="/images/button_separator_gold.png" width=30%>
					</div>
			<div id="block_kurort_skhidnytsya">
			<?$this->load->view("/kurort_skhidnytsya/content_kurort_skhidnytsya_".$lang."_view")?></div>