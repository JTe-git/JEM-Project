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
 * View class: Attendees
 */
class JemViewAttendees extends JemAdminView
{
	public function display($tpl = null)
	{
		$app = JFactory::getApplication();
		$db  = JFactory::getDBO();

		$this->jemsettings = JemHelper::config();

		if($this->getLayout() == 'print') {
			$this->_displayprint($tpl);
			return;
		}

		$filter_status    = $app->getUserStateFromRequest('com_jem.attendees.filter_status', 'filter_status', -2, 'int');
		$filter_type      = $app->getUserStateFromRequest('com_jem.attendees.filter_type',   'filter_type',    0, 'int');
		$filter_search    = $app->getUserStateFromRequest('com_jem.attendees.filter_search', 'filter_search', '', 'string');
		$filter_search    = $db->escape(trim(\Joomla\String\StringHelper::strtolower($filter_search)));

		// Load css
		HTMLHelper::_('stylesheet', 'com_jem/backend.css', array(), true);

		// Get data from the model
		$event = $this->get('Event');

		$this->items      = $this->get('Items');
		$this->pagination = $this->get('Pagination');
		$this->state      = $this->get('State');

		// Check for errors.
		$errors = $this->get('Errors');
		if (is_array($errors) && count($errors)) {
			\Joomla\CMS\Factory::getApplication()->enqueueMessage(implode("\n", $errors), 'error');
			return false;
		}

		// check for data error
		if (empty($event)) {
			$app->enqueueMessage(Text::_('JERROR_AN_ERROR_HAS_OCCURRED'), 'error');
			return false;
		}

 		if (JemHelper::isValidDate($event->dates)) {
			$event->dates = JemOutput::formatdate($event->dates);
		} else {
			$event->dates = Text::_('COM_JEM_OPEN_DATE');
		}

		//build filter selectlist
		$filters = array();
		$filters[] = HTMLHelper::_('select.option', '1', Text::_('COM_JEM_NAME'));
		$filters[] = HTMLHelper::_('select.option', '2', Text::_('COM_JEM_USERNAME'));
		$lists['filter'] = HTMLHelper::_('select.genericlist', $filters, 'filter_type', array('size'=>'1','class'=>'inputbox'), 'value', 'text', $filter_type);

		// search filter
		$lists['search'] = $filter_search;

		// registration status
		$options = array(HTMLHelper::_('select.option', -2, Text::_('COM_JEM_ATT_FILTER_ALL')),
		                 HTMLHelper::_('select.option',  0, Text::_('COM_JEM_ATT_FILTER_INVITED')),
		                 HTMLHelper::_('select.option', -1, Text::_('COM_JEM_ATT_FILTER_NOT_ATTENDING')),
		                 HTMLHelper::_('select.option',  1, Text::_('COM_JEM_ATT_FILTER_ATTENDING')),
		                 HTMLHelper::_('select.option',  2, Text::_('COM_JEM_ATT_FILTER_WAITING')));
		$lists['status'] = HTMLHelper::_('select.genericlist', $options, 'filter_status', array('onChange'=>'this.form.submit();'), 'value', 'text', $filter_status);

		//assign to template
		$this->lists 		= $lists;
		$this->event 		= $event;

		// add toolbar
		$this->addToolbar();

		parent::display($tpl);
	}

	/**
	 * Prepares the print screen
	 */
	protected function _displayprint($tpl = null)
	{
		// Load css
		HTMLHelper::_('stylesheet', 'com_jem/backend.css', array(), true);

		$rows = $this->get('Items');
		$event = $this->get('Event');

		if (JemHelper::isValidDate($event->dates)) {
			$event->dates = JemOutput::formatdate($event->dates);
		} else {
			$event->dates = Text::_('COM_JEM_OPEN_DATE');
		}

		//assign data to template
		$this->rows = $rows;
		$this->event = $event;

		parent::display($tpl);
	}


	/**
	 * Add Toolbar
	 */
	protected function addToolbar()
	{
		JToolBarHelper::title(Text::_('COM_JEM_REGISTERED_USERS'), 'users');

		JToolBarHelper::addNew('attendees.add');
		JToolBarHelper::editList('attendees.edit');
		JToolBarHelper::custom('attendees.setNotAttending', 'loop', 'loop', Text::_('COM_JEM_ATTENDEES_SETNOTATTENDING'), true);
		JToolBarHelper::custom('attendees.setAttending', 'loop', 'loop', Text::_('COM_JEM_ATTENDEES_SETATTENDING'), true);
		if ($this->event->waitinglist) {
			JToolBarHelper::custom('attendees.setWaitinglist', 'loop', 'loop', Text::_('COM_JEM_ATTENDEES_SETWAITINGLIST'), true);
		}
		JToolBarHelper::spacer();
		JToolBarHelper::custom('attendees.export', 'download', 'download', Text::_('COM_JEM_EXPORT'), false);

		$eventid 	= $this->event->id;
		$link_print = 'index.php?option=com_jem&amp;view=attendees&amp;layout=print&amp;tmpl=component&amp;eventid='.$eventid;

		$bar = JToolBar::getInstance('toolbar');
		$bar->appendButton('Popup', 'print', 'COM_JEM_PRINT', $link_print, 600, 300);

		JToolBarHelper::deleteList('COM_JEM_CONFIRM_DELETE', 'attendees.remove', 'COM_JEM_ATTENDEES_DELETE');
		JToolBarHelper::spacer();
		JToolBarHelper::custom('attendees.back', 'back', 'back', Text::_('COM_JEM_ATT_BACK'), false);
		JToolBarHelper::divider();
		JToolBarHelper::help('registereduser', true);
	}
}
