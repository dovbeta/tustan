<?php header('Content-Type: text/html; charset=UTF-8');?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>

<meta NAME="keywords" content="отель ТуСтань в Сходнице, Сходница, курорт Східниця, тустань сходница, готель Тустань Східниця, Сходница отели, отдых в Сходнице, лечение в сходнице, відпочинок в східниці, східниця готелі, отдых в Карпатах, отдых и лечение Сходница, сходница отель тустань, східниця готель 4*, лікування в східниці">

<meta NAME="description"content="відпочинок та оздоровлення в готелі ТуСтань Східниця в Карпатах">

<meta name='yandex-verification' content='78c737201d5a7d8e' />

<meta name="google-site-verification" content="P9M_la_y-NbkRt2TRHx5txUf65hoyrL-9_HqFtxjuqA" />

		<title><?=$title?></title>
		<link rel="stylesheet" type="text/css" href="/css/style.css">
		<script type="text/javascript" src="/js/jquery.js"></script>
		<script type="text/javascript" src="/js/script.js"></script>
	</head>
	<body onload="conf()">
		<input type="hidden" value="<?=$lang?>" id="langues">
		
		<!-- Шапка сайту і верхня половина фону -->
		<div class="bg_top" id="bg_top"></div>
        
		<div class="head">
			<div class="logo">
				<img src="/images/logo.png" alt="Hotel Tustan Logo">
                <?$this->load->view("/top_telephone/top_telephone_view")?>
				<div class="lang" id="lang">
					<?$this->load->view("/system/lang_view")?>
				</div>
			</div>
		</div>

		
		<!-- Кінець шапки -->
		
<!-- cut here -->
<?if(isset($user[0]['type'])){?>
				<?if($user[0]['type']=='admin'){?><a href="/adminka"> Адмінка </a><?}?>	
			<?}?>
		
		<div class="page">

<!-- cut here -->
		<div class="menu" id="menu">
            <?$this->load->view('/system/menu_view')?>
		</div>
        <div class="content">
