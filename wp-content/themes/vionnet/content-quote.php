<?php if( !is_single() ) { ?>
	<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'zilla'), get_the_title()); ?>">
<?php } ?>

	<!-- BEGIN .entry-quote -->
	<div class="entry-quote">
	    <?php $quote = get_post_meta($post->ID, '_zilla_quote_quote', true); ?>
	    <h2><?php echo $quote; ?></h2>    
        <span class="alignleft quote-avatar-small"><?php the_post_thumbnail(); ?></span>
	    <p class="quote-source"><?php the_title(); ?></p>
	<!-- END .entry-quote -->
	</div>

<?php if( !is_single() ) { ?>
	</a>
<?php } else { ?>
	
	    <!-- BEGIN .entry-content -->
<div class="entry-content">
	<ul class="clearfix">
    	<li class="alignleft quote-avatar"><?php the_post_thumbnail(); ?></li>
        <li class="alignleft quote-title-position"><?php the_title(); ?></li>
    </ul>
    
    <div>
        <?php  the_content( __('Find out more...', 'zilla') ) ?>
    </div>
       
<?php /*?>		<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'framework').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number'));  ?>
<?php */?>		
    
<!-- END .entry-content -->
</div>

<?php } ?>