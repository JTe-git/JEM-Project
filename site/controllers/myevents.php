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

jimport('joomla.application.component.controller');

/**
 * JEM Component Myevents Controller
 *
 * @package JEM
 *
 */
class JemControllerMyevents extends JControllerLegacy
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Logic to publish events
	 *
	 * @access public
	 * @return void
	 */
	public function publish()
	{
		// Check for request forgeries
		JSession::checkToken() or jexit('Invalid Token');

		$app = JFactory::getApplication();
		$input = $app->input;

		$cid = $input->get('cid', array(), 'array');

		if (empty($cid)) {
			\Joomla\CMS\Factory::getApplication()->enqueueMessage(Text::_('COM_JEM_SELECT_ITEM_TO_PUBLISH'), 'notice');
			$this->setRedirect(JemHelperRoute::getMyEventsRoute());
			return;
		}

		$model = $this->getModel('myevents');
		if (!$model->publish($cid, 1)) {
			echo "<script> alert('".$model->getError()."'); window.history.go(-1); </script>\n";
		}

		$total = count($cid);
		$msg   = $total.' '.Text::_('COM_JEM_EVENT_PUBLISHED');

		$this->setRedirect(JemHelperRoute::getMyEventsRoute(), $msg);
	}

	/**
	 * Logic for canceling an event and proceed to add a venue
	 */
	public function unpublish()
	{
		// Check for request forgeries
		JSession::checkToken() or jexit('Invalid Token');

		$app = JFactory::getApplication();
		$input = $app->input;

		$cid = $input->get('cid', array(), 'array');

		if (empty($cid)) {
			\Joomla\CMS\Factory::getApplication()->enqueueMessage(Text::_('COM_JEM_SELECT_ITEM_TO_UNPUBLISH'), 'notice');
			$this->setRedirect(JemHelperRoute::getMyEventsRoute());
			return;
		}

		$model = $this->getModel('myevents');
		if (!$model->publish($cid, 0)) {
			echo "<script> alert('".$model->getError()."'); window.history.go(-1); </script>\n";
		}

		$total = count($cid);
		$msg   = $total.' '.Text::_('COM_JEM_EVENT_UNPUBLISHED');

		$this->setRedirect(JemHelperRoute::getMyEventsRoute(), $msg);
	}

	/**
	 * Logic to trash events
	 *
	 * @access public
	 * @return void
	 */
	public function trash()
	{
		// Check for request forgeries
		JSession::checkToken() or jexit('Invalid Token');

		$app = JFactory::getApplication();
		$input = $app->input;

		$cid = $input->get('cid', array(), 'array');

		if (empty($cid)) {
			\Joomla\CMS\Factory::getApplication()->enqueueMessage(Text::_('COM_JEM_SELECT_ITEM_TO_TRASH'), 'notice');
			$this->setRedirect(JemHelperRoute::getMyEventsRoute());
			return;
		}

		$model = $this->getModel('myevents');
		if (!$model->publish($cid, -2)) {
			echo "<script> alert('".$model->getError()."'); window.history.go(-1); </script>\n";
		}

		$total = count($cid);
		$msg   = $total.' '.Text::_('COM_JEM_EVENT_TRASHED');

		$this->setRedirect(JemHelperRoute::getMyEventsRoute(), $msg);
	}
}
?>
