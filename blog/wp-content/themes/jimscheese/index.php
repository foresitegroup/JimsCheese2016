<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header();

$TopDir = substr( home_url(), 0, strrpos( home_url(), '/')+1);
?>

<?php
if ( have_posts() ) :

	/* Start the Loop */
	while ( have_posts() ) : the_post();

		/*
		 * Include the Post-Format-specific template for the content.
		 * If you want to override this in a child theme, then include a file
		 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
		 */
		get_template_part( 'content', get_post_format() );

	endwhile;
  
  echo "<div class=\"site-width blog-index-nav\">\n";
		// Previous/next page navigation.
		FG_posts_pagination(array(
			'next_text' => __('OLDER POSTS'),
			'prev_text' => __('NEWER POSTS')
		));
	echo "</div>\n";

else :

	get_template_part( 'content', 'none' );

endif;
?>

<?php get_footer(); ?>