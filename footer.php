<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package launchframe
 */
?>
		</div><!-- .container -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<div class="site-info">
				<?php do_action( 'launchframe_credits' ); ?>
				<a href="http://wordpress.org/" title="<?php esc_attr_e( 'Whiteboard', 'launchframe' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'launchframe' ), 'WordPress' ); ?></a>
				<span class="sep"> | </span>
				<?php printf( __( 'Theme: %1$s by %2$s.', 'launchframe' ), 'launchframe', '<a href="http://whiteboard.is/" rel="designer">Whiteboard</a>' ); ?>
			</div><!-- .site-info -->
		</div><!-- .container -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>