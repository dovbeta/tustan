<script type="text/javascript" src="/js/comments.js"></script>
<style>
	.comment_user{
		float: left;
		margin-right: 15px;
	}
	.comment{
		margin-top:10px;
		margin-bottom:10px;
		-webkit-border-radius:10px;
		-moz-border-radius:10px;
		border-radius:10px;
		
	}
	.comment_text{
		padding-left: 15px;
	}
	#comments_show_all_of{
		cursor:pointer;
	}
	.answer_odd{
		background:#c6c6c6;
		margin-left:25px;
		-webkit-border-radius:10px;
		-moz-border-radius:10px;
		border-radius:10px;
	}
	.answer_evan{
		background:#e4e4e4;
		margin-left:25px;
		-webkit-border-radius:10px;
		-moz-border-radius:10px;
		border-radius:10px;
	}
	.branch{
		background:#e4e4e4;
		-webkit-border-radius:10px;
		-moz-border-radius:10px;
		border-radius:10px;
	}
	.edit_comments:hover{
		background-color:#79ad7b;
	}
	.dell_comments:hover{
		background-color:#ad7979;
	}
	.comments_center{
		padding: 15px;
		display:table;
		width:600px;
	}
</style>
<?if(file_exists('./comments/'.$whot.'/'.$whot_id.'_view.php')){?>
	<?include('./comments/'.$whot.'/'.$whot_id.'_view.php')?>
<?}else{?>
	<div class='comments'></div>
<?}?>
<?if(!isset($type)){
	$type='user';
}?>

<input type='hidden' value='<?=$whot?>' id='whot'>
<input type='hidden' value='<?=$whot_id?>' id='whot_id'>

<?if(($type=='not_login')){?>
	<div>
		<table>
			<tr>
				<td id='add_comments_form'>
					<?$this->load->view('/system/textarea_view',array('type'=>$type,'name'=>'comment_text','text'=>'','height'=>150,'id'=>'comment_text'))?>
				</td>
			</tr>
			<tr>
				<td>
				<button class='button' onclick="add_comments('<?=$whot?>','<?=$whot_id?>','comment_text')">
					<span><?=$text?></span>
				</button></td>
			</tr>
		</table>
	</div>
<?}?>
