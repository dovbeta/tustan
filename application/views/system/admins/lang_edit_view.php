<?php header('Content-Type: text/html; charset=UTF-8');?>
<form action='/adminka/edit_lang' method='post' enctype='multipart/form-data'/><table>
				<?foreach($lang as $l){?>
					<tr>
					<td><input type='text' name='name<?=$l['id']?>' value='<?=$l['name']?>'></td>
					<td><select name='vis<?=$l['id']?>'><option selected='selected' value='1'>відображати</option><option value='0'>не відображати</option></select></td>
					<td><input type='file' name='userfile<?=$l['id']?>'></td>
					<td><span style='color:red;cursor:pointer' onclick='dell_elm_lang(<?=$l['id']?>)'>видалити</span></td>
					</tr>
				<?}?>
				<tr><td><input type='submit'></td></tr></table></form>
