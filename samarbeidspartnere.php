<?php
/**
 * Template Name: samarbeidspartnere
 *
 * A custom page template for the room page
 *
 *
 * @package WordPress
 * @subpackage kvarteret
 * @since Kvarteret 1.0
 */

get_header(); ?>
	<?php get_sidebar(); ?>
  <div id="content" role="main">
      <h1 class="entry-title"><?php the_title(); ?></h1>
      [<?php query_posts(array('post_parent' => 15, 'post_type' => 'page', 'post_status' => 'published', 'posts_per_page' => -1)); while (have_posts()) { the_post(); ?>
        <a class="kultur_link" href="#<?php the_ID()?>"><?php the_title(); ?></a>
        <?php } ?>]
      <!-- This loops through all the children of the samarbeidspartnere page. -->
      <?php query_posts(array('post_parent' => 15, 'post_type' => 'page', 'post_status' => 'published', 'posts_per_page' => -1)); while (have_posts()) { the_post(); ?>
        <div class="room_container">
          <a name="<?php the_ID() ?>" />
          <h2><?php the_title(); ?></h2>
          <?php the_post_thumbnail('samarbeids-logo'); ?>
          <?php the_content(); ?>
        </div>
        <?php } ?>
  <!-- #content -->
	</div><!-- #content -->
<?php get_footer(); ?>