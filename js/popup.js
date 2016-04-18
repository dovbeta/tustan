function destroy_popup(){
	$("#shadow_bg").remove();
}
function create_popup(text,title_text,top,width,close){
	$('body').append("<div id='shadow_bg' style='background:url(/images/textarea/shadow_bg.png);'></div>");
	$('#shadow_bg').css("width",$('body').width()+16);
	$('#shadow_bg').css("height",$('body').height()+16);
	$('#shadow_bg').css("position","absolute");
	$('#shadow_bg').css("left","0px");
	$('#shadow_bg').css("top","0px");
	$('#shadow_bg').css("z-index","1000");
	if(width==undefined){
		width=600;
	}
	if(top==undefined){
		top=200;
	}
	if(close==undefined){
		close=true;
	}
	if(title_text==undefined){
		title_text=' ';
	}
	var html = "<div style='text-align:center;margin:";
	html+=(top)+"px auto;width: "+width+"px;'>";
	html+="<table CELLPADDING='0px' CELLSPACING='0px'width='"+width+"px' style='border-collapse: collapse;border-spacing: 0px;'>";
	html+="<tr>";
	html+="<td style='background-image: url(/images/popup_window/top_left.png);width:27px;height:35px;'> </td>";
	html+="<td style='background-image: url(/images/popup_window/top_center.png);width:"+(width-27-34)+"px;height:35px;'>"+title_text+"</td>";
	html+="<td style='background-image: url(/images/popup_window/top_right.png);width:34px;height:35px;'>";
	if(close){
		html+="<img src='/images/popup_window/close.png' style='cursor:pointer;margin-left: -20px;margin-top: 5px;' onclick='destroy_popup()'>";
	}
	html+="</td>";
	html+="</tr>";
	html+="<tr>";
	html+="<td style='background-image: url(/images/popup_window/center_left.png);width:27px;'></td>";
	html+="<td id='popup_window' style='background-image: url(/images/popup_window/center_center.png);width:"+(width-27-34)+"px;min-height:15px;'>"+text+"</td>";
	html+="<td style='background-image: url(/images/popup_window/center_right.png);width:27px;'></td>";
	html+="</tr>";
	html+="<tr>";
	html+="<td style='background-image: url(/images/popup_window/bottom_left.png);width:27px;height:38px;'></td>";
	html+="<td style='background-image: url(/images/popup_window/bottom_center.png);width:"+(width-27-34)+"px;height:38px;'></td>";
	html+="<td style='background-image: url(/images/popup_window/bottom_right.png);width:27px;height:38px;'></td>";
	html+="</tr>";
	html+="</table>";
	$('#shadow_bg').append(html);	
}