<?php header('Content-Type: text/html; charset=UTF-8');?>
<table width='550px'>
				<tr>
					<td align='center'><b>дата заїзду</b></td>
					<td align='center'><b>дата виїзду</b></td>
					<td align='center'><b>телефон</b></td>
					<td align='center'><b>П.І.П.</b></td>
					<td align='center'><b>тип номеру</b></td>
					<td></td>
				</tr>
				<?foreach($bron as $b){?>
					<tr>
					<td align='center'><?=$b['start_date']?></td>
					<td align='center'><?=$b['end_date']?></td>
					<td align='center'><?=$b['tell']?></td> 
					<td align='center'><?=$b['firstname']?> <?=$b['lastname']?></td>
					<td align='center'>
					<?switch ($b['type_room']){
						case "single": echo "oдномісний";break;
						case "double":echo "двомісний";break;
						case "junior":echo "напівлюкс";break;
						case "luxe":echo "люкс";break;
					}?>
					</td>
					<td align='center'><span style='color:red;cursor:pointer' onclick="dell_bron('<?=$b['id']?>')">видалити</span></td>
					
					</tr>
				<?}?>
				
</table>