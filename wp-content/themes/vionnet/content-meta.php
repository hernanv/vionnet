<!-- BEGIN .entry-meta-footer-->
<div class="entry-meta-footer">
<?php /*?>    <span class="comment-count"><?php _e('Comments: ', 'zilla'); comments_popup_link( '0', '1', '%' ); ?></span>
    <span class="author"><?php _e('Posted by:', 'zilla') ?> <?php the_author_posts_link(); ?></span>
<?php */?>	
	
    
	<span class="entry-categories">
		<?php $archive_year = get_the_time('Y'); ?>
		<?php _e('Year: ', 'zilla');?><a href="<?php echo get_year_link( $archive_year ); ?>"><?php the_time('Y'); ?></a>
    </span>

<?php /*?>	<span class="entry-categories"><?php _e('Categories:', 'zilla') ?> <?php the_category(', ') ?></span><?php */?>    <span class="entry-tags"><?php the_tags( __('Tags:', 'zilla') . ' ', ', ', ''); ?></span>
    
<?php /*?>    <?php if( function_exists('zilla_likes') ) {
        zilla_likes(); 
    } ?>
<?php */?>    
<!-- END .entry-meta-footer-->
</div>
