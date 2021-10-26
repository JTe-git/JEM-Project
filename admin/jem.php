<?php
/**
 * @version 4.0.0
 * @package JEM
 * @copyright (C) 2013-2022 joomlaeventmanager.net
 * @copyright (C) 2005-2009 Christoph Lukes
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

// Access check.
require_once (JPATH_COMPONENT_SITE.'/factory.php');
if (!JemFactory::getUser()->authorise('core.manage', 'com_jem')) {
	\Joomla\CMS\Factory::getApplication()->enqueueMessage(Text::_('JERROR_ALERTNOAUTHOR'), 'warning');
}

// Require classes
require_once (JPATH_COMPONENT_SITE.'/helpers/helper.php');
require_once (JPATH_COMPONENT_SITE.'/helpers/countries.php');
require_once (JPATH_COMPONENT_SITE.'/classes/config.class.php');
require_once (JPATH_COMPONENT_SITE.'/classes/image.class.php');
require_once (JPATH_COMPONENT_SITE.'/classes/output.class.php');
require_once (JPATH_COMPONENT_SITE.'/classes/user.class.php');
require_once (JPATH_COMPONENT_SITE.'/classes/attachment.class.php');
require_once (JPATH_COMPONENT_SITE.'/classes/categories.class.php');
require_once (JPATH_COMPONENT_ADMINISTRATOR.'/classes/admin.class.php');
require_once (JPATH_COMPONENT_ADMINISTRATOR.'/classes/admin.view.class.php');
require_once (JPATH_COMPONENT_ADMINISTRATOR.'/helpers/helper.php');

// Set the table directory
JTable::addIncludePath(JPATH_COMPONENT.'/tables');

// create JEM's file logger
JemHelper::addFileLogger();

// import joomla controller library
jimport('joomla.application.component.controller');

// Require the frontend base controller
require_once (JPATH_COMPONENT.'/controller.php');

// Get an instance of the controller
$controller = JControllerLegacy::getInstance('Jem');

// Perform the Request task
$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task'));

// Redirect if set by the controller
$controller->redirect();
?>
