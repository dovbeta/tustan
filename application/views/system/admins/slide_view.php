<?php header('Content-Type: text/html; charset=UTF-8');?><form action="/adminka/save_slide" method="post">	<textarea rows="13" cols="75" name="slide">	<?foreach($slide as $s){?>		<?=$s;?>	<?}?>	</textarea>	<br>	<input type="submit" class="button" value="Зберегти"></form>