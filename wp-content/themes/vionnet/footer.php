        
        <?php zilla_content_end(); ?>
		<!-- END #content -->
		</div>

		<?php zilla_footer_before(); ?>
			
		<!-- BEGIN #footer -->
		<div id="footer">
		    
		    <!-- BEGIN .footer-inner -->
		    <div class="footer-inner">
		    
		    <?php zilla_footer_start(); ?>
		    
		        <?php get_sidebar('footer'); ?>
		
		    <?php zilla_footer_end(); ?>
		    
		    <!-- END .footer-inner -->
		    </div>
		    
		    <div class="footer-lower">
		        <div class="footer-inner">
		            <p class="copyright">&copy; <?php _e('Copyright', 'zilla') ?> <a href="profile"><?php the_author_link(); ?></a> <?php _e('1999 -', 'zilla'); echo date( 'Y' ); ?>.</p>
        			<p class="credit">Reproduction without explicit permission is prohibited. All Rights Reserved.</p>
		        </div>
		    </div>
		    
		<!-- END #footer -->
		</div>

		<a href="#" id="back-to-top"></a>
		
		<?php zilla_footer_after(); ?>
		
		
	<!-- Theme Hook -->
	<?php wp_footer(); ?>
	<?php zilla_body_end(); ?>
			
	<!-- <?php echo 'Ran '. $wpdb->num_queries .' queries '. timer_stop(0, 2) .' seconds'; ?> -->
<!-- END body-->
</body>
<!-- END html-->
</html>