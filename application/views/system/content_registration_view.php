<form action="/registration/registr" method="post">
	<table>
		<tr>
			<td align="right"><?=$this->lang->line("login")?>:</td>
			<td><input class="textedit"  type="text" name="login"></td>
		</tr>
		<tr>
			<td align="right"><?=$this->lang->line("pass")?>:</td>
			<td><input class="textedit"  type="password" name="pass"></td>
		</tr>
		<tr>
			<td align="right"><?=$this->lang->line("full_name")?>:</td>
			<td><input class="textedit"  type="text" name="full_name"></td>
		</tr>
		<tr>
			<td align="right"><?=$this->lang->line("phone_number")?>:</td>
			<td><input class="textedit"  type="text" name="phone_number"></td>
		</tr>
		<tr>
			<td align="right"><?=$this->lang->line('fax');?>:<br><small><?=$this->lang->line('optional');?></small></td>
			<td align="left">
				<input class="textedit" type="text" name="fax">
			</td>
		</tr>
		<tr>
			<td align="right"><?=$this->lang->line('email');?>:</td>
			<td align="left">
				<input class="textedit" type="text" name="email">
			</td>
		</tr>
		<tr>
			<?$one = rand(10,99)?>
			<?$two = rand(10,99)?>
			<td align="right"><?=$this->lang->line('how_many');?>: <span id="one"><?=$one?></span>+<span id="two"><?=$two?></span>?</td>
			<td><input  class="textedit" type="text" name="result" id="result" onkeyup="chek_bot('<?=$one?>','<?=$two?>')"></td>
			<input type="hidden" name="one" value="<?=$one?>">
			<input type="hidden" name="two" value="<?=$two?>">
		</tr>
		<tr>
			<td><input type="submit" class="button" value="<?=$this->lang->line('registr');?>" style="display:none" id="sbm_buttom"></td>
			<td></td>
		</tr>
	</table>
</form>
<?if(isset($result)){?>
	<?=$result?>
<?}?>