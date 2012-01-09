<?php
/**
 * Template Name: Neste helhus
 * Neste helhus
 *
 * @package WordPress
 * @subpackage kvarteret
 * @since Kvarteret 1.0
 */

//require_once('dew_template.php');

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

	$dew_options = DEW_Management::getOptions();
	$client = new eventsCalendarClient ($dew_options['eventServerUrl'], null, $dew_options['cache'], $dew_options['cacheTime']);

$festivalSearch = $client->festivalList(array('titleContains' => 'helhus', 'limit' => 1));

if (!empty($festivalSearch->data[0]->id)) {
	$wp_query->set('festival_id', $festivalSearch->data[0]->id);
	include(TEMPLATEPATH . '/eventTemplates/festival.php');
}
