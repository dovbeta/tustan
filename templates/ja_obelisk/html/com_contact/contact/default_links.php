<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

if ($this->params->get('presentation_style')=='sliders'):?>
<div class="accordion-group">
	<div class="accordion-heading">
		<a class="accordion-toggle" data-toggle="collapse" data-parent="#slide-contact" href="#display-links">
		<?php echo JText::_('COM_CONTACT_LINKS');?>
		</a>
	</div>
	<div id="display-links" class="accordion-body collapse">
		<div class="accordion-inner">
<?php endif; ?>
<?php if ($this->params->get('presentation_style') == 'tabs') : ?>
<div id="display-links" class="tab-pane">
<?php endif; ?>
<?php if  ($this->params->get('presentation_style')=='plain'):?>
<?php echo '<h3>'. JText::_('COM_CONTACT_LINKS').'</h3>'; ?>
<?php endif; ?>

		<div class="contact-link">
			<ul class="nav nav-tabs nav-stacked social-link">
				<?php
				foreach (range('a', 'e') as $char) :// letters 'a' to 'e'
					$link = $this->contact->params->get('link'.$char);
					$label = $this->contact->params->get('link'.$char.'_name');

					if (!$link) :
						continue;
					endif;

					// Add 'http://' if not present
					$link = (0 === strpos($link, 'http')) ? $link : 'http://'.$link;

					// If no label is present, take the link
					?>
					<li class="<?php echo JApplication::stringURLSafe(strtolower($label)) ?>">
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

<?php if ($this->params->get('presentation_style')=='sliders'):?>
		</div>
	</div>
</div>
<?php endif; ?>
<?php if ($this->params->get('presentation_style') == 'tabs') : ?>
</div>
<?php endif; ?>