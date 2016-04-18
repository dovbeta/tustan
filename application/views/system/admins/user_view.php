<?php header('Content-Type: text/html; charset=UTF-8');?>
<table width='550px'>
				<tr>
					<td align='center'><b>логін</b></td>
					<td align='center'><b>телефон</b></td>
					<td align='center'><b>П.І.П.</b></td>
					<td align='center'><b>тип</b></td>			
					<td align='center'></td>			
				</tr>
				<?foreach($user as $u){?>
					<tr>
					<td align='center'><?=$u['login']?></td>
					<td align='center'><?=$u['tell']?></td>
					<td align='center'><?=$u['firstname']?> <?=$u['lastname']?></td>
					<td align='center'><?=$u['type']?></td>
					<td align='center'><span style='color:red;cursor:pointer' onclick='dell_user(<?=$u['id']?>)'>видалити</span></td>
					</tr>
				<?}?>
				
				</table>