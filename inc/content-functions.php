<?php
/**
 * these functions apply directly Quota's content
 */



/** ===============
 * Social networking profiles for post footer and headline
 */
function quota_social_profiles() {
	/**
	 * Built into the Customizer are a fields for social networking
	 * profiles. Using the following array, check to see if the field
	 * has a URL. If so, create a link for that profile in the post
	 * footer. If not, do nothing.
	 */
	$social_profiles = array( 
		'twitter'	=> array(
			'name' 		=> 'Twitter',
			'option'	=> get_theme_mod( 'quota_twitter' ),
			'icon'		=> '<i class="fa fa-twitter-square"></i>',
		),
		'facebook'	=> array(
			'name' 		=> 'Facebook',
			'option'	=> get_theme_mod( 'quota_facebook' ),
			'icon'		=> '<i class="fa fa-facebook-square"></i>',
		),
		'gplus'	=> array(
			'name' 		=> 'Google+',
			'option'	=> get_theme_mod( 'quota_gplus' ),
			'icon'		=> '<i class="fa fa-google-plus-square"></i>',
		),
		'linkedin'	=> array(
			'name' 		=> 'Linkedin',
			'option'	=> get_theme_mod( 'quota_linkedin' ),
			'icon'		=> '<i class="fa fa-linkedin-square"></i>',
		),
	);
	// Build the social networking profile links based on the $social_profiles
	foreach ( $social_profiles as $profile ) {
		if ( $profile[ 'option' ] ) :
			if ( is_single() ) : ?>
				<a href="<?php echo esc_url( $profile[ 'option' ] ); ?>"><?php echo $profile[ 'name' ]; ?></a> 
				<?php
			elseif ( ( is_home() && is_front_page() ) || ( is_front_page() && ! is_home() ) ) : ?>
				<a href="<?php echo esc_url( $profile[ 'option' ] ); ?>"><?php echo $profile[ 'icon' ]; ?></a> 
				<?php
			endif;
		endif;
	}
}
add_action( 'quota_author_box', 'quota_social_profiles' );
add_action( 'quota_front_page_headline', 'quota_social_profiles' );


/** ===============
 * Register sidebar areas and update sidebars with default widgets
 */
function quota_widgets_init() {
	
	/**
	 * Array with unique information about the various widgetized areas
	 */
	$register_sidebars = array(
		'main'			=> array(
			'name'			=> __( 'Sidebar', 'quota' ),
			'id'			=> 'sidebar-1',
			'description'	=> __( 'This is the main sidebar that will display on all standard layout pages except for product download pages.', 'quota' ),
		),
		'download'			=> array(
			'name'          => __( 'Download Sidebar', 'quota' ),
			'id'            => 'sidebar-download',
			'description'	=> __( 'This sidebar appears only on single download pages.', 'quota' ),
		),
	);
	// Register all widgetized areas based on the $register_sidebars information
	foreach ( $register_sidebars as $sidebars ) {
		register_sidebar( array(
			'name'			=> $sidebars[ 'name' ],
			'id'			=> $sidebars[ 'id' ],
			'description'	=> $sidebars[ 'description' ],
			'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</aside>',
			'before_title'	=> '<h4 class="widget-title">',
			'after_title'	=> '</h4>',
		) );
	}
}
add_action( 'widgets_init', 'quota_widgets_init' );



/** ===============
 * Adds custom classes to the array of body classes
 */
function quota_body_classes( $classes ) {

	if ( is_page_template( 'edd-store-front.php' ) ) :
	
		// add .store-front body class to pages that use the Store Front template
		$classes[] = 'store-front';
	elseif ( is_page_template( 'landing.php' ) ) :
	
		// add .landing body class to pages that use the Landing template
		$classes[] = 'landing';
	endif;
	
	if ( is_multi_author() ) 
		$classes[] = 'group-blog';
		
	return $classes;
}
add_filter( 'body_class', 'quota_body_classes');



/** ===============
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 */
function quota_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', 'quota' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'quota_wp_title', 10, 2 );



/** ===============
 * Replace excerpt ellipses with new ellipses and link to full article
 */
function quota_excerpt_more( $more ) {
	return '...</p> <p><a class="more-link button" href="' . get_permalink( get_the_ID() ) . '">' . get_theme_mod( 'quota_read_more', __( 'Read More &rarr;', 'quota' ) ) . '</a></p>';
}
add_filter( 'excerpt_more', 'quota_excerpt_more' );



