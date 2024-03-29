<?php
/**
 * ------------------------------------------------------------------------
 * JA Accordion Module for J25 & J31
 * ------------------------------------------------------------------------
 * Copyright (C) 2004-2011 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
 * @license - GNU/GPL, http://www.gnu.org/licenses/gpl.html
 * Author: J.O.O.M Solutions Co., Ltd
 * Websites: http://www.joomlart.com - http://www.joomlancers.com
 * ------------------------------------------------------------------------
 */

/**
 * Display tab
 */
// no direct access
defined('_JEXEC') or die('Restricted access');?>
<div id="ja-accordion<?php echo $module->id?>"	class="ja-accordion ja-accordion<?php echo $module->id?><?php echo $params->get('moduleclass_sfx')?>">
<?php
if (!empty($accordionData)) :
?>
<ul class="ja-accordion-containner ja-accordion-containner<?php echo $module->id?>" style="width:<?php echo (intval($params->get('Width')) > 0) ? intval($params->get('Width')) . 'px' : '100%'?>">
	<?php
    foreach ($accordionData as $accordion) :
    ?>
    <li>
		<h3 class="ja-accordion-title ja-accordion-title<?php echo $module->id?>"><?php echo $accordion->title?></h3>
		<div class="ja-accordion-content ja-accordion-content<?php echo $module->id?>"><?php echo $accordion->content?></div>
    </li>
	<?php
    endforeach ;
    ?>
</ul>
<?php
endif ;
?>
</div>
<script type="text/javascript">
	window.addEvent('domready', function(){
		var myAccordion = new Fx.Accordion($('ja-accordion<?php echo $module->id?>'), $$('.ja-accordion-title<?php echo $module->id?>'), $$('.ja-accordion-content<?php echo $module->id?>'), {
			alwaysHide: true,
			display: 0,
			trigger: '<?php echo $params->get("mouseType", 'click')?>',
			duration: <?php echo intval($params->get('duration'))?>,
			transition: <?php echo trim($params->get('effect', 'Fx.Transitions.Elastic.linear'))?>,
			onActive: function(toggler, element){
				toggler.addClass('active');				
				element.addClass('active');				
			},
			onBackground: function(toggler, element){
				toggler.removeClass('active');
				element.removeClass('active');
			}
		});
	});
</script>