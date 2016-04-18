<br>
<br>
<?if(isset($res)){?>
	<?=$res?>
<?}?>
<br>
<hr>	
<span id="lang" lang="hide" onclick="select(this);" style="cursor:pointer"><b>мови</b></span>
<div id="lang_edit" style="display:none">	
	<table>
		<form action="/adminka/add_lang" method="post">		
			<tr>
				<td>мовa:</td><td><input type="text" name="lang"></td>
			</tr>		
			<tr>
				<td colspan="2"><input type="submit" class="button" value="додати мову"></td>
			</tr>	
		</form>
	</table>
	<span id="langs" lang="hide" onclick="select(this);get_lang();" style="cursor:pointer"><b>редагувати мови</b></span>
	<div id="langs_edit" style="display:none">
	</div>
</div>
<hr>
<span id="menu" lang="hide" onclick="select(this)" style="cursor:pointer"><b>меню</b></span>
<div id="menu_edit" style="display:none">	
	<table>
		<form action="/adminka/add_menu" method="post">		
			<tr>
				<td>назва:</td><td><input type="text" name="name"></td>
				<td>
					<select name="lang">
						<option value='all' selected="selected">-</option>
						<?foreach($langs as $l){?>
							<option value="<?=strtolower($l['name'])?>"><?=$l['name']?></option>
						<?}?>
					</select>
				</td>
			</tr>
			<tr>
				<td>шлях:</td><td><input type="text" name="path"></td><td></td>
			</tr>
			<tr>
				<td colspan="3"><input type="submit" class="button" value="Додати пункт меню"></td>
			</tr>		
		</form>
	</table>
	<span id="menus" lang="hide" onclick="select(this);get_menu();" style="cursor:pointer"><b>редагувати меню</b></span>
	<div id="menus_edit" style="display:none">		
	</div>
</div>
<hr>
<span id="page" lang="hide" onclick="select(this)" style="cursor:pointer"><b>сторінки</b></span>
	<div id="page_edit" style="display:none">	
		<form action="/adminka/add_page" method="post">		
			<input type="text" name="name"> 
			<input type="submit" class="button" value="Cтворити сторінку">	
		</form>
		<br>
		<form action="/adminka/add_view" method="post">		
			<input type="text" name="name"> 
			<select name="lang">
						<?foreach($langs as $l){?>
							<option value="<?=strtolower($l['name'])?>"><?=$l['name']?></option>
						<?}?>
			</select>
			<input type="submit" class="button" value="додати вигляд">	
		</form>
	</div>
