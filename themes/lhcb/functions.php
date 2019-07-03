<?php
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

/**
 * Enqueue scripts and styles.
 */
function cbi_scripts() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_dequeue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'cbi_scripts' );

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}

// shortcode to display 3 more recent blog posts
function recent_posts_func(){
	ob_start();

	$args = array(
		'post_type' => 'post',
		'posts_per_page' => 3
	); $the_query = new WP_Query($args);
	echo '<div class="recentposts--wrap">';
	if($the_query->have_posts()): while ($the_query->have_posts()): $the_query->the_post();
		echo '<div class="recentposts--indiv">';
		echo '<a href="'.get_the_permalink().'">'.get_the_post_thumbnail().'</a>';
		echo '<div class="recentposts--inner">';
		echo '<h3><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3>';
		include('inc/meta.php');
		the_excerpt();
		echo '<a class="button" href="'.get_the_permalink().'">Read More</a>';
		echo "</div>";
		echo "</div>";
	endwhile; endif; wp_reset_postdata();
	echo '</div>';
	return ob_get_clean();
}
add_shortcode('recent_posts', 'recent_posts_func');

// Filter except length to 35 words.
// tn custom excerpt length
function tn_custom_excerpt_length( $length ) {
return 35;
}
add_filter( 'excerpt_length', 'tn_custom_excerpt_length', 999 );


// shortcode for current year
function year_shortcode() {
  $year = date('Y');
  return $year;
}
add_shortcode('year', 'year_shortcode');

if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => 'Footer Menu Bar',
        'id'   => 'footer-menu-bar',
        'description'   => 'These are widgets for the sidebar.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ));
}