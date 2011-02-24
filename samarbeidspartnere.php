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
      <div class="entry-content">
      <!-- This loops through all the children of the samarbeidspartnere page. -->
      <?php query_posts(array('post_parent' => 15,  'order' => 'ASC', 'order_by' => 'menu_order', 'post_type' => 'page', 'post_status' => 'published', 'posts_per_page' => -1)); while (have_posts()) { the_post(); ?>
        <div class="samarbeids_container">
          <a id="<?php the_ID() ?>"></a>
          <h2><?php the_title(); ?></h2>
          <?php the_post_thumbnail('samarbeids-logo'); ?>
          <?php the_content(); ?>
        </div>
        <?php } ?>
  <!-- #content -->
    </div>
	</div><!-- #content -->
<?php get_footer(); ?>