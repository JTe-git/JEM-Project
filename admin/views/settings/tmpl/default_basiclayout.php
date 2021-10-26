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
?>
<div class="width-100">
	<fieldset class="adminform">
		<legend><?php echo Text::_( 'COM_JEM_LAYOUT_STYLE_SETTINGS' ); ?></legend>
		<ul class="adminformlist">
			<li><?php echo $this->form->getLabel('layoutstyle'); ?> <?php echo $this->form->getInput('layoutstyle'); ?></li>
			<li><?php echo $this->form->getLabel('useiconfont'); ?> <?php echo $this->form->getInput('useiconfont'); ?></li>
		</ul>
	</fieldset>
</div>
