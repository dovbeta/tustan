<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_articles_latest
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

?>
<ul class="latestnews<?php echo $moduleclass_sfx; ?>">
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
		<a href="<?php echo $item->link; ?>">
			<?php echo $item->title; ?></a>
	</li>
<?php endforeach; ?>
</ul>
