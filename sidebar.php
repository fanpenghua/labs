<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package WordPress
 * @subpackage Labs_Theme
 * @since Labs Theme 1.0
 */
?>
<?php
$options = labs_get_theme_options();
$current_layout = $options['theme_layout'];

if ( 'content' != $current_layout ) :
?>

<div id="sidebar" class="widget-area" role="complementary">
  <?php if ( ! dynamic_sidebar( 'sidebar' ) ) : ?>
  <?php endif; // end sidebar widget area ?>
</div>
<!-- #sidebar .widget-area -->
<?php endif; ?>