/** ===============
 * Protected posts custom password form
 */
function quota_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    
    $o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post"><p class="password-protected">
    ' . __( 'To view this protected post, enter the password below:', 'quota' ) . '</p>
    <input name="post_password" class="post-password" id="' . $label . '" type="password" size="20" placeholder="Enter Password" /><input type="submit" name="Submit" value="' . esc_attr__( 'Submit' ) . '" />
    </form>';
    
    return $o;
}
add_filter( 'the_password_form', 'quota_password_form' );



/** ===============
 * Only show regular posts in search results
 */
function quota_search_filter($query) {
	if ($query->is_search)
		$query->set('post_type', 'post');
	return $query;
}
add_filter('pre_get_posts','quota_search_filter');



/** ===============
 * Display navigation to next/previous pages when applicable
 */
if ( ! function_exists( 'quota_content_nav' ) ) :

	function quota_content_nav( $nav_id ) {
		global $wp_query, $post;
	
		// Don't print empty markup on single pages if there's nowhere to navigate.
		if ( is_single() ) {
			$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
			$next = get_adjacent_post( false, '', false );
	
			if ( ! $next && ! $previous )
				return;
		}
	
		// Don't print empty markup in archives if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
			return;
	
		$nav_class = ( is_single() ) ? 'navigation-post' : 'navigation-paging';
	
		?>
		<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
			<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'quota' ); ?></h1>
	
		<?php if ( is_single() ) : // navigation links for single posts ?>
	
			<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'quota' ) . '</span> %title' ); ?>
			<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'quota' ) . '</span>' ); ?>
	
		<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>
	
			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'quota' ) ); ?></div>
			<?php endif; ?>
	
			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'quota' ) ); ?></div>
			<?php endif; ?>
	
		<?php endif; ?>
	
		</nav>
		<?php
	}
endif; // quota_content_nav



/** ===============
 * Prints the attached image with a link to the next attached image.
 */
if ( ! function_exists( 'quota_the_attached_image' ) ) :

	function quota_the_attached_image() {
		$post                = get_post();
		$attachment_size     = apply_filters( 'quota_attachment_size', array( 1200, 1200 ) );
		$next_attachment_url = wp_get_attachment_url();
	
		/**
		 * Grab the IDs of all the image attachments in a gallery so we can get the URL
		 * of the next adjacent image in a gallery, or the first image (if we're
		 * looking at the last image in a gallery), or, in a gallery of one, just the
		 * link to that image file.
		 */
		$attachments = array_values( get_children( array(
			'post_parent'    => $post->post_parent,
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => 'ASC',
			'orderby'        => 'menu_order ID'
		) ) );
	
		// If there is more than 1 attachment in a gallery...
		if ( count( $attachments ) > 1 ) {
			foreach ( $attachments as $k => $attachment ) {
				if ( $attachment->ID == $post->ID )
					break;
			}
			$k++;
	
			// get the URL of the next image attachment...
			if ( isset( $attachments[ $k ] ) )
				$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
	
			// or get the URL of the first image attachment.
			else
				$next_attachment_url = get_attachment_link( $attachments[0]->ID );
		}
	
		printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
			esc_url( $next_attachment_url ),
			the_title_attribute( array( 'echo' => false ) ),
			wp_get_attachment_image( $post->ID, $attachment_size )
		);
	}
endif; // quota_the_attached_image



/** ===============
 * Prints HTML with meta information for the current post-date/time and author.
 */
if ( ! function_exists( 'quota_posted_on' ) ) :

	function quota_posted_on() {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) )
			$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	
		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);
	
		printf( __( 'Posted on <a href="%1$s" title="%2$s" rel="bookmark">%3$s</a><span class="byline"> by <span class="author vcard"><a class="url fn n" href="%4$s" title="%5$s" rel="author">%6$s</a></span></span>', 'quota' ),
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			$time_string,
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'quota' ), get_the_author() ) ),
			get_the_author()
		);
	}
endif; // quota_posted_on



/** ===============
 * Returns true if a blog has more than 1 category
 */
function quota_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so quota_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so quota_categorized_blog should return false
		return false;
	}
}



/** ===============
 * Flush out the transients used in quota_categorized_blog
 */
function quota_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'quota_category_transient_flusher' );
add_action( 'save_post',     'quota_category_transient_flusher' );