<?php
/**
 * Template Name: Custom page for Sommerkvarteret
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
	return 20;
}
add_filter('excerpt_length', 'custom_excerpt_length');
?>

  <div id="content" role="main">
    <div id="left_content">
      <?php
        global $post;
        $current_news = get_posts('numberposts=10&category_name=sk');
        ?>
        <?php
        foreach($current_news as $post) :
          setup_postdata($post);
        ?>
      <div class="current_news">
        <div class="current_news_image">
          <?php
          if ( has_post_thumbnail() ) {
            ?>
            <a href="<?php the_permalink(); ?>">
            	<?php the_post_thumbnail( 'current-news-thumbnail' ); ?>
            </a>
            <?php
          } else {
          ?>
          <a href="<?php the_permalink(); ?>">
            <img src="<?php bloginfo('template_directory'); ?>/images/current_news_image_missing_<?php echo rand(1,2) ?>.png">
          </a>
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
     

    <div id="standard_right_menu" class="widget-area" role="complementary">
      <ul class="xoxo">
        <li>
          <img alt="sommerkvarteret_logo" src="<?php bloginfo('template_directory'); ?>/images/sommerkvarteret_logo.png" style="max-width: 100%;"/>
        </li>
        <?php dynamic_sidebar( 'sommerkvarteret-widget-area' );  ?>
      </ul>
    </div><!-- #sommerkvarteret .widget-area -->

  </div><!-- #content -->

<?php get_footer(); ?>
