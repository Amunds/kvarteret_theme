<?php
/**
 * Template Name: Events
 * The Template for displaying dak_event_wp events, festival and agenda
 *
 * @package WordPress
 * @subpackage kvarteret
 * @since Kvarteret 1.0
 */

//require_once('dew_template.php');

// if this is a full event, attach wp_title filter
$event_id = 0;
$event_id = (empty($_GET['event_id'])) ? $wp_query->get('event_id') : $_GET['event_id'];
$event_id = intval($event_id);

if ($event_id > 0) {
	$eventOptions = get_option('optionsDakEventsWp');
	$client = new eventsCalendarClient($eventOptions['eventServerUrl'], null, $eventOptions['cache'], $eventOptions['cacheTime']);

	$arr = $client->event($event_id);
	$rawEvent = $arr->data[0];

	add_filter('wp_title', 'dew_arrangement_template_wp_title', 5, 3);
}

if ($event_id > 0) {
	$dew_title = $rawEvent->title;
	$title = apply_filters('the_title', $dew_title);
} else {
	$title = the_title('', '', false);
}

get_header(); ?>

			<div id="content" role="main">
				<?php //echo dew_agenda_menu_shortcode_handler() ?>
				<div id="left_content">
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if ( is_front_page() ) { ?>
						<h2 class="entry-title"><?php echo $title; ?></h2>
					<?php } else { ?>
						<h1 class="entry-title"><?php echo $title; ?></h1>
					<?php } ?>

<?php if ( $event_id > 0 ): ?>
<!-- # event page -->

						<div class="entry-content">

						<?php echo dew_fullevent_shortcode_handler (array('event_id' => $event_id, 'no_title' => true, 'exclude_metadata' => true)) ?>

						</div>

<!-- # end event page -->
<?php endif ?>

					</div><!-- end #post-<?php echo the_ID() ?> -->
				</div><!-- end #left_content -->

				<div id="standard_right_menu" class="widget-area" role="complementary">
					<ul class="xoxo">
						<?php if ( !empty($rawEvent) ): ?>
						<li>
							<?php do_action('kvarteret_event_detailbox', $rawEvent) ?>
						</li>
						<?php endif ?>
						<?php // dynamic_sidebar( 'primary-widget-area' ) ?>
					</ul>
				</div>
			</div><!-- #content -->
<?php get_footer(); ?>
