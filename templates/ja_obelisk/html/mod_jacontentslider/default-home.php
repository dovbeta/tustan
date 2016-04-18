<?php
/**
 * ------------------------------------------------------------------------
 * JA Obelisk Template
 * ------------------------------------------------------------------------
 * Copyright (C) 2004-2011 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
 * @license - Copyrighted Commercial Software
 * Author: J.O.O.M Solutions Co., Ltd
 * Websites:  http://www.joomlart.com -  http://www.joomlancers.com
 * This file may not be redistributed in whole or significant part.
 * ------------------------------------------------------------------------
 */

// no direct access
defined('_JEXEC') or die('Restricted access');
/* Defined array order field
*/

$order_field = array("created","ordering","hits");
/*
 * Get sort order field
 * Return created, ordering,hits
 *
 */
$sort_order_field = $params->get('sort_order_field');

if ($total):
    $mainframe = JFactory::getApplication();
    $tmplPath = 'templates/' . $mainframe->getTemplate() . '/';
    $tmplimages = $tmplPath . 'images/';
    $modPath = 'modules/mod_jacontentslider/assets/images/';
    //Images
    $image_path = $modPath;
    if (file_exists(JPATH_SITE . '/' . $tmplimages . 're-left.gif')) {
        $image_path = $tmplimages;
    }
    $image_path = str_replace('\\', '/', $image_path);

    $cateArr = array();
    foreach ($contents as $contn) {
        if (isset($contn->cateName) && !isset($cateArr[$contn->catid])) {
            $cateArr[$contn->catid] = $contn->cateName;
        }
    }
    if (!$showTab || count($cateArr) <= 1) {
        //if not display tabs
        //we must show all items of All Categories on one tab
        $firstCid = 0;
    } else {
        $firstCid = array_keys($cateArr);
        $firstCid = $firstCid[0];
    }
?>
<!-- Script running when click -->



<?php
    /*
     * Return toolbar
     * It's show only one
     * */
    $firstActive = '';
    if(!defined('JA_CONTENTSLIDER_TOOLBAR_ORDER')){
        echo '<div class="ja-contentslider-wrapper">';
        $script = '<script type="text/javascript">'
            .' function contentSliderOrder(e,classid){
                    $$(".ja-contentslider-'.$module->id.' ").removeClass("active");
                    $$(".ja-control-order-'.$module->id.' .jactoolbar").removeClass("active");
                    $$(".ja-control-order-'.$module->id.' .jactoolbar-"+classid).addClass("active");
                    $("ja-contentslider-"+classid+"-'.$module->id.'").addClass("active");
               }'
            .'</script>';
        echo  $script;
        echo '<div class="ja-button-control ja-control-order-'.$module->id.'">';
        foreach($order_field as $o){
            $act = '';
            if($o == $sort_order_field) $act =' active';
            echo '<a href="javascript:contentSliderOrder(this,\''.$o.'\')" class="jactoolbar-'.$o.' jactoolbar'.$act.'">';
            echo JText::_('TPL_JA_MOD_CONTENTSLIDER_'.strtoupper($o));
            echo '</a>';
        }
        if(count($catid) == 1 && $catid[0] != ''){
            if($params->get('source') == 'content'){
                echo '<a class="ja-contentslider_view_all" href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($catid[0])).'" title="'.JText::_('TPL_JA_MOD_CONTENTSLIDER_VIEW_ALL_TITLES').'">'.JText::_('TPL_JA_MOD_CONTENTSLIDER_VIEW_ALL').'</a>';
            }else if($params->get('source') == 'k2'){
                echo '<a class="ja-contentslider_view_all" href="'.urldecode(JRoute::_(K2HelperRoute::getCategoryRoute($catid[0]))).'" title="'.JText::_('TPL_JA_MOD_CONTENTSLIDER_VIEW_ALL_TITLES').'">'.JText::_('TPL_JA_MOD_CONTENTSLIDER_VIEW_ALL').'</a>';

            }
        }
        echo '</div>';

        $firstActive = ' active';

        /*
         * Link view all
         * It's show when choise only one category
         * */
		?>
		<script type="text/javascript">
		function setDirection<?php echo $module->id;?>(direction,ret, jscontentslider) {
			jscontentslider.options.direction = direction;
			
			if(ret){
				jscontentslider.options.auto = <?php echo $auto; ?>;
				jscontentslider.options.interval = <?php echo $delaytime; ?>;
				jscontentslider.options.direction = '<?php echo $direction; ?>';
			}
			else{
				jscontentslider.options.auto = 1;
				jscontentslider.options.interval = 100;
				jscontentslider.nextRun();
				jscontentslider.options.interval = <?php echo $delaytime; ?>;
			}
		}
		
		function setDirection2<?php echo $module->id;?>(direction, jscontentslider) {
			var oldDirection = jscontentslider.options.direction;
			
			jscontentslider.options.direction = direction;
			
			jscontentslider.options.interval = 100;
			jscontentslider.options.auto = 1;
			jscontentslider.nextRun();
			jscontentslider.options.auto = <?php echo $auto; ?>;
			jscontentslider.options.interval = <?php echo $delaytime; ?>;
			
			setTimeout(function(){
				jscontentslider.options.direction = oldDirection;
			}, 510);
		}
		</script>
		<?php
        define('JA_CONTENTSLIDER_TOOLBAR_ORDER','1');
    }

