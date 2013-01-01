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
            <div class="copyright"> Copyright &copy; <?php echo date('Y');?> <a href="<?php
bloginfo('siteurl'); ?>" title="<?php bloginfo('name'); ?>"><?php
bloginfo('name'); ?></a>.</div>

			<div class="powered">
                <a href="http://labs.cnfph.me/" target="_blank" title="Labs Theme">Labs Theme</a>
				powered by<a href="<?php echo esc_url( __( 'http://wordpress.org', 'labs' ) ); ?>" title="<?php esc_attr_e( 'WordPress', 'labs' ); ?>"><?php printf( __( ' %s', 'labs' ), 'WordPress' ); ?></a>
			</div>
	</footer><!-- footer -->

<?php wp_footer(); ?>

</body>
</html>