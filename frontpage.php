<?php
/**
 * Template Name: Default Frontpage
 *
 * A custom page template for the frontpage.
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
	return 11;
}
add_filter('excerpt_length', 'custom_excerpt_length');
?>

<div id="container">
  <div id="content" role="main">
    <div id="left_content">
      <?php
        global $post;
        $current_news = get_posts('numberposts=10&category=4');
        foreach($current_news as $post) :
          setup_postdata($post);
      ?>
      <div class="current_news">
        <div class="current_news_image">
          <?php
          if ( has_post_thumbnail() ) {
          	the_post_thumbnail();
          } else {
          ?>
            <img src="<?php bloginfo('template_directory'); ?>/images/current_news_image_missing.png">
          <?php
          }
          ?>
        </div>
        
        <a href="<?php the_permalink(); ?>" class="current_news_title"><?php the_title(); ?></a>
        <span class="excerpt">
          <?php the_excerpt(); ?>
        </span>
      </div>
        <?php endforeach; ?>
    </div>
  </div><!-- #content -->
</div><!-- #container -->

<?php get_footer(); ?>