?>

<script type="text/javascript">
	//<!--[CDATA[
	function contentSliderInit_<?php echo $sort_order_field;?>_<?php echo $module->id;?> (cid) {
		cid = parseInt(cid);
		var containerID = 'ja-contentslider-<?php echo $sort_order_field;?>-<?php echo $module->id;?>';
		var container =  $(containerID);

		container.getElements('.jsslide').each(function(el){
			el.dispose();
		});

		if(cid == 0) {
			var elems = container.getElement('#ja-contentslider-center-<?php echo $sort_order_field;?>-<?php echo $module->id;?>').getElements('div[class*=content_element]');
		}else{
			var elems = container.getElement('#ja-contentslider-center-<?php echo $sort_order_field;?>-<?php echo $module->id;?>').getElements('div[class*=jaslide2_'+cid+']');
		}
		var total = elems.length;

		var options={
			w: <?php echo $xwidth; ?>,
			h: <?php echo $xheight; ?>,
			num_elem: <?php echo  $numElem; ?>,
			mode: '<?php  echo  $mode; ?>', //horizontal or vertical
			direction: '<?php echo $direction; ?>', //horizontal: left or right; vertical: up or down
			total: total,
			url: '<?php echo JURI::base(); ?>modules/mod_jacontentslider/mod_jacontentslider.php',
			wrapper:  container.getElement("div.ja-contentslider-center"),
			duration: <?php echo $animationtime; ?>,
			interval: <?php echo $delaytime; ?>,
			modid: <?php echo $module->id;?>,
			running: false,
			auto: <?php echo $auto;?>
		};

		var jscontentslider = new JS_ContentSlider( options );

		for(i=0;i<elems.length;i++){
			jscontentslider.update (elems[i].innerHTML, i);
		}
		jscontentslider.setPos(null);
		if(jscontentslider.options.auto){
			jscontentslider.nextRun();
		}

		<?php if( $params->get( 'showbutton' ) || ($params->get( 'showbutton' ) == '') ): ?>
		  <?php if($params->get( 'scroll_when', 'click' ) == 'click'): ?>
			<?php if ($mode == 'vertical'): ?>
			container.getElement(".ja-contentslide-up-img").onclick = function(){setDirection2<?php echo $module->id;?>('down', jscontentslider);};
			container.getElement(".ja-contentslide-down-img").onclick = function(){setDirection2<?php echo $module->id;?>('up', jscontentslider);};
			<?php else: ?>
			container.getElement(".ja-contentslide-left-img").onclick = function(){setDirection2<?php echo $module->id;?>('right', jscontentslider);};
			container.getElement(".ja-contentslide-right-img").onclick = function(){setDirection2<?php echo $module->id;?>('left', jscontentslider);};
			<?php endif; //vertical? ?>
		  <?php else: ?>
			<?php if ($mode == 'vertical'): ?>
			container.getElement(".ja-contentslide-up-img").onmouseover = function(){setDirection<?php echo $module->id;?>('down',0, jscontentslider);};
			container.getElement(".ja-contentslide-up-img").onmouseout = function(){setDirection<?php echo $module->id;?>('down',1, jscontentslider);};
			container.getElement(".ja-contentslide-down-img").onmouseover = function(){setDirection<?php echo $module->id;?>('up',0, jscontentslider);};
			container.getElement(".ja-contentslide-down-img").onmouseout = function(){setDirection<?php echo $module->id;?>('up',1, jscontentslider);};
			<?php else: ?>
			container.getElement(".ja-contentslide-left-img").onmouseover = function(){setDirection<?php echo $module->id;?>('right',0, jscontentslider);};
			container.getElement(".ja-contentslide-left-img").onmouseout = function(){setDirection<?php echo $module->id;?>('right',1, jscontentslider);};
			container.getElement(".ja-contentslide-right-img").onmouseover = function(){setDirection<?php echo $module->id;?>('left',0, jscontentslider);};
			container.getElement(".ja-contentslide-right-img").onmouseout = function(){setDirection<?php echo $module->id;?>('left',1, jscontentslider);};
			<?php endif; //vertical? ?>
		  <?php endif; //scroll event ?>
		<?php endif; //show control? ?>

		/**active tab**/
		if (container.getElement('.ja-button-control')) {
		container.getElement('.ja-button-control').getElements('a').each(function(el){
			var css = (el.getProperty('rel') == cid) ? 'active' : '';
			el.className = css;
		});
		}
	}
	window.addEvent( 'domready', function(){ contentSliderInit_<?php echo $sort_order_field;?>_<?php echo $module->id;?>(<?php echo $firstCid; ?>); } );

	
	//]]-->
