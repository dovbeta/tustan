<?if($type=='admin'){?>
	<form action="/news/edit_news" method="post" enctype="multipart/form-data"/>		
	<div id="news_elm" class="news_elm"> 
			<div id="news_content" class="news_content">
				<div id="news_img" class="news_img" style="width:220px">
					<img src='/images/news/<?=$new[0]['img']?>' width='215px'><input type="file"  name="userfile">
				</div>
				<h3><input type="text" value="<?=$new[0]['title']?>" name="title"></h3>
				<textarea name="news" cols='95' rows='25'><?=$new[0]['new']?></textarea>
			</div>
		</div>
	<input type='hidden' value='<?=$id?>' name='id'>
	<input type='submit' class="button" value='Зберегти зміни'>
	</form>
	<br>
	<input type="submit" class="button" value="Видалити" onclick="dell_elm_news('<?=$new[0]['id']?>')">
<?}else{?>
	Ви не адміністратор! у вас не немає прав!
<?}?>