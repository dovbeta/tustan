<?$count=$news['c'][0]['c']?>

<a href="#" style="display:none;" id="nw" onclick="new_news('<?=$lang?>')">новіші</a>
<div id="news">
<?$this->load->view('/system/content_news_view');?>
</div>
<input type="hidden" id="start" value="0">
<input type="hidden" id="count" value="<?=$count?>">
<?if($news['c'][0]['c']>3){?>
<center>
<a href="#" id="ld" onclick="old_news('<?=$lang?>')"><img src="/images/news/down.png" width="50px"></a>
</center>
<?}?>
