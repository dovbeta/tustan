<div id='[%%%id%%%]' class='comment' itemprop="review" itemscope itemtype="http://schema.org/Review">
	<div class='comments_center'>
		<?if(isset($user[0]['type'])&&(($user[0]['type']=='admin')||($user[0]['id']==[%%%user_id%%%]))){?>
			<div style='width:100%;'>
			<div style='cursor:pointer;float:right;' class='edit_comments' id='edit_comments[%%%id%%%]' onclick="edit_comments('[%%%id%%%]','[%%%whot_id%%%]')">Редагувати</div>
			<div style='cursor:pointer;float:right;margin-right:15px;' class='dell_comments' onclick="dell_comments_forewer('[%%%id%%%]','[%%%whot_id%%%]')">Видалити</div>
			</div>
		<?}?>
		<span itemprop="author" itemscope itemtype="http://schema.org/Person">
            <div class='comment_user' itemprop="name" >[%%%user_name%%%]</div>
        </span>
        <div class='comment_date' itemprop="datePublished">[%%%date%%%]</div>
		<div class='comment_text' id='comment_text[%%%id%%%]'><span itemprop="reviewBody">[%%%text%%%]</span></div>
		<?if(isset($user[0]['type'])){?>
			<?if($user[0]['id']!=[%%%user_id%%%]){?>
				<div id="answer[%%%id%%%]" style='cursor:pointer' onclick="answer('[%%%id%%%]')"><?=$this->lang->line('answer')?></div>
			<?}?>
		<?}else{?>
			<div id="answer[%%%id%%%]" style='cursor:pointer' onclick="answer('[%%%id%%%]')"><?=$this->lang->line('answer')?></div>
		<?}?>
	</div>
</div>
