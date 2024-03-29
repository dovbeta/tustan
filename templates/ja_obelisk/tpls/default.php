<?php
/** 
 *------------------------------------------------------------------------------
 * @package       T3 Framework for Joomla!
 *------------------------------------------------------------------------------
 * @copyright     Copyright (C) 2004-2013 JoomlArt.com. All Rights Reserved.
 * @license       GNU General Public License version 2 or later; see LICENSE.txt
 * @authors       JoomlArt, JoomlaBamboo, (contribute to this project at github 
 *                & Google group to become co-author)
 * @Google group: https://groups.google.com/forum/#!forum/t3fw
 * @Link:         http://t3-framework.org 
 *------------------------------------------------------------------------------
 */


defined('_JEXEC') or die;
$user =JFactory::getUser();
if($user->id)
{
    $jaloginclass=' login';
}
else
{
    $jaloginclass=' no-login';
}
?>

<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" class='<jdoc:include type="pageclass" /><?php echo $jaloginclass;?>'>

  <head>
    <jdoc:include type="head" />
    <?php $this->loadBlock ('head') ?>
  </head>

  <body class="white-background">

    <?php $this->loadBlock ('header') ?>
    
    <?php $this->loadBlock ('mainnav') ?>

		<?php $this->loadBlock ('slideshow') ?>

    <?php $this->loadBlock ('spotlight-1') ?>
    
    <?php $this->loadBlock ('masshead') ?>

    <?php $this->loadBlock ('mainbody-content-left') ?>
    
    <?php $this->loadBlock ('spotlight-2') ?>
    
    <?php $this->loadBlock ('navhelper') ?>
    
    <?php $this->loadBlock ('footer') ?>
    
  </body>

</html>