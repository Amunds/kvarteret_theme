<?php
/**
 * Template Name: Events
 * The Template for displaying dak_event_wp events, festival and agenda
 *
 * @package WordPress
 * @subpackage kvarteret
 * @since Kvarteret 1.0
 */

$queryYear = null;
$queryMonth = null;

$dateComponents = explode('-', $dew_archive);

if (count($dateComponents) >= 2) {
	$queryYear = intval($dateComponents[0]);
	$queryMonth = intval($dateComponents[1]);
}

if (($queryMonth >= 1) && ($queryMonth <= 12)) {
	$config['start_date'] = sprintf('%04d-%02d-01', $queryYear, $queryMonth);
	$config['end_date'] = sprintf('%04d-%02d-', $queryYear, $queryMonth);

	$config['end_date'] .= date('t' , strtotime($config['start_date']));
}

add_filter('wp_title', 'dew_arrangement_template_wp_title', 5, 3);

$dew_title  = 'Events in ' . $month[sprintf('%02d', $queryMonth)] . ' ' . $queryYear;
$title = apply_filters('the_title', $dew_title);

get_header(); ?>

			<div id="content" role="main">
				<?php echo dew_agenda_menu_shortcode_handler() ?>
				<div id="left_content">
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if ( is_front_page() ): ?>
						<h2 class="entry-title"><?php echo $title ?></h2>
					<?php else: ?>
						<h1 class="entry-title"><?php echo $title ?></h1>
					<?php endif ?>

<!-- # agenda or ordinary page -->

						<div class="entry-content">

							<?php echo dew_agenda_shortcode_handler($config); ?>

						</div>

<!-- #end agenda or ordinary page -->

					</div>
				  </div>

				<div id="standard_right_menu" class="widget-area" role="complementary">
					<ul class="xoxo">
						<?php dynamic_sidebar( 'primary-widget-area' ) ?>
					</ul>
				</div>				
			</div><!-- #content -->
<?php get_footer(); ?>
