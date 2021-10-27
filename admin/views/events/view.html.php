<?php
/**
 * @version 4.0.0
 * @package JEM
 * @copyright (C) 2013-2022 joomlaeventmanager.net
 * @copyright (C) 2005-2009 Christoph Lukes
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 *
 */
defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Factory;

/**
 * Events-View
 */

class JemViewEvents extends JemAdminView
{
	protected $items;
	protected $pagination;
	protected $state;

	public function display($tpl = null)
	{
		$user 		= JemFactory::getUser();
		$document	= Factory::getDocument();
		$settings 	= JemHelper::globalattribs();

		$jemsettings = JemAdmin::config();
		$url 		= JUri::root();

		// Initialise variables.
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');

		// Retrieving params
		$params = $this->state->get('params');

		// highlighter
		$highlighter = $settings->get('highlight','0');

		// Check for errors.
		$errors = $this->get('Errors');
		if (is_array($errors) && count($errors)) {
			\Joomla\CMS\Factory::getApplication()->enqueueMessage(implode("\n", $errors), 'error');
			return false;
		}

		// Load css
		HTMLHelper::_('stylesheet', 'com_jem/backend.css', array(), true);

		// Load Scripts
		$document->addScript('https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');

		if ($highlighter) {
			$document->addScript($url.'media/com_jem/js/highlighter.js');
			$style = '
			    .red, .red a {
			    color:red;}
			    ';
			$document->addStyleDeclaration($style);
		}

		//add style to description of the tooltip (hastip)
		HTMLHelper::_('behavior.core');
    
		// add filter selection for the search
		$filters = array();
		$filters[] = HTMLHelper::_('select.option', '1', Text::_('COM_JEM_EVENT_TITLE'));
		$filters[] = HTMLHelper::_('select.option', '2', Text::_('COM_JEM_VENUE'));
		$filters[] = HTMLHelper::_('select.option', '3', Text::_('COM_JEM_CITY'));
		$filters[] = HTMLHelper::_('select.option', '4', Text::_('COM_JEM_CATEGORY'));
		$filters[] = HTMLHelper::_('select.option', '5', Text::_('COM_JEM_STATE'));
		$filters[] = HTMLHelper::_('select.option', '6', Text::_('COM_JEM_COUNTRY'));
		$filters[] = HTMLHelper::_('select.option', '7', Text::_('JALL'));
		$lists['filter'] = HTMLHelper::_('select.genericlist', $filters, 'filter_type', array('size'=>'1','class'=>'inputbox'), 'value', 'text', $this->state->get('filter_type'));

		//assign data to template
		$this->lists		= $lists;
		$this->user			= $user;
		$this->jemsettings  = $jemsettings;
		$this->settings		= $settings;

		// add toolbar
		$this->addToolbar();

		parent::display($tpl);
	}


	/**
	 * Add Toolbar
	 */
	protected function addToolbar()
	{
		JToolBarHelper::title(Text::_('COM_JEM_EVENTS'), 'events');

		/* retrieving the allowed actions for the user */
		$canDo = JemHelperBackend::getActions(0);

		/* create */
		if (($canDo->get('core.create'))) {
			JToolBarHelper::addNew('event.add');
		}

		/* edit */
		if (($canDo->get('core.edit'))) {
			JToolBarHelper::editList('event.edit');
			JToolBarHelper::divider();
		}

		/* state */
		if ($canDo->get('core.edit.state')) {
			if ($this->state->get('filter_state') != 2) {
				JToolBarHelper::publishList('events.publish', 'JTOOLBAR_PUBLISH', true);
				JToolBarHelper::unpublishList('events.unpublish', 'JTOOLBAR_UNPUBLISH', true);
				JToolBarHelper::custom('events.featured', 'featured.png', 'featured_f2.png', 'JFEATURED', true);
			}

			if ($this->state->get('filter_state') != -1) {
				JToolBarHelper::divider();
				if ($this->state->get('filter_state') != 2) {
					JToolBarHelper::archiveList('events.archive');
				} elseif ($this->state->get('filter_state') == 2) {
					JToolBarHelper::unarchiveList('events.publish');
				}
			}
		}

		if ($canDo->get('core.edit.state')) {
			JToolBarHelper::checkin('events.checkin');
		}

		if ($this->state->get('filter_state') == -2 && $canDo->get('core.delete')) {
			JToolBarHelper::deleteList('COM_JEM_CONFIRM_DELETE', 'events.delete', 'JTOOLBAR_EMPTY_TRASH');
		} elseif ($canDo->get('core.edit.state')) {
			JToolBarHelper::trash('events.trash');
		}

		JToolBarHelper::divider();
		JToolBarHelper::help('listevents', true);
	}
}
?>
