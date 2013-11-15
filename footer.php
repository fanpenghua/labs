<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage Labs_Theme
 * @since Labs Theme 1.0
 */
?>

	</div><!-- #wrapper -->

	<footer>
    <div class="inner">
            <div class="copyright"> Copyright &copy; <?php echo date('Y');?> <a href="<?php
bloginfo('siteurl'); ?>" title="<?php bloginfo('name'); ?>"><?php
bloginfo('name'); ?></a>.</div>

			<div class="powered">
                <a href="http://labs.cnfph.me/labs-theme/" target="_blank" title="Labs Theme">Labs Theme</a>
				powered by<a href="<?php echo esc_url( __( 'http://wordpress.org', 'labs' ) ); ?>" title="<?php esc_attr_e( 'WordPress', 'labs' ); ?>"><?php printf( __( ' %s', 'labs' ), 'WordPress' ); ?></a>
			</div>
            <a class="returnTop Indicator btn" href="#" onclick="return;" style="display:none"><strong><br>Top</strong><span></span></a>
    </div>
	</footer><!-- footer -->
<script language="javascript"> 
$(function(){
  // 给 window 对象绑定 scroll 事件
  $(window).bind("scroll", function(){

      // 获取网页文档对象滚动条的垂直偏移
      var scrollTopNum = $(document).scrollTop(),
          // 获取浏览器当前窗口的高度
          winHeight = $(window).height(),
          returnTop = $("a.returnTop");

      // 滚动条的垂直偏移大于 0 时显示，反之隐藏
      (scrollTopNum > 0) ? returnTop.fadeIn("fast") : returnTop.fadeOut("fast");

      // 给 IE6 定位
      if (!-[1,]&&!window.XMLHttpRequest) {
          returnTop.css("top", scrollTopNum + winHeight - 200);
      }

  });

  // 点击按钮后，滚动条的垂直方向的值逐渐变为0，也就是滑动向上的效果
  $("a.returnTop").click(function() {
      $("html, body").animate({ scrollTop: 0 }, 200);
  });

});
</script>
<?php wp_footer(); ?>
</body>
</html>