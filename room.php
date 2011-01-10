<?php
/**
 * Template Name: Room
 *
 * A custom page template for the room page
 *
 *
 * @package WordPress
 * @subpackage kvarteret
 * @since Kvarteret 1.0
 */

get_header(); ?>
<?php
// Add custom excerpt length
function custom_excerpt_length($length) {
	return 20;
}
add_filter('excerpt_length', 'custom_excerpt_length');
?>
	<?php get_sidebar(); ?>
  <div id="content" role="main" class="room_content">
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <!-- This loops through all the children of the Rom page. -->
      <?php query_posts(array('post_parent' => 11, 'post_type' => 'page', 'post_status' => 'published', 'posts_per_page' => -1)); while (have_posts()) { the_post(); ?>
        <div class="room_container">
          <h2><?php the_title(); ?></h2>
          <?php the_post_thumbnail('room-thumbnail'); ?>

          <?php the_content(); ?>
          
        </div>
        <?php } ?>
  <!-- #content -->
	</div><!-- #content -->
<?php get_footer(); ?>