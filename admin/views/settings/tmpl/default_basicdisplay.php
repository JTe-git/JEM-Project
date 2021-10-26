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
		<legend><?php echo Text::_( 'COM_JEM_DISPLAY_SETTINGS' ); ?></legend>
		<ul class="adminformlist">
			<li><?php echo $this->form->getLabel('showdetails'); ?> <?php echo $this->form->getInput('showdetails'); ?></li>

			<li><?php echo $this->form->getLabel('formatShortDate'); ?> <?php echo $this->form->getInput('formatShortDate'); ?>
				<span <?php echo JEMOutput::tooltip(Text::_('COM_JEM_PHP_DATE_MANUAL'), Text::_('COM_JEM_PHP_DATE_MANUAL_DESC'), 'error'); ?>>
					<a href="http://php.net/manual/en/function.date.php" target="_blank"><?php echo $this->WarningIcon(); ?></a>
				</span>
			</li>

			<li><?php echo $this->form->getLabel('formatdate'); ?> <?php echo $this->form->getInput('formatdate'); ?>
				<span <?php echo JEMOutput::tooltip(Text::_('COM_JEM_PHP_DATE_MANUAL'), Text::_('COM_JEM_PHP_DATE_MANUAL_DESC'), 'error'); ?>>
					<a href="http://php.net/manual/en/function.date.php" target="_blank"><?php echo $this->WarningIcon(); ?></a>
				</span>
			</li>

			<li><?php echo $this->form->getLabel('formattime'); ?> <?php echo $this->form->getInput('formattime'); ?>
				<span <?php echo JEMOutput::tooltip(Text::_('COM_JEM_PHP_STRFTIME_MANUAL'), Text::_('COM_JEM_PHP_STRFTIME_MANUAL_DESC'), 'error'); ?>>
					<a href="http://www.php.net/strftime" target="_blank"><?php echo $this->WarningIcon(); ?></a>
				</span>
			</li>

			<li><?php echo $this->form->getLabel('timename'); ?> <?php echo $this->form->getInput('timename'); ?></li>

			<li><?php echo $this->form->getLabel('formathour'); ?> <?php echo $this->form->getInput('formathour'); ?>
				<span <?php echo JEMOutput::tooltip(Text::_('COM_JEM_PHP_STRFTIME_MANUAL'), Text::_('COM_JEM_PHP_STRFTIME_MANUAL_DESC'), 'error'); ?>>
					<a href="http://www.php.net/strftime" target="_blank"><?php echo $this->WarningIcon(); ?></a>
				</span>
			</li>

			<li><?php echo $this->form->getLabel('storeip'); ?> <?php echo $this->form->getInput('storeip'); ?></li>
		</ul>
	</fieldset>
</div>
