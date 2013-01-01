<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="wrapper">
 *
 * @package WordPress
 * @subpackage Labs_Theme
 * @since Labs Theme 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title>
<?php
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
		echo ' | ' . sprintf( __( 'Page %s' ), max( $paged, $page ) );

	?>
</title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-35893402-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>

<body <?php body_class(); ?>>
<header>
  <div class="topnav">
            <?php if ( ! dynamic_sidebar( 'topnav' ) ) : ?>
          <?php _e(' <aside id="search-4" class="widget widget_search"><h3 class="widget-title">搜索</h3>
		    <form method="get" id="searchform" action="http://127.0.0.1/labs/">
			  <input type="text" class="field" name="s" id="search" placeholder="search here …">
			  <input type="submit" class="submit" name="submit" id="searchsubmit" value="Go">
	        </form>
          </aside>','labs'); ?>
    <?php endif; // end topnav widget area ?>
  </div>
  <!-- end of .topnav -->
  <hgroup>
    <h1 id="site-title"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
      <?php bloginfo( 'name' ); ?>
      </a></span></h1>
    <h2 id="site-description">
      <?php bloginfo( 'description' ); ?>
    </h2>
  </hgroup>
  <!-- end of hgroup -->
  <nav class="mainnav" role="navigation">
    <h3 class="title">
      <?php _e( 'Main menu', 'Labs' ); ?>
    </h3>
    <?php wp_nav_menu( array( 'theme_location' => 'header_menu' ) ); ?>
  </nav>
  <!-- end of .topnav --> 
</header>
<!-- en of header -->
<div id="wrapper">