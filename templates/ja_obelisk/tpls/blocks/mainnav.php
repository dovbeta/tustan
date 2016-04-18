<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<!-- MAIN NAVIGATION -->
<nav id="t3-mainnav" class="wrap t3-mainnav navbar-collapse-fixed-top">
  <div class="container navbar">
  
  	<?php if ($this->countModules('socialheader') || $this->countModules('languageswitcherload') ) : ?>
  	<div class="row">
  	<?php endif ?>
  	
	    <div class="navbar-inner <?php if ($this->countModules('socialheader') || $this->countModules('languageswitcherload') ) : ?> span10 <?php endif ?>">
	    
	      <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	        <i class="icon-reorder"></i>
	      </button>
	
	      <div class="nav-collapse collapse<?php echo $this->getParam('navigation_collapse_showsub', 1) ? ' always-show' : '' ?>">
	      <?php if ($this->getParam('navigation_type') == 'megamenu') : ?>
			<?php $this->megamenu($this->getParam('mm_type', 'mainmenu')) ?>
		  <?php else : ?>
			<jdoc:include type="modules" name="<?php $this->_p('mainnav') ?>" style="raw" />
		  <?php endif ?>
	      </div>
	    </div>
	    
	    <?php if ($this->countModules('languageswitcherload')) : ?>
      <!-- LANGUAGE SWITCHER -->
      <div class="span1 pull-right languageswitcherload <?php $this->_c('languageswitcherload') ?>">
          <jdoc:include type="modules" name="<?php $this->_p('languageswitcherload') ?>" style="raw" />
      </div>
      <!-- //LANGUAGE SWITCHER -->
      <?php endif ?>
	    
	    <?php if ($this->countModules('socialheader')) : ?>
	    <div class="span2 pull-right <?php $this->_c('socialheader') ?>">
	    	<jdoc:include type="modules" name="<?php $this->_p('socialheader') ?>" style="raw" />
	    </div>
	    <?php endif ?>
	
	  
	  <?php if ($this->countModules('socialheader')) : ?>
	  </div>
	  <?php endif ?>
	  
  </div>
</nav>
<!-- //MAIN NAVIGATION -->