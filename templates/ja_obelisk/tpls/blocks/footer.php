<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<!-- FOOTER -->
<footer id="t3-footer" class="wrap t3-footer">
	<div class="container">
	<?php if ($this->countModules('footer-banner')) : ?>
  <div class="t3-footer-banner<?php $this->_c('footer-banner') ?>">
  	<jdoc:include type="modules" name="<?php $this->_p('footer-banner') ?>" style="raw" />
  </div>
  <?php endif ?>
	
	<?php if ($this->checkSpotlight('footnav', 'footer-1, footer-2, footer-3, footer-4, footer-5') || $this->countModules('footer-6') ) : ?>
	<!-- FOOT NAVIGATION -->
	<nav class="t3-footnav row">
	  <div class="span8">
      <div class="footer-info">
    		<?php 
    	  	$this->spotlight ('footnav', 'footer-1, footer-2, footer-3, footer-4, footer-5',array('row-fluid' => true))
    	  ?>
      </div>
	  </div>
	  <?php if ($this->countModules('footer-4')) : ?>
	  <div class="span4<?php $this->_c('footer-4') ?>">
  	  	<jdoc:include type="modules" name="<?php $this->_p('footer-4') ?>" style="T3xhtml" />
     
	  </div>
	  <?php endif ?>
	</nav>
	<!-- //FOOT NAVIGATION -->
	<?php endif ?>

  <section class="t3-copyright">
    <div class="row">
      <?php if($this->getParam('t3-rmvlogo', 1)): ?>
      <div class="span4 poweredby">
        <a class="t3-logo-small t3-logo-light" href="http://t3-framework.org" title="Powered By T3 Framework" target="_blank" rel="nofollow" >Powered by <strong>T3 Framework</strong></a>
      </div>
      <?php endif; ?>
      <div class="<?php echo $this->getParam('t3-rmvlogo', 1) ? 'span8' : 'span12' ?> copyright<?php $this->_c('footer')?>">
        <jdoc:include type="modules" name="<?php $this->_p('footer') ?>" />
      </div>
     
    </div>
  </section>
	</div>
</footer>
<!-- //FOOTER -->