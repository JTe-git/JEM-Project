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

/**
 * View class for the JEM Updatecheck screen
 *
 * @package JEM
 *
 */
class JemViewUpdatecheck extends JemAdminView
{

	public function display($tpl = null)
	{
		//Get data from the model
		$updatedata      	= $this->get('Updatedata');

		// Load css
		JHtml::_('stylesheet', 'com_jem/backend.css', array(), true);

		// Load script
		JHtml::_('behavior.framework');

		//assign data to template
		$this->updatedata	= $updatedata;

		// add toolbar
		$this->addToolbar();

		parent::display($tpl);
	}


	/**
	 * Add Toolbar
	 */
	protected function addToolbar()
	{
		JToolBarHelper::title(Text::_('COM_JEM_UPDATECHECK_TITLE'), 'settings');

		JToolBarHelper::back();
		JToolBarHelper::divider();
		JToolBarHelper::help('update', true);
	}
}
