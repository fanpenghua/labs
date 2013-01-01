<?php
/**
 * The template for displaying search
 *
 * @package WordPress
 * @subpackage Labs_Theme
 * @since Labs Theme 1.0
 */
?>
	<form method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
		<input type="text" class="field" name="s" id="search" placeholder="<?php esc_attr_e('search here &hellip;', 'labs'); ?>" />
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e('Go', 'labs'); ?>"  />
	</form>
