<?php header("Content-Type: text/html; charset=UTF-8");?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script type='text/javascript' src='/js/jquery.js'></script>
		<script type='text/javascript' src='/js/popup.js'></script>
		<script>
			function download(){
				if(document.getElementById('file').value.length>2){
					document.getElementById('res').style.display='block';			
				}
			}	
			$(document).ready(function(){
				var type = $('#<?=$whot_id?>_upload_images_types', window.parent.document).children('input');
				var types = new Array();
				for(var i=0;i<type.length;i++){
					types.push(type[i].value);
				}
				if(jQuery.inArray('autoload',types)!=-1){
					$("#file").change(function(){
						forma.submit();
						$('#create_popup<?=$whot_id?>', window.parent.document).click();
					});
				}
				if(jQuery.inArray('multiple',types)!=-1){
					$("#file").attr('multiple',true);
				}
				if ($.browser.msie) { 
					$("#file").attr('ACCEPT','image/jpeg');
				}
			});
		</script>	
	</head>
	<body>
		<form action="/photo/upload_images/<?=$album?>/<?=$whot_id?>/<?=$lang?>" method="post" enctype="multipart/form-data" id="forma" name='forma'>
			<input type="file" ACCEPT="image/png,image/gif,image/jpeg,image/bmp" name="file[]" id="file"><br>
			<input type="submit" onclick="download()" id="but"><br>
			<div id="res" style='display:none'>
				<img src="/images/system/ajax-loader.gif" height="25px" width="475">
				<div style="margin-top:-28.5px;"><?=$this->lang->line('photo_is_in_progress_please_wait')?></div>
			</div>
			
		</form>
	</body>
</html>