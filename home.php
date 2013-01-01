<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage Labs_Theme
 */

get_header(); ?>

<div id="home-content">
  <div id="container">
    <div id="example">
      <div id="slides">
        <div class="slides_container">
          <?php if ( ! dynamic_sidebar( 'home-images-tab' ) ) : ?>
          <?php _e(' <div class="slide"><a href="#" target="_blank" title="GO Link"><img src="'.get_stylesheet_directory_uri().'/images/IMG_3879.png" width="960" height="300" title="F.P.H shooting grass" alt="F.P.H shooting grass"></a>
            <div class="caption" style="bottom:0"> <span>F.P.H shooting grass</span> </div>
          </div>
          <div class="slide"><a href="#" target="_blank" title="GO Link"><img src="'.get_stylesheet_directory_uri().'/images/IMG_4182.png" width="960" height="300" title="F.P.H shooting cat" alt="F.P.H shooting cat"></a>
            <div class="caption"> <span>F.P.H shooting cat</span></div>
          </div>','labs'); ?>
          <?php endif; // end sidebar widget area ?>
        </div>
        <a href="#" class="prev" title="Arrow Prev"></a> <a href="#" class="next" title="Arrow Next"></a> </div>
    </div>
    <!--首页 图片结束-->
    <div class="home-widget right">
      <?php if ( ! dynamic_sidebar( 'home-widget-left' ) ) : ?>
      <?php _e('  <aside class="widget">
		<h3 class="widget-title">News</h3>
		<ul>
		  <li><a href="'.home_url().'/?page_id=2" title="Sample Page">Sample Page</a></li>
		  <li><a href="'.home_url().'/?page_id=2" title="Sample Page">Sample Page</a></li>
		  <li><a href="'.home_url().'/?page_id=2" title="Sample Page">Sample Page</a></li>
		  <li><a href="'.home_url().'/?page_id=2" title="Sample Page">Sample Page</a></li>
		  <li><a href="'.home_url().'/?page_id=2" title="Sample Page">Sample Page</a></li>
		</ul>
	  </aside>','labs'); ?>
      <?php endif; // end sidebar widget area ?>
    </div>
    <div class="home-widget">
      <?php if ( ! dynamic_sidebar( 'home-widget-right' ) ) : ?>
      <?php _e('  <aside class="widget">
		<h3 class="widget-title">News</h3>
		<ul>
		  <li><a href="'.home_url().'/?page_id=2" title="Sample Page">Sample Page</a></li>
		  <li><a href="'.home_url().'/?page_id=2" title="Sample Page">Sample Page</a></li>
		  <li><a href="'.home_url().'/?page_id=2" title="Sample Page">Sample Page</a></li>
		  <li><a href="'.home_url().'/?page_id=2" title="Sample Page">Sample Page</a></li>
		  <li><a href="'.home_url().'/?page_id=2" title="Sample Page">Sample Page</a></li>
		</ul>
	  </aside>','labs'); ?>
      <?php endif; // end sidebar widget area ?>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script> 
<script src="<?php echo get_template_directory_uri(); ?>/js/slides.min.jquery.js"></script> 
<script>
$(function(){
	$('#slides').slides({
		preload: true,
		preloadImage: '<?php echo get_template_directory_uri(); ?>/images/loading.gif',
		play: 5000,
		pause: 2500,
		hoverPause: true,
		animationStart: function(current){
			$('.caption').animate({
				bottom:-45
			},100);
			if (window.console && console.log) {
				// example return of current slide number
				console.log('animationStart on slide: ', current);
			};
		},
		animationComplete: function(current){
			$('.caption').animate({
				bottom:0
			},200);
			if (window.console && console.log) {
				// example return of current slide number
				console.log('animationComplete on slide: ', current);
			};
		},
		slidesLoaded: function() {
			$('.caption').animate({
				bottom:0
			},200);
		}
	});
});
</script>
<?php get_footer(); ?>