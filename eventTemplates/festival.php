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
$festival_id = 0;
$festival_id = (empty($_GET['festival_id'])) ? $wp_query->get('festival_id') : $_GET['festival_id'];
$festival_id = intval($festival_id);

if ($festival_id > 0) {
	$eventOptions = get_option('optionsDakEventsWp');
	$client = new eventsCalendarClient($eventOptions['eventServerUrl'], null, $eventOptions['cache'], $eventOptions['cacheTime']);

	$arr = $client->festival($festival_id);
	$rawFestival = $arr->data[0];

	add_filter('wp_title', 'dew_arrangement_template_wp_title', 5, 3);
}

if ($festival_id > 0) {
	$dew_title = $rawFestival->title;
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

<?php if ( $festival_id > 0 ): ?>
<!-- # event page -->

						<div class="entry-content">

						<?php echo dew_fullfestival_shortcode_handler (array('festival_id' => $festival_id, 'no_title' => true, 'exclude_metadata' => true)) ?>

						</div>

<!-- # end event page -->
<?php endif ?>

					</div><!-- end #post-<?php echo the_ID() ?> -->
				</div><!-- end #left_content -->

				<div id="standard_right_menu" class="widget-area" role="complementary">
					<ul class="xoxo">
						<?php if ( !empty($rawFestival) ): ?>
						<li>
							<?php do_action('kvarteret_festival_detailbox', $rawFestival) ?>
						</li>
						<?php endif ?>
						<?php // dynamic_sidebar( 'primary-widget-area' ) ?>
					</ul>
				</div>
			</div><!-- #content -->
<?php get_footer(); ?>
