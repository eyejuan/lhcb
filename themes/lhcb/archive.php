<?php get_header(); ?>
	<header class="entry-header">
	<?php if (have_posts()) : $post = $posts[0]; ?>
		<?php /* If this is a category archive */ if (is_category()) { ?>
			<h1><?php single_cat_title(); ?></h1>
		<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
			<h1><?php single_tag_title(); ?></h1>
		<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
			<h1><?php the_time('F jS, Y'); ?></h1>
		<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
			<h1><?php the_time('F, Y'); ?></h1>
		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
			<h1 class="pagetitle"><?php the_time('Y'); ?></h1>
		<?php /* If this is an author archive */ } elseif (is_author()) { ?>
			<h1 class="pagetitle">Author Archive</h1>
		<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			<h1 class="pagetitle">Blog Archives</h1>			
		<?php } ?>
	</header>

	<?php 
	echo '<div class="postswrapper">';
	while (have_posts()) : the_post();
		echo '<div class="recentposts--indiv">';
		echo '<a href="'.get_the_permalink().'">'.get_the_post_thumbnail().'</a>';
		echo '<div class="recentposts--inner">';
		echo '<h3><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3>';
		include('inc/meta.php');
		the_excerpt();
		echo '<a class="button" href="'.get_the_permalink().'">Read More</a>';
		echo "</div>";
		echo "</div>";
	endwhile; 
	echo "</div>";
	wp_pagenavi(); 
	else : ?>
		<header class="entry-header">
			<h2>No posts found</h2>
		</header>
	<?php endif; ?>


<?php get_footer(); ?>