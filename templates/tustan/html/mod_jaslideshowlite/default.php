<?php
/**
 * ------------------------------------------------------------------------
 * JA Slideshow Lite Module for J25 & J31
 * ------------------------------------------------------------------------
 * Copyright (C) 2004-2011 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
 * @license - GNU/GPL, http://www.gnu.org/licenses/gpl.html
 * Author: J.O.O.M Solutions Co., Ltd
 * Websites: http://www.joomlart.com - http://www.joomlancers.com
 * ------------------------------------------------------------------------
 */
defined('_JEXEC') or die('Restricted access');
?>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
	<!--<div class="soc-slider">
		<a href="#" class="g-pl"></a>
		<a href="#" class="twit"></a>
		<a href="#" class="vk"></a>
		<a href="#" class="fb"></a>
		<a href="#" class="rs"></a>
		<a href="#" class="odkl"></a>
	</div>
	-->
	<!--<ol class="carousel-indicators">
	<?php for ($i = 0; $i < count($images); $i++): ?>
		<li data-target="#carousel-example-generic" data-slide-to="<?php echo $i;?>"<?php if($i==0) echo ' class="active"';?>></li>
	<?php endfor; ?>
	</ol>-->

	<div class="carousel-inner">	
	<?php for ($i = 0; $i < count($images); $i++): ?>
		<div class="item<?php if($i==0) echo ' active';?>">
			<img src="<?php echo $images[$i];?>" alt="slider img"/>			
		</div>
	<?php endfor; ?>
	</div>

	<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left"></span>
	</a>
	<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right"></span>
	</a>
</div>
