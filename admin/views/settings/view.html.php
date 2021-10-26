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
 * View class for the JEM Settings screen
 *
 * @package JEM
 */
class JemViewSettings extends JemAdminView
{
	protected $form;
	protected $data;
	protected $state;

	public function display($tpl = null)
	{
		$app         = JFactory::getApplication();
		$document    = JFactory::getDocument();
		$form        = $this->get('Form');
		$data        = $this->get('Data');
		$state       = $this->get('State');
		$config      = $this->get('ConfigInfo');
		$jemsettings = $this->get('Data');

		// Load css
		HTMLHelper::_('stylesheet', 'com_jem/backend.css', array(), true);
		HTMLHelper::_('stylesheet', 'com_jem/colorpicker.css', array(), true);

		$style = '
		    div.current fieldset.radio input {
		        cursor: pointer;
		    }';
		$document->addStyleDeclaration($style);

		// Check for model errors.
		if ($errors = $this->get('Errors')) {
			\Joomla\CMS\Factory::getApplication()->enqueueMessage(implode('<br />', $errors), 'error');
			return false;
		}

		// Bind the form to the data.
		if ($form && $data) {
			$form->bind($data);
		}

		// Check for errors.
		$errors = $this->get('Errors');
		if (is_array($errors) && count($errors)) {
			\Joomla\CMS\Factory::getApplication()->enqueueMessage(implode("\n", $errors), 'error');
			return false;
		}

		// Load Script
		$document->addScript(JUri::root().'media/com_jem/js/colorpicker.js');

		HTMLHelper::_('behavior.modal', 'a.modal');
		HTMLHelper::_('behavior.tooltip');
		HTMLHelper::_('behavior.formvalidation');
		HTMLHelper::_('behavior.framework');

		// only admins have access to this view
		if (!JemFactory::getUser()->authorise('core.manage', 'com_jem')) {
			\Joomla\CMS\Factory::getApplication()->enqueueMessage(Text::_('JERROR_ALERTNOAUTHOR'), 'warning');
			$app->redirect('index.php?option=com_jem&view=main');
		}

		// mapping variables
		$this->form        = $form;
		$this->data        = $data;
		$this->state       = $state;
		$this->jemsettings = $jemsettings;
		$this->config      = $config;

		// add toolbar
		$this->addToolbar();

		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since  1.6
	 */
	protected function addToolbar()
	{
		JToolBarHelper::title(Text::_('COM_JEM_SETTINGS_TITLE'), 'settings');
		JToolBarHelper::apply('settings.apply');
		JToolBarHelper::save('settings.save');
		JToolBarHelper::cancel('settings.cancel');

		JToolBarHelper::divider();
		JToolBarHelper::help('settings', true);
	}

	protected function WarningIcon()
	{
		$url = JUri::root();
		$tip = '<img src="'.$url.'media/system/images/tooltip.png" border="0"  alt="" />';

		return $tip;
	}
}
