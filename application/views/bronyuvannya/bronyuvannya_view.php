
			<?if($type=='admin'){?>
			<?$d['elm']='bronyuvannya';?>
			<?$this->load->view("/system/admin_edit",$d);?>
			<?}?>
			<div class="content_title"><?=$page?></div>
					<div class="menu_decor" align=center>
					 <img src="/images/button_separator_gold.png" width=30%>
					</div>
                    
            
                    <div align=center>
<table>
<form action="/Bronyuvannya/online_bron/<?=$lang?>" method="post" >
    <tr>
        <td align="right"><?=$this->lang->line('date_from');?>:</td>
        <td align="left"><input class="textedit" type="text" value="dd-mm-yy" name="date_start" onclick="event.cancelBubble=true;this.select();lcs(this)"></td>
    </tr>
    <tr>
        <td align="right"><?=$this->lang->line('date_on');?>:</td>
        <td align="left"><input class="textedit" type="text" value="dd-mm-yy" name="date_end" onclick="event.cancelBubble=true;this.select();lcs(this)"></td>
    </tr>
    <tr>
        <td align="right"><?=$this->lang->line('full_name');?>:</td>
        <td align="left"><input class="textedit" type="text" name="name" <?if(isset($user[0]['type'])){?>value="<?=$user[0]['firstname']?> <?=$user[0]['lastname']?>"<?}?>></td>
    </tr>
    <tr>
        <td align="right"><?=$this->lang->line('phone_number');?>:</td>
        <td align="left"><input onkeyup="chek_tell(tell.value)" class="textedit" type="text" name="tell" <?if(isset($user[0]['type'])){?>value="<?=$user[0]['tell']?>"<?}?>></td>
    </tr>
    <tr>
        <td align="right"><?=$this->lang->line('fax');?>:<br><small><?=$this->lang->line('optional');?></small></td>
        <td align="left">
            <input class="textedit" type="text" name="fax" <?if(isset($user[0]['type'])){?>value="<?=$user[0]['fax']?>"<?}?>>
        </td>
    </tr>
    <tr>
        <td align="right"><?=$this->lang->line('email');?>:</td>
        <td align="left">
            <input class="textedit" type="text" name="email" <?if(isset($user[0]['type'])){?>value="<?=$user[0]['email']?>"<?}?>>
        </td>
    </tr>
    <tr>
        <td align="right"><?=$this->lang->line('type_nomer');?>:</td>
        <td align="left">
            <select class="textedit" name="type_room">
                <option selected="select" value="single"><?=$this->lang->line('single');?></option>
                <option value="standart"><?=$this->lang->line('standart');?></option>
                <option value="juniora"><?=$this->lang->line('juniora');?></option>
                <option value="juniorb"><?=$this->lang->line('juniorb');?></option>
                <option value="luxea"><?=$this->lang->line('luxea');?></option>
                <option value="luxeb"><?=$this->lang->line('luxeb');?></option>
            </select>
        </td>
    </tr>
    
    <tr>
        <?$one = rand(10,99)?>
        <?$two = rand(10,99)?>
        <td align="right"><?=$this->lang->line('how_many');?>: <span id="one"><?=$one?></span>+<span id="two"><?=$two?></span>?</td>
        <td align="left"><input class="textedit" type="text" name="result" id="result" onkeyup="chek_bot('<?=$one?>','<?=$two?>')"></td>
        <input type="hidden" name="one" value="<?=$one?>">
        <input type="hidden" name="two" value="<?=$two?>">
    </tr>
    <tr>
        <td><input class="button" type="submit" value="<?=$this->lang->line('bron');?>" style="display:none" id="sbm_buttom"></td>
        <td></td>
    </tr>
</form>
</table>
</div>
<?if(isset($result)){?>
    <?=$result;?>
<?}?>

			<div id="block_bronyuvannya">
			<?$this->load->view("/bronyuvannya/content_bronyuvannya_".$lang."_view")?></div>