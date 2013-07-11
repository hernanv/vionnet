<?php /* if the post has a WP 2.9+ Thumbnail */
if( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>
    <div class="post-thumb">

        <?php if( !is_singular() ) { /*----- !singular is for protfolio homepage -----*/ ?> 
        
        <a title="<?php printf(__('Permanent Link to %s', 'zilla'), get_the_title()); ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('portfolio-thumbnail'); ?></a></li>
    	    
    	<?php } ?>
    	    
    </div>
<?php } ?>

<?php if( !is_singular() ) { ?>
    
    
	<ul class="entry-header clearfix">
		<li>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'zilla'), get_the_title()); ?>"> <?php the_title(); ?></a></h2>
		</li>
		<li class="like-heart"><?php if( function_exists('zilla_likes') ) { zilla_likes(); } ?></li>
	</ul>
        
<?php } else { ?>
    <h1 class="entry-title"><?php the_title(); ?></h1>
		
<?php } ?>

<!-- BEGIN .entry-meta-header-->
<div class="entry-meta-header">
    <?php /*?><span class="published"><?php the_time( get_option('date_format') ); ?></span><?php */?>
    <?php edit_post_link( __('edit', 'zilla'), '<span class="edit-post">[', ']</span>' ); ?>
<!-- END .entry-meta-header -->
</div>


<!-- BEGIN .entry-content -->
<div class="entry-content">
	<?php 
		get_template_part( 'content', 'meta' );/*agregado desde single.php*/
        the_content( __('Read more...', 'zilla') ); 
        wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'framework').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); 
    ?>
<!-- END .entry-content -->
</div>