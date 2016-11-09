<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package bstrap-lite
 */

 /***** Pagination *****/

if (!function_exists('bstrap_pagination')) {
	function botville_pagination() {
		global $wp_query;
	    $big = 9999;
	    $paginate_links = paginate_links(array(
	    	'base' 		=> str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
	    	'format' 	=> '?paged=%#%',
	    	'current' 	=> max(1, get_query_var('paged')),
	    	'prev_next' => true,
	    	'prev_text' => esc_html__('&laquo;', 'tuto'),
	    	'next_text' => esc_html__('&raquo;', 'tuto'),
	    	'total' 	=> $wp_query->max_num_pages,
			'type'		=> 'array',)
	    );
		if( is_array( $paginate_links ) ) {
            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
            echo '<ul class="pagination">';
            foreach ( $paginate_links as $page ) {
				/*$activeclass = ( strpos( $page, 'current' ) !== false ) ? 'active' : ''; */
                    echo "<li class=".$activeclass.">$page</li>";
            }
           echo '</ul>';
		}
	}
}
 
if ( ! function_exists( 'bstrap_post_nav' ) ) : 
 /**
 * Display navigation to next/previous post when applicable.
 */
function bstrap_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="sr-only"><?php __( 'Post navigation', 'bstrap-lite' ); ?></h1>
		<ul class="pager">
			<?php
				previous_post_link( '<li class="">%link</li>', _x( '<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', 'bstrap-lite' ) );
				next_post_link(     '<li class="">%link</li>',     _x( '%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link',     'bstrap-lite' ) );
			?>
		</ul><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;
 
if ( ! function_exists( 'bstrap_lite_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function bstrap_lite_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'bstrap-lite' ),
		'<i class="fa fa-calendar"></i><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);
	echo '<span class="posted-on">' . $posted_on . '</span>';

	if ( is_single()){
		$byline = sprintf(
			esc_html_x( 'by %s', 'post author', 'bstrap-lite' ),
			'<span class="author vcard"><i class="fa fa-user"></i><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);
		echo '<span class="byline"> ' . $byline . '</span>';
	}
		
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'bstrap-lite' ) );
		if ( $categories_list && bstrap_lite_categorized_blog() ) {
			printf( '<span class="cat-links"><i class="fa fa-folder-open"></i>' . esc_html__( 'Posted in %1$s', 'bstrap-lite' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}
	}
	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link"><i class="fa fa-comments-o"></i>';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'bstrap-lite' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}
	echo '<span><i class="fa fa-eye"></i><span class="pull-right">' . getPostViews((int)get_the_ID()) . '</span></span>';
}
endif;

if ( ! function_exists( 'bstrap_lite_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function bstrap_lite_entry_footer() {
	
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ' ', 'bstrap-lite' ) );
		if ( $tags_list ) {
			/*$newtags_list = str_replace('rel="tag"', 'rel="tag" class="label label-default"', $tags_list);*/
			printf( '<span class="tags-links"><i class="fa fa-tags"></i>' . esc_html__( 'Tagged %1$s', 'bstrap-lite' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'bstrap-lite' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link pull-right">',
		'</span>'
	);
}
endif;

/**function custom_edit_post_link($output) {

 $output = str_replace('class="post-edit-link"', 'class="post-edit-link btn btn-danger btn-xs"', $output);
 return $output;
}
add_filter('edit_post_link', 'custom_edit_post_link');*/


/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function bstrap_lite_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'bstrap_lite_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'bstrap_lite_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so bstrap_lite_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so bstrap_lite_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in bstrap_lite_categorized_blog.
 */
function bstrap_lite_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'bstrap_lite_categories' );
}
add_action( 'edit_category', 'bstrap_lite_category_transient_flusher' );
add_action( 'save_post',     'bstrap_lite_category_transient_flusher' );
