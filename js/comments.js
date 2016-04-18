$(document).ready(function(){
    var not_login_user_name = localStorage['not_login_user_name'];
    if((not_login_user_name!=undefined)&&(not_login_user_name!="undefined")){
        $("#not_login_name").val(not_login_user_name); 
        
    }
}
);

function add_comments(whot,whot_id,textarea){
	if(typeof(coments_id)!='undefined'){
		default_comments(coments_id);
	}
    var dateObj = new Date();
    var s_date = dateObj.getFullYear()+"-"+('0'+(dateObj.getMonth()+1)).slice(-2)+"-"+('0'+dateObj.getDate()).slice(-2)+" "+dateObj.getHours()+":"+dateObj.getMinutes()+":"+dateObj.getSeconds();
    localStorage['not_login_user_name'] = $("#not_login_name").val();
	var text = $('iframe#comment_text').contents().find('body').html(); 
	if(text.length>1){
			$("#answer_form_w").parent().html($("#answer_form_w").parent().children('button').html());
			$.post("/vidhuky/add_comment",
			{
				whot:whot,
				whot_id:whot_id,
                text:text,
				date:s_date,
				lang:$("#langues").val(),
				type:$("#type_comment").val(),
				user_name:$("#not_login_name").val(),
				user_mail:$("#not_login_email").val()
			},
			function(html){
				var data = html.split('[%%%|%%%]');
				if(data.length==1){
					alert(html);
				}else{
					$(".comments").append('<div class="comment_user"><b>'+data[0]+'</b></div><div class="comment_date">'+s_date+'</div><div class="comment_text">'+data[2]+'</div>');
					$('iframe#comment_text').contents().find('body').html('');
				}
			});
		}
}

function dell_comments_forewer(id,whot_id){
	if(confirm('Видалити?')){
		$.post("/vidhuky/dell_comments_forewer",{id:id,whot:$("#whot").val(),whot_id:whot_id},function (){
			$("#"+id).parent().remove();
		});
	}
}

function edit_comments(id,whot_id){
	if($("#edit_comments"+id).html()=='Редагувати'){
		$("#edit_comments"+id).html('Зберегти');
		var comment = $('#comment_text'+id).html();
		$('#comment_text'+id).html($('#add_comments_form').html());
		$('#comment_text'+id+' iframe#comment_text').contents().find('body').html(comment);
	}else{
		var tmp = $('#comment_text'+id+' iframe#comment_text').contents().find('body').html();
		$.post("/vidhuky/update_comments",{id:id,whot:$("#whot").val(),new_data:tmp,whot_id:whot_id},function (){
			$('#comment_text'+id).html(tmp);
			$("#edit_comments"+id).html('Редагувати');
		});
	}
}

function answer(id){
	if(typeof(coments_id)=='undefined'){
		coments_id = id;
        
        localStorage['not_login_user_name'] = $("#not_login_name").val();
		var text_answer = $('#answer'+id).html();
		$('#answer'+id).html("<div id='answer_form_w'>"+$('#add_comments_form').html()+"</div>");
		$('#answer'+id).append("<button onclick='add_ansver("+id+")' id='button_text_answer'>"+text_answer+"</button>");
		$('#answer'+id).unbind();
		$('#answer'+id).attr('onclick','');
	}else{
		default_comments(coments_id);
		answer(id);
	}
}

function default_comments(id){
	$('#answer'+id).html($("#button_text_answer").html());
	$('#answer'+id).bind('click',function(){
		answer(id);
	});
	delete coments_id;
}


function add_ansver(id){
	var text = $('iframe#comment_text').contents().find('body').html(); 
	if(text.length>1){
         var dateObj = new Date();
         var s_date = dateObj.getFullYear()+"-"+('0'+(dateObj.getMonth()+1)).slice(-2)+"-"+('0'+dateObj.getDate()).slice(-2)+" "+dateObj.getHours()+":"+dateObj.getMinutes()+":"+dateObj.getSeconds();
		$.post("/vidhuky/add_comment",
		{
			whot:$("#whot").val(),
			whot_id:$("#whot_id").val(),
			text:text,
            date:s_date,
			lang:$("#langues").val(),
			type:$("#type_comment").val(),
			parent_id:id,
			user_name:$("#not_login_name").val(),
			user_mail:$("#not_login_email").val()
		},
		function(html){
			var data = html.split('[%%%|%%%]');
			if(data.length==1){
				alert(html);
			}else{
				$('#'+id+'+ div:first').append('<div class="comment_user"><b>'+data[0]+'</b></div><div class="comment_date">'+data[1]+'</div><div class="comment_text">'+data[2]+'</div>');
				default_comments(id);
			}
		});
	}
}