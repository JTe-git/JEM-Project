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
		<legend><?php echo Text::_( 'COM_JEM_EVENT_HANDLING' ); ?></legend>
		<ul class="adminformlist">
			<li><?php echo $this->form->getLabel('oldevent'); ?> <?php echo $this->form->getInput('oldevent'); ?></li>
			<li id="evhandler1"><?php echo $this->form->getLabel('minus'); ?> <?php echo $this->form->getInput('minus'); ?></li>
		</ul>
	</fieldset>
</div>
