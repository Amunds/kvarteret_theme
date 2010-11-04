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
	return 20;
}
add_filter('excerpt_length', 'custom_excerpt_length');
?>

  <div id="content" role="main">
    <div id="left_content">
      <?php
        global $post;
        $featured = get_posts('numberposts=5&category=5');
        $current_news = get_posts('numberposts=10&category=4');
        ?>
        <div id="featured_holder">
          <ul>
          <?php
          foreach($featured as $post) :
            setup_postdata($post);
          ?>          
          <li>  
        <div class="featured_news">
          <div class="featured_image">
            <?php
            if ( has_post_thumbnail() ) {
            ?>
            <a href="<?php the_permalink(); ?>">
            	<?php the_post_thumbnail( 'featured-thumbnail' ); ?>
            </a>
            <?php
            } else {
            ?>
              <a href="<?php the_permalink(); ?>">
                <img src="<?php bloginfo('template_directory'); ?>/images/featured_image_missing.png">
              </a>
            <?php
            }
            ?>
          </div>

          <a href="<?php the_permalink(); ?>" class="featured_title"><?php the_title(); ?></a>
          <span class="excerpt">
            <?php the_excerpt(); ?>
          </span>
        </div>
          </li>
          <?php endforeach; ?>
          </ul>
        </div>
        
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
            <img src="<?php bloginfo('template_directory'); ?>/images/current_news_image_missing.png">
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
      <?php get_sidebar(); ?>
  </div><!-- #content -->

<?php get_footer(); ?>
