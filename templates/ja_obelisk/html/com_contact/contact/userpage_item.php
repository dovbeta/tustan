<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Create a shortcut for params.
$params = &$this->item->params;
$images = json_decode($this->item->images);
$canEdit = $this->item->params->get('access-edit');
$hasInfo = (($params->get('show_author') && !empty($this->item->author )) or ($params->get('show_category')) or ($params->get('show_create_date')) or $params->get('show_publish_date') or ($params->get('show_parent_category')));
$hasCtrl = ($params->get('show_print_icon') || $params->get('show_email_icon') || $canEdit);
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
$info = $this->item->params->get('info_block_position', 0);
JHtml::_('behavior.tooltip');
JHtml::_('behavior.framework');
?>
<?php if ($this->item->state == 0) : ?>

<div class="system-unpublished">
    <?php endif; ?>

    <!-- Article -->
    <article class="row-fluid">
        <?php  if (isset($images->image_intro) and !empty($images->image_intro)) : ?>
            <?php $imgfloat = (empty($images->float_intro)) ? $params->get('float_intro') : $images->float_intro; ?>
            <div class="span3 pull-<?php echo htmlspecialchars($imgfloat); ?>"> <img
                    <?php if ($images->image_intro_caption):
                        echo 'class="caption"'.' title="' .htmlspecialchars($images->image_intro_caption) .'"';
                    endif; ?>
                    src="<?php echo htmlspecialchars($images->image_intro); ?>" alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>"/> </div>
        <?php endif; ?>
        <div class="<?php echo (isset($images->image_intro) and !empty($images->image_intro))?"span9":"span12";?>">
            <?php if ($params->get('show_title')) : ?>
                <header class="article-header clearfix">
                    <h2 class="article-title">
                        <?php if ($params->get('link_titles') && $params->get('access-view')) : ?>
                            <a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid)); ?>"> <?php echo $this->escape($this->item->title); ?></a>
                        <?php else : ?>
                            <?php echo $this->escape($this->item->title); ?>
                        <?php endif; ?>
                    </h2>
                </header>
            <?php endif; ?>

            <!-- Aside -->
            <?php if ($hasInfo || $hasCtrl) : ?>
                <aside class="article-aside row-fluid">

                    <?php // to do not that elegant would be nice to group the params ?>
                    <?php if ($hasInfo) : ?>
                        <dl class="article-info span9">

                            <?php if ($params->get('show_author') && !empty($this->item->author )) : ?>
                                <dd class="createdby">
                                    <?php $author =  $this->item->author; ?>
                                    <?php $author = ($this->item->created_by_alias ? $this->item->created_by_alias : $author);?>
                                    <?php if (!empty($this->item->contactid) && $params->get('link_author') == true): ?>
                                        <?php
                                        $needle = 'index.php?option=com_contact&view=contact&layout=userpage&id=' . $this->item->contactid;
                                        $menu = JFactory::getApplication()->getMenu();
                                        $item = $menu->getItems('link', $needle, true);
                                        $cntlink = !empty($item) ? $needle . '&Itemid=' . $item->id : $needle;
                                        ?>
                                        <?php echo '<span class="name">', JText::sprintf('TPL_COM_CONTENT_WRITTEN_BY',
                                            '</span><span>' . JHtml::_('link', JRoute::_($cntlink), $author) . '</span>'); ?>
                                    <?php else : ?>
                                        <?php echo '<span class="name">', JText::sprintf('TPL_COM_CONTENT_WRITTEN_BY', '</span><span>' . $author . '</span>'); ?>
                                    <?php endif; ?>
                                </dd>
                            <?php endif; ?>

                            <?php if ($params->get('show_publish_date')) : ?>
                                <dd class="published">
                                    <?php echo JText::sprintf('COM_CONTENT_PUBLISHED_DATE_ON', '<span>'.JHtml::_('date', $this->item->publish_up, JText::_('DATE_FORMAT_LC3')).'</span>'); ?>
                                </dd>
                            <?php endif; ?>

                            <?php if ($params->get('show_create_date')) : ?>
                                <dd class="create">
                                    <?php echo JText::sprintf( '<span>'.JHtml::_('date', $this->item->created, JText::_('DATE_FORMAT_LC3')).'</span>'); ?>
                                </dd>
                            <?php endif; ?>

                            <?php if ($params->get('show_parent_category') && $this->item->parent_id != 1) : ?>
                                <dd class="parent-category-name">
                                    <?php $title = $this->escape($this->item->parent_title);
                                    $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_id)) . '">' . $title . '</a>'; ?>
                                    <?php if ($params->get('link_parent_category')) : ?>
                                        <?php echo JText::sprintf('COM_CONTENT_PARENT', '<span>'.$url.'</span>'); ?>
                                    <?php else : ?>
                                        <?php echo JText::sprintf('COM_CONTENT_PARENT', '<span>'.$title.'</span>'); ?>
                                    <?php endif; ?>
                                </dd>
                            <?php endif; ?>

                            <?php if ($params->get('show_category')) : ?>
                                <dd class="category-name">
                                    <?php $title = $this->escape($this->item->category_title);
                                    $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catid)) . '">' . $title . '</a>'; ?>
                                    <?php if ($params->get('link_category')) : ?>
                                        <?php echo JText::sprintf( '<span>'.$url.'</span>'); ?>
                                    <?php else : ?>
                                        <?php echo JText::sprintf( '<span>'.$title.'</span>'); ?>
                                    <?php endif; ?>
                                </dd>
                            <?php endif; ?>

                        </dl>
                    <?php endif; ?>

                    <?php if ($hasCtrl) : ?>
                        <div class="article-action-icon span3">

                            <?php if ($params->get('show_print_icon')) : ?>
                                <div class="print-icon"> <?php echo JHtml::_('icon.print_popup', $this->item, $params); ?> </div>
                            <?php endif; ?>

                            <?php if ($params->get('show_email_icon')) : ?>
                                <div class="email-icon"> <?php echo JHtml::_('icon.email', $this->item, $params); ?> </div>
                            <?php endif; ?>

                            <?php if ($canEdit) : ?>
                                <div class="edit-icon"> <?php echo JHtml::_('icon.edit', $this->item, $params); ?> </div>
                            <?php endif; ?>

                        </div>
                    <?php endif; ?>
                </aside>
            <?php endif; ?>
            <!-- //Aside -->

            <section class="article-intro clearfix">
                <?php if (!$params->get('show_intro')) : ?>
                    <?php echo $this->item->event->afterDisplayTitle; ?>
                <?php endif; ?>

                <?php echo $this->item->event->beforeDisplayContent; ?>



                <?php echo $this->item->introtext; ?>
            </section>

            <?php if (($params->get('show_modify_date')) or ($params->get('show_hits'))) : ?>
                <footer class="article-footer clearfix">
                    <dl class="article-info pull-left">
                        <?php if ($params->get('show_modify_date')) : ?>
                            <dd class="modified"><?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', '<span>'.JHtml::_('date', $this->item->modified, JText::_('DATE_FORMAT_LC3')).'</span>'); ?> </dd>
                        <?php endif; ?>
                        <?php if ($params->get('show_hits')) : ?>
                            <dd class="hits"><?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', '<span>'.$this->item->hits.'</span>'); ?> </dd>
                        <?php endif; ?>
                    </dl>
                </footer>
            <?php endif; ?>

            <?php if ($params->get('show_readmore') && $this->item->readmore) :
                if ($params->get('access-view')) :
                    $link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
                else :
                    $menu = JFactory::getApplication()->getMenu();
                    $active = $menu->getActive();
                    $itemId = $active->id;
                    $link1 = JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId);
                    $returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
                    $link = new JURI($link1);
                    $link->setVar('return', base64_encode($returnURL));
                endif;
                ?>
                <section class="readmore">
                    <a class="btn" href="<?php echo $link; ?>"><span>
	<?php if (!$params->get('access-view')) :
        echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
    elseif ($readmore = $this->item->alternative_readmore) :
        echo $readmore;
        if ($params->get('show_readmore_title', 0) != 0) :
            echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
        endif;
    elseif ($params->get('show_readmore_title', 0) == 0) :
        echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');
    else :
        echo JText::_('COM_CONTENT_READ_MORE');
        echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
    endif; ?>
	</span></a>
                </section>
            <?php endif; ?>
        </div>
    </article>
    <!-- //Article -->

    <?php if ($this->item->state == 0) : ?>
</div>
<?php endif; ?>

<?php echo $this->item->event->afterDisplayContent; ?>