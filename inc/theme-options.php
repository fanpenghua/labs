<?php
/**
 * Labs Theme Options
 *
 * @package WordPress
 * @subpackage Labs_Theme
 * @since Labs Theme 1.0
 */

/**
 * Properly enqueue styles and scripts for our theme options page.
 *
 * This function is attached to the admin_enqueue_scripts action hook.
 *
 * @since Labs Theme 1.0
 *
 */

function labs_option_page_capability( $capability ) {
}
/**
 * widgets Tools
*/
function labs_get_theme_options() {
}
/**
 * Labs Theme Options
*/
function labs_admin_enqueue_scripts( $hook_suffix ) {
	wp_enqueue_style( 'labs_theme_options', get_template_directory_uri() . '/inc/theme-options.css', false, '1.0' );
	wp_enqueue_script( 'labs_theme_options', get_template_directory_uri() . '/inc/theme-options.js', array( 'jquery' ), '1.0' );
	wp_enqueue_style( 'farbtastic' );
}
add_action( 'admin_print_styles-appearance_page_theme_options', 'labs_admin_enqueue_scripts' );


global $pagenow;
if( ( 'themes.php' == $pagenow ) && ( isset( $_GET['activated'] ) && ( $_GET['activated'] == 'true' ) ) ) :


/**
 * Set default options on activation
 */
function labs_init_options() {
	$options = get_option( 'labs_options' );
	if ( false === $options ) {
		$options = labs_default_options();
	}
	update_option( 'labs_options', $options );
}

add_action( 'after_setup_theme', 'labs_init_options', 9 );
endif;

/**
 * Register the theme options setting
 */
function labs_register_settings() {
	register_setting( 'labs_options', 'labs_options', 'labs_validate_options' );	
}
add_action( 'admin_init', 'labs_register_settings' );

/**
 * Register the options page
 */
function labs_theme_add_page() {
	add_theme_page( __( 'Theme Options', 'labs' ), __( 'Theme Options', 'labs' ), 'edit_theme_options', 'theme_options', 'labs_theme_options_page' );
}
add_action( 'admin_menu', 'labs_theme_add_page');

/**
 * Set custom RSS feed links.
 *
 */
function labs_custom_feed( $output, $feed ) {
	$options = get_option('labs_options');
	$url = $options['rss_url'];	
	if ( $url ) {
		$outputarray = array( 'rss' => $url, 'rss2' => $url, 'atom' => $url, 'rdf' => $url, 'comments_rss2' => '' );
		$outputarray[$feed] = $url;
		$output = $outputarray[$feed];
	}
	return $output;
}
add_filter( 'feed_link', 'labs_custom_feed', 1, 2 );

/**
 * Set custom Favicon.
 *
 */
function labs_custom_favicon() {
	$options = get_option('labs_options');
	$favicon_url = $options['favicon_url'];	
	
    if (!empty($favicon_url)) {
		echo '<link rel="shortcut icon" href="'. $favicon_url. '" />	'. "\n";
	}
}

add_action('wp_head', 'labs_custom_favicon');

/**
 * Set custom CSS.
 *
 */
function labs_inline_css() {
    $options = get_option('labs_options');
	$inline_css = $options['inline_css'];
    if (!empty($inline_css)) {
		echo '<!-- Custom CSS Styles -->' . "\n";
        echo '<style type="text/css" media="screen">' . "\n";
		echo $inline_css . "\n";
		echo '</style>' . "\n";
	}
}
add_action('wp_head', 'labs_inline_css');


/**
 * Add tracking code in the footer.
 *
 */
function labs_stats_tracker() {
    $options = get_option('labs_options');
	$stats_tracker = $options['stats_tracker'];
    if (!empty($stats_tracker)) {
        echo $stats_tracker;
	}
}
add_action('wp_footer', 'labs_stats_tracker');

/**
 * Set meta description.
 *
 */
function labs_meta_desc() {
    $options = get_option('labs_options');
	$meta_desc = $options['meta_desc'];
    
	if (!empty($meta_desc)) {
		echo '<meta name="description" content=" '. $meta_desc .'"  />' . "\n";
	}
}
add_action('wp_head', 'labs_meta_desc');


/**
 * Set Google site verfication code
 *
 */
function labs_google_verification() {
    $options = get_option('labs_options');
	$google_verification = $options['google_verification'];
   
   if (!empty($google_verification)) {
		echo '<meta name="google-site-verification" content="' . $google_verification . '" />' . "\n";
	}
}
add_action('wp_head', 'labs_google_verification');


