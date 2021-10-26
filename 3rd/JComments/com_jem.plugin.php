<?php
/**
 * JComments plugin for JEM
 * 
 * @version 4.0.0
 * @package JEM
 * @copyright (C) 2013-2022 joomlaeventmanager.net
 * 
 * @author Sergey M. Litvinov (smart@joomlatune.ru)
 * @copyright (C) 2006-2013 by Sergey M. Litvinov (http://www.joomlatune.ru)
 * @license GNU/GPL: http://www.gnu.org/copyleft/gpl.html
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;

class jc_com_jem extends JCommentsPlugin
{
	function getObjectTitle($id)
	{
		$db = Factory::getDbo();
		$db->setQuery( 'SELECT title, id FROM #__jem_events WHERE id = ' . $id );
		return $db->loadResult();
	}

	function getObjectLink($id)
	{
		$db = Factory::getDBO();

		$query = 'SELECT a.id, CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(\':\', a.id, a.alias) ELSE a.id END as slug'
			. ' FROM #__jem_events AS a'
			. ' WHERE id = ' . $id
			;
		$db->setQuery($query);
		$slug = $db->loadResult();

		$JEMRouter = JPATH_SITE.'/components/com_jem/helpers/route.php';
		if (is_file($JEMRouter)) {
			require_once($JEMRouter);
			$link = JRoute::_(JemHelperRoute::getEventRoute($slug));
		} else {
			$link = JRoute::_( 'index.php?option=com_jem&view=event&id=' . $slug );
		}

		return $link;
	}

	function getObjectOwner($id) {

		$db = Factory::getDbo();
		$db->setQuery( 'SELECT created_by, id FROM #__jem_events WHERE id = ' . $id );
		$userid = $db->loadResult();

		return $userid;
	}
}
