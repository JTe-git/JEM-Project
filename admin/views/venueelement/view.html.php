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
use Joomla\CMS\Factory;

/**
 * Venueselect-View
 */
class JemViewVenueelement extends JViewLegacy {

	public function display($tpl = null)
	{
		$app = Factory::getApplication();

		//initialise variables
		$db			= Factory::getDBO();
		$document	= Factory::getDocument();
		$itemid 	= $app->input->getInt('id', 0) . ':' . $app->input->getInt('Itemid', 0);

		HTMLHelper::_('behavior.tooltip');
		HTMLHelper::_('behavior.modal');

		//get vars
		$filter_order     = $app->getUserStateFromRequest('com_jem.venueelement.'.$itemid.'.filter_order', 'filter_order', 'l.ordering', 'cmd');
		$filter_order_Dir = $app->getUserStateFromRequest('com_jem.venueelement.'.$itemid.'.filter_order_Dir', 'filter_order_Dir', '', 'word');
		$filter_type      = $app->getUserStateFromRequest('com_jem.venueelement.'.$itemid.'.filter_type', 'filter_type', 0, 'int');
		$filter_search    = $app->getUserStateFromRequest('com_jem.venueelement.'.$itemid.'.filter_search', 'filter_search', '', 'string');
		$filter_search    = $db->escape(trim(\Joomla\String\StringHelper::strtolower($filter_search)));

		//prepare document
		$document->setTitle(Text::_('COM_JEM_SELECTVENUE'));

		// Load css
		HTMLHelper::_('stylesheet', 'com_jem/backend.css', array(), true);

		// Get data from the model
		$rows = $this->get('Data');

		// add pagination
		$pagination = $this->get('Pagination');

		// table ordering
		$lists['order_Dir'] = $filter_order_Dir;
		$lists['order'] = $filter_order;

		//Build search filter
		$filters = array();
		$filters[] = HTMLHelper::_('select.option', '1', Text::_('COM_JEM_VENUE'));
		$filters[] = HTMLHelper::_('select.option', '2', Text::_('COM_JEM_CITY'));
		$filters[] = HTMLHelper::_('select.option', '3', Text::_('COM_JEM_STATE'));
		$lists['filter'] = HTMLHelper::_('select.genericlist', $filters, 'filter_type', array('size'=>'1','class'=>'inputbox'), 'value', 'text', $filter_type);

		// search filter
		$lists['search']= $filter_search;

		//assign data to template
		$this->lists		= $lists;
		$this->rows			= $rows;
		$this->pagination	= $pagination;

		parent::display($tpl);
	}
}
?>
