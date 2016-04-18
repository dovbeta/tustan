
			<?if($type=='admin'){?>
			<?$d['elm']='Posluhy';?>
			<?$this->load->view("/system/admin_edit",$d);?>
			<?}?>
			<div class="content_title"><?=$page?></div>
					<div class="menu_decor" align=center>
					 <img src="/images/button_separator_gold.png" width=30%>
					</div>
                  
			<div id="block_Posluhy">
			<?$this->load->view("/Posluhy/content_Posluhy_".$lang."_view")?></div>