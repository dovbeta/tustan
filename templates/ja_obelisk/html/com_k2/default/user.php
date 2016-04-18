<?php
/**
 * @version		$Id: user.php 1812 2013-01-14 18:45:06Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2013 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;

// Get user stuff (do not change)
$user = JFactory::getUser();

?>

<!-- Start K2 User Layout -->

<div id="k2Container" class="userView<?php if($this->params->get('pageclass_sfx')) echo ' '.$this->params->get('pageclass_sfx'); ?>">

	<?php if($this->params->get('show_page_title') && $this->params->get('page_title')!=$this->user->name): ?>
	<!-- Page title -->
	<div class="componentheading<?php echo $this->params->get('pageclass_sfx')?>">
		<?php echo $this->escape($this->params->get('page_title')); ?>
	</div>
	<?php endif; ?>

	<?php if($this->params->get('userFeedIcon',1)): ?>
	<!-- RSS feed icon -->
	<div class="k2FeedIcon">
		<a href="<?php echo $this->feed; ?>" title="<?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?>">
			<span><?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?></span>
		</a>
		<div class="clr"></div>
	</div>
	<?php endif; ?>

	<?php if ($this->params->get('userImage') || $this->params->get('userName') || $this->params->get('userDescription') || $this->params->get('userURL') || $this->params->get('userEmail')): ?>
	<div class="userBlock">
	
		<?php if(isset($this->addLink) && JRequest::getInt('id')==$user->id): ?>
		<!-- Item add link -->
		<span class="userItemAddLink">
			<a class="modal" rel="{handler:'iframe',size:{x:990,y:550}}" href="<?php echo $this->addLink; ?>">
				<?php echo JText::_('K2_POST_A_NEW_ITEM'); ?>
			</a>
		</span>
		<?php endif; ?>
	
		<?php if ($this->params->get('userImage') && !empty($this->user->avatar)): ?>
		<img src="<?php echo $this->user->avatar; ?>" alt="<?php echo $this->user->name; ?>" style="width:<?php echo $this->params->get('userImageWidth'); ?>px; height:auto;" />
		<?php endif; ?>
		
		<?php if ($this->params->get('userName')): ?>
		<h2><?php echo $this->user->name; ?></h2>
		<?php endif; ?>
		
		<?php if ($this->params->get('userDescription') && trim($this->user->profile->description)): ?>
		<div class="userDescription"><?php echo $this->user->profile->description; ?></div>
		<?php endif; ?>
		
		<?php if (($this->params->get('userURL') && isset($this->user->profile->url) && $this->user->profile->url) || $this->params->get('userEmail')): ?>
		<div class="userAdditionalInfo">
			<?php if ($this->params->get('userURL') && isset($this->user->profile->url) && $this->user->profile->url): ?>
			<span class="userURL">
				<?php echo JText::_('K2_WEBSITE_URL'); ?>: <a href="<?php echo $this->user->profile->url; ?>" target="_blank" rel="me"><?php echo $this->user->profile->url; ?></a>
			</span>
			<?php endif; ?>

			<?php if ($this->params->get('userEmail')): ?>
			<span class="userEmail">
				<?php echo JText::_('K2_EMAIL'); ?>: <?php echo JHTML::_('Email.cloak', $this->user->email); ?>
			</span>
			<?php endif; ?>	
		</div>
		<?php endif; ?>

		<div class="clr"></div>
		
		<?php echo $this->user->event->K2UserDisplay; ?>
		
		<div class="clr"></div>
	</div>
	<?php endif; ?>



	<?php if(count($this->items)): ?>
	<!-- Item list -->
	<div class="userItemList clearfix">
		<?php 
			$num_user_columns = 4; 
			$key = 0;
		?>
		<?php foreach($this->items as $item): ?>
		<?php 
			$key++;
			if($key == $num_user_columns )
				$lastContainer= ' userItemContainerLast';
			else
				$lastContainer='';
		?>
		
		<!-- Start K2 Item Layout -->
		<div class="userItemContainer<?php echo $lastContainer; ?>" <?php echo (count($this->items)==1) ? '' : ' style="width:'.(floor(number_format(100/$num_user_columns, 3)*100)/100).'%;"'; ?>>
		<div class="userItemView<?php if(!$item->published || ($item->publish_up != $this->nullDate && $item->publish_up > $this->now) || ($item->publish_down != $this->nullDate && $item->publish_down < $this->now)) echo ' userItemViewUnpublished'; ?><?php echo ($item->featured) ? ' userItemIsFeatured' : ''; ?>">
			<?php if($this->params->get('userItemImage') && !empty($item->imageGeneric)): ?>
		  <!-- Item Image -->
		  <div class="userItemImageBlock">
			  <span class="userItemImage">
			    <a href="<?php echo $item->link; ?>" title="<?php if(!empty($item->image_caption)) echo K2HelperUtilities::cleanHtml($item->image_caption); else echo K2HelperUtilities::cleanHtml($item->title); ?>">
			    	<img src="<?php echo $item->imageGeneric; ?>" alt="<?php if(!empty($item->image_caption)) echo K2HelperUtilities::cleanHtml($item->image_caption); else echo K2HelperUtilities::cleanHtml($item->title); ?>" style="width:<?php echo $this->params->get('itemImageGeneric'); ?>px; height:auto;" />
			    </a>
			  </span>
			  <div class="clr"></div>
		  </div>
		  <?php endif; ?>
			<!-- Plugins: BeforeDisplay -->
			<?php echo $item->event->BeforeDisplay; ?>
			
			<!-- K2 Plugins: K2BeforeDisplay -->
			<?php echo $item->event->K2BeforeDisplay; ?>
		
			<div class="userItemHeader">			
				<?php if($this->params->get('userItemDateCreated')): ?>
				<!-- Date created -->
				<span class="userItemDateCreated">
					<?php echo JHTML::_('date', $item->created , JText::_('K2_DATE_FORMAT_LC2')); ?>
				</span>
				<?php endif; ?>
				
				<?php if($this->params->get('userItemTags') && isset($item->tags)): ?>
			  <!-- Item tags -->
			  <div class="userItemTagsBlock">
				  <ul class="userItemTags">
				    <?php foreach ($item->tags as $tag): ?>
				    <li><a href="<?php echo $tag->link; ?>"><?php echo $tag->name; ?></a></li>
				    <?php endforeach; ?>
				  </ul>
				  <div class="clr"></div>
			  </div>
			  <?php endif; ?>
				
			  <?php if($this->params->get('userItemTitle')): ?>
			  <!-- Item title -->
			  <h3 class="userItemTitle">
					<?php if(isset($item->editLink)): ?>
					<!-- Item edit link -->
					<span class="userItemEditLink">
						<a class="modal" rel="{handler:'iframe',size:{x:990,y:550}}" href="<?php echo $item->editLink; ?>">
							<?php echo JText::_('K2_EDIT_ITEM'); ?>
						</a>
					</span>
					<?php endif; ?>

			  	<?php if ($this->params->get('userItemTitleLinked') && $item->published): ?>
					<a href="<?php echo $item->link; ?>">
			  		<?php echo $item->title; ?>
			  	</a>
			  	<?php else: ?>
			  	<?php echo $item->title; ?>
			  	<?php endif; ?>
			  	<?php if(!$item->published || ($item->publish_up != $this->nullDate && $item->publish_up > $this->now) || ($item->publish_down != $this->nullDate && $item->publish_down < $this->now)): ?>
			  	<span>
		  			<sup>
		  				<?php echo JText::_('K2_UNPUBLISHED'); ?>
		  			</sup>
	  			</span>
	  			<?php endif; ?>
			  </h3>
			  <?php endif; ?>
		  </div>
		
		  <!-- Plugins: AfterDisplayTitle -->
		  <?php echo $item->event->AfterDisplayTitle; ?>
		  
		  <!-- K2 Plugins: K2AfterDisplayTitle -->
		  <?php echo $item->event->K2AfterDisplayTitle; ?>

		  <div class="userItemBody">
		
			  <!-- Plugins: BeforeDisplayContent -->
			  <?php echo $item->event->BeforeDisplayContent; ?>
			  
			  <!-- K2 Plugins: K2BeforeDisplayContent -->
			  <?php echo $item->event->K2BeforeDisplayContent; ?>
			  
			  <?php if($this->params->get('userItemIntroText')): ?>
			  <!-- Item introtext -->
			  <div class="userItemIntroText">
			  	<?php echo $item->introtext; ?>
			  </div>
			  <?php endif; ?>
		
				<div class="clr"></div>

			  <!-- Plugins: AfterDisplayContent -->
			  <?php echo $item->event->AfterDisplayContent; ?>
			  
			  <!-- K2 Plugins: K2AfterDisplayContent -->
			  <?php echo $item->event->K2AfterDisplayContent; ?>
		
			  <div class="clr"></div>
		  </div>
		
		  <?php if($this->params->get('userItemCategory') || $this->params->get('userItemTags')): ?>
		  <div class="userItemLinks">

				<?php if($this->params->get('userItemCategory')): ?>
				<!-- Item category name -->
				<div class="userItemCategory">
					<span><?php echo JText::_('K2_PUBLISHED_IN'); ?></span>
					<a href="<?php echo $item->category->link; ?>"><?php echo $item->category->name; ?></a>
				</div>
				<?php endif; ?>

				<div class="clr"></div>
		  </div>
		  <?php endif; ?>  
		
			<div class="clr"></div>

			<?php if($this->params->get('userItemCommentsAnchor') && ( ($this->params->get('comments') == '2' && !$this->user->guest) || ($this->params->get('comments') == '1')) ): ?>
			<!-- Anchor link to comments below -->
			<div class="userItemCommentsLink">
				<?php if(!empty($item->event->K2CommentsCounter)): ?>
					<!-- K2 Plugins: K2CommentsCounter -->
					<?php echo $item->event->K2CommentsCounter; ?>
				<?php else: ?>
					<?php if($item->numOfComments > 0): ?>
					<a href="<?php echo $item->link; ?>#itemCommentsAnchor">
						<?php echo $item->numOfComments; ?> <?php echo ($item->numOfComments>1) ? JText::_('K2_COMMENTS') : JText::_('K2_COMMENT'); ?>
					</a>
					<?php else: ?>
					<a href="<?php echo $item->link; ?>#itemCommentsAnchor">
						<?php echo JText::_('K2_BE_THE_FIRST_TO_COMMENT'); ?>
					</a>
					<?php endif; ?>
				<?php endif; ?>
			</div>
			<?php endif; ?>
		  
			<?php if ($this->params->get('userItemReadMore')): ?>
			<!-- Item "read more..." link -->
			<div class="userItemReadMore">
				<a class="k2ReadMore" href="<?php echo $item->link; ?>">
					<?php echo JText::_('K2_READ_MORE'); ?>
				</a>
			</div>
			<?php endif; ?>
			
			<div class="clr"></div>

		  <!-- Plugins: AfterDisplay -->
		  <?php echo $item->event->AfterDisplay; ?>
		  
		  <!-- K2 Plugins: K2AfterDisplay -->
		  <?php echo $item->event->K2AfterDisplay; ?>
			
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
            <?php if(($key % $num_user_columns)==0 ): ?>
                <div class="clr"></div>
            <?php endif; ?>
		<?php endforeach; ?>
	</div>

	<!-- Pagination -->
	<?php if(count($this->pagination->getPagesLinks())): ?>
	<div class="pagination">
		<?php echo $this->pagination->getPagesLinks(); ?>
		<p class="counter pull-right"><?php echo $this->pagination->getPagesCounter(); ?></p>
	</div>
	<?php endif; ?>
	
	<?php endif; ?>

</div>

<!-- End K2 User Layout -->
