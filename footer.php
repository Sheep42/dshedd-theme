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

<?php 
	dshedd_load_fontawesome();
	dshedd_google_analytics();

	if( class_exists( 'DS_SpotifyRecentlyPlayed' ) )
		ds_spotify_recently_played();
?>

<?php wp_footer(); ?>

</body>
</html>
