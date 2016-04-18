<?if(isset($lang)){?>
<div style="display: none;"><img src="/images/button_separator_over.png"></div>
<?$this->load->view("/system/menu_item_".$lang."_view")?>
<?}?>
<br>
<?if(!isset($user[0]['type'])){?>
	<table>
	<form name="authorization" action="/login" method="post">
		<tr>
			<td align="right"><?=$this->lang->line('login');?>:</td><td><input class="textedit" type="text" name="login" size=16></td>
		</tr>
		<tr>
			<td align="right"><?=$this->lang->line('pass');?>:</td><td><input class="textedit" type="password" name="pass" size=16></td>
		</tr>
		<tr>
			<td align="center" colspan=2>
				<input class="button" type="submit" value="<?=$this->lang->line('enter');?>"><br>
				<a href="/registration/lang/<?=$lang?>"><?=$this->lang->line('registr');?></a>
			</td>
		</tr>
	</form>
	</table>
<?}else{?>
<div align=center>
	<?=$this->lang->line('you_entered_as');?> <?=$user[0]['firstname']?> <?=$user[0]['lastname']?><br>
	<a href="/login/settings/<?=$lang?>"><?=$this->lang->line('settings');?></a><br>
	<a href="/login/logout"><?=$this->lang->line('exit');?></a>
</div>
<?}?>