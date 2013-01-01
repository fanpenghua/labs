<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Labs_Theme
 * @since Labs Theme 1.0
 */
?>
<?php
get_header(); ?>

<div class="breadcrumb">
  <?php
              if(function_exists('bcn_display')) {
                  bcn_display();
              }
          ?>
</div>
<div id="content" role="main">
  <?php while ( have_posts() ) : the_post(); ?>
  <?php get_template_part( 'content', 'single' ); ?>
  <?php comments_template( '', true ); ?>
  <?php endwhile; // end of the loop. ?>
</div>
<!-- #content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
