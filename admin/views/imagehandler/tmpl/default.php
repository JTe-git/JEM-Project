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
?>
<form action="index.php" method="post" name="adminForm" id="adminForm">
	<div class="imghead">
		<?php echo Text::_('COM_JEM_SEARCH').' '; ?>
		<input type="text" name="filter_search" id="filter_search" value="<?php echo $this->search; ?>" class="text_area" onChange="document.adminForm.submit();" />
		<button class="buttonfilter" type="submit"><?php echo Text::_('JSEARCH_FILTER_SUBMIT'); ?></button>
		<button class="buttonfilter" type="button" onclick="document.id('filter_search').value='';this.form.submit();"><?php echo Text::_('JSEARCH_FILTER_CLEAR'); ?></button>
	</div>

	<div class="imglist">
		<?php
		$n = is_array($this->images) ? count($this->images) : 0;
		for ($i = 0; $i < $n; $i++) :
			$this->setImage($i);
			echo $this->loadTemplate('image');
		endfor;
		?>
	</div>

	<div class="clear"></div>

	<div class="pnav">
		<?php echo (method_exists($this->pagination, 'getPaginationLinks') ? $this->pagination->getPaginationLinks() : $this->pagination->getListFooter()); ?>
	</div>

	<?php echo HTMLHelper::_('form.token'); ?>
	<input type="hidden" name="option" value="com_jem" />
	<input type="hidden" name="view" value="imagehandler" />
	<input type="hidden" name="tmpl" value="component" />
	<input type="hidden" name="task" value="<?php echo $this->task; ?>" />
</form>
