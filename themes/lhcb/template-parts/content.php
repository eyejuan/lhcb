<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Gutenbergtheme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
		$absolute_header = get_post_meta( $post->ID, 'page_absolute_header', true);
		if($absolute_header != "yes"): ?>
			<header class="entry-header">
				<?php
				if ( is_singular() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					if ( has_post_thumbnail() ) :
						echo '<a href="'.get_the_permalink().'">'.get_the_post_thumbnail().'</a>';
					endif;
				endif;

				if ( 'post' === get_post_type() ) :
					include(__DIR__ . '\..\inc\meta.php');
				endif; ?>
			</header><!-- .entry-header -->
	<?php endif; ?>

	<div class="entry-content">
		<?php
			if ( !is_front_page() && is_home() ):
				the_excerpt();
			else:			
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'gutenbergtheme' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );
			endif;
			if ( !is_front_page() && is_home() ):
				echo '<a class="button" href="'.get_the_permalink().'">Read More</a>';
			endif;
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php gutenbergtheme_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
