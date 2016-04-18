<?php
 /**
 * @package		Joomla.Site
 * @subpackage	com_contact
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Included dependencies
$com_path = JPATH_SITE.'/components/com_content/';
require_once $com_path.'router.php';
require_once $com_path.'helpers/route.php';
require_once $com_path.'helpers/query.php';

// Prepare
JModelLegacy::addIncludePath($com_path . '/models', 'ContentModel');

JHtml::addIncludePath($com_path.'helpers');
JHtml::addIncludePath(T3_PATH.'/html/com_content');

JFactory::getLanguage()->load('com_content', JPATH_SITE);

// Register the helper class
JLoader::register('JAObeliskHelper', T3_TEMPLATE_PATH . '/templateHelper.php');

// Set application parameters in model
$app        = JFactory::getApplication();
$db         = JFactory::getDbo();
$params     = JComponentHelper::getParams('com_content');
$input      = $app->input;
$menuParams = new JRegistry();
if ($menu = $app->getMenu()->getActive()) {
	$menuParams->loadString($menu->params);
}
$params->merge($menuParams);


// Get an instance of the generic articles model
$articles = JModelLegacy::getInstance('Articles', 'ContentModel', array('ignore_request' => true));

//params
$articles->setState('params', $params);

// Set the filters based on the module params
$articles->setState('list.start', $input->getUInt('limitstart', 0));
$articles->setState('list.limit', (int) $params->get('num_intro_articles', $app->getCfg('list_limit')));
$articles->setState('filter.published', 1);

// Access filter
$access = !JComponentHelper::getParams('com_content')->get('show_noauth');
$authorised = JAccess::getAuthorisedViewLevels(JFactory::getUser()->get('id'));
$articles->setState('filter.access', $access);
$articles->setState('filter.author_id', $this->item->user_id);

// Ordering
$articleOrderby		= $params->get('orderby_sec', 'rdate');
$articleOrderDate	= $params->get('order_date');
$categoryOrderby	= $params->def('orderby_pri', '');
$secondary			= ContentHelperQuery::orderbySecondary($articleOrderby, $articleOrderDate) . ', ';
$primary			= ContentHelperQuery::orderbyPrimary($categoryOrderby);
$articles->setState('list.ordering', $primary . ' ' . $secondary . ' a.created ');
$articles->setState('list.direction', $params->get('article_ordering_direction', 'ASC'));


// Filter by language
$articles->setState('filter.language', $app->getLanguageFilter());

$contact = $this->item;
$this->contact = $contact;
$items  = $articles->getItems();

if($params->get('show_pagination')){
	$this->pagination = $articles->getPagination();
}

//template params
$tplparams = JFactory::getApplication()->getTemplate(true)->params;
?>
<!-- user info -->
<div class="user-info">
	<div class="avatar">
		<?php if(!empty($contact->image)) : ?>
		<img src="<?php echo htmlspecialchars($contact->image) ?>" alt="<?php echo $contact->name ?>" />
		<?php else: ?>
		<i class="no-avatar icon-user"></i>
		<?php endif ?>
	</div>
	<span class="contact-name"><?php echo $contact->name ?></span>
	
	<div class="contact-links">
		<ul class="social-link">
		<?php
		foreach(range('a', 'e') as $char) :// letters 'a' to 'e'
			$link = $contact->params->get('link'.$char);
			$label = $contact->params->get('link'.$char.'_name');

			if( ! $link) :
				continue;
			endif;

			// Add 'http://' if not present
			$link = (0 === strpos($link, 'http')) ? $link : 'http://'.$link;

			// If no label is present, take the link
		?>
		<li>
			<a href="<?php echo $link; ?>">
				<?php if($label): ?>
					<i class="icon-<?php echo JApplication::stringURLSafe(strtolower($label)) ?>"></i>
					<span><?php echo $label; ?></span>
				<?php else: ?>
					<?php echo $link ?>
				<?php endif; ?>
			</a>
		</li>
		<?php endforeach; ?>
		</ul>
	</div>
	
	<div class="contact-desc"><?php echo $contact->misc; ?></div>

	<?php echo $this->loadTemplate('address'); ?>
</div>
<!-- end user info -->

<!-- total posts -->
<h2 class="posted-by">
    <?php echo JText::sprintf('TPL_USERPAGE_POST_BY', $contact->name) ?>
    <?php if($this->pagination): ?>
        <span class="user-total-post">( <?php echo JText::plural('TPL_USERPAGE_TOTAL_POST', $this->pagination->get('total')) ?> )</span>
    <?php endif ?>
</h2>
<!-- end total posts -->
<!-- main content -->
<div class="blog">
    <!-- page heading -->
	<?php
    if ($params->get('show_page_heading')) : ?>
        <div class="page-header clearfix">
            <h1 class="page-title"> <?php echo $this->escape($params->get('page_heading')); ?> </h1>
        </div>
	<?php endif; ?>
    <!-- end page heading-->
    <!-- echo introtext -->
    <?php
        $dispatcher = JDispatcher::getInstance();

        // Compute the article slugs and prepare introtext (runs content plugins).
        foreach ($items as $i => & $item)
        {
            $item->slug = $item->alias ? ($item->id . ':' . $item->alias) : $item->id;
            $item->catslug = ($item->category_alias) ? ($item->catid . ':' . $item->category_alias) : $item->catid;
            $item->parent_slug = ($item->parent_alias) ? ($item->parent_id . ':' . $item->parent_alias) : $item->parent_id;
            // No link for ROOT category
            if ($item->parent_alias == 'root') {
                $item->parent_slug = null;
            }

            $item->event = new stdClass();

            // Old plugins: Ensure that text property is available
            if (!isset($item->text))
            {
                $item->text = $item->introtext;
            }
            JPluginHelper::importPlugin('content');
            $results = $dispatcher->trigger('onContentPrepare', array ('com_content.featured', &$item, &$this->params, 0));

            // Old plugins: Use processed text as introtext
            $item->introtext = $item->text;

            $results = $dispatcher->trigger('onContentAfterTitle', array('com_content.featured', &$item, &$item->params, 0));
            $item->event->afterDisplayTitle = trim(implode("\n", $results));

            $results = $dispatcher->trigger('onContentBeforeDisplay', array('com_content.featured', &$item, &$item->params, 0));
            $item->event->beforeDisplayContent = trim(implode("\n", $results));

            $results = $dispatcher->trigger('onContentAfterDisplay', array('com_content.featured', &$item, &$item->params, 0));
            $item->event->afterDisplayContent = trim(implode("\n", $results));
        }

    ?>

	<?php //render template ?>
    <div class="items-leading">
    <?php foreach ($items as &$item) : ?>
        <div class="leading<?php echo $item->state == 0 ? ' system-unpublished' : null; ?>">
        <?php
            $this->item = $item;
            echo $this->loadTemplate('item');
        ?>
        </div>
        <hr class="divider-vertical" />
    <?php endforeach ?>
    </div>

    <div class="pagination">
        <?php  if ($this->params->def('show_pagination_results', 1)) : ?>
            <p class="counter pull-right"> <?php echo $this->pagination->getPagesCounter(); ?> </p>
        <?php endif; ?>
        <?php echo $this->pagination->getPagesLinks(); ?>
    </div>


</div>
