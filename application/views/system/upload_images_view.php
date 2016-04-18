<?
//init data
if(!isset($id)){
	$id='upload_images';
}
if(!isset($album)){
	$album='none';
}
if(!isset($output)){
	$output="<img src='/images/textarea/img.jpg'>";
}
if(!isset($script)){
	$script='';
}
if(!isset($lang)){
	$lang='ua';
}
if(!isset($type)){
	$type=array('return','autoload','multiple');
}
?>
<script type='text/javascript' src='/js/popup.js'></script>
<script type='text/javascript' src='/js/iframe.js'></script>
<script type='text/javascript'>
	function comet<?=$id?>(where,width,height,display) {
		createIFrame('cometFrame<?=$id?>', '/photo/load_form/<?=$album?>/<?=$id?>/<?=$lang?>', where, width, height,display);
	}
	$(document).ready(init_data<?=$id?>);
	
	function init_data<?=$id?>(){

		$("#cometFrame<?=$id?>").remove();
		comet<?=$id?>('photo<?=$id?>','25px','25px','none');		
		$("#<?=$id?>").children(':first').click(function(){
			$('iframe#cometFrame<?=$id?>').contents().find('input#file').click();
		});
	}
	function upload_complete<?=$id?>(){
		destroy_popup();
		<?=$script?>
		$('#photo_list<?=$id?>').html(' ');
		$("#cometFrame<?=$id?>").remove();
		comet<?=$id?>('photo<?=$id?>','25px','25px','none');
	}
</script>

<div id='<?=$id?>'>
	<?=$output?>
	<div id='photo_list<?=$id?>'></div><div id='photo<?=$id?>'></div>	
	<input type='hidden' onclick="
		create_popup($('iframe#cometFrame<?=$id?>').contents().find('div#res').html(),'',$('#photo<?=$id?>').offset().top);" 
		id='create_popup<?=$id?>'>
	<div id='<?=$id?>_upload_images_types'>
		<?foreach($type as $t){?>
			<input type='hidden' value='<?=$t?>'>
		<?}?>
	</div>
</div>