/**
 * Set Bing site verfication code
 *
 */
function labs_bing_verification() {	
    $options = get_option('labs_options');
	$bing_verification = $options['bing_verification'];	
	
    if (!empty($bing_verification)) {
        echo '<meta name="msvalidate.01" content="' . $bing_verification . '" />' . "\n";
	}
}
add_action('wp_head', 'labs_bing_verification');


/**
 * Output the options page
 */
function labs_theme_options_page() { ?>

<div id="labs-admin" class="wrap">
  <div class="options-form">
    <?php $theme_name = function_exists('wp_get_theme') ? wp_get_theme() : ''; ?>
    <?php screen_icon(); echo "<h2>" . $theme_name ." ". __('Theme Options', 'labs') . "</h2>"; ?>
    <div class="theme-info">
      <ul>
        <li> <a href="<?php echo esc_url(__('http://labs.cnfph.me/labs-theme/', 'labs')); ?>" title="<?php _e('Theme Support', 'labs'); ?>" target="_blank"><?php printf(__('Theme Support', 'labs')); ?></a> </li>
        <li> <a href="<?php echo esc_url(__('http://labs.cnfph.me/donate/', 'labs')); ?>" title="<?php _e('Donate Now', 'labs'); ?>" target="_blank"><?php printf(__('Donate Now', 'labs')); ?></a> </li>
      </ul>
    </div>
    <br />
    <br />
    <?php if ( isset( $_GET['settings-updated'] ) ) : ?>
    <div class="updated fade">
      <p>
        <?php _e('Theme settings updated successfully', 'labs'); ?>
      </p>
    </div>
    <?php endif; ?>
    <form action="options.php" method="post">
      <?php settings_fields( 'labs_options' ); ?>
      <?php $options = get_option('labs_options'); ?>
      <div class="options_blocks">
        <h3 class="block_title"><a href="#">
          <?php _e('Home', 'labs'); ?>
          </a></h3>
        <div class="block">
          <div class="field">
            <label for="labs_options[logo_url]">
              <?php _e('Logo URL:', 'labs'); ?>
            </label>
            <input id="labs_options[logo_url]" name="labs_options[logo_url]" type="text" value="<?php echo esc_attr($options['logo_url']); ?>" />
            <span>
            <?php _e( 'Enter full URL of logo image starting with <strong>http:// </strong>.', 'labs' ); ?>
            </span> </div>
          <div class="field">
            <label for="labs_options[favicon_url]">
              <?php _e('Favicon URL', 'labs'); ?>
            </label>
            <input id="labs_options[favicon_url]" name="labs_options[favicon_url]" type="text" value="<?php echo esc_attr($options['favicon_url']); ?>" />
            <span>
            <?php _e( 'Enter full URL of favicon image starting with <strong>http:// </strong>.', 'labs' ); ?>
            </span> </div>
          <div class="field">
            <label for="labs_options[rss_url]">
              <?php _e('Custom RSS URL', 'labs'); ?>
            </label>
            <input id="labs_options[rss_url]" name="labs_options[rss_url]" type="text" value="<?php echo esc_attr($options['rss_url']); ?>" />
            <span>
            <?php _e( 'Enter full URL of RSS Feeds link starting with <strong>http:// </strong>. Leave blank to use default RSS Feeds.', 'labs' ); ?>
            </span> </div>
          <div class="submit">
            <input type="submit" name="labs_options[submit]" class="button-primary" value="<?php _e( 'Save Settings', 'labs' ); ?>" />
          </div>
        </div>
        <!-- /block -->
        
        <h3 class="block_title"><a href="#">
          <?php _e('Webmaster Tools', 'labs'); ?>
          </a></h3>
        <div class="block">
          <div class="field">
            <label for="labs_options[meta_desc]">
              <?php _e('Meta Description', 'labs'); ?>
            </label>
            <textarea id="labs_options[meta_desc]" class="textarea" cols="50" rows="10" name="labs_options[meta_desc]"><?php echo esc_attr($options['meta_desc']); ?></textarea>
            <span>
            <?php _e( 'A short description of your site for the META Description tag. Keep it less than 149 characters.', 'labs' ); ?>
            </span> </div>
          <div class="field">
            <label for="labs_options[stats_tracker]">
              <?php _e('Statistics Tracking Code', 'labs'); ?>
            </label>
            <textarea id="labs_options[stats_tracker]" class="textarea" cols="50" rows="10" name="labs_options[stats_tracker]"><?php echo esc_attr($options['stats_tracker']); ?></textarea>
            <span>
            <?php _e( 'If you want to add any tracking code (eg. Google Analytics). It will appear in the header of the theme.', 'labs' ); ?>
            </span> </div>
          <div class="field">
            <label for="labs_options[google_verification]">
              <?php _e('Google Site Verification', 'labs'); ?>
            </label>
            <input id="labs_options[google_verification]" type="text" name="labs_options[google_verification]" value="<?php echo esc_attr($options['google_verification']); ?>" />
            <span>
            <?php _e( 'Enter your ID only.', 'labs' ); ?>
            </span> </div>
          <div class="field">
            <label for="labs_options[bing_verification]">
              <?php _e('Bing Site Verification', 'labs'); ?>
            </label>
            <input id="labs_options[bing_verification]" type="text" name="labs_options[bing_verification]" value="<?php echo esc_attr($options['bing_verification']); ?>" />
            <span>
            <?php _e( 'Enter the ID only. <strong>Yahoo</strong> search is powered by Bing, so it will be automatically verified by Yahoo as well.', 'labs' ); ?>
            </span> </div>
          <div class="submit">
            <input type="submit" name="labs_options[submit]" class="button-primary" value="<?php _e( 'Save Settings', 'labs' ); ?>" />
          </div>
        </div>
        <!-- /block -->
        
        <h3 class="support_title">
          <?php _e('Support us', 'labs'); ?>
        </h3>
        <div class="support-block">
          <div class="field">
            <p><strong>
              <?php _e('Did you like this theme?', 'labs') ?>
              </strong></p>
            <p>
              <?php _e( 'Please consider making a small donation to support our continued WordPress theme development. It takes real time and money to develop themes and make them available for free.', 'labs' ); ?>
            </p>
            <p> <a href="<?php echo esc_url(__('http://labs.cnfph.me/donate/', 'labs')); ?>" title="<?php _e('Donate Now', 'labs'); ?>" target="_blank"> Donate Now </a> </p>
          </div>
        </div>
        <!-- /block --> 
        
      </div>
      <!-- /option_blocks -->
      
      <input type="submit" name="labs_options[submit]" class="button-primary" value="<?php _e( 'Save Settings', 'labs' ); ?>" />
      <input type="submit" name="labs_options[reset]" class="button-secondary" value="<?php _e( 'Reset Defaults', 'labs' ); ?>" />
    </form>
  </div>
  <!-- /options-form --> 
</div>
<!-- /labs-admin -->
<?php
}

