<?php 

?>
			</div><!-- #content -->
		</div><!-- #page -->
	</div><!-- .site-content-contain -->

	<footer id="footer" class="page-footer site-footer text-center py-4" role="contentinfo">
		<div class="wrap">
			<?php
				get_template_part( 'template-parts/footer/footer', 'widgets' );

				get_template_part( 'template-parts/navigation/navigation', 'social' );

				get_template_part( 'template-parts/footer/site', 'info' );
			?>
		</div><!-- .wrap -->
	</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>
