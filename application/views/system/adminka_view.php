<?if($user[0]['type']=='admin'){?>
	<div id="block_adminka">
		<?$this->load->view("/system/content_adminka_view")?>
	</div>
<?}else{?>
	ви не адмін!
<?}?>