<?php
/**
 * Template Name: Events
 * The Template for displaying dak_event_wp events, festival and agenda
 *
 * @package WordPress
 * @subpackage kvarteret
 * @since Kvarteret 1.0
 */

// if this is a full event, attach wp_title filter
$event_id = 0;
$festival_id = 0;
if (!empty($_GET['event_id']) || $wp_query->get('event_id')) {
	$event_id = (empty($_GET['event_id'])) ? $wp_query->get('event_id') : $_GET['event_id'];
	$event_id = intval($event_id);
}

if (!empty($_GET['festival_id']) || $wp_query->get('festival_id')) {
	$festival_id = (empty($_GET['festival_id'])) ? $wp_query->get('festival_id') : $_GET['festival_id'];
	$festival_id = intval($festival_id);
}

if ( ! in_array('dak_events_wp/dak_events_wp.php', get_option('active_plugins')) ) {
	// Don't do anything if the dak_events_wp isn't activated
	get_header(); ?>
<div id="content" class="narrowcolumn">
	<h2 class="center">The plugin <dd>dak_events_wp</dd> <em>must</em> be activated before you can use this template</h2>
</div>
<?php
	get_sidebar();
	get_footer();

	exit();
}

if (($event_id > 0) || ($festival_id > 0)) {
	$eventOptions = get_option('optionsDakEventsWp');
	$client = new eventsCalendarClient($eventOptions['eventServerUrl'], null, $eventOptions['cache'], $eventOptions['cacheTime']);

	if ($event_id > 0) {
		$arr = $client->event($event_id);
	} else if ($festival_id > 0) {
		$arr = $client->festival($festival_id);
	}

	/**
	 * Ouput event or festival title in header, overrides the page's title
	 */
	function dew_arrangement_template_wp_title ($title, $sep, $seplocation) {
		global $arr;

		$title = $arr->data[0]->title;

		$t_sep = '%WP_TITILE_SEP%'; // Temporary separator, for accurate flipping, if necessary

		$prefix = '';
		if ( !empty($title) ) {
			$prefix = " $sep ";
		}

	 	// Determines position of the separator and direction of the breadcrumb
		if ( 'right' == $seplocation ) { // sep on right, so reverse the order
			$title_array = explode( $t_sep, $title );
			$title_array = array_reverse( $title_array );
			$title = implode( " $sep ", $title_array ) . $prefix;
		} else {
			$title_array = explode( $t_sep, $title );
			$title = $prefix . implode( " $sep ", $title_array );
		}

		return $title;
	}

	add_filter('wp_title', 'dew_arrangement_template_wp_title', 5, 3);
}

if (($event_id > 0) || ($festival_id > 0)) {
	$title = apply_filters('the_title', $arr->data[0]->title);
} else {
	$title = the_title('', '', false);
}

get_header(); ?>

<div id="content">
<?php 
/** 
* Templates for the different areas of the Event pages
*/
// Fullview/agenda listing
function dew_template_agenda_event() {
	return '
		<li class="agenda_compact_event_wrapper">
			<a href="%(readMore)s">%(title)s</a><br />
			<span class="agenda_compact_event_details">%(startTime)s - %(category)s - %(location)s %(festivalLink)s</span>
		</li>
	';
}
function dew_template_agenda_eventcollection() {
	return '
		<li class="agenda_day clearfix">
			<h2 class="agenda_box">
				<span class="agenda_day_name">%(dayName)s</span>
				<span class="agenda_day_number">%(dayNumber)s</span>
				<span class="agenda_month_name">%(monthName)s</span>
			</h2>
			<ul class="event_date_list">
				%(eventCollection)s
			</ul>
		</li>
	';
}

// Event Fullview/Single event
function dew_template_single_event() {
	return '
		<h1 class="entry-title">Arrangement: %(title)s</h1>
		<div id="left_content">
			<div class="ingress">%(leadParagraph)s</div>
			<div class="full">%(description)s</div>
		</div>
		<div id="standard_right_menu" class="widget-area">
			%(festivalLink)s
			%(arranger)s-logo<br />
			
			%(category)s i %(location)s <br />
			Dato: %(renderedDate)s <br />
			Arrangør: %(arranger)s<br />
			%(extra)s
			
			<h2>Kalender</h2>
			<a href="%(iCalUrl)s">Legg til i kalender (iCal)</a><br />
			<a href="%(googleCalUrl)s">Legg til i Google Calendar</a>
		</div>
	';
}

//festival
function dew_template_festival() {
	return '
		<h1 class="entry-title">Festival: %(title)s</h1>
		<div id="left_content">
			<ul>
				%(festivalEvents)s
			</ul>
		</div>
		<div id="standard_right_menu" class="widget-area">
			Sted: %(location)s <br />
			Dato: %(renderedDate)s <br />
			Arrangør: %(arranger)s<br />
			%(extra)s
			
			<h2>Kalender</h2>
			<a href="%(iCalUrl)s">Legg til i kalender (iCal)</a><br />
			<a href="%(googleCalUrl)s">Legg til i Google Calendar</a>
			
		</div>
	';
}

// if(isset($dew_archive));
if($event_id > 0) {
	echo dew_fullevent_shortcode_handler($atts = array('event_id'=>$event_id,'template'=>dew_template_single_event()));
}
elseif($festival_id > 0) {
	echo dew_fullfestival_shortcode_handler($atts = array('festival_id'=>$festival_id,'template'=>dew_template_festival(), 'agendaTemplate'=>array('eventTemplate'=>dew_template_agenda_event())));//'agendaTemplate'=>array('eventTemplate' =>dew_template_agenda_event(), 'eventDateCollectionTemplate' => dew_template_agenda_eventcollection())));
}
elseif(isset($dew_archive)) {
	echo 
	$dew_archive .
	'<h1 class="entry-title">' . $title . '</h1>' .
	dew_agenda_menu_shortcode_handler() .
	'<div id="left_content" style="clear:left">' . 
	'<ul>' .
	dew_agenda_shortcode_handler ($atts = array('start_date' => $dew_archive . '-01','end_date' => $dew_archive . '-31','dayspan'=>14,'exclude_menu'=>1, 'exclude_meta'=>1, 'eventTemplate' =>dew_template_agenda_event(), 'eventDateCollectionTemplate' => dew_template_agenda_eventcollection())) . 
	'</ul>' .
	'</div>';
}
else {
	echo 
	'<h1 class="entry-title">' . $title . '</h1>' .
	dew_agenda_menu_shortcode_handler() .
	'<div id="left_content" style="clear:left">' . 
	'<ul>' .
	dew_agenda_shortcode_handler ($atts = array('dayspan'=>14,'exclude_menu'=>1, 'exclude_meta'=>1, 'eventTemplate' =>dew_template_agenda_event(), 'eventDateCollectionTemplate' => dew_template_agenda_eventcollection())) . 
	'</ul>' .
	'</div>';
}
	/*dew_fullevent_shortcode_handler();
dew_fullfestival_shortcode_handler();
'template' => 'blabla'
	 *       'agendaTemplate' => array(
	 *           'eventTemplate' => 'some template' or function name,
	 *           'eventDateCollectionTemplate' => 'some template' or function name,
	 *       ),*/
?>
</div>

<?php get_footer(); ?>