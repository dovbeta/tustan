<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_articles_popular
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
$tplparams = JFactory::getApplication()->getTemplate(true)->params;
?>
<ul class="mostread<?php echo $moduleclass_sfx; ?>">
<?php foreach ($list as $item) :
    $images = "";
    if (isset($item->images)) {
        $images = json_decode($item->images);
    }
    ?>
	<li>
        <!-- Intro images -->
        <?php  if (isset($images->image_intro) and !empty($images->image_intro)) : ?>
            <div class="img-intro">
                <img
                    <?php if ($images->image_intro_caption):
                        echo 'class="caption"'.' title="' .htmlspecialchars($images->image_intro_caption) .'"';
                    endif; ?>
                    src="<?php echo htmlspecialchars($images->image_intro); ?>" alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>"/>
            </div>
        <?php endif; ?>
        <!--End Intro images -->
		<a href="<?php echo $item->link; ?>" class="item-title">
			<?php echo $item->title; ?></a>
        <div class="desc"><?php echo $item->introtext;?></div>

        <?php
        $author = $item->created_by_alias ? $item->created_by_alias : $item->author;
        ?>
        <?php if (!empty($item->contactid)): ?>
            <?php
            $cneedle = 'index.php?option=com_contact&view=contact&id=' . $item->contactid;
            $cmenu = JFactory::getApplication()->getMenu();
            $citem = $cmenu->getItems('link', $cneedle, true);
            $cntlinkitemid = $tplparams->get('tpl_userpage_mid',0)>0?'&Itemid='.$tplparams->get('tpl_userpage_mid'):'';
            $cntlink = !empty($citem) ? $cneedle . '&Itemid=' . $citem->id : $cneedle.$cntlinkitemid;
            ?>
            <?php echo '<span class="name">'. JHtml::_('link', JRoute::_($cntlink), $author) . '</span>'; ?>
        <?php else : ?>
            <?php echo '<span class="name">', JText::sprintf('TPL_COM_CONTENT_WRITTEN_BY', '</span><span>' . $author . '</span>'); ?>
        <?php endif; ?>
	</li>
<?php endforeach; ?>
</ul>
