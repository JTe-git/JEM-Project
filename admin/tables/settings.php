<?php
/**
 * @version 4.0.0
 * @package JEM
 * @copyright (C) 2013-2022 joomlaeventmanager.net
 * @copyright (C) 2005-2009 Christoph Lukes
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

defined('_JEXEC') or die;

use Joomla\Registry\Registry;

/**
 * JEM Settings Table
 *
 * @deprecated since version 2.1.6
 */
class JemTableSettings extends JTable
{
	public function __construct(&$db)
	{
		parent::__construct('#__jem_settings', 'id', $db);
	}

	/**
	 * Validators
	 * @deprecated since version 2.1.6
	 */
	public function check()
	{
		return true;
	}

	/**
	 * Overloaded the store method
	 * @deprecated since version 2.1.6
	 */
	public function store($updateNulls = false)
	{
		return parent::store($updateNulls);
	}

	/**
	 * @deprecated since version 2.1.6
	 */
	public function bind($array, $ignore = '')
	{
		if (isset($array['globalattribs']) && is_array($array['globalattribs']))
		{
			$registry = new Registry;
			$registry->loadArray($array['globalattribs']);
			$array['globalattribs'] = (string) $registry;
		}

		if (isset($array['css']) && is_array($array['css']))
		{
			$registrycss = new Registry;
			$registrycss->loadArray($array['css']);
			$array['css'] = (string) $registrycss;
		}

		//don't override without calling base class
		return parent::bind($array, $ignore);
	}
}
?>
