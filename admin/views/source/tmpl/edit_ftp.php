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
<fieldset class="adminform" title="<?php echo Text::_('COM_JEM_CSSMANAGER_FTP_TITLE'); ?>">
	<legend><?php echo Text::_('COM_JEM_CSSMANAGER_FTP_TITLE'); ?></legend>

	<?php echo Text::_('COM_JEM_CSSMANAGER_FTP_DESC'); ?>

	<?php if ($this->ftp instanceof Exception): ?>
		<p class="error"><?php echo Text::_($this->ftp->message); ?></p>
	<?php endif; ?>

	<table class="adminform">
		<tbody>
			<tr>
				<td width="120">
					<label for="username"><?php echo Text::_('JGLOBAL_USERNAME'); ?></label>
				</td>
				<td>
					<input type="text" id="username" name="username" class="inputbox" size="70" value="" />
				</td>
			</tr>
			<tr>
				<td width="120">
					<label for="password"><?php echo Text::_('JGLOBAL_PASSWORD'); ?></label>
				</td>
				<td>
					<input type="password" id="password" name="password" class="inputbox" size="70" value="" />
				</td>
			</tr>
		</tbody>
	</table>
</fieldset>