/**
 * Return default array of options
 */
 
function labs_default_options() {
	$options = array(
		'logo_url' => get_template_directory_uri().'/images/logo.png',
		'favicon_url' => '',
		'rss_url' => '',
		'meta_desc' => '',
		'stats_tracker' => '',
		'google_verification' => '',
		'bing_verification' => '',
	);
	return $options;
}

/**
 * Sanitize and validate options
 */
function labs_validate_options( $input ) {
	$submit = ( ! empty( $input['submit'] ) ? true : false );
	$reset = ( ! empty( $input['reset'] ) ? true : false );
	if( $submit ) :
	
		$input['logo_url'] = esc_url_raw($input['logo_url']);
		$input['favicon_url'] = esc_url_raw($input['favicon_url']);
		$input['rss_url'] = esc_url_raw($input['rss_url']);
		
		$input['meta_desc'] = wp_kses_stripslashes($input['meta_desc']);
	
		$input['google_verification'] = wp_filter_post_kses($input['google_verification']);
		$input['bing_verification'] = wp_filter_post_kses($input['bing_verification']);
	
		$input['stats_tracker'] = wp_kses_stripslashes($input['stats_tracker']);
	
		$categories = get_categories( array( 'hide_empty' => 0, 'hierarchical' => 0 ) );
		$cat_ids = array();
		foreach( $categories as $category )
			$cat_ids[] = $category->term_id;
			
		return $input;
		
	elseif( $reset ) :
	
		$input = labs_default_options();
		return $input;
		
	endif;
}

if ( ! function_exists( 'labs_get_option' ) ) :
/**
 * Used to output theme options is an elegant way
 * @uses get_option() To retrieve the options array
 */
function labs_get_option( $option ) {
	$options = get_option( 'labs_options', labs_default_options() );
	return $options[ $option ];
}
endif;


