
<?for($n=0;$n<count($news)-1;$n++){?>
	<div id="news_elm" class="news_elm"> <?/* якщо ти не збираєшся використовувати id="news_elm" для жабоскрипта, то id видали і лиши тільки class */?>
		<div id="news_content" class="news_content">
			<div id="news_img" class="news_img">
				<a href="/news/show_news/<?=$lang?>/<?=$news[$n]['id']?>"><img src="/images/news/<?=$news[$n]['img']?>" width="90%"></a>
			</div>
			<b><a href="/news/show_news/<?=$lang?>/<?=$news[$n]['id']?>">
			<!--початок виводу заголовка новини, та встановлення переносу якщо слово завелике. перенос іде після 8 букви -->
			<?$tmp='';
			for($i=0;$i<strlen($news[$n]['title']);$i++){
				if(($news[$n]['title'][$i]==' ')||($i==strlen($news[$n]['title'])-1)){
					$tmp.=$news[$n]['title'][$i];
					$word='';
					for($j=0;$j<strlen($tmp);$j++){
						if(($j==18)&&($tmp[$j]!=' ')){
							$word.="-<br>";
						}
						$word.=$tmp[$j];
					}
					echo $word;
					$tmp='';
					
				}else{
					$tmp.=$news[$n]['title'][$i];
				}		
			}
			?>
			<!--закінчення виводу заголовка новини, та встановлення переносу якщо слово завелике. перенос іде після 8 букви -->
			</a></b>
			<br>
			<a href="/news/show_news/<?=$lang?>/<?=$news[$n]['id']?>" >
			<?$nw = '';
			$w=1;
			$b=125;
			$s=0;
			for($i=0;$i<strlen($news[$n]['new']);$i++){
				if(($i>$b)&&($news[$n]['new'][$i]==' ')){
					$nw.="...";
					break;
				}
				if($news[$n]['new'][$i]=='<'){
					$w--;
					$s=$i;
				}			
				if($w==1){
					$nw.=$news[$n]['new'][$i];
				}
				if($news[$n]['new'][$i]=='>'){
					$w++;
					$b+=$i-$s;
				}
			}
			echo $nw?>
			</a>
		</div>
	</div>
<?}?>