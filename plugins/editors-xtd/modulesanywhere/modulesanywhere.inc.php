<?php
/**
 * Popup page
 * Displays a list with modules
 *
 * @package         Modules Anywhere
 * @version         3.2.2
 *
 * @author          Peter van Westen <peter@nonumber.nl>
 * @link            http://www.nonumber.nl
 * @copyright       Copyright © 2012 NoNumber All Rights Reserved
 * @license         http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

defined('_JEXEC') or die;

$user = JFactory::getUser();
if ($user->get('guest')) {
	JError::raiseError(403, JText::_("ALERTNOTAUTH"));
}

require_once JPATH_PLUGINS . '/system/nnframework/helpers/parameters.php';
$parameters = NNParameters::getInstance();
$params = $parameters->getPluginParams('modulesanywhere');

if (JFactory::getApplication()->isSite()) {
	if (!$params->enable_frontend) {
		JError::raiseError(403, JText::_("ALERTNOTAUTH"));
	}
}

$class = new plgButtonModulesAnywherePopup;
$class->render($params);

class plgButtonModulesAnywherePopup
{
	function render(&$params)
	{
		$app = JFactory::getApplication();

		// load the admin language file
		$lang = JFactory::getLanguage();
		if ($lang->getTag() != 'en-GB') {
			// Loads English language file as fallback (for undefined stuff in other language file)
			$lang->load('plg_editors-xtd_modulesanywhere', JPATH_ADMINISTRATOR, 'en-GB');
			$lang->load('plg_system_modulesanywhere', JPATH_ADMINISTRATOR, 'en-GB');
		}
		$lang->load('plg_editors-xtd_modulesanywhere', JPATH_ADMINISTRATOR, null, 1);
		$lang->load('plg_system_modulesanywhere', JPATH_ADMINISTRATOR, null, 1);
		// load the content language file
		$lang->load('com_modules', JPATH_ADMINISTRATOR);

		// Initialize some variables
		$db = JFactory::getDBO();
		$option = 'modulesanywhere';

		$filter_order = $app->getUserStateFromRequest($option . 'filter_order', 'filter_order', 'm.position', 'string');
		$filter_order_Dir = $app->getUserStateFromRequest($option . 'filter_order_Dir', 'filter_order_Dir', '', 'string');
		$filter_state = $app->getUserStateFromRequest($option . 'filter_state', 'filter_state', '', 'string');
		$filter_position = $app->getUserStateFromRequest($option . 'filter_position', 'filter_position', '', 'string');
		$filter_type = $app->getUserStateFromRequest($option . 'filter_type', 'filter_type', '', 'string');
		$filter_search = $app->getUserStateFromRequest($option . 'filter_search', 'filter_search', '', 'string');
		$filter_search = JString::strtolower($filter_search);

		$limit = $app->getUserStateFromRequest('global.list.limit', 'limit', $app->getCfg('list_limit'), 'int');
		$limitstart = $app->getUserStateFromRequest('modulesanywhere_limitstart', 'limitstart', 0, 'int');

		$where[] = 'm.client_id = 0';

		// used by filter
		if ($filter_position) {
			if ($filter_position == 'none') {
				$where[] = 'm.position = ""';
			} else {
				$where[] = 'm.position = ' . $db->q($filter_position);
			}
		}
		if ($filter_type) {
			$where[] = 'm.module = ' . $db->q($filter_type);
		}
		if ($filter_search) {
			$where[] = 'LOWER( m.title ) LIKE ' . $db->q('%' . $db->escape($filter_search, true) . '%', false);
		}
		if ($filter_state != '') {
			$where[] = 'm.published = ' . $filter_state;
		}

		$where = implode(' AND ', $where);

		if ($filter_order == 'm.ordering') {
			$orderby = 'm.position, m.ordering ' . $filter_order_Dir;
		} else {
			$orderby = $filter_order . ' ' . $filter_order_Dir . ', m.ordering ASC';
		}

		// get the total number of records
		$query = $db->getQuery(true);
		$query->select('COUNT(DISTINCT m.id)');
		$query->from('#__modules AS m');
		$query->join('LEFT', '#__users AS u ON u.id = m.checked_out');
		$query->join('LEFT', '#__viewlevels AS g ON g.id = m.access');
		$query->join('LEFT', '#__modules_menu AS mm ON mm.moduleid = m.id');
		$query->where($where);
		$db->setQuery($query);
		$total = $db->loadResult();

		jimport('joomla.html.pagination');
		$pageNav = new JPagination($total, $limitstart, $limit);

		$query = $db->getQuery(true);
		$query->select('m.*, u.name AS editor, g.title AS groupname, MIN( mm.menuid ) AS pages');
		$query->from('#__modules AS m');
		$query->join('LEFT', '#__users AS u ON u.id = m.checked_out');
		$query->join('LEFT', '#__viewlevels AS g ON g.id = m.access');
		$query->join('LEFT', '#__modules_menu AS mm ON mm.moduleid = m.id');
		$query->where($where);
		$query->group('m.id');
		$query->order($orderby);
		$db->setQuery($query, $pageNav->limitstart, $pageNav->limit);
		$rows = $db->loadObjectList();
		if ($db->getErrorNum()) {
			echo $db->stderr();
			return false;
		}

		// get list of Positions for dropdown filter
		$query = $db->getQuery(true);
		$query->select('m.position AS value, m.position AS text');
		$query->from('#__modules as m');
		$query->where('m.client_id = 0');
		$query->where('m.position != ""');
		$query->group('m.position');
		$query->order('m.position');
		$db->setQuery($query);
		$positions = $db->loadObjectList();
		array_unshift($positions, $options[] = JHtml::_('select.option', 'none', ':: ' . JText::_('JNONE') . ' ::'));
		array_unshift($positions, JHtml::_('select.option', '', JText::_('COM_MODULES_OPTION_SELECT_POSITION')));
		$lists['position'] = JHtml::_('select.genericlist', $positions, 'filter_position', 'class="inputbox" size="1" onchange="this.form.submit()"', 'value', 'text', $filter_position);

		// get list of Types for dropdown filter
		$query = $db->getQuery(true);
		$query->select('e.element AS value, e.name AS text');
		$query->from('#__extensions as e');
		$query->where('e.client_id = 0');
		$query->where('type = ' . $db->q('module'));
		$query->join('LEFT', '#__modules as m ON m.module = e.element AND m.client_id = e.client_id');
		$query->where('m.module IS NOT NULL');
		$query->group('e.element, e.name');
		$db->setQuery($query);
		$types = $db->loadObjectList();
		$lang = JFactory::getLanguage();
		foreach ($types as $i => $type) {
			$extension = $type->value;
			$source = JPATH_SITE . '/modules/' . $extension;
			$lang->load($extension . '.sys', JPATH_SITE, null, false, false)
				|| $lang->load($extension . '.sys', $source, null, false, false)
				|| $lang->load($extension . '.sys', JPATH_SITE, $lang->getDefault(), false, false)
				|| $lang->load($extension . '.sys', $source, $lang->getDefault(), false, false);
			$types[$i]->text = JText::_($type->text);
		}
		JArrayHelper::sortObjects($types, 'text', 1, true, $lang->getLocale());
		array_unshift($types, JHtml::_('select.option', '', JText::_('COM_MODULES_OPTION_SELECT_MODULE')));
		$lists['type'] = JHtml::_('select.genericlist', $types, 'filter_type', 'class="inputbox" size="1" onchange="this.form.submit()"', 'value', 'text', $filter_type);

		// state filter
		$states = array();
		$states[] = JHtml::_('select.option', '', JText::_('JOPTION_SELECT_PUBLISHED'));
		$states[] = JHtml::_('select.option', '1', JText::_('JPUBLISHED'));
		$states[] = JHtml::_('select.option', '0', JText::_('JUNPUBLISHED'));
		$states[] = JHtml::_('select.option', '-2', JText::_('JTRASHED'));
		$lists['state'] = JHtml::_('select.genericlist', $states, 'filter_state', 'class="inputbox" size="1" onchange="this.form.submit()"', 'value', 'text', $filter_state);

		// table ordering
		$lists['order_Dir'] = $filter_order_Dir;
		$lists['order'] = $filter_order;

		// search filter
		$lists['filter_search'] = $filter_search;

		$this->outputHTML($params, $rows, $pageNav, $lists);
	}

	function outputHTML(&$params, &$rows, &$page, &$lists)
	{
		$tag = explode(',', $params->module_tag);
		$tag = trim($tag['0']);
		$postag = explode(',', $params->modulepos_tag);
		$postag = trim($postag['0']);

		JHtml::_('behavior.tooltip');
		JHtml::_('formbehavior.chosen', 'select');

		?>
		<div class="header">
			<div class="container-fluid">
				<h1 CLASS="page-title"><?php echo JText::_('MODULES_ANYWHERE'); ?></h1>

			</div>
		</div>

		<div style="margin-bottom: 20px"></div>

		<div class="container-fluid container-main">
			<form action="" method="post" name="adminForm" id="adminForm">
				<div class="well well-small">
					<?php echo html_entity_decode(JText::_('MA_CLICK_ON_ONE_OF_THE_MODULES_LINKS'), ENT_COMPAT, 'UTF-8'); ?>
				</div>

				<div class="row-fluid form-vertical">
					<div class="span4 well">
						<div class="control-group">
							<label id="style-lbl" for="style" class="control-label"><?php echo JText::_('MA_MODULE_STYLE'); ?></label>

							<div class="controls">
								<?php
								$style = JFactory::getApplication()->input->get('style');
								if (!$style) {
									$style = $params->style;
								}

								?>
								<select name="style" if="style" class="inputbox">
									<?php foreach (explode(',', $params->styles) as $s) : ?>
										<option <?php echo ($s == $style) ? 'selected="selected"' : ''; ?> value="<?php echo $s; ?>"><?php echo $s; ?><?php echo ($s == $params->style) ? ' *' : ''; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>
					<div class="span4 well">
						<div class="control-group">
							<label id="showtitle-lbl" for="showtitle-field" class="control-label" rel="tooltip"
								title="<?php echo JText::_('COM_MODULES_FIELD_SHOWTITLE_DESC'); ?>">
								<?php echo JText::_('COM_MODULES_FIELD_SHOWTITLE_LABEL'); ?>
							</label>

							<div class="controls">
								<fieldset id="showtitle" class="radio btn-group">
									<input type="radio" id="showtitle0" name="showtitle" value="" checked="checked" />
									<label for="showtitle0"><?php echo JText::_('JDEFAULT'); ?></label>
									<input type="radio" id="showtitle1" name="showtitle" value="0" />
									<label for="showtitle1"><?php echo JText::_('JNO'); ?></label>
									<input type="radio" id="showtitle2" name="showtitle" value="1" />
									<label for="showtitle2"><?php echo JText::_('JYES'); ?></label>
								</fieldset>
							</div>
						</div>
					</div>

				</div>

				<div id="filter-bar" class="btn-toolbar">
					<div class="filter-search btn-group pull-left">
						<label for="filter_search" class="element-invisible"><?php echo JText::_('COM_BANNERS_SEARCH_IN_TITLE'); ?></label>
						<input type="text" name="filter_search" id="filter_search" placeholder="<?php echo JText::_('COM_MODULES_MODULES_FILTER_SEARCH_DESC'); ?>" value="<?php echo $lists['filter_search']; ?>" title="<?php echo JText::_('COM_MODULES_MODULES_FILTER_SEARCH_DESC'); ?>" />
					</div>
					<div class="btn-group pull-left hidden-phone">
						<button class="btn" type="submit" rel="tooltip" title="<?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?>">
							<i class="icon-search"></i></button>
						<button class="btn" type="button" rel="tooltip" title="<?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?>" onclick="document.id('filter_search').value='';this.form.submit();">
							<i class="icon-remove"></i></button>
					</div>

					<div class="btn-group pull-right hidden-phone">
						<?php echo $lists['type']; ?>
					</div>
					<div class="btn-group pull-right hidden-phone">
						<?php echo $lists['position']; ?>
					</div>
					<div class="btn-group pull-right hidden-phone">
						<?php echo $lists['state']; ?>
					</div>
				</div>

				<table class="table table-striped">
					<thead>
						<tr>
							<th width="1%" class="nowrap">
								<?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', 'm.id', @$lists['order_Dir'], @$lists['order']); ?>
							</th>
							<th width="1%" class="nowrap center">
								<?php echo JHtml::_('grid.sort', 'JSTATUS', 'm.published', @$lists['order_Dir'], @$lists['order']); ?>
							</th>
							<th class="title">
								<?php echo JHtml::_('grid.sort', 'JGLOBAL_TITLE', 'm.title', @$lists['order_Dir'], @$lists['order']); ?>
							</th>
							<th width="15%" class="nowrap">
								<?php echo JHtml::_('grid.sort', 'COM_MODULES_HEADING_POSITION', 'm.position', @$lists['order_Dir'], @$lists['order']); ?>
							</th>
							<th width="10%" class="nowrap hidden-phone">
								<?php echo JHtml::_('grid.sort', 'COM_MODULES_HEADING_MODULE', 'm.module', @$lists['order_Dir'], @$lists['order']); ?>
							</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<td colspan="8">
								<?php echo $page->getListFooter(); ?>
							</td>
						</tr>
					</tfoot>
					<tbody>
						<?php
						$k = 0;
						for ($i = 0, $n = count($rows); $i < $n; $i++) {
							$row =& $rows[$i];
							?>
							<tr class="<?php echo "row$k"; ?>">
								<td class="center">
									<a rel="tooltip" title="<?php echo JText::_('MA_USE_ID_IN_TAG'); ?>:<br />{module <?php echo $row->id; ?>}"
										href="javascript://" onclick="modulesanywhere_jInsertEditorText( '<?php echo $row->id; ?>' )">
										<?php echo $row->id; ?>
									</a>
								</td>
								<td class="center">
									<?php echo JHtml::_('jgrid.published', $row->published, $row->id, 'modules.', 0, 'cb', $row->publish_up, $row->publish_down); ?>
								</td>
								<td>
									<a rel="tooltip" title="<?php echo JText::_('MA_USE_TITLE_IN_TAG'); ?>:<br />{module <?php echo htmlspecialchars($row->title); ?>}"
										href="javascript://" onclick="modulesanywhere_jInsertEditorText( '<?php echo addslashes(htmlspecialchars($row->title)); ?>' )">
										<?php echo htmlspecialchars($row->title); ?>
									</a>
									<?php if (!empty($row->note)) : ?>
										<p class="smallsub">
											<?php echo JText::sprintf('JGLOBAL_LIST_NOTE', htmlspecialchars($row->note)); ?></p>
									<?php endif; ?>
								</td>
								<td>
									<?php if ($row->position) : ?>
										<a class="label label-info" rel="tooltip" title="<?php echo JText::_('MA_USE_MODULE_POSITION_TAG'); ?>:<br />{modulepos <?php echo $row->position; ?>}"
											href="javascript://" onclick="modulesanywhere_jInsertEditorText( '<?php echo $row->position; ?>', 1 )">
											<?php echo $row->position; ?>
										</a>
									<?php else : ?>
										<span class="label">
											<?php echo JText::_('JNONE'); ?>
										</span>
									<?php endif; ?>
								</td>
								<td class="hidden-phone">
									<?php echo $row->module ? $row->module : JText::_('User'); ?>
								</td>
							</tr>
							<?php
							$k = 1 - $k;
						}
						?>
					</tbody>
				</table>
				<input type="hidden" name="name" value="<?php echo JFactory::getApplication()->input->getString('name', 'text'); ?>" />
				<input type="hidden" name="filter_order" value="<?php echo $lists['order']; ?>" />
				<input type="hidden" name="filter_order_Dir" value="<?php echo $lists['order_Dir']; ?>" />
			</form>
			<?php
			if (JFactory::getApplication()->isAdmin()) {
				$user = JFactory::getUser();
				if ($user->authorise('core.admin', 1)) {
					echo '<em>' . str_replace('<a ', '<a target="_blank" ', html_entity_decode(JText::_('MA_SETTINGS'))) . '</em>';
				}
			}
			?>
		</div>
		<script type="text/javascript">
			function modulesanywhere_jInsertEditorText(id, modulepos)
			{
				(function($)
				{
					if (modulepos) {
						str = '{<?php echo $postag; ?> ' + id + '}';
					} else {
						str = '{<?php echo $tag; ?> ' + id;
						<?php if ($params->override_style && (count(explode(',', $params->styles)) > 1 || $params->styles != $params->style)) : ?>
						var style = $('input[name=style]').val();
						if (style && style != '<?php echo $params->style; ?>') {
							str += '|' + style;
						}
						<?php endif; ?>
						if ($('input[name=showtitle]:checked').val()) {
							str += '|showtitle=' + $('input[name=showtitle]:checked').val();
						}
						str += '}';
					}


					window.parent.jInsertEditorText(str, '<?php echo JFactory::getApplication()->input->getString('name', 'text'); ?>');
					window.parent.SqueezeBox.close();
				})(jQuery);
			}

			function initDivs()
			{
				(function($)
				{
					$('div.toggle_div').each(function(i, el)
					{
						$('input[name=' + $(el).attr('rel') + ']').each(function(i, el)
						{
							$(el).click(function() { toggleDivs(); });
						});
					});
					toggleDivs();
				})(jQuery);
			}

			function toggleDivs()
			{

				(function($)
				{
					$('div.toggle_div').each(function(i, el)
					{
						el = $(el);
						if ($('input[name=' + el.attr('rel') + ']:checked').val() == 1) {
							el.slideDown();
						} else {
							el.slideUp();
						}
					});
				})(jQuery);
			}

			jQuery(document).ready(function() { initDivs(); });
		</script>
	<?php
	}
}