<hr>	
<span id="news" lang="hide" onclick="select(this)" style="cursor:pointer"><b>новини</b></span>
<div id="news_edit" style="display:none">	
	<table>
				
			<tr>
				<td>фото:</td><td>
                    <input name="photo" id='article_photo'>
                    <?$this->load->view("/system/upload_images_view",array(
                        'id'=>'art_upload_images',
                        'output'=>"<button>вибрати фото</button>",
                        'album'=> "none",
                        'lang'=>'ua',
                        'script'=>"
                            var count = $(\"#art_upload_images_count_images\").val();
                            $('#result_art_upload_images').html(' ');
                            for(var i=1;i<=count;i++){
                                var tmp = '<img id=\"art_upload_images_result'+i+'\" style=\"margin-left:15px;margin-right:15px;\">';
                                $('#result_art_upload_images').append(tmp);    
                                $('#article_photo').val($(\".art_upload_images_uploaded_photo_path_small250\"+i).val());    
                                $('#art_upload_images_result'+i).attr('src',$(\".art_upload_images_uploaded_photo_path_small250\"+i).val());
                                $('#art_img').val($(\".art_upload_images_uploaded_photo_path_small250\"+i).val());
                            }    
                            $(\"#art_upload_images_count_images\").val(0);
                        ",
                        'type'=>array('autoload')
                    ))?>
                    <div id='result_art_upload_images'>
                        
                    </div>
                </td>
			</tr>
            <form action="/adminka/add_news" method="post" enctype="multipart/form-data"/>
            <input type="hidden" id="art_img" name="photo_art">
			<tr>
				<td>заголовок:</td><td><input type="text" name="title"></td>
			</tr>
			<tr>
				<td>новина:</td><td>
                <?$this->load->view('/system/textarea_view',array(
    'name'=>'newed',
    'text'=>'',
    'type'=>'admin',
    'width'=>'100%',
    'height'=>'400px',
    'lang'=>'ua',
    'id'=>'newed'
))?>
                <textarea style='display:none' id='news' name="new"></textarea>
                </td>
			</tr>
			<tr>
				<td colspan="2"><input onclick="$('#news').val($('iframe#newed').contents().find('body').html());" type="submit" class="button" value="Додати новину"></td>
			</tr>	
			
		</form>
	</table>
</div>
<hr>	
<span id="bron" lang="hide" onclick="select(this);get_bron()" style="cursor:pointer"><b>бронювання</b></span>
<div id="bron_edit" style="display:none">	
</div>
<hr>	
<span id="user" lang="hide" onclick="select(this);get_user()" style="cursor:pointer"><b>користувачі</b></span>
<div id="user_edit" style="display:none">	
</div>
<hr>	
<span id="photo" lang="hide" onclick="select(this);" style="cursor:pointer"><b>загрузка фото</b></span>
<div id="photo_edit" style="display:none">	
	<table>
        <?$this->load->view("/system/upload_images_view",array(
            'id'=>'upload_images',
            'output'=>"<button>вибрати фото</button>",
            'album'=> "none",
            'lang'=>'ua',
            'script'=>"
                var count = $(\"#upload_images_count_images\").val();
                $('#result_upload_images').html(' ');
                for(var i=1;i<=count;i++){
                    var tmp = '<img id=\"upload_images_result'+i+'\" style=\"margin-left:15px;margin-right:15px;\">';
                    $('#result_upload_images').append(tmp);    
                    $('#upload_images_result'+i).attr('src',$(\".upload_images_uploaded_photo_path_small250\"+i).val());
                    
                }    
                $(\"#upload_images_count_images\").val(0);
            ",
            'type'=>array('autoload','multiple')
        ))?>
        <div id='result_upload_images'>
            
        </div>
		
	</table>
</div>

<hr>	
<span id="langue" lang="hide" onclick="select(this);" style="cursor:pointer"><b>редагування словників</b></span>
<div id="langue_edit" style="display:none">	
	<ul>
	<?foreach($langs as $l){?>
		<li><b style="cursor:pointer" onclick="edit_langue('<?=$l['name']?>')"><?=$l['name']?></b><div id="lang_<?=$l['name']?>" style="display:none"></div>
	<?}?>
	</ul>
</div>
<hr>	
<span id="email" lang="hide" onclick="select(this);" style="cursor:pointer"><b>email отримувача повідомлень</b></span>
<div id="email_edit" style="display:none">	
	<?include("./application/views/system/email.php");?>
	<form action="/adminka/set_mail" method="post">
	email:<input value=<?=$emailadmin?> name="email">
	<br><input type="submit" class="button" value="Змінити">
	</form>
</div>
<hr>	
<span id="slide" lang="hide" onclick="select(this);showslide();" style="cursor:pointer"><b>slide show</b></span>
<div id="slide_edit" style="display:none">	

</div>
<div>
    <b>comments</b>
    <table width='700px' style='text-align:center;'>
    <tr>
        <td style='width:120px;border: 1px solid skyBlue;'><b>дата</b></td>
        <td style='width:460px;border: 1px solid skyBlue;'><b>коментар</b></td>
        <td style='width:120px;border: 1px solid skyBlue;'><b>до чого</b></td>
        <td style='width:120px;border: 1px solid skyBlue;'><b>користувач</b></td>
        <td style='width:120px;border: 1px solid skyBlue;'></td>
    </tr>
    <?foreach($comments as $key=>$val){?>
        <tr id='<?=$val->id?>' <?if($val->status=='dell'){?>style='background: lightSalmon;'<?}?>>
            <td style='border: 1px solid skyBlue;'><?=$val->date?></td>
            <td style='border: 1px solid skyBlue;'><span id='text<?=$val->id?>'><?=htmlspecialchars($val->text)?></span></td>
            <td style='border: 1px solid skyBlue;'><a href='/<?=str_replace("[|]","/",$val->whot)?>/<?=$val->whot_id?>'><?=str_replace("[|]","/",$val->whot)?>/<?=$val->whot_id?></a></td>
            <td style='border: 1px solid skyBlue;'><?=$val->user_name?></td>
            <td style='border: 1px solid skyBlue;'><b onclick='$.post("/comments/sync_comments",{whot:"<?=$val->whot?>",whot_id:<?=$val->whot_id?>},function(){alert("ok")})'>sunc</b></td>
        </tr>
    <?}?>
</table>
</div>
