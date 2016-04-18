<?php
/**
 * @version		$Id: tag.php 1812 2013-01-14 18:45:06Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2013 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;

?>

<!-- Start K2 Tag Layout -->
<div id="k2Container" class="tagView<?php if($this->params->get('pageclass_sfx')) echo ' '.$this->params->get('pageclass_sfx'); ?>">

	<?php if($this->params->get('show_page_title')): ?>
	<!-- Page title -->
	<div class="componentheading<?php echo $this->params->get('pageclass_sfx')?>">
		<?php echo $this->escape($this->params->get('page_title')); ?>
	</div>
	<?php endif; ?>

	<?php if($this->params->get('tagFeedIcon',1)): ?>
	<!-- RSS feed icon -->
	<div class="k2FeedIcon">
		<a href="<?php echo $this->feed; ?>" title="<?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?>">
			<span><?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?></span>
		</a>
		<div class="clr"></div>
	</div>
	<?php endif; ?>

	<?php if(count($this->items)): ?>
	<div class="tagItemList clearfix">
		<?php 
			$num_tag_columns = 4; 
			$key = 0;
		?>
		<?php foreach($this->items as $item): ?>
		<?php 
			$key++;
			if($key == $num_tag_columns )
				$lastContainer= ' tagItemContainerLast';
			else
				$lastContainer='';
		?>
		
		<!-- Start K2 Item Layout -->
		<div class="tagItemContainer<?php echo $lastContainer; ?>" <?php echo (count($this->items)==1) ? '' : ' style="width:'.(floor(number_format(100/$num_tag_columns, 3)*100)/100).'%;"'; ?>>
		<div class="tagItemView">
			<?php if($item->params->get('tagItemImage',1) && !empty($item->imageGeneric)): ?>
		  <!-- Item Image -->
		  <div class="tagItemImageBlock">
			  <span class="tagItemImage">
			    <a href="<?php echo $item->link; ?>" title="<?php if(!empty($item->image_caption)) echo K2HelperUtilities::cleanHtml($item->image_caption); else echo K2HelperUtilities::cleanHtml($item->title); ?>">
			    	<img src="<?php echo $item->imageGeneric; ?>" alt="<?php if(!empty($item->image_caption)) echo K2HelperUtilities::cleanHtml($item->image_caption); else echo K2HelperUtilities::cleanHtml($item->title); ?>" style="width:<?php echo $item->params->get('itemImageGeneric'); ?>px; height:auto;" />
			    </a>
			  </span>
			  <div class="clr"></div>
		  </div>
		  <?php endif; ?>

			<div class="tagItemHeader">
				<?php if($item->params->get('tagItemCategory')): ?>
				<!-- Item category name -->
				<div class="tagItemCategory">
					<a href="<?php echo $item->category->link; ?>"><?php echo $item->category->name; ?></a>
				</div>
				<?php endif; ?>
			
				<?php if($item->params->get('tagItemDateCreated',1)): ?>
				<!-- Date created -->
				<span class="tagItemDateCreated">
					<?php echo JHTML::_('date', $item->created , JText::_('K2_DATE_FORMAT_LC2')); ?>
				</span>
				<?php endif; ?>
			
			  <?php if($item->params->get('tagItemTitle',1)): ?>
			  <!-- Item title -->
			  <h2 class="tagItemTitle">
			  	<?php if ($item->params->get('tagItemTitleLinked',1)): ?>
					<a href="<?php echo $item->link; ?>">
			  		<?php echo $item->title; ?>
			  	</a>
			  	<?php else: ?>
			  	<?php echo $item->title; ?>
			  	<?php endif; ?>
			  </h2>
			  <?php endif; ?>
		  </div>

			
			<?php if($item->params->get('tagItemIntroText',1)): ?>
		  <div class="tagItemBody">
			  <!-- Item introtext -->
			  <div class="tagItemIntroText">
			  	<?php echo $item->introtext; ?>
			  </div>
		  </div>
		  <?php endif; ?>
		  
		  <div class="clr"></div>
		  
		  <?php if($item->params->get('tagItemExtraFields',0) && count($item->extra_fields)): ?>
		  <!-- Item extra fields -->  
		  <div class="tagItemExtraFields">
		  	<h4><?php echo JText::_('K2_ADDITIONAL_INFO'); ?></h4>
		  	<ul>
				<?php foreach ($item->extra_fields as $key=>$extraField): ?>
				<?php if($extraField->value != ''): ?>
				<li class="<?php echo ($key%2) ? "odd" : "even"; ?> type<?php echo ucfirst($extraField->type); ?> group<?php echo $extraField->group; ?>">
					<?php if($extraField->type == 'header'): ?>
					<h4 class="tagItemExtraFieldsHeader"><?php echo $extraField->name; ?></h4>
					<?php else: ?>
					<span class="tagItemExtraFieldsLabel"><?php echo $extraField->name; ?></span>
					<span class="tagItemExtraFieldsValue"><?php echo $extraField->value; ?></span>
					<?php endif; ?>		
				</li>
				<?php endif; ?>
				<?php endforeach; ?>
				</ul>
		    <div class="clr"></div>
		  </div>
		  <?php endif; ?>
		  
			<?php if ($item->params->get('tagItemReadMore')): ?>
			<!-- Item "read more..." link -->
			<div class="tagItemReadMore">
				<a class="k2ReadMore" href="<?php echo $item->link; ?>">
					<?php echo JText::_('K2_READ_MORE'); ?>
				</a>
			</div>
			<?php endif; ?>

			<div class="clr"></div>
			<div class="catItemFooter">
                <?php
                $K2ModelItem = new K2ModelItem;
                $item->votingPercentage = $K2ModelItem->getVotesPercentage($item->id);
			    $item->numOfvotes = $K2ModelItem->getVotesNum($item->id);

                ?>
                <div class="catItemRatingBlock">
                    <div class="itemRatingForm">
                        <ul class="itemRatingList">
                            <li class="itemCurrentRating" id="itemCurrentRating<?php echo $item->id; ?>" style="width:<?php echo $item->votingPercentage; ?>%;"></li>
                            <li><a href="#" rel="<?php echo $item->id; ?>" title="<?php echo JText::_('K2_1_STAR_OUT_OF_5'); ?>" class="one-star">1</a></li>
                            <li><a href="#" rel="<?php echo $item->id; ?>" title="<?php echo JText::_('K2_2_STARS_OUT_OF_5'); ?>" class="two-stars">2</a></li>
                            <li><a href="#" rel="<?php echo $item->id; ?>" title="<?php echo JText::_('K2_3_STARS_OUT_OF_5'); ?>" class="three-stars">3</a></li>
                            <li><a href="#" rel="<?php echo $item->id; ?>" title="<?php echo JText::_('K2_4_STARS_OUT_OF_5'); ?>" class="four-stars">4</a></li>
                            <li><a href="#" rel="<?php echo $item->id; ?>" title="<?php echo JText::_('K2_5_STARS_OUT_OF_5'); ?>" class="five-stars">5</a></li>
                        </ul>
                        <div class="clr"></div>
                    </div>
                    <div class="clr"></div>
                </div>
				<!-- Addthis button -->
		    <div class="shareon">
		        <!-- AddThis Button BEGIN -->
		        <a class="addthis_button_compact" addthis:userid="joomlart" addthis:url="<?php echo $item->link; ?>"><i class="icon-share"></i></a>
		        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-52609ad90c3efe1e"></script>
		        <!-- AddThis Button END -->
		    </div>
		    <!-- End addthis -->
			</div>
		</div>
		</div>
		<!-- End K2 Item Layout -->
		<?php if(($key % $num_tag_columns) == 0 ): ?>
		<div class="clr"></div>
		<?php endif; ?>
		<?php endforeach; ?>
	</div>

	<!-- Pagination -->
	<?php if($this->pagination->getPagesLinks()): ?>
	<div class="pagination">
		<?php echo $this->pagination->getPagesLinks(); ?>
		<p class="counter pull-right">
			<?php echo $this->pagination->getPagesCounter(); ?>
		</p>
	</div>
	<?php endif; ?>

	<?php endif; ?>
	
</div>
<!-- End K2 Tag Layout -->
