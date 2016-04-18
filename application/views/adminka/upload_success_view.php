<?php header("Content-Type: text/html; charset=UTF-8");?>
<?if($type=='echo'){?>
	<table width='800px' style='text-align:center;'>
		<?foreach($images as $img){?>
			<tr>
				<td style='border-bottom:1px solid black'>type</td>
				<td style='border-bottom:1px solid black'>path</td>
				<td rowspan='<?=count($img)+1?>'>
					<img src='<?=$img['original']?>' height='125px'>
				</td>
				<td rowspan='<?=count($img)+1?>'>
					<?=$alt?>
				</td>
			</tr>
			<?foreach($img as $key=>$val){?>
				<tr style='height:30px;'>
					<td><?=$key?></td>
					<td><b><?=$val?></b></td>
				</tr>
			<?}?>
		<?}?>
	</table>
<?}else{?>
	Загрузка завершена
<?}?>
<script type="text/javascript" src="/js/jquery.js"></script>
<script>
	<?$i=0?>
	<?foreach($images as $img){?>
		<?$i++?>
		$('#photo_list<?=$whot_id?>', window.parent.document).append("<input type='hidden' class='<?=$whot_id?>_uploaded_photo_path<?=$i?>' value='<?=$img['original']?>'>");
		$('#photo_list<?=$whot_id?>', window.parent.document).append("<input type='hidden' class='<?=$whot_id?>_uploaded_photo_path_small250<?=$i?>' value='<?=$img['250']?>'>");
		$('#photo_list<?=$whot_id?>', window.parent.document).append("<input type='hidden' class='<?=$whot_id?>_uploaded_photo_path_small500<?=$i?>' value='<?=$img['500']?>'>");
		$('#photo_list<?=$whot_id?>', window.parent.document).append("<input type='hidden' class='<?=$whot_id?>_uploaded_photo_alt<?=$i?>' value='<?=$alt?>'>");
	<?}?>
	$('#photo_list<?=$whot_id?>', window.parent.document).append("<input type='hidden' id='<?=$whot_id?>_count_images' value='<?=$i?>'>");
	$('#popup_window', window.parent.document).html("upload complite<br><button onclick='upload_complete<?=$whot_id?>()'>OK</button>");

</script>