<?php
/**
 * @version 4.0.0
 * @package JEM
 * @subpackage JEM Teaser Module
 * @copyright (C) 2013-2022 joomlaeventmanager.net
 * @copyright (C) 2005-2009 Christoph Lukes
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */
defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Factory;

if ($params->get('use_modal', 0)) {
	HTMLHelper::_('behavior.modal', 'a.flyermodal');
	$modal = 'flyermodal';
} else {
	$modal = 'notmodal';
}
/*
if (Factory::getApplication()->input->getInt('jem-rss','0') == 1) {		
  ob_get_clean();
  createRSSfeed($list);
  jexit(); 
}
*/

/*$module_name = 'mod_jem_teaser';
$css_path = JPATH_THEMES. '/'.$document->template.'/css/'.$module_name;
if(file_exists($css_path.'/'.$module_name.'.css')) {
  unset($document->_styleSheets[JUri::base(true).'/modules/mod_jem_teaser/tmpl/mod_jem_teaser.css']);
  $document->addStylesheet(JURI::base(true) . '/templates/'.$document->template.'/css/'. $module_name.'/'.$module_name.'.css');
}*/
?>

<style>
 <?php
 $imagewidth = 'inherit';
 if ($jemsettings->imagewidth != 0) {
  $imagewidth = $jemsettings->imagewidth / 2; 
  $imagewidth = $imagewidth.'px';
 }
 $imagewidthstring = 'jem-imagewidth';
 if (JemHelper::jemStringContains($params->get('moduleclass_sfx'), $imagewidthstring)) {
   $pageclass_sfx = $params->get('moduleclass_sfx');
   $imagewidthpos = strpos($pageclass_sfx, $imagewidthstring);
   $spacepos = strpos($pageclass_sfx, ' ', $imagewidthpos);
   if ($spacepos === false) {
     $spacepos = strlen($pageclass_sfx);
   }
   $startpos = $imagewidthpos + strlen($imagewidthstring);
   $endpos = $spacepos - $startpos;
   $imagewidth = substr($pageclass_sfx, $startpos, $endpos);
 }
 $imageheight = 'auto';
 $imageheigthstring = 'jem-imageheight';
 if (JemHelper::jemStringContains($params->get('moduleclass_sfx'), $imageheigthstring)) {
   $pageclass_sfx = $params->get('moduleclass_sfx');
   $imageheightpos = strpos($pageclass_sfx, $imageheigthstring);
   $spacepos = strpos($pageclass_sfx, ' ', $imageheightpos);
   if ($spacepos === false) {
     $spacepos = strlen($pageclass_sfx);
   }
   $startpos = $imageheightpos + strlen($imageheigthstring);
   $endpos = $spacepos - $startpos;
   $imageheight = substr($pageclass_sfx, $startpos, $endpos);
 }
 ?>

  #jemmoduleteaser .jem-eventimg-teaser {
    width: <?php echo $imagewidth; ?>;
  }
  
  #jemmoduleteaser .jem-eventimg-teaser img {
    width: <?php echo $imagewidth; ?>;
    height: <?php echo $imageheight; ?>;
  }
  
  @media not print {
    @media only all and (max-width: 47.938rem) {  
      #jemmoduleteaser .jem-eventimg-teaser {
        
      }
      
      #jemmoduleteaser .jem-eventimg-teaser img {
        width: <?php echo $imagewidth; ?>;
        height: <?php echo $imageheight; ?>;
      }
    }
  }
</style>

<div class="jemmoduleteaser<?php echo $params->get('moduleclass_sfx')?>" id="jemmoduleteaser">
<?php ?>
	<div class="eventset">
	<?php if (count($list)) : ?>
    <?php
      $titletag = '<h2 class="event-title">';
      $titleendtag = '</h2>';
      if ($module->showtitle) {
        $titletag = '<h3 class="event-title">';
        $titleendtag = '</h3>';
      } 
    ?>
    <?php foreach ($list as $item) : ?>
      
      <?php echo $titletag; ?>
        <?php if ($item->eventlink) : ?>
          <a href="<?php echo $item->eventlink; ?>" title="<?php echo $item->fulltitle; ?>"><?php echo $item->title; ?></a>
        <?php else : ?>
          <?php echo $item->title; ?>
        <?php endif; ?>
      <?php echo $titleendtag; ?>
      
      <div class="jem-row-teaser jem-teaser-event">
        <div class="calendar<?php echo '-'.$item->colorclass; ?> jem-teaser-calendar"
             title="<?php echo strip_tags($item->dateinfo); ?>"
          <?php if (!empty($item->color)) : ?>
             style="background-color: <?php echo $item->color; ?>"
          <?php endif; ?>
        >
          <div class="monthteaser">
            <?php echo $item->month; ?>
          </div>
          <div class="dayteaser">
            <?php echo empty($item->dayname) ? '<br/>' : $item->dayname; ?>
          </div>
          <div class="daynumteaser">
            <?php echo empty($item->daynum) ? '?' : $item->daynum; ?>
          </div>
        </div>
        <div class="jem-event-details-teaser">
          <div class="jem-row-teaser jem-teaser-datecat">
            <?php if ($item->date && $params->get('datemethod', 1) == 2) :?>
              <div class="date" title="<?php echo Text::_('COM_JEM_TABLE_DATE').': '.strip_tags($item->dateinfo); ?>">
                <i class="fa fa-clock-o" aria-hidden="true"></i>
                <?php echo $item->date; ?>
              </div>
            <?php //endif; ?>
            <?php elseif ($item->date && $params->get('datemethod', 1) == 1) : ?>
              <div class="time" title="<?php echo Text::_('COM_JEM_TABLE_DATE').': '.strip_tags($item->dateinfo); ?>">
                <i class="fa fa-clock-o" aria-hidden="true"></i>
                <?php echo $item->dateinfo; ?>
              </div>
            <?php //endif; ?>
            <?php /* elseif ($item->time && $params->get('datemethod', 1) == 1) :?>
              <div class="time" title="<?php echo strip_tags($item->dateinfo); ?>">
                <i class="fa fa-clock-o" aria-hidden="true"></i>
                <?php echo $item->time; ?>
              </div>
            <?php */endif; ?>
            <?php if (!empty($item->venue)) : ?>
              <?php if (!JemHelper::jemStringContains($params->get('moduleclass_sfx'), 'jem-novenue')) : ?>
                <div class="venue-title" title="<?php echo Text::_('COM_JEM_TABLE_LOCATION').': '.strip_tags($item->venue); ?>">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <?php if ($item->venuelink) : ?>
                  <a href="<?php echo $item->venuelink; ?>"><?php echo $item->venue; ?></a>
                <?php else : ?>
                  <?php echo $item->venue; ?>
                <?php endif; ?>
                </div>
              <?php endif; ?>
            <?php endif; ?>
            <?php if (!JemHelper::jemStringContains($params->get('moduleclass_sfx'), 'jem-nocats')) : ?>
              <div class="category" title="<?php echo Text::_('COM_JEM_TABLE_CATEGORY').': '.strip_tags($item->catname); ?>">
                <i class="fa fa-tag" aria-hidden="true"></i>
                <?php echo $item->catname; ?>
              </div>
            <?php endif; ?>
          </div>
          <div class="jem-description-teaser">
            <?php //uncomment this construct to disable the eventimage ?>
            <?php if(strpos($item->eventimage,'/media/system/images/blank.png') === false) : ?>
              <?php if (!JemHelper::jemStringContains($params->get('moduleclass_sfx'), 'jem-noimageevent')) : ?>
                <?php if(!empty($item->eventimage)) : ?>
                  <a href="<?php echo $item->eventimageorig; ?>" class="jem-eventimg-teaser <?php echo $modal;?>" title="<?php echo $item->fulltitle; ?> ">
                    <img class="float_right image-preview" src="<?php echo $item->eventimage; ?>" alt="<?php echo $item->title; ?>" />
                  </a>
                <?php endif; ?>
              <?php endif; ?>
            <?php endif; ?>
            
            <?php echo $item->eventdescription; ?>
            <?php if (isset($item->link) && $item->readmore != 0 && $params->get('readmore')) :
              echo '<a class="readmore" href="'.$item->link.'">'.$item->linkText.'</a>';
              endif;
            ?>          
          </div> 
          <?php if ($item->eventlink) : ?>
          <div class="jem-readmore">
            <a href="<?php echo $item->eventlink ?>" title="<?php echo Text::_('COM_JEM_EVENT_READ_MORE_TITLE'); ?>">
              <!--<button class="jem-btn btn">-->
              <?php echo Text::_('COM_JEM_EVENT_READ_MORE_TITLE'); ?>
              <!--</button>-->
            </a>
          </div>
          <?php endif; ?>
        </div>
      </div>
      <?php 
      if ($item !== end($list)) :
          echo '<hr class="jem-hr">';
      endif;
      ?>
    <?php endforeach; ?>
	<?php else : ?>
		<?php echo Text::_('MOD_JEM_TEASER_NO_EVENTS'); ?>
	<?php endif; ?>
	</div>
