<?php
/**
 * Template Name: Master template for events
 * The Template for displaying dak_event_wp events, festival and agenda
 *
 * @package WordPress
 * @subpackage kvarteret
 * @since Kvarteret 1.0
 */

require_once('dew_template.php');

// if this is a full event, attach wp_title filter
$event_id = 0;
$festival_id = 0;
$dew_archive = '';

if (!empty($_GET['event_id']) || $wp_query->get('event_id')) {
	$event_id = (empty($_GET['event_id'])) ? $wp_query->get('event_id') : $_GET['event_id'];
	$event_id = intval($event_id);
}

if (!empty($_GET['festival_id']) || $wp_query->get('festival_id')) {
	$festival_id = (empty($_GET['festival_id'])) ? $wp_query->get('festival_id') : $_GET['festival_id'];
	$festival_id = intval($festival_id);
}

if (!empty($_GET['dew_archive']) || $wp_query->get('dew_archive')) {
	$dew_archive = (empty($_GET['dew_archive'])) ? $wp_query->get('dew_archive') : $_GET['dew_archive'];
	$dew_archive = strval($dew_archive);
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

if ($event_id > 0) {
	include(TEMPLATEPATH . '/eventTemplates/single.php');
} else if ($festival_id > 0) {
	include(TEMPLATEPATH . '/eventTemplates/festival.php');
} else if ( $dew_archive == 'list' ) {
	include(TEMPLATEPATH . '/eventTemplates/archive-list.php');
} else if ( !empty($dew_archive) ) {
	include(TEMPLATEPATH . '/eventTemplates/archive-month.php');
} else {
	include(TEMPLATEPATH . '/eventTemplates/upcoming.php');
}
