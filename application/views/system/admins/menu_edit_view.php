<?php header('Content-Type: text/html; charset=UTF-8');?>
<form action='/adminka/edit_menu' method='post'>
				<?foreach($menu as $m){?>
					<input name="id<?=$m['id']?>" value="<?=$m['id']?>" style="width:55px;">
					<input type='text' name='name<?=$m['id']?>' value='<?=$m['name']?>'>
					<select name='display<?=$m['id']?>'>
						<option value='1'
						<?if($m['display']=='1'){ ?>
						selected='selected'
						<?}?>
						>відображати</option>
						<option value='0' 
						<?if($m['display']=='0'){?>
						selected='selected'
						<?}?>
						>приховати</option>
					</select>
					<span><?=$m['lang']?></span> <span style='color:red;cursor:pointer' onclick='dell_elm_menu(<?=$m['id']?>)'>видалити</span><br>
				<?}?>
	<input type='submit' class='button' value='зберегти зміни'></form>
