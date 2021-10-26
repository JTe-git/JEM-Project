<?php
/**
 * @version     4.0.0
 * @package     JEM
 * @copyright   Copyright (C) 2013-2022 joomlaeventmanager.net
 * @copyright   Copyright (C) 2005-2009 Christoph Lukes
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */
defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;

/**
 *  View class for the JEM Categories screen
 */
class JemViewCategories extends JemAdminView
{
	protected $items;
	protected $pagination;
	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$this->state		= $this->get('State');
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');

		// Check for errors.
		$errors = $this->get('Errors');
		if (is_array($errors) && count($errors)) {
			\Joomla\CMS\Factory::getApplication()->enqueueMessage(implode("\n", $errors), 'error');
			return false;
		}

		// Load css
		HTMLHelper::_('stylesheet', 'com_jem/backend.css', array(), true);

		// Preprocess the list of items to find ordering divisions.
		foreach ($this->items as &$item) {
			$this->ordering[$item->parent_id][] = $item->id;
		}

		// Levels filter.
		$options	= array();
		$options[]	= HTMLHelper::_('select.option', '1', Text::_('J1'));
		$options[]	= HTMLHelper::_('select.option', '2', Text::_('J2'));
		$options[]	= HTMLHelper::_('select.option', '3', Text::_('J3'));
		$options[]	= HTMLHelper::_('select.option', '4', Text::_('J4'));
		$options[]	= HTMLHelper::_('select.option', '5', Text::_('J5'));
		$options[]	= HTMLHelper::_('select.option', '6', Text::_('J6'));
		$options[]	= HTMLHelper::_('select.option', '7', Text::_('J7'));
		$options[]	= HTMLHelper::_('select.option', '8', Text::_('J8'));
		$options[]	= HTMLHelper::_('select.option', '9', Text::_('J9'));
		$options[]	= HTMLHelper::_('select.option', '10', Text::_('J10'));

		$this->f_levels = $options;

		$this->addToolbar();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 */
	protected function addToolbar()
	{

		// Initialise variables.
		$canDo		= null;
		$user		= JemFactory::getUser();

		// Get the results for each action.
		$canDo = JemHelperBackend::getActions(0);

		JToolBarHelper::title(Text::_('COM_JEM_CATEGORIES'), 'elcategories');

		if ($canDo->get('core.create')) {
			 JToolBarHelper::addNew('category.add');
		}

		if ($canDo->get('core.edit' ) || $canDo->get('core.edit.own')) {
			JToolBarHelper::editList('category.edit');
			JToolBarHelper::divider();
		}

		if ($canDo->get('core.edit.state')) {
			JToolBarHelper::publish('categories.publish', 'JTOOLBAR_PUBLISH', true);
			JToolBarHelper::unpublish('categories.unpublish', 'JTOOLBAR_UNPUBLISH', true);
			JToolBarHelper::divider();
			JToolBarHelper::archiveList('categories.archive');
		}

		if ($user->authorise('core.admin')) { // todo: is that correct?
			JToolBarHelper::checkin('categories.checkin');
		}

		if ($this->state->get('filter.published') == -2 && $canDo->get('core.delete')) {
			JToolBarHelper::deleteList('COM_JEM_CONFIRM_DELETE', 'categories.remove', 'JTOOLBAR_EMPTY_TRASH');
		}
		elseif ($canDo->get('core.edit.state')) {
			JToolBarHelper::trash('categories.trash');
		}

		if ($canDo->get('core.admin')) {
			JToolBarHelper::divider();
			JToolBarHelper::custom('categories.rebuild', 'refresh.png', 'refresh_f2.png', 'JTOOLBAR_REBUILD', false);
		}

		JToolBarHelper::divider();
		JToolBarHelper::help('listcategories', true);
	}
}