</script>




<div id="ja-contentslider-<?php echo $sort_order_field;?>-<?php echo $module->id;?>" class="ja-contentslider-home ja-contentslider-<?php echo $module->id;?> ja-contentslider<?php echo $params->get( 'moduleclass_sfx' );?><?php echo $firstActive;?> clearfix" >
  <!--toolbar-->
  <?php if( $params->get( 'showbutton' ) || ($params->get( 'showbutton' ) == '') ) : ?>
  <?php if ($showTab == 1 && count($cateArr) > 1): ?>
  <div class="ja-button-control">
    <?php if(!empty($text_heading)){ ?>
    <span class="ja-text-heading"><?php echo $text_heading; ?></span>
    <?php } ?>

    
    <a href="javascript:contentSliderInit_<?php echo $sort_order_field;?>_<?php echo $module->id;?>(0)" rel="0"><?php echo JText::_('All'); ?></a>
    <?php foreach ($cateArr as $key=>$value){ ?>
		<?php if(!empty($value)){ ?>
			<a href="javascript:contentSliderInit_<?php echo $sort_order_field;?>_<?php echo $module->id;?>('<?php echo $key;?>')" rel="<?php echo $key;?>"><?php echo $value; ?></a>
		<?php } ?>
    <?php } ?>
    

  </div>
  <?php endif; //show tab? ?>
  <?php if ($mode == 'vertical'){ ?>
		<div class="ja-contentslider-right ja-contentslide-up-img" title="<?php echo JText::_('Next'); ?>">&nbsp;</div>
		<div class="ja-contentslider-left ja-contentslide-down-img" title="<?php echo JText::_('Previous'); ?>">&nbsp;</div>
	<?php } else {?>
		<div class="ja-contentslider-right ja-contentslide-right-img" title="<?php echo JText::_('Next'); ?>">&nbsp;</div>
		<div class="ja-contentslider-left ja-contentslide-left-img" title="<?php echo JText::_('Previous'); ?>">&nbsp;</div>
	<?php } ?>
  <?php endif; //show showbutton? ?>

  <!--items-->
  <div class="ja-contentslider-center-wrap clearfix">
    <div id="ja-contentslider-center-<?php echo $sort_order_field;?>-<?php echo $module->id;?>" class="ja-contentslider-center">
      <?php
	foreach( $contents  as $contn ) :
		$link = $contn->link;
		$image = $contn->image;
		$show_data = false;
		if (!empty($image)){
			$show_data = true;
		}
		if ($params->get( 'showintrotext' )){
			$show_data = true;
		}
		if ($params->get( 'showtitle' )){
			$show_data = true;
		}
		if ($show_data == true) :
	?>
      <div class="content_element jaslide2_<?php echo $contn->catid; ?>" style="display:none;">
	      <div class="jaslider-inner">
	      	
	        <div class="ja_slideimages">
	            <?php if(  $params->get( 'showimages' ) && (strlen($image)>3) ) { ?>
	              <?php echo $image; ?>
	            <?php } ?>
	        </div>
        <?php if( $params->get( 'showtitle' ) ) { ?>
        <div class="ja_slidetitle">
          <?php  echo ($params->get( 'link_titles' ) ) ? '<a href="'.$link.'" title="">'.$contn->title.'</a>' : $contn->title;?>
        </div>
        <?php } ?>
        <?php /* if ($contn->featured == 1) { ?>
	  <span class="featured">&nbsp;</span>
	  <?php } */?>
        
        <?php if(  $params->get( 'showintrotext' ) ) { ?>
        <div class="ja_slideintro"> <?php echo ( $params->get('numchar') ) ? $contn->introtext1 : $contn->introtext; ?> </div>
        <?php } ?>
	    <div class="ja_slidefooter">
            <?php if( $params->get('showreadmore') ){ ?>
            <div class="ja-slidereadmore"> <a href="<?php echo $link;?>" class="readon"><?php echo JTEXT::_('READMORE');?></a> </div>
            <?php } // endif;?>
            <?php if (isset($contn->demoUrl) && $contn->demoUrl != '') { ?>
            <div class="ja-slideDemo"> <a href="<?php echo $contn->demoUrl;?>" class="readon"><?php echo $contn->demoUrl;?></a> </div>
            <?php } ?>
            <?php
            //Add voting
            if($params->get('source') == 'content'){
                $html = '';
                $rating = intval(@$contn->rating);
                $rating_count = intval(@$contn->rating_count);

                $view = JRequest::getString('view', '');
                $img = '';

                // look for images in template if available
                $starImageOn = JHtml::_('image', 'system/rating_star.png', NULL, NULL, true);
                $starImageOff = JHtml::_('image', 'system/rating_star_blank.png', NULL, NULL, true);

                for ($i=0; $i < $rating; $i++) {
                    $img .= $starImageOn;
                }
                for ($i=$rating; $i < 5; $i++) {
                    $img .= $starImageOff;
                }
                $html .= '<span class="content_rating">';
                $html .= JText::sprintf( 'PLG_VOTE_USER_RATING', $img, $rating_count );
                $html .= "</span>\n<br />\n";
                echo $html;
            }elseif($params->get('source') == 'k2'){
                $contn->votingPercentage = 0;
                $contn->numOfvotes=0;
                if(count($contn->rating) >0 ){
                    $contn->votingPercentage = number_format(intval($contn->rating[1]) / intval($contn->rating[2]), 2) * 20;
                    $contn->numOfvotes = $contn->rating[2];
                }
                ?>
                <div class="itemRatingBlock">
                    <div class="itemRatingForm">
                        <ul class="itemRatingList">
                            <li class="itemCurrentRating" id="itemCurrentRating<?php echo $contn->id; ?>" style="width:<?php echo $contn->votingPercentage; ?>%;"></li>
                            <li><a href="#" title="<?php echo JText::_('K2_1_STAR_OUT_OF_5'); ?>" class="one-star">1</a></li>
                            <li><a href="#" title="<?php echo JText::_('K2_2_STARS_OUT_OF_5'); ?>" class="two-stars">2</a></li>
                            <li><a href="#" title="<?php echo JText::_('K2_3_STARS_OUT_OF_5'); ?>" class="three-stars">3</a></li>
                            <li><a href="#" title="<?php echo JText::_('K2_4_STARS_OUT_OF_5'); ?>" class="four-stars">4</a></li>
                            <li><a href="#" title="<?php echo JText::_('K2_5_STARS_OUT_OF_5'); ?>" class="five-stars">5</a></li>
                        </ul>
                        <div class="clr"></div>
                    </div>
                    <div class="clr"></div>
                </div>
            <?php

            }
            //End voting
            ?>
            
            <!-- Addthis button -->
            <div class="shareon">
                <!-- AddThis Button BEGIN -->
                <a class="addthis_button_compact" addthis:userid="joomlart" addthis:url="<?php echo JRoute::_($link,true, -1);?>"><i class="icon-share"></i></a>
                <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-52609ad90c3efe1e"></script>
                <!-- AddThis Button END -->
            </div>
            <!-- End addthis -->
        </div>
	 </div>
	 </div>
	       <?php
		endif;
	  endforeach; ?>
    </div>
  </div>
</div>
<?php endif; //not total ?>


<?php
if(!defined('JA_CONTENTSLIDER_RELOAD')){
    define('JA_CONTENTSLIDER_RELOAD',1);

    $mod = JModuleHelper::getModule('jacontentslider',$module->title);
    $document = JFactory::getDocument();
    $renderer = $document->loadRenderer('module');
    foreach($order_field AS $o){
        if($o != $sort_order_field){
            $modparams = json_decode($mod->params);
            $modparams->sort_order_field = $o;
            $mod->params = json_encode($modparams);
            echo JModuleHelper::renderModule($mod);
        }
    }
    echo '</div>';
}


?>

