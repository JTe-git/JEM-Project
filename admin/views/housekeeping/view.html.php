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
use Joomla\CMS\HTML\HTMLHelper;

/**
 * Housekeeping-View
 */
class JemViewHousekeeping extends JemAdminView
{

	public function display($tpl = null) {

		$app = JFactory::getApplication();

		$this->totalcats = $this->get('Countcats');

		//only admins have access to this view
		if (!JemFactory::getUser()->authorise('core.manage', 'com_jem')) {
			\Joomla\CMS\Factory::getApplication()->enqueueMessage(Text::_('JERROR_ALERTNOAUTHOR'), 'warning');
			$app->redirect('index.php?option=com_jem&view=main');
		}

		// Load css
		HTMLHelper::_('stylesheet', 'com_jem/backend.css', array(), true);

		// Load Script
		HTMLHelper::_('behavior.framework');

		// add toolbar
		$this->addToolbar();

		parent::display($tpl);
	}


	/**
	 * Add Toolbar
	 */
	protected function addToolbar()
	{
		JToolBarHelper::title(Text::_('COM_JEM_HOUSEKEEPING'), 'housekeeping');

		JToolBarHelper::back();
		JToolBarHelper::divider();
		JToolBarHelper::help('housekeeping', true);
	}
}
?>
