<?php
/**
 * ------------------------------------------------------------------------
 * JA Obelisk Template
 * ------------------------------------------------------------------------
 * Copyright (C) 2004-2011 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
 * @license - Copyrighted Commercial Software
 * Author: J.O.O.M Solutions Co., Ltd
 * Websites:  http://www.joomlart.com -  http://www.joomlancers.com
 * This file may not be redistributed in whole or significant part.
 * ------------------------------------------------------------------------
 */

// no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<ul class="ja-login<?php echo $params->get('moduleclass_sfx','')?>">
<?php if($type == 'logout') : ?>
	<li class="dropdown test">
	<a data-toggle="dropdown" href="#" class="dropdown-toggle btn btn-primary">
		<?php echo JText::_('TPL_USER') ?>
	</a>
	<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" name="form-login" id="login-form" class="nav-child dropdown-menu">
<?php if ($params->get('greeting')) : ?>
	<div class="login-greeting">
	<?php if($params->get('name') == 0) :
		echo JText::sprintf('HINAME', $user->get('username'));
	 else :
		echo JText::sprintf('HINAME', $user->get('name'));
	 endif; ?>
	</div>
<?php endif; ?>
	<div class="logout-button">
		<input type="submit" name="Submit" class="button btn btn-primary" value="<?php echo JText::_('JLOGOUT'); ?>" />
	</div>

	<input type="hidden" name="option" value="com_users" />
	<input type="hidden" name="task" value="user.logout" />
	<input type="hidden" name="return" value="<?php echo $return; ?>" />
	<?php echo JHTML::_('form.token');?>
</form>
	</li>
<?php else : ?>
	<li>
		<a class="login-switch btn btn-primary" href="<?php echo JRoute::_('index.php?option=com_user&view=login');?>" onclick="showBox('ja-user-login','mod_login_username',this, window.event || event);return false;" title="<?php echo JText::_('TXT_LOGIN');?>"><span><?php echo JText::_('TXT_LOGIN');?></span></a>

	<!--LOFIN FORM content-->
	<div id="ja-user-login">
	<?php if(JPluginHelper::isEnabled('authentication', 'openid')) : ?>
        <?php JHTML::_('script', 'openid.js'); ?>
    <?php endif; ?>
	  <form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" autocomplete="off" method="post" name="form-login" id="login-form" >
			<div class="pretext">
				<?php echo $params->get('pretext'); ?>
			</div>
			<fieldset class="userdata">
				<p id="form-login-username">
					<input id="modlgn-username" type="text" name="username" placeholder="<?php echo JText::_('JAUSERNAME') ?>" class="inputbox"  size="18" />
				</p>
				<p id="form-login-password">
					<input id="modlgn-passwd" type="password" name="password" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD') ?>" class="inputbox" size="18"  />
				</p>
				
				<button type="submit" name="Submit" class="button btn btn-primary"><?php echo JText::_('JABUTTON_LOGIN'); ?></button>
				<input type="hidden" name="option" value="com_users" />
				<input type="hidden" name="task" value="user.login" />
				<input type="hidden" name="return" value="<?php echo $return; ?>" />
				<?php echo JHTML::_('form.token'); ?>
			</fieldset>
			<div class="form-login-meta clearfix">
				<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
        <p id="form-login-remember" class="pull-left">
          <label for="modlgn-remember"><?php echo JText::_('JAREMEMBER_ME') ?></label>
          <input id="modlgn-remember" type="checkbox" name="remember" class="inputbox" value="yes"/>
        </p>
        <?php endif; ?>
        <p class="pull-right">
          <a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>">
          <?php echo JText::_('FORGOT_YOUR_PASSWORD'); ?></a>
        </p>
			</div>
	        <?php echo $params->get('posttext'); ?>
	    </form>
    </div>

	</li>
	<?php
				$option = JRequest::getCmd('option');
				$task = JRequest::getCmd('task');
				if($option!='com_user' && $task != 'register') { ?>
	<li>
		<a class="register-switch btn btn-highlight" href="<?php echo JRoute::_("index.php?option=com_users&task=registration");?>" onclick="showBox('ja-user-register','namemsg',this, window.event || event);return false;" >
			<span><?php echo JText::_('REGISTER');?></span>
		</a>
		<!--LOFIN FORM content-->
		<div id="ja-user-register" <?php if(!empty($captchatext)) echo "class='hascaptcha'"; ?> >
			<?php
			JHTML::_('behavior.keepalive');
			JHTML::_('behavior.formvalidation');
			?>

			<form id="member-registration" action="<?php echo JRoute::_('index.php?option=com_users&task=registration.register'); ?>" method="post" class="form-validate">
				<fieldset>
				<?php if (isset($fieldset->label)):// If the fieldset has a label set, display it as the legend.?>
					<legend><?php echo JText::_($fieldset->label);?></legend>
				<?php endif;?>
					<div class="row-fluid">      
            <div class="span6">
              <input type="text" size="30" class="required" value="" id="jform_name" name="jform[name]" placeholder="<?php echo JText::_( 'JANAME' ); ?>">
            </div>      
            <div class="span6">
              <input type="text" size="30" class="validate-username required" value="" id="jform_username" placeholder="<?php echo JText::_( 'JAUSERNAME' ); ?>" name="jform[username]">
            </div>
          </div>  
          <div class="row-fluid">     
            <div class="span6">
              <input type="password" size="30" class="validate-password required" autocomplete="off" placeholder="<?php echo JText::_( 'JGLOBAL_PASSWORD' ); ?>" value="" id="jform_password1" name="jform[password1]">
            </div>          
            <div class="span6">
              <input type="password" size="30" class="validate-password required" autocomplete="off" placeholder="<?php echo JText::_( 'JGLOBAL_REPASSWORD' ); ?>" value="" id="jform_password2" name="jform[password2]">
            </div>  
          </div>  
          <div class="row-fluid">     
            <div class="span6">
              <input type="text" size="30" class="validate-email required" value="" id="jform_email1" placeholder="<?php echo JText::_( 'JAEMAIL' ); ?>" name="jform[email1]">
            </div>          
            <div class="span6">
              <input type="text" size="30" class="validate-email required" value="" id="jform_email2" placeholder="<?php echo JText::_( 'JACONFIRM_EMAIL_ADDRESS'); ?>" name="jform[email2]">
            </div>
          </div>
          <?php  if(!empty($captchatext)) { ?>
          <div>
            <label title="" class="required"  id="jform_captcha-lbl"><?php echo JText::_( 'JACAPTCHA'); ?>:</label>
            <em> (*)</em> 
          </div>           
          <div><?php echo $captchatext; ?></div>
          <?php } ?>
				</fieldset>
				<br/>
				<p><?php echo JText::_("DESC_REQUIREMENT"); ?></p>
				<div class="row-fluid">
          <div class="span6">
            <button type="submit" class="validate btn btn-highlight"><?php echo JText::_('JAREGISTER');?></button>
          </div>
        </div>
				<div>
					<input type="hidden" name="option" value="com_users" />
					<input type="hidden" name="task" value="registration.register" />
					<?php echo JHTML::_('form.token');?>
				</div>
			</form>
				<!-- Old code -->
		</div>
	</li>
	<?php } ?>
		<!--LOFIN FORM content-->
<?php endif; ?>
</ul>