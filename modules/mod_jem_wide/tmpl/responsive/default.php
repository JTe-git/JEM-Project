<?php
/**
 * @version 4.0.0
 * @package JEM
 * @subpackage JEM Wide Module
 * @copyright (C) 2013-2022 joomlaeventmanager.net
 * @copyright (C) 2005-2009 Christoph Lukes
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;

HTMLHelper::_('behavior.modal', 'a.flyermodal');

/*$module_name = 'mod_jem_wide';
$css_path = JPATH_THEMES. '/'.$document->template.'/css/'.$module_name;
if(file_exists($css_path.'/'.$module_name.'.css')) {
  unset($document->_styleSheets[JUri::base(true).'/modules/mod_jem_wide/tmpl/mod_jem_wide.css']);
  $document->addStylesheet(JURI::base(true) . '/templates/'.$document->template.'/css/'. $module_name.'/'.$module_name.'.css');
}*/

$jemsettings = JemHelper::config();

echo '<div class="jemmodulewide'.$params->get('moduleclass_sfx').'" id="jemmodulewide">';
if (count($list)) {
  if (JemHelper::jemStringContains($params->get('moduleclass_sfx'), 'jem-tablestyle')) {
    include('default_jem_eventslist_small.php'); // Similar to the old table-layout
  } else {
    include("default_jem_eventslist.php"); // The new layout
  }
} else {
	echo Text::_('MOD_JEM_WIDE_NO_EVENTS');
}
echo '</div>';

?>