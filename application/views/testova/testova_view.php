
			<?if($type=='admin'){?>
			<?$d['elm']='testova';?>
			<?$this->load->view("/system/admin_edit",$d);?>
			<?}?>
			<div class="content_title"><?=$page?></div>
					
			<div id="block_testova">
			<?$this->load->view("/testova/content_testova_".$lang."_view")?></div>