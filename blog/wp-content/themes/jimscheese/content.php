<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

if ( is_single() ) { ?>
	<div class="site-width blog-content">
	  <?php the_content(); ?>
	  
	  <div class="blog-metadata">
	    Posted in <?php echo get_the_category_list(', '); ?><br>
	    Tagged in <?php echo get_the_tag_list('',', '); ?>
	  </div>
    
    <?php
	  // Previous/next post navigation.
		FG_post_pagination(array(
			'next_text' => __('NEXT POST'),
			'prev_text' => __('PREVIOUS POST')
		));
		?>
	</div>
<?php } else { ?>
	<div class="blog-content-index">
		<div class="site-width">
			<div class="date">Posted on <?php echo get_the_date(); ?></div>

			<h2><?php the_title(); ?></h2>

			<?php echo get_the_excerpt(); ?><br>

			<a href="<?php the_permalink(); ?>" class="readmore">READ MORE</a>
		</div>
	</div>
<?php } ?>