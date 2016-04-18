<?
//init data
if(!isset($id)){
    $id='textarea_id';
}
if(!isset($name)){
    $name='textarea_name';
}
if(!isset($width)){
    $width="500px";
}
if(!isset($height)){
    $height="250px";
}
if(!isset($text)){
    $text='';
}
if(!isset($lang)){
    $lang='ua';
}
if(!isset($type)){
    $type='not_login';
}
include('./application/config/smileys.php');

?>
<style>    
    .td{
        min-width:15px;
        height:20px;
        text-align:center;
        cursor:pointer;
        float:left;
        padding-left: 2px;
        padding-right: 2px;
        margin-left: 2px;
        margin-right: 2px;
        margin-top: 2px;
    }
    .td:hover{
        background:#d8d8d8;        
    }
    #value:hover{
        background:#e3e3e3;
        cursor:pointer;
    }
    .textarea_text_color{
        width:15px;
        height:15px;
        margin:2px 2px 2px 2px;
        float:left;
        cursor:pointer;
    }
    .my_select_option:hover{
        background-color:silver;
    }
    font[size=7] {
      font-size: 18px;
    }
    font[size=6] {
      font-size: 16px;
    }
    font[size=5] {
      font-size: 14px;
    }
    font[size=4] {
      font-size: 13px;
    }
    font[size=3] {
      font-size: 12px;
    }
    font[size=2] {
      font-size: 11px;
    }
    font[size=1] {
      font-size: 10px;
    }
</style>
<script type='text/javascript' src='/js/popup.js'></script>
<?if($type=='not_login'){?>
    <table>
        <?if(isset($not_login_user_name)){?>
            <tr>
                <td align="right">Ваше ім'я:</td>
                <td><input id='not_login_name' value="<?=$not_login_user_name?>" ></td>
            </tr>
        <?}else{?>
            <tr>
                <td align="right">Ваше ім'я:</td>
                <td><input id='not_login_name'></td>
            </tr>
        <?}?>
        <tr style="display: none;">
            <td align="right">Ваш e-mail:</td>
            <td><input id='not_login_email' value="notemail@thisua.com"></td>
        </tr>
    </table>
<?}?>
<div style='display:table'>
    <div class='td' onclick="setBold<?=$id?>()"><b>B</b></div>            
    <div class='td' onclick="setUnder<?=$id?>()"><u>U</u></div>            
    <div class='td' onclick="setItal<?=$id?>()"><i>I</i></div>            
    <div class='td' onclick="JustifyLeft<?=$id?>()"><img style='margin-top: 2.5px;' src='/images/textarea/left.png'></div>                    
    <div class='td' onclick="JustifyCenter<?=$id?>()"><img style='margin-top: 2.5px;' src='/images/textarea/center.png'></div>                    
    <div class='td' onclick="JustifyRight<?=$id?>()"><img style='margin-top: 2.5px;' src='/images/textarea/right.png'></div>                    
    <div class='td' onclick="JustifyFull<?=$id?>()"><img style='margin-top: 2.5px;' src='/images/textarea/justify.png'></div>    
    <div class='td' onclick="Indent<?=$id?>()"><img style='margin-top: 2.5px;' src='/images/textarea/push_right.png'></div>                    
    <div class='td' onclick="Outdent<?=$id?>()"><img style='margin-top: 2.5px;' src='/images/textarea/push_left.png'></div>                    
    <div class='td' onclick="InsertOrderedList<?=$id?>()"><img style='margin-top: 2.5px;' src='/images/textarea/ol.gif'></div>                    
    <div class='td' onclick="InsertUnorderedList<?=$id?>()"><img style='margin-top: 2.5px;' src='/images/textarea/ul.gif'></div>    
     
