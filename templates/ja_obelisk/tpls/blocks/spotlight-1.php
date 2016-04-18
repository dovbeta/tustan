<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<?php if ($this->checkSpotlight('spotlight-1', 'position-1, position-2, position-3, position-4') || $this->countModules('slider') ) : ?>
<!-- SPOTLIGHT 1 -->
<div class="container t3-sl t3-sl-1 <?php $this->_c('slider') ?>">
  <?php 
  	$this->spotlight ('spotlight-1', 'position-1, position-2, position-3, position-4');
  ?>
  <div class="ja-slider<?php $this->_c('slider') ?>">
  	<jdoc:include type="modules" name="<?php $this->_p('slider') ?>" style="raw" />
  </div>
</div>
<!-- //SPOTLIGHT 1 -->
<?php endif ?>