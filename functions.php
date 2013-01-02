<?php
/**
 * Labs Theme functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, labs_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 *
 * @package WordPress
 * @subpackage Labs_Theme
 * @since Labs Theme 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 584;

/**
 * Tell WordPress to run labs_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'labs_setup' );

if ( ! function_exists( 'labs_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override labs_setup() in a child theme, add your own labs_setup to your child theme's
 * functions.php file.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To style the visual editor.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links, custom headers
 * 	and backgrounds, and post formats.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Labs_Theme 1.0
 */
function labs_setup() {

	/* Make Labs_Theme available for translation.
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Labs_Theme, use a find and replace
	 * to change 'labs' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'labs', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Load up our theme options page and related code.
	require( get_template_directory() . '/inc/theme-options.php' );

	// Grab Labs_Theme's Ephemera widget.
	require( get_template_directory() . '/inc/widgets.php' );

	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'header_menu', __( 'Header Menu', 'labs' ) );

	// Add support for custom backgrounds.
	// 背景图片
	add_theme_support( 'custom-background', array(
		// Let WordPress know what our default background color is.
		'default-color' => $default_background_color,
	) );
}
endif; // labs_setup

if ( ! function_exists( 'labs_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_theme_support('custom-header') in labs_setup().
 *
 * @since Labs_Theme 1.0
 */
function labs_admin_header_style() {
?>
<?php
}
endif; // labs_admin_header_style

/**
 * Sets the post excerpt length to 40 words.
 *设定后摘录长度为40个字，。
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
function labs_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'labs_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 * 返回一个“继续阅读”的链接摘录
 */
function labs_continue_reading_link() {
	return ' <a href="'. esc_url( get_permalink() ) . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'labs' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and labs_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function labs_auto_excerpt_more( $more ) {
	return ' &hellip;' . labs_continue_reading_link();
}
add_filter( 'excerpt_more', 'labs_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 * 增加了一个漂亮的“继续阅读”的链接，自定义文章的摘录。
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function labs_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= labs_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'labs_custom_excerpt_more' );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function labs_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'labs_page_menu_args' );

/**
 * Register our sidebars and widgetized areas. Also register the default Epherma widget.
 *
 * 皮肤内 小工具
 * @since Labs Theme 1.0
 */
function labs_widgets_init() {

	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'labs' ),
		'id' => 'sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Top Nav', 'labs' ),
		'id' => 'topnav',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Home Images Tab', 'labs' ),
		'id' => 'home-images-tab',
		'description' => __( 'Sample:<a href="#" target="_blank" title="GO Link"><img src="http://Image path/IMG_3879.png" width="950" height="300" title="Image Title" alt="Image Title"></a>', 'labs' ),
		'before_widget' => '<div class="slide %2$s"">',
		'after_widget' => "</div>",
		'before_title' => '<div class="caption" style="bottom:0"><span>',
		'after_title' => '</span> </div>',
	) );
	register_sidebar( array(
		'name' => __( 'Home Widget Left', 'labs' ),
		'id' => 'home-widget-left',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
		register_sidebar( array(
		'name' => __( 'Home Widget Right', 'labs' ),
		'id' => 'home-widget-right',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

}
add_action( 'widgets_init', 'labs_widgets_init' );

if ( ! function_exists( 'labs_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function labs_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>

        <div class="navigation">
         <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
		</div><!-- end of .navigation -->
<!-- #nav-above -->
<?php endif;
}
endif; // labs_content_nav

/**
 * Return the URL for the first link found in the post content.
 *
 * @since Labs_Theme 1.0
 * @return string|bool URL or false when no link is present.
 */
function labs_url_grabber() {
	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )
		return false;

	return esc_url_raw( $matches[1] );
}


if ( ! function_exists( 'labs_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own labs_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Labs_Theme 1.0
 */
function labs_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
<li class="post pingback">
  <p>
    <?php _e( 'Pingback:', 'labs' ); ?>
    <?php comment_author_link(); ?>
    <?php edit_comment_link( __( 'Edit', 'labs' ), '<span class="edit-link">', '</span>' ); ?>
  </p>
  <?php
			break;
		default :
	?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
  <article id="comment-<?php comment_ID(); ?>" class="comment">
    <div class="comment-meta">
      <div class="comment-author vcard">
        <?php
						$avatar_size = 32;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 32;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s | %2$s <span class="says">said:</span>', 'labs' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'Y-m-d' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'labs' ), get_comment_date('Y-m-d'), get_comment_time('G:i') )
							)
						);
					?>
        <?php edit_comment_link( __( 'Edit', 'labs' ), '<span class="edit-link">', '</span>' ); ?>
      </div>
      <!-- .comment-author .vcard -->
      
      <?php if ( $comment->comment_approved == '0' ) : ?>
      <em class="comment-awaiting-moderation">
      <?php _e( 'Your comment is awaiting moderation.', 'labs' ); ?>
      </em> <br />
      <?php endif; ?>
    </div>
    <!-- .comment-meta -->
    
    <div class="comment-content">
      <?php comment_text(); ?>
    </div>
    <div class="reply">
      <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'labs' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
    </div>
    <!-- .reply --> 
  </article>
  <!-- #comment-## -->
  
  <?php
			break;
	endswitch;
}
endif; // ends check for labs_comment()

if ( ! function_exists( 'labs_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own labs_posted_on to override in a child theme
 *
 * @since Labs_Theme 1.0
 */
function labs_posted_on() {
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'labs' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time('G:i') ),
		esc_attr( get_the_date( 'Y-m-d' ) ),
		esc_html( get_the_date('Y-m-d') ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'labs' ), get_the_author() ) ),
		get_the_author()
	);
}
endif;

//if ( ! function_exists( 'labs_posted_on' ) ) :
///**
// * Prints HTML with meta information for the current post-date/time and author.
// * Create your own labs_posted_on to override in a child theme
// *
// * @since Labs_Theme 1.0
// */
//function labs_posted_on() {
//	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'labs' ),
//		esc_url( get_permalink() ),
//		esc_attr( get_the_time() ),
//		esc_attr( get_the_date( 'c' ) ),
//		esc_html( get_the_date() ),
//		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
//		esc_attr( sprintf( __( 'View all posts by %s', 'labs' ), get_the_author() ) ),
//		get_the_author()
//	);
//}
//endif;

/**
 * Adds two classes to the array of body classes.
 * The first is if the site has only had one author with published posts.
 * The second is if a singular post being displayed
 *
 * @since Labs_Theme 1.0
 */
function labs_body_classes( $classes ) {

	if ( function_exists( 'is_multi_author' ) && ! is_multi_author() )
		$classes[] = 'single-author';

	if ( is_singular() && ! is_home() && ! is_page_template( 'showcase.php' ) && ! is_page_template( 'sidebar-page.php' ) )
		$classes[] = 'singular';

	return $classes;
}
add_filter( 'body_class', 'labs_body_classes' );


// get_the_time get_the_date 定义日期显示类型 解决多语言插件时间乱码问题
