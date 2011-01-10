<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage kvarteret
 * @since Kvarteret 1.0
 */

get_header(); ?>
			<div id="content" role="main">
        <div id="left_content">

<?php if ( have_posts() ) : ?>
  <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h1 class="entry-title">
				  <?php printf( __( 'Søkeresultat for: %s', 'twentyten' ), '<span>' . get_search_query() . '</span>' ); ?>
				</h1>
				<?php
				/* Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called loop-search.php and that will be used instead.
				 */
				 get_template_part( 'loop', 'search' );
				?>
<?php else : ?>
				<div id="post-0" class="post no-results not-found">
					<h2 class="entry-title"><?php _e( 'Nothing Found', 'twentyten' ); ?></h2>
					<div class="entry-content">
						<p><?php _e( 'Beklager, vi fant ingenting på søket ditt. Prøv noe annet?', 'twentyten' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-0 -->
<?php endif; ?>
			</div><!-- #content -->

		</div><!-- #container -->
    </div>
<?php get_footer(); ?>