</div>

<script>
  function parseColor(input) {
    return input.split("(")[1].split(")")[0].split(",");
  }
  
  function calculateBrightness(rgb) {
    var o = Math.round(((parseInt(rgb[0]) * 299) + (parseInt(rgb[1]) * 587) + (parseInt(rgb[2]) * 114)) /1000);    
    return o;
  }
  
  var calendars = document.getElementsByClassName('calendar-category');
  if (calendars != undefined) {
    var o = 0;
    var monthteaser = null;
    for (var i = 0; i < calendars.length; i++) {
      o = calculateBrightness(parseColor(calendars[i].style.backgroundColor));
      monthteaser = null;
      for (var j = 0; j < calendars[i].childNodes.length; j++) {
          if (calendars[i].childNodes[j].className == "monthteaser") {
            monthteaser = calendars[i].childNodes[j];
            break;
          }        
      }
      if (monthteaser != null) {
        if (o > 125) {
            monthteaser.style.color = 'rgb(0, 0, 0)';
        } else { 
            monthteaser.style.color = 'rgb(255, 255, 255)';
        }        
      }
    }
  }
</script>
<?php /*
function createRSSfeed($list) {
header("Content-Type: application/rss+xml; charset=UTF-8");
$baseurl = JURI::base();
if(substr($baseurl, -1) == '/') {
    $baseurl = substr($baseurl, 0, -1);
}
echo '<?xml version="1.0" encoding="UTF-8" ?>';
echo '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">';
echo '<channel>';
  $doc = Factory::getDocument(); 
  $page_title = $doc->getTitle();
  echo '<title>'.$page_title.'</title>';
  echo '<link>'.JURI::current().'</link>';
  echo '<atom:link href="'.JURI::getInstance()->toString().'" rel="self" type="application/rss+xml" />';
  echo '<description>JEM teasered Events</description>';
  foreach ($list as $item) :
    echo '<item>';
      echo '<title>'.$item->fulltitle.'</title>';
      echo '<link>'.$baseurl.$item->eventlink.'</link>';
      echo '<guid>'.$baseurl.$item->eventlink.'</guid>';
      echo '<description><![CDATA[';
      echo '<div id="date">'.strip_tags($item->dateinfo).'</div>';
      echo '<div id="image">'.$baseurl.$item->eventimage.'</div>';
      echo '<div id="desc">'.$item->eventdescription.'</div>';
      echo ']]></description>';
    echo '</item>';
  endforeach;
echo '</channel>';
echo '</rss>';
}
*/ ?>