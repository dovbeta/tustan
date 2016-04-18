<?if(isset($res)){?>
<?=$res?>
<?}?>
<span id="pass" lang="hide" onclick="select(this)" style="cursor:pointer"><b><?=$this->lang->line('change');?> <?=$this->lang->line('pass');?></b></span>
<div id="pass_edit" style="display:none">	
	<form action="/login/change" method="post">
	<input type="hidden" name="lang" value="<?=$lang?>">
		<table>
			<tr>
				<td><?=$this->lang->line('old');?> <?=$this->lang->line('pass');?>:</td>
				<td><input type="password" name='pass_old'></td>
			</tr>
			<tr>
				<td><?=$this->lang->line('new');?> <?=$this->lang->line('pass');?>:</td>
				<td><input type="password" name='pass_new'></td>
			</tr>
			<tr>
				<td><input class="button" type="submit" value="<?=$this->lang->line('change');?>"></td>
				<td></td>
			</tr>
		</table>
	</form> 
</div>
<hr>
<span id="chdt" lang="hide" onclick="select(this)" style="cursor:pointer"><b><?=$this->lang->line('change');?> <?=$this->lang->line('data');?></b></span>
<div id="chdt_edit" style="display:none">	
	<form action="/login/change_data" method="post">
	<input type="hidden" name="lang" value="<?=$lang?>">
		<table>
			<tr>
				<td><?=$this->lang->line('full_name');?>:</td>
				<td><input type="text" name='name' value="<?=$user[0]['firstname']?> <?=$user[0]['lastname']?>"></td>
			</tr>
			<tr>
				<td><?=$this->lang->line('phone_number');?>:</td>
				<td><input type="text" name='tell' value="<?=$user[0]['tell']?>"></td>
			</tr>
			<tr>
				<td><input class="button" type="submit" value="<?=$this->lang->line('change');?>"></td>
				<td></td>
			</tr>
		</table>
	</form> 
</div>