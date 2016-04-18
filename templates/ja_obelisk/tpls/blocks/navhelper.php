<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<!-- NAV HELPER -->
<nav class="container t3-navhelper<?php $this->_c('navhelper') ?>">
	<div class="row">
	 	<div class="span10<?php $this->_c('navhelper')?>">
  		<jdoc:include type="modules" name="<?php $this->_p('navhelper') ?>" />
  	</div>
  	<div class="span2">
        <div id="back-to-top" class="backtotop">
          <i class="icon-angle-up"></i>
        </div>
      </div>
  </div>
</nav>
<!-- //NAV HELPER -->