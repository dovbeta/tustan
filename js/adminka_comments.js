function get_comments(){
	$.post("/adminka/comments/comments_info",function (html){
		$("#admin_data").html(html);
	});
}

function dell_comments(id){
	if(confirm('Видалити?')){
		$.post("/adminka/comments/dell_comments",{id:id},function (html){
			$("#admin_data").html(html);
		});
	}
}

function dell_comments_forewer(id,whot_id){
	if(confirm('Видалити?')){
		$.post("/adminka/comments/dell_comments_forewer",{id:id,whot:$("#whot").val(),whot_id:whot_id},function (){
			$("#"+id).remove();
		});
	}
}

function restore_comments(id){
	if(confirm('Відновити?')){
		$.post("/adminka/comments/restore_comments",{id:id},function (html){
			$("#admin_data").html(html);
		});
	}
}


function edit_comments(id,whot_id){
	if($("#edit_comments"+id).html()=='Редагувати'){
		$("#edit_comments"+id).html('Зберегти');
		$('#comment_text'+id).html("<textarea  style='width:"+$('#comment_text'+id).css('width')+";height:100px'>"+$('#comment_text'+id).html()+"</textarea>");
	}else{
		var tmp = $('#comment_text'+id).children('textarea:first').val();
		$.post("/adminka/comments/update_comments",{id:id,whot:$("#whot").val(),new_data:tmp,whot_id:whot_id},function (){
			$('#comment_text'+id).html(tmp);
			$("#edit_comments"+id).html('Редагувати');
		});
	}
}

function comments_page(start){
	$.post("/adminka/comments/get_comments/"+start+"/"+$("#count_comments_page").val(),function (html){
		$("#admin_data").html(html);
	});
}