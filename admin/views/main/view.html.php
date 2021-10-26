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
use Joomla\CMS\Factory;

/**
 * View class for the JEM home screen
 *
 * @package JEM
 */
class JemViewMain extends JemAdminView
{

	public function display($tpl = null)
	{
		//Load pane behavior
		jimport('joomla.html.pane');

		//initialise variables
		$document = Factory::getDocument();
		$user     = JemFactory::getUser();

		// Get data from the model
		$events   = $this->get('EventsData');
		$venue    = $this->get('VenuesData');
		$category = $this->get('CategoriesData');

		// Load css
		HTMLHelper::_('stylesheet', 'com_jem/backend.css', array(), true);

		//assign vars to the template
		$this->events   = $events;
		$this->venue    = $venue;
		$this->category = $category;
		$this->user     = $user;

		// add toolbar
		$this->addToolbar();

		parent::display($tpl);
	}

	/**
	 * Add Toolbar
	 */
	protected function addToolbar()
	{
		JToolBarHelper::title(Text::_('COM_JEM_MAIN_TITLE'), 'home');

		if (JemFactory::getUser()->authorise('core.manage', 'com_jem')) {
			JToolBarHelper::preferences('com_jem');
			JToolbarHelper::divider();
		}

		JToolBarHelper::help('home', true);
	}

	/**
	 * Creates the buttons view
	 *
	 * @param  string  $link  targeturl
	 * @param  string  $image path to image
	 * @param  string  $text  image description
	 * @param  boolean $modal 1 for loading in modal
	 */
	protected function quickiconButton($link, $image, $text, $modal = 0)
	{
		// Initialise variables
		$lang = Factory::getLanguage();
		?>
		<div style="float:<?php echo ($lang->isRTL()) ? 'right' : 'left'; ?>;">
			<div class="icon">
				<?php if ($modal == 1) : ?>
					<?php HTMLHelper::_('behavior.modal'); ?>
					<a href="<?php echo $link.'&amp;tmpl=component'; ?>" style="cursor:pointer" class="modal"
							rel="{handler: 'iframe', size: {x: 650, y: 400}}">
						<?php echo HTMLHelper::_('image', 'com_jem/'.$image, $text, NULL, true); ?>
						<span><?php echo $text; ?></span>
					</a>
				<?php else : ?>
					<a href="<?php echo $link; ?>">
						<?php echo HTMLHelper::_('image', 'com_jem/'.$image, $text, NULL, true); ?>
						<span><?php echo $text; ?></span>
					</a>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}
}
?>
