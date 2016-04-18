<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$sitename = $this->params->get('sitename') ? $this->params->get('sitename') : JFactory::getConfig()->get('sitename');
$slogan = $this->params->get('slogan');
$logotype = $this->params->get('logotype', 'text');
$logoimage = $logotype == 'image' ? $this->params->get('logoimage', '') : '';
?>

<!-- HEADER -->
<header id="t3-header" class="wrap t3-header">
<div class="container">
  <div class="row">

    <!-- LOGO -->
    <div class="span5">
      <div class="logo logo-<?php echo $logotype ?> <?php echo $logoimage?'has-images':'';?>">
        <div class="brand">
           <a href="<?php echo JURI::base(true) ?>" title="<?php echo strip_tags($sitename) ?>">
           <?php if($logotype == 'image' && $logoimage): ?>
           <img class="logoimg" src="<?php echo JURI::base(true).'/'.$logoimage ?>" alt="<?php echo strip_tags($sitename) ?>" />
           <?php endif ?>
           <span><?php echo $sitename ?></span>
           </a>
           <small class="site-slogan hidden-phone"><?php echo $slogan ?></small>
        </div>
     </div>
    </div>
    <!-- //LOGO -->

    <?php if($this->countModules('head-search')): ?>
    <div class="span6 top-search clearfix">  
      <!-- HEAD SEARCH -->
      <div class="head-search<?php $this->_c('head-search')?>">     
        <jdoc:include type="modules" name="<?php $this->_p('head-search') ?>" style="raw" />
      </div>
      <!-- //HEAD SEARCH -->
    </div>
    <?php endif ?>
    
    <?php if($this->countModules('head-login')): ?>
    <div class="span4 pull-right clearfix">
			 <!-- HEAD LOGIN -->
      <div class="head-login<?php $this->_c('head-login')?>">     
        <jdoc:include type="modules" name="<?php $this->_p('head-login') ?>" style="raw" />
      </div>
      <!-- //HEAD LOGIN -->
    </div>
    <?php endif ?>

  </div>
</div>
</header>
<!-- //HEADER -->
