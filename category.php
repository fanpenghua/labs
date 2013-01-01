<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Labs_Theme
 * @since Labs Theme 1.0
 */
?>
<?php get_header(); ?>

            <div class="breadcrumb">
            <?php
                if(function_exists('bcn_display')) {
                    bcn_display();
                }
            ?>
            </div>
			<div id="content" role="main">

<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
        
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h1 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'labs'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a></h1>
                
                <div class="post-meta">
                <?php 
                    printf( __( '<span class="%1$s">Posted on category </span> %2$s by %3$s', 'labs' ),'meta-prep meta-prep-author',
		            sprintf( '<a href="%1$s" title="%2$s" rel="bookmark">%3$s</a>',
			            get_permalink(),
			            esc_attr( get_the_time('G:i') ),
			            get_the_date('Y-m-d')
		            ),
		            sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			            get_author_posts_url( get_the_author_meta( 'ID' ) ),
			        sprintf( esc_attr__( 'View all posts by %s', 'labs' ), get_the_author() ),
			            get_the_author()
		                )
			        );
		        ?>
				    <?php if ( comments_open() ) : ?>
                        <span class="comments-link">
                    <?php comments_popup_link(__('No Comments &darr;', 'labs'), __('1 Comment &darr;', 'labs'), __('% Comments &darr;', 'labs')); ?>
                        </span>
                    <?php endif; ?> 
                </div><!-- end of .post-meta -->
                
                <div class="post-entry">
                    <?php if ( has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
                    <?php the_post_thumbnail(); ?>
                        </a>
                    <?php endif; ?>
                    <?php the_content(__('Read more &#8250;', 'labs')); ?>
                    <?php wp_link_pages(array('before' => '<div class="pagination">' . __('Pages:', 'labs'), 'after' => '</div>')); ?>
                </div><!-- end of .post-entry -->
                
                <div class="post-data">
				    <?php the_tags(__('Tags:', 'labs') . ' ', ', ', '<br />'); ?> 
					<?php printf(__('Posted in %s', 'labs'), get_the_category_list(', ')); ?> 
                </div><!-- end of .post-data -->             

            <div class="post-edit"><?php edit_post_link(__('Edit', 'labs')); ?></div>
            <div class="hr"></div>             
            </div><!-- end of #post-<?php the_ID(); ?> -->
            
        <?php endwhile; ?> 
        
        <div class="navigation">
         <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
		</div><!-- end of .navigation -->
        
<?php endif; ?>  

			</div><!-- #content -->
	
<?php get_sidebar(); ?>
<?php get_footer(); ?>