</div>
<div style='display:table'>
    <?if($type=='admin'){?>
        <div class='td'>
            <div class='tmp' style='display:none;'></div>
            <script>
                $(document).ready(function(){
                    
                });
                
                
                
                function save_img(img_path,id){
                    var images = "<img src='"+img_path+"' ";
                    if($('#upload_images_width').val().length>1){
                        images+=" width='"+$('#upload_images_width').val()+"' ";
                    }
                    if($('#upload_images_height').val().length>1){
                        images+=" height='"+$('#upload_images_height').val()+"' ";
                    }
                    images+=" alt='"+$('#upload_images_alt').val()+"' ";
                    images+=" vspace='"+$('#upload_images_vspace').val()+"' ";
                    images+=" hspace='"+$('#upload_images_hspace').val()+"' ";
                    images+=" class='uploaded_img' ";
                    images+=" id='"+id+"' ";
                    images+=" align='"+$('#upload_images_align').val()+"' onclick=\"parent.edit_img(\'"+id+"\')\">";
                    iWin<?=$id?>.focus(); 
                    iWin<?=$id?>.document.execCommand("insertHTML", null, images); 
                }
                
                function edit_img(id){            
                    var tmp_res = '<div><img src="'+$('iframe#<?=$id?>').contents().find('#'+id).attr('src')+'" width="250px"></div>';
                    tmp_res+='<div>ширина:<input style="width:70px" id="upload_images_width" value="';
                    if(typeof($('iframe#<?=$id?>').contents().find('#'+id).attr('width'))!='undefined'){
                        tmp_res+=$('iframe#<?=$id?>').contents().find('#'+id).attr('width');
                    }
                    tmp_res+='"></div>';
                    tmp_res+='<div>висота:<input style="width:70px" id="upload_images_height" value="';
                    if(typeof($('iframe#<?=$id?>').contents().find('#'+id).attr('height'))!='undefined'){
                        tmp_res+=$('iframe#<?=$id?>').contents().find('#'+id).attr('height');
                    }
                    tmp_res+='"></div>';
                    tmp_res+='<div>опис:<input id="upload_images_alt" value="'+$('iframe#<?=$id?>').contents().find('#'+id).attr('alt')+'"></div>';
                    tmp_res+='<div>відступ по вертикалі:<input id="upload_images_vspace" value="'+$('iframe#<?=$id?>').contents().find('#'+id).attr('vspace')+'"></div>';
                    tmp_res+='<div>відступ по горизонталі:<input id="upload_images_hspace" value="'+$('iframe#<?=$id?>').contents().find('#'+id).attr('hspace')+'"></div>';
                    tmp_res+='<div>вирівнбвання:<select id="upload_images_align">';
                    tmp_res+='<option value="left"';
                    if($('iframe#<?=$id?>').contents().find('#'+id).attr('align')=='left'){
                        tmp_res+=' selected ';
                    }
                    tmp_res+='>ліво</option>';
                    tmp_res+='<option value="right"';
                    if($('iframe#<?=$id?>').contents().find('#'+id).attr('align')=='right'){
                        tmp_res+=' selected ';
                    }
                    tmp_res+='>право</option>';
                    tmp_res+='<option value="middle"';
                    if($('iframe#<?=$id?>').contents().find('#'+id).attr('align')=='middle'){
                        tmp_res+=' selected ';
                    }
                    tmp_res+='>центр</option>';
                    tmp_res+='<option value="bottom"';
                    if($('iframe#<?=$id?>').contents().find('#'+id).attr('align')=='bottom'){
                        tmp_res+=' selected ';
                    }
                    tmp_res+='>низ</option>';
                    tmp_res+='<option value="top"';
                    if($('iframe#<?=$id?>').contents().find('#'+id).attr('align')=='top'){
                        tmp_res+=' selected ';
                    }
                    tmp_res+='>верх</option>';
                    tmp_res+='</select></div>';
                    tmp_res+='<div><button onclick="$(\'iframe#<?=$id?>\').contents().find(\'#'+id+'\').remove();save_img(\''+$('iframe#<?=$id?>').contents().find('#'+id).attr('src')+'\',\''+id+'\');destroy_popup();">save</button><button onclick="$(\'iframe#<?=$id?>\').contents().find(\'#'+id+'\').remove();destroy_popup()">dell</button></div>'; 
                    create_popup(tmp_res);
                }
                
                function create_img(id){            
                    var tmp_res = '<div><img src="'+$('#'+id).attr('src')+'" width="250px"></div>';
                    tmp_res+='<div>ширина:<input style="width:70px" id="upload_images_width" value="200px"></div>';
                    tmp_res+='<div>висота:<input style="width:70px" id="upload_images_height" value=""></div>';
                    tmp_res+='<div>опис:<input id="upload_images_alt" value=""></div>';
                    tmp_res+='<div>відступ по вертикалі:<input id="upload_images_vspace" value="0px"></div>';
                    tmp_res+='<div>відступ по горизонталі:<input id="upload_images_hspace" value="0px"></div>';
                    tmp_res+='<div>вирівнювання:<select id="upload_images_align">';
                    tmp_res+='<option value="left">ліво</option>';
                    tmp_res+='<option value="right">право</option>';
                    tmp_res+='<option value="middle">центр</option>';
                    tmp_res+='<option value="bottom">низ</option>';
                    tmp_res+='<option value="top">верх</option>';
                    tmp_res+='</select></div>';
                    tmp_res+='<div><button onclick="save_img(\''+$('#'+id).attr('src')+'\',\''+id+'\');destroy_popup();">save</button><button onclick="destroy_popup()">cancel</button></div>'; 
                    create_popup(tmp_res,'',$('#unique_id').offset().top-200);
                }            
            </script>
            <?$this->load->view("/system/upload_images_view",array(
              'id'=>'unique_id',
              'album'=>'none',
              'lang'=>$lang,
              'output'=>"<img src='/images/textarea/img.jpg'>",
              'script'=>"
                var count = $(\"#unique_id_count_images\").val();
                for(var i=1;i<=count;i++){
                  var tmp_path = $(\".unique_id_uploaded_photo_path\"+i).val();
                  var img_id = 'upload_images'+Math.floor(Math.random()*(9998));
                  $('.tmp').append('<img src=\''+tmp_path+'\' id=\''+img_id+'\'>');      
                  create_img(img_id);
                  $('#'+img_id).remove();
                }
                $(\"#unique_id_count_images\").val(0);
              ",
              'type'=>array('autoload')
            ));
            ?>
        </div>    
        <div class='td' onclick="CreateLink<?=$id?>()"><img id='link<?=$id?>' src='/images/textarea/a_href.gif'></div>
        <div class='td' onclick="Unlink<?=$id?>()"><img src='/images/textarea/a_href_none.gif'></div>
        <div class='td'>
            <div style='position:relative;z-index:100;width:43px;' lang='1' class='my_select' onclick='if($(this).attr("lang")==1){$(this).attr("lang",0);$("#fontsize_values<?=$id?>").show();$("#fontsize_values<?=$id?>").css("display","table");$(this).on("mouseleave",function(){$(this).attr("lang",1);$("#fontsize_values<?=$id?>").hide()})}else{$(this).attr("lang",1);$("#fontsize_values<?=$id?>").hide()}'>розмір
                <div style='display:none;background-color:white' id='fontsize_values<?=$id?>'>
                    <div class='my_select_option' style='width:43px' onclick="FontSize<?=$id?>(1);">10</div>
                    <div class='my_select_option' style='width:43px' onclick="FontSize<?=$id?>(2);">11</div>
                    <div class='my_select_option' style='width:43px' onclick="FontSize<?=$id?>(3);">12</div>
                    <div class='my_select_option' style='width:43px' onclick="FontSize<?=$id?>(4);">13</div>
                    <div class='my_select_option' style='width:43px' onclick="FontSize<?=$id?>(5);">14</div>
                    <div class='my_select_option' style='width:43px' onclick="FontSize<?=$id?>(6);">16</div>
                    <div class='my_select_option' style='width:43px' onclick="FontSize<?=$id?>(7);">18</div>
                </div>
            </div>
        </div>    
        <div class='td'>
            <div style='position:relative;z-index:100;width:120px;' lang='1' class='my_select'
            onclick='if($(this).attr("lang")==1){$(this).attr("lang",0);$("#fontcolor_values<?=$id?>").show()();$("#fontcolor_values<?=$id?>").css("display","table");$(this).on("mouseleave",function(){$(this).attr("lang",1);$("#fontcolor_values<?=$id?>").hide()})}else{$(this).attr("lang",1);$("#fontcolor_values<?=$id?>").hide()}'>колір
                <div style='display:none;background-color:white' id='fontcolor_values<?=$id?>'>
                    <div onclick="ForeColor<?=$id?>('#C0C0C0');" style='float:left;width:25px;height:25px;margin:2px 2px 2px 2px;background-color:#C0C0C0'></div>
                    <div onclick="ForeColor<?=$id?>('#808080');" style='float:left;width:25px;height:25px;margin:2px 2px 2px 2px;background-color:#808080'></div>
                    <div onclick="ForeColor<?=$id?>('#000000');" style='float:left;width:25px;height:25px;margin:2px 2px 2px 2px;background-color:#000000'></div>
                    <div onclick="ForeColor<?=$id?>('#FF0000');" style='float:left;width:25px;height:25px;margin:2px 2px 2px 2px;background-color:#FF0000'></div>
                    <div onclick="ForeColor<?=$id?>('#800000');" style='float:left;width:25px;height:25px;margin:2px 2px 2px 2px;background-color:#800000'></div>
                    <div onclick="ForeColor<?=$id?>('#FFFF00');" style='float:left;width:25px;height:25px;margin:2px 2px 2px 2px;background-color:#FFFF00'></div>
                    <div onclick="ForeColor<?=$id?>('#808000');" style='float:left;width:25px;height:25px;margin:2px 2px 2px 2px;background-color:#808000'></div>
                    <div onclick="ForeColor<?=$id?>('#00FF00');" style='float:left;width:25px;height:25px;margin:2px 2px 2px 2px;background-color:#00FF00'></div>
                    <div onclick="ForeColor<?=$id?>('#008000');" style='float:left;width:25px;height:25px;margin:2px 2px 2px 2px;background-color:#008000'></div>
                    <div onclick="ForeColor<?=$id?>('#00FFFF');" style='float:left;width:25px;height:25px;margin:2px 2px 2px 2px;background-color:#00FFFF'></div>
                    <div onclick="ForeColor<?=$id?>('#008080');" style='float:left;width:25px;height:25px;margin:2px 2px 2px 2px;background-color:#008080'></div>
                    <div onclick="ForeColor<?=$id?>('#0000FF');" style='float:left;width:25px;height:25px;margin:2px 2px 2px 2px;background-color:#0000FF'></div>
                    <div onclick="ForeColor<?=$id?>('#000080');" style='float:left;width:25px;height:25px;margin:2px 2px 2px 2px;background-color:#000080'></div>
                    <div onclick="ForeColor<?=$id?>('#FF00FF');" style='float:left;width:25px;height:25px;margin:2px 2px 2px 2px;background-color:#FF00FF'></div>
                    <div onclick="ForeColor<?=$id?>('#800080');" style='float:left;width:25px;height:25px;margin:2px 2px 2px 2px;background-color:#800080'></div>
                </div>
            </div>
        </div>    
        <div class='td'>
            <div style='position:relative;z-index:100;width:200px;' lang='1' class='my_select'
            onclick='if($(this).attr("lang")==1){$(this).attr("lang",0);$("#fontname_values<?=$id?>").show();$("#fontname_values<?=$id?>").css("display","table");$(this).on("mouseleave",function(){$(this).attr("lang",1);$("#fontname_values<?=$id?>").hide()})}else{$(this).attr("lang",1);$("#fontname_values<?=$id?>").hide()}'>Шрифт
                <div style='display:none;background-color:white;' id='fontname_values<?=$id?>'>
                    <div class='my_select_option' onclick="FontName<?=$id?>('Verdana, Geneva, sans-serif');" style='float:left;font-family:Verdana, Geneva, sans-serif;margin-top:2px;margin-bottom:2px;'>Verdana, Geneva, sans-serif</div>
                    <div class='my_select_option' onclick="FontName<?=$id?>('Georgia, Times New Roman, Times, serif');" style='float:left;font-family:Georgia, Times New Roman, Times, serif;margin-top:2px;margin-bottom:2px;'>Georgia, Times New Roman, Times, serif</div>
                    <div class='my_select_option' onclick="FontName<?=$id?>('Courier New, Courier, monospace');" style='float:left;font-family:Courier New, Courier, monospace;margin-top:2px;margin-bottom:2px;'>Courier New, Courier, monospace</div>
                    <div class='my_select_option' onclick="FontName<?=$id?>('Arial, Helvetica, sans-serif');" style='float:left;font-family:Arial, Helvetica, sans-serif;margin-top:2px;margin-bottom:2px;'>Arial, Helvetica, sans-serif</div>
                    <div class='my_select_option' onclick="FontName<?=$id?>('Tahoma, Geneva, sans-serif');" style='float:left;font-family:Tahoma, Geneva, sans-serif;margin-top:2px;margin-bottom:2px;'>Tahoma, Geneva, sans-serif</div>
                    <div class='my_select_option' onclick="FontName<?=$id?>('Trebuchet MS, Arial, Helvetica, sans-serif');" style='float:left;font-family:Trebuchet MS, Arial, Helvetica, sans-serif;margin-top:2px;margin-bottom:2px;'>Trebuchet MS, Arial, Helvetica, sans-serif</div>
                    <div class='my_select_option' onclick="FontName<?=$id?>('Arial Black, Gadget, sans-serif');" style='float:left;font-family:Arial Black, Gadget, sans-serif;margin-top:2px;margin-bottom:2px;'>Arial Black, Gadget, sans-serif</div>
                    <div class='my_select_option' onclick="FontName<?=$id?>('Times New Roman, Times, serif');" style='float:left;font-family:Times New Roman, Times, serif;margin-top:2px;margin-bottom:2px;'>Times New Roman, Times, serif</div>
                    <div class='my_select_option' onclick="FontName<?=$id?>('Palatino Linotype, Book Antiqua, Palatino, serif');" style='float:left;font-family:Palatino Linotype, Book Antiqua, Palatino, serif;margin-top:2px;margin-bottom:2px;'>Palatino Linotype, Book Antiqua, Palatino, serif</div>
                    <div class='my_select_option' onclick="FontName<?=$id?>('Lucida Sans Unicode, Lucida Grande, sans-serif');" style='float:left;font-family:Lucida Sans Unicode, Lucida Grande, sans-serif;margin-top:2px;margin-bottom:2px;'>Lucida Sans Unicode, Lucida Grande, sans-serif</div>
                    <div class='my_select_option' onclick="FontName<?=$id?>('MS Serif, New York, serif');" style='float:left;font-family:MS Serif, New York, serif;margin-top:2px;margin-bottom:2px;'>MS Serif, New York, serif</div>
                    <div class='my_select_option' onclick="FontName<?=$id?>('Lucida Console, Monaco, monospace');" style='float:left;font-family:Lucida Console, Monaco, monospace;margin-top:2px;margin-bottom:2px;'>Lucida Console, Monaco, monospace</div>
                    <div class='my_select_option' onclick="FontName<?=$id?>('Comic Sans MS, cursive');" style='float:left;font-family:Comic Sans MS, cursive;margin-top:2px;margin-bottom:2px;'>Comic Sans MS, cursive</div>    
                </div>
            </div>
        </div>    
        <div class='td'>
            <div onclick="if($('#textarea_<?=$id?>').attr('lang')=='0'){
                    $('#textarea_<?=$id?>').attr('lang','1');
                    $('#textarea_<?=$id?>').val(getHTML<?=$id?>());
                    $('#textarea_<?=$id?>').show();
                    $('#<?=$id?>').hide();
                }else{
                    $('#textarea_<?=$id?>').attr('lang','0');
                    setHTML<?=$id?>($('#textarea_<?=$id?>').val());
                    $('#textarea_<?=$id?>').hide();
                    $('#<?=$id?>').show();
                }
                ">
                change input
            </div>
        </div>
    <?}?>
</div>
<div style='display:none' id='text_iframe<?=$id?>' name='text_iframe<?=$id?>'><?=$text?></div>
<textarea style='display:none;width:<?=$width?>;height:<?=$height?>' id='textarea_<?=$id?>' name='textarea_<?=$id?>' lang='0'><?=$text?></textarea>
<iframe src='#' id='<?=$id?>' name='<?=$name?>' width='<?=$width?>' height='<?=$height?>'></iframe>
</div>
<script>
    var isGecko<?=$id?> = navigator.userAgent.toLowerCase().indexOf("gecko") != -1; 
    var iframe<?=$id?> = (isGecko<?=$id?>) ? document.getElementById("<?=$id?>") : frames["<?=$id?>"]; 
    var iWin<?=$id?> = (isGecko<?=$id?>) ? iframe<?=$id?>.contentWindow : iframe<?=$id?>.window; 
    var iDoc<?=$id?> = (isGecko<?=$id?>) ? iframe<?=$id?>.contentDocument : iframe<?=$id?>.document; 
    iDoc<?=$id?>.open(); 
    iDoc<?=$id?>.write($('#text_iframe<?=$id?>').html()); 
    iDoc<?=$id?>.close(); 

    if (!iDoc<?=$id?>.designMode) alert("Визуальный режим редактирования не поддерживается Вашим браузером"); 
    else iDoc<?=$id?>.designMode = (isGecko<?=$id?>) ? "on" : "On"; 

    function CreateLink<?=$id?>(){
        create_popup('URL:<input id="href_url"><br><button onclick="iWin<?=$id?>.focus();iWin<?=$id?>.document.execCommand(\'CreateLink\', null, $(\'#href_url\').val());destroy_popup();">add</button>','link',$("#link<?=$id?>").offset().top);
    }
    
    function Indent<?=$id?>() { 
          iWin<?=$id?>.focus(); 
          iWin<?=$id?>.document.execCommand("Indent", null, ""); 
    } 
    function InsertOrderedList<?=$id?>() { 
          iWin<?=$id?>.focus(); 
          iWin<?=$id?>.document.execCommand("InsertOrderedList", null, ""); 
    } 
    function InsertUnorderedList<?=$id?>() { 
          iWin<?=$id?>.focus(); 
          iWin<?=$id?>.document.execCommand("InsertUnorderedList", null, ""); 
    } 
    function Outdent<?=$id?>() { 
          iWin<?=$id?>.focus(); 
          iWin<?=$id?>.document.execCommand("Outdent", null, ""); 
    } 
    function Unlink<?=$id?>() { 
          iWin<?=$id?>.focus(); 
          iWin<?=$id?>.document.execCommand("Unlink", null, ""); 
    } 
    function setBold<?=$id?>() { 
          iWin<?=$id?>.focus(); 
          iWin<?=$id?>.document.execCommand("bold", null, ""); 
    } 
    function ForeColor<?=$id?>(color) { 
          iWin<?=$id?>.focus(); 
          iWin<?=$id?>.document.execCommand("ForeColor", null, color); 
    } 
    function setItal<?=$id?>() { 
          iWin<?=$id?>.focus(); 
          iWin<?=$id?>.document.execCommand("italic", null, ""); 
    } 
    function setUnder<?=$id?>() { 
          iWin<?=$id?>.focus(); 
          iWin<?=$id?>.document.execCommand("underline", null, ""); 
    }
    function FontName<?=$id?>(font) { 
          iWin<?=$id?>.focus(); 
          iWin<?=$id?>.document.execCommand("FontName", null,font); 
    }
    function JustifyCenter<?=$id?>() { 
          iWin<?=$id?>.focus(); 
          iWin<?=$id?>.document.execCommand("JustifyCenter", null, ""); 
    }
    function JustifyLeft<?=$id?>() { 
          iWin<?=$id?>.focus(); 
          iWin<?=$id?>.document.execCommand("JustifyLeft", null, ""); 
    }
    function JustifyRight<?=$id?>() { 
          iWin<?=$id?>.focus(); 
          iWin<?=$id?>.document.execCommand("JustifyRight", null, ""); 
    }
    function JustifyFull<?=$id?>() { 
          iWin<?=$id?>.focus(); 
          iWin<?=$id?>.document.execCommand("JustifyFull", null, ""); 
    }
    function getHTML<?=$id?>() {
          return iDoc<?=$id?>.body.innerHTML;
    }
    function setHTML<?=$id?>(html) {
          iDoc<?=$id?>.body.innerHTML = html;
    }
    function FontSize<?=$id?>(size){
        iWin<?=$id?>.focus(); 
        iWin<?=$id?>.document.execCommand("FontSize", null, size); 
    }
    function BackColor<?=$id?>(color){
        iWin<?=$id?>.focus(); 
        iWin<?=$id?>.document.execCommand("BackColor", null, color); 
    }
    function InsertImage<?=$id?>(id){
        iWin<?=$id?>.focus(); 
        iWin<?=$id?>.document.execCommand("InsertImage", null, id); 
    }
    function InsertSmile<?=$id?>(key,s1,s2,s3){
        iWin<?=$id?>.focus();
        iWin<?=$id?>.document.execCommand('insertHTML', null, "<img src='/images/smileys/"+key+"' style=\'width: "+s1+"px;height:"+s2+";' title='"+s3+"'>");
    }
</script>