#
#<?php die('Forbidden.'); ?>
#Date: 2014-06-06 09:31:57 UTC
#Software: Joomla Platform 13.1.0 Stable [ Curiosity ] 24-Apr-2013 00:00 GMT

#Fields: datetime	priority	category	message
2014-06-06T09:31:57+00:00	INFO	update	Update started by user Super User (42). Old version is 3.2.0.
2014-06-06T09:31:57+00:00	INFO	update	Downloading update file from .
2014-06-06T09:32:00+00:00	INFO	update	File Joomla_3.2.x_to_3.2.4-Stable-Patch_Package.zip successfully downloaded.
2014-06-06T09:32:00+00:00	INFO	update	Starting installation of new version.
2014-06-06T09:32:18+00:00	INFO	update	Finalising installation.
2014-06-06T09:32:19+00:00	INFO	update	Ran query from file 3.2.1. Query text: DELETE FROM `#__postinstall_messages` WHERE `title_key` = 'PLG_USER_JOOMLA_POSTI.
2014-06-06T09:32:19+00:00	INFO	update	Ran query from file 3.2.2-2013-12-22. Query text: ALTER TABLE `#__update_sites` ADD COLUMN `extra_query` VARCHAR(1000) DEFAULT '';.
2014-06-06T09:32:19+00:00	INFO	update	Ran query from file 3.2.2-2013-12-22. Query text: ALTER TABLE `#__updates` ADD COLUMN `extra_query` VARCHAR(1000) DEFAULT '';.
2014-06-06T09:32:19+00:00	INFO	update	Ran query from file 3.2.2-2013-12-28. Query text: UPDATE `#__menu` SET `component_id` = (SELECT `extension_id` FROM `#__extensions.
2014-06-06T09:32:19+00:00	INFO	update	Ran query from file 3.2.2-2014-01-08. Query text: INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`.
2014-06-06T09:32:19+00:00	INFO	update	Ran query from file 3.2.2-2014-01-15. Query text: INSERT INTO `#__postinstall_messages` (`extension_id`, `title_key`, `description.
2014-06-06T09:32:19+00:00	INFO	update	Ran query from file 3.2.2-2014-01-18. Query text: /* Update updates version length */ ALTER TABLE `#__updates` MODIFY `version` va.
2014-06-06T09:32:19+00:00	INFO	update	Ran query from file 3.2.2-2014-01-23. Query text: INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`.
2014-06-06T09:32:19+00:00	INFO	update	Ran query from file 3.2.3-2014-02-20. Query text: UPDATE `#__extensions` ext1, `#__extensions` ext2 SET ext1.`params` =  ext2.`par.
2014-06-06T09:32:20+00:00	INFO	update	Deleting removed files and folders.
2014-06-06T09:32:25+00:00	INFO	update	Cleaning up after installation.
2014-06-06T09:32:25+00:00	INFO	update	Update to version 3.2.4 is complete.
2014-06-06T10:49:16+00:00	INFO	update	Update started by user Super User (42). Old version is 3.2.4.
2014-06-06T10:49:16+00:00	INFO	update	Downloading update file from .
2014-06-06T10:49:21+00:00	INFO	update	File Joomla_3.3.0-Stable-Update_Package.zip successfully downloaded.
2014-06-06T10:49:21+00:00	INFO	update	Starting installation of new version.
2014-06-06T10:49:30+00:00	INFO	update	Finalising installation.
2014-06-06T10:49:31+00:00	INFO	update	Ran query from file 3.3.0-2014-02-16. Query text: ALTER TABLE `#__users` ADD COLUMN `requireReset` tinyint(4) NOT NULL DEFAULT 0 C.
2014-06-06T10:49:31+00:00	INFO	update	Ran query from file 3.3.0-2014-04-02. Query text: INSERT INTO `#__extensions` (`extension_id`, `name`, `type`, `element`, `folder`.
2014-06-06T10:49:31+00:00	INFO	update	Deleting removed files and folders.
2014-06-06T10:49:31+00:00	INFO	update	Cleaning up after installation.
2014-06-06T10:49:31+00:00	INFO	update	Update to version 3.3.0 is complete.
