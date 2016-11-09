<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bstrap-lite
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php dynamic_sidebar( 'footer-1' ); ?>
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'bstrap-lite' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'bstrap-lite' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'bstrap-lite' ), 'bstrap-lite', '<a href="http://underscores.me/" rel="designer">Underscores.me</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #wrap -->

<?php wp_footer(); ?>

</body>
</html>
