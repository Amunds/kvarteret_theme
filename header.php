<?php
/**
 * The Header for our theme.
 *
 * @package WordPress
 * @subpackage kvarteret
 * @since Kvarteret 1.0
 */
?>
<!DOCTYPE html>
  <html lang="nb">
  <head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" />
    <link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/favicon.ico">
    <title><?php
	  /*
	   * Print the <title> tag based on what is being viewed.
	   */
	 global $page, $paged;

	 wp_title( '|', true, 'right' );

	 // Add the blog name.
	 bloginfo( 'name' );

	 // Add the blog description for the home/front page.
	 $site_description = get_bloginfo( 'description', 'display' );
	 if ( $site_description && ( is_home() || is_front_page() ) )
		 echo " | $site_description";

	 // Add a page number if necessary:
	 if ( $paged >= 2 || $page >= 2 )
		 echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	 ?></title>
  
   <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
   <?php
	  wp_head();
    ?>
    <script src="<?php bloginfo('template_directory'); ?>/javascript/jquery-1.4.3.min.js" 
      type="text/javascript" charset="utf-8">
    </script>
    <script src="<?php bloginfo('template_directory'); ?>/javascript/jquery.slider.js" 
      type="text/javascript" charset="utf-8">
    </script>
    <script src="<?php bloginfo('template_directory'); ?>/javascript/application.js" 
      type="text/javascript" charset="utf-8">
    </script>
  </head>

  <body <?php body_class(); ?>>
	  <div id="header">
		<div id="header_follow_buttons">
			<a href="http://et.kvarteret.no/endre/kvarteret_symfony_events/web/api/atom/upcomingEvents"><img src="<?php bloginfo('template_directory'); ?>/images/rss-l.png" alt="Facebook" /></a> 
			<a href="http://www.facebook.com/pages/Det-Akademiske-Kvarter/20210537496"><img src="<?php bloginfo('template_directory'); ?>/images/facebook-l.png" alt="Facebook" /></a> 
			<a href="http://twitter.com/Kvarteret"><img src="<?php bloginfo('template_directory'); ?>/images/twitter-l.png" alt="Twitter" /></a>
		</div>
	    <div id="header_search_form">
			<form action="<?php echo home_url( '/' ); ?>?" method="get">
			  <input name="s" id="search_input_box" value="Skriv inn søkeord" type="text" />
			  <button id="search_button" title="søk">Søk</button>
			</form>
	    </div>
      <span>
        <a href="<?php echo home_url( '/' ); ?>" 
           title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
           rel="home">
           <img src="<?php bloginfo('template_directory'); ?>/images/logo.png" 
                title="Det Akademiske Kvarter" 
                alt="Det Akademiske Kvarter" />
        </a>
      </span>
	  </div>
	  <div id="navigation_bar" role="navigation">
		  <?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
		  <span id="navigation_sides">
	      <img src="<?php bloginfo('template_directory'); ?>/images/navigation_left.png" id="fancy_left">
	      <span id="white_navigation_background"></span>
        <img src="<?php bloginfo('template_directory'); ?>/images/navigation_right.png" id="fancy_right">
      </span>
	  </div>
    <div id="main">