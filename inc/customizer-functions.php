<?php
/**
 * Quota Theme Customizer
 */
function quota_customize_register( $wp_customize ) {
	
	
	/** ===============
	 * Extends controls class to add textarea
	 */
	class quota_customize_textarea_control extends WP_Customize_Control {
		public $type = 'textarea';
		public function render_content() { ?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea rows="5" style="width:98%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
			<?php
		}
	}
	
	
	/** ===============
	 * Site Title, Logo, Tagline
	 */
	// change section title
	$wp_customize->get_section( 'title_tagline' )->title = __( 'Site Title (Logo) & Tagline', 'quota' );
	$wp_customize->get_section( 'title_tagline' )->priority = 10;
	
	// site title settings
	$wp_customize->get_control( 'blogname' )->priority = 10;
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	
	// Image uploader setting
	$wp_customize->add_setting( 'quota_logo', array( 'default' => null ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'quota_logo', array(
		'label'		=> __( 'Custom Site Logo', 'quota' ),
		'section'	=> 'title_tagline',
		'settings'	=> 'quota_logo',
		'priority'	=> 20
	) ) );
	
	// tagline settings
	$wp_customize->get_control( 'blogdescription' )->priority = 30;
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	
	
	/** ===============
	 * Color Options
	 */
	// change title
	$wp_customize->get_section( 'colors' )->title = __( 'Color Settings', 'quota' );
	// change priority
	$wp_customize->get_section( 'colors' )->priority = 20;
	 	 
	// Color customization options
	$colors = array();
	$colors[] = array(
		'slug'		=> 'quota_primary_color', 
		'default'	=> '#0c6b9b',
		'label'		=> __( 'Primary Design Color', 'quota' ),
		'priority'	=> 20
	);
	$colors[] = array(
		'slug'		=> 'quota_primary_color_hover', 
		'default'	=> '#034f75',
		'label'		=> __( 'Primary Design Color - Hover', 'quota' ),
		'priority'	=> 21
	);
	$colors[] = array(
		'slug'		=> 'quota_secondary_color', 
		'default'	=> '#75ba95',
		'label'		=> __( 'Secondary Design Color', 'quota' ),
		'priority'	=> 22
	);
	$colors[] = array(
		'slug'		=>'quota_secondary_color_hover', 
		'default'	=> '#5e9678',
		'label'		=> __( 'Secondary Design Color - Hover', 'quota' ),
		'priority'	=> 23
	);
	$colors[] = array(
		'slug'		=> 'quota_text_color', 
		'default'	=> '#404040',
		'label'		=> __( 'Main Text Color', 'quota' ),
		'priority'	=> 24
	);
	// Build settings from $colors array
	foreach( $colors as $color ) {
	
		// customizer settings
		$wp_customize->add_setting( $color['slug'], array(
			'default'		=> $color['default'],
			'type'			=> 'option', 
			'capability'	=> 'edit_theme_options'
		) );
		
		// customizer controls
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $color['slug'], array(
			'label'		=> $color['label'], 
			'section'	=> 'colors',
			'settings'	=> $color['slug'],
			'priority'	=> $color['priority']
		) ) );
	}


	/** ===============
	 * Content Options
	 */
	$wp_customize->add_section( 'quota_content_section', array(
    	'title'			=> __( 'Content Options', 'quota' ),
		'description'	=> __( 'Adjust the display of content on your website. All options have a default value that can be left as-is but you are free to customize.', 'quota' ),
		'priority'		=> 30,
	) );
	
	// excerpts or full posts
	$wp_customize->add_setting( 'quota_post_content', array(
		'default'			=> 'option2',
		'sanitize_callback'	=> 'sanitize_quota_checkbox'
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'quota_post_content', array(
		'label'		=> __( 'Enable Post Excerpts', 'quota' ),
		'section'	=> 'quota_content_section',
		'type'		=> 'checkbox',
		'priority'	=> 10,
		'choices'	=> array( /* only for backwards compatibility -- forgive me */
		    'option1'	=> 'option1',
		    'option2'	=> 'option2',
		),
	) ) );
	
	// read more link
	$wp_customize->add_setting( 'quota_read_more', array(
		'default'			=> __( 'Read More', 'quota' ) . '<i class="fa fa-arrow-circle-right button-icon"></i>',
		'sanitize_callback'	=> 'quota_sanitize_text'
	) );
	$wp_customize->add_control( 'quota_read_more', array(
	    'label' 	=> __( 'Excerpt & More Link Text', 'quota' ),
	    'section' 	=> 'quota_content_section',
		'priority'	=> 20,
	) );
	
	// feed featured images
	$wp_customize->add_setting( 'quota_feed_featured_image', array(
		'default'			=> 'option1',
		'sanitize_callback'	=> 'sanitize_quota_checkbox'
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'quota_feed_featured_image', array(
		'label'		=> __( 'Display Featured Images on Post Listings', 'quota' ),
		'section'	=> 'quota_content_section',
		'type'		=> 'checkbox',
		'priority'	=> 30,
		'choices'	=> array( /* only for backwards compatibility -- forgive me */
		    'option1'	=> 'option1',
		    'option2'	=> 'option2',
		),
	) ) );
	
	// single featured images
	$wp_customize->add_setting( 'quota_single_featured_image', array(
		'default'			=> 'option1',
		'sanitize_callback'	=> 'sanitize_quota_checkbox'
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'quota_single_featured_image', array(
		'label'		=> __( 'Display Featured Images on Single Posts', 'quota' ),
		'section'	=> 'quota_content_section',
		'type'		=> 'checkbox',
		'priority'	=> 40,
		'choices'	=> array( /* only for backwards compatibility -- forgive me */
		    'option1'	=> 'option1',
		    'option2'	=> 'option2',
		),
	) ) );
	
	// single post footer
	$wp_customize->add_setting( 'quota_post_footer', array(
		'default'			=> 'option1',
		'sanitize_callback'	=> 'sanitize_quota_checkbox'
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'quota_post_footer', array(
		'label'		=> __( 'Display Post Footer on Single Posts', 'quota' ),
		'section'	=> 'quota_content_section',
		'type'		=> 'checkbox',
		'priority'	=> 50,
		'choices'	=> array( /* only for backwards compatibility -- forgive me */
		    'option1'	=> 'option1',
		    'option2'	=> 'option2',
		),
	) ) );
	
	// page comments
	$wp_customize->add_setting( 'quota_page_comments', array(
		'default'			=> 'option2',
		'sanitize_callback'	=> 'sanitize_quota_checkbox'
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'quota_page_comments', array(
		'label'		=> __( 'Display Comments on Standard Pages', 'quota' ),
		'section'	=> 'quota_content_section',
		'type'		=> 'checkbox',
		'priority'	=> 60,
		'choices'	=> array( /* only for backwards compatibility -- forgive me */
		    'option1'	=> 'option1',
		    'option2'	=> 'option2',
		),
	) ) );
	
	// site footer info
	$wp_customize->add_setting( 'quota_credits_copyright', array(
		'default'			=> null,
		'sanitize_callback'	=> 'quota_sanitize_text'
	) );
	$wp_customize->add_control( 'quota_credits_copyright', array(
	    'label'		=> __( 'Footer Credits & Copyright', 'quota' ),
	    'section'	=> 'quota_content_section',
		'priority'	=> 70,
	) );


	/** ===============
	 * EDD Options
	 */
	$wp_customize->add_section( 'quota_edd_options', array(
    	'title'			=> __( 'Easy Digital Downloads', 'quota' ),
		'description'	=> __( 'All other EDD options are under Dashboard => Downloads.', 'quota' ),
		'priority'		=> 40,
	) );
	
	// store front main headline
	$wp_customize->add_setting( 'quota_store_front_headlines', array(
		'default'			=> null,
		'sanitize_callback'	=> 'quota_sanitize_text'
	) );
	$wp_customize->add_control( 'quota_store_front_headlines', array(
	    'label'		=> __( 'Store Front Headline', 'quota' ),
	    'section'	=> 'quota_edd_options',
		'priority'	=> 10,
	) );
	
	// store front/downloads archive description
	$wp_customize->add_setting( 'quota_store_archives_description', array(
		'default'			=> null,
		'sanitize_callback'	=> 'quota_sanitize_textarea'
	) );
	$wp_customize->add_control( new quota_customize_textarea_control( $wp_customize, 'quota_store_archives_description', array(
		'label'		=> __( 'Store Front Description', 'presentation' ),
		'section'	=> 'quota_edd_options',
		'priority'	=> 20,
	) ) );
	
	// view details button
	$wp_customize->add_setting( 'quota_product_info_button', array(
		'default'			=> __( 'View Details', 'quota' ),
		'sanitize_callback'	=> 'quota_sanitize_text'
	) );
	$wp_customize->add_control( 'quota_product_info_button', array(
	    'label'		=> __( 'Store Front Item Detail Button', 'quota' ),
	    'section'	=> 'quota_edd_options',
		'priority'	=> 30,
	) );
	
	// store front item count
	$wp_customize->add_setting( 'quota_store_front_count', array(
		'default'			=> 9,
		'sanitize_callback'	=> 'quota_sanitize_integer'
	) );		
	$wp_customize->add_control( 'quota_store_front_count', array(
	    'label'		=> __( 'Store Front Item Count', 'quota' ),
	    'section'	=> 'quota_edd_options',
		'priority'	=> 40,
	) );
	
	// download comments
	$wp_customize->add_setting( 'quota_download_comments', array(
		'default'			=> 'option2',
		'sanitize_callback'	=> 'sanitize_quota_checkbox'
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'quota_download_comments', array(
		'label'		=> __( 'Display Comments on Download Pages', 'quota' ),
		'section'	=> 'quota_edd_options',
		'type'		=> 'checkbox',
		'priority'	=> 50,
		'choices'	=> array( /* only for backwards compatibility -- forgive me */
		    'option1'	=> 'option1',
		    'option2'	=> 'option2',
		),
	) ) );


	/** ===============
	 * Navigation Options
	 */
	// change title
	$wp_customize->get_section( 'nav' )->title = __( 'Navigation Menu', 'quota' );
	// change priority
	$wp_customize->get_section( 'nav' )->priority = 50;


	/** ===============
	 * Front Page Options
	 */
	// change title
	$wp_customize->get_section( 'static_front_page' )->priority = 60;


	/** ===============
	 * Social Networking Options
	 */
	$wp_customize->add_section( 'quota_social_networks', array(
    	'title'			=> __( 'Social Networking Profiles', 'quota' ),
		'description'	=> __( 'Paste full URLs to profiles. The URLs will be used in various places around the theme like the post footer author section on single posts.', 'quota' ),
		'priority'		=> 70,
	) );
	
	// twitter URL
	$wp_customize->add_setting( 'quota_twitter', array(
		'default'			=> null,
		'sanitize_callback'	=> 'quota_sanitize_text'
	) );
	$wp_customize->add_control( 'quota_twitter', array(
	    'label'		=> __( 'Twitter Profile URL', 'quota' ),
	    'section'	=> 'quota_social_networks',
		'priority'	=> 10,
	) );
	
	// Facebook URL
	$wp_customize->add_setting( 'quota_facebook', array(
		'default'			=> null,
		'sanitize_callback'	=> 'quota_sanitize_text'
	) );
	$wp_customize->add_control( 'quota_facebook', array(
	    'label'		=> __( 'Facebook Profile URL', 'quota' ),
	    'section'	=> 'quota_social_networks',
		'priority'	=> 20,
	) );
	
	// Google+ URL
	$wp_customize->add_setting( 'quota_gplus', array(
		'default'			=> null,
		'sanitize_callback'	=> 'quota_sanitize_text'
	) );
	$wp_customize->add_control( 'quota_gplus', array(
	    'label'		=> __( 'Google+ Profile URL', 'quota' ),
	    'section'	=> 'quota_social_networks',
		'priority'	=> 30,
	) );
	
	// LinkedIn URL
	$wp_customize->add_setting( 'quota_linkedin', array(
		'default'			=> null,
		'sanitize_callback'	=> 'quota_sanitize_text'
	) );
	$wp_customize->add_control( 'quota_linkedin', array(
	    'label'		=> __( 'LinkedIn Profile URL', 'quota' ),
	    'section'	=> 'quota_social_networks',
		'priority'	=> 40,
	) );
}
add_action( 'customize_register', 'quota_customize_register' );


/** ===============
 * Sanitize checkbox
 *
 * I had to get a little silly here because of the version 1.0 customizer
 * setup in which these options were radio inputs. In order to maintain
 * backwards compatibility for users who already chose their settings,
 * the checkbox options have specific values that match with the radio
 * inputs used to be. It's easier and hurts no one. :)
 */
function sanitize_quota_checkbox( $input ) {
    $valid = array( 'option1', 'option2' );
 
    if ( 'option1' == $input ) {
        return 'option1';
    } else {
        return 'option2';
    }
}


/** ===============
 * Sanitize text input
 */
function quota_sanitize_text( $input ) {
    return strip_tags( stripslashes( $input ) );
}


/** ===============
 * Sanitize textarea
 */
function quota_sanitize_textarea( $input ) {
	$allowed = array(
		'a' => array(
			'href' => true,
			'title' => true,
		),
		'abbr' => array(
			'title' => true,
		),
		'acronym' => array(
			'title' => true,
		),
		'b' => array(),
		'blockquote' => array(
			'cite' => true,
		),
		'cite' => array(),
		'code' => array(),
		'del' => array(
			'datetime' => true,
		),
		'em' => array(),
		'i' => array(),
		'q' => array(
			'cite' => true,
		),
		'strike' => array(),
		'strong' => array(),
	);
    return wp_kses( $input, $allowed );
}


/** ===============
 * Sanitize integer input
 */
function quota_sanitize_integer( $input ) {
	return absint( $input );
}


/** ===============
 * Add Quota theme Customizer color style options to <head>
 */
function quota_customizer_head_styles() {
	$quota_primary_color = get_option( 'quota_primary_color' );
	$quota_primary_color_hover = get_option( 'quota_primary_color_hover' );
	$quota_secondary_color = get_option( 'quota_secondary_color' );
	$quota_secondary_color_hover = get_option( 'quota_secondary_color_hover' );
	$quota_text_color = get_option( 'quota_text_color' ); 
	
	echo '<style type="text/css">';
		
		/**
		 * Only add styles to the head of the document if the styles
		 * have been changed from default. 
		 */	
		 
		// Primary design color
		if ('#0c6b9b' != $quota_primary_color ) :
			echo "a, .navigation-main a:hover, .headline-text { color: {$quota_primary_color}; }\nbutton, html input[type=\"button\"], input[type=\"reset\"], input[type=\"submit\"], .button, .product-button, .more-link, .widget_calendar table caption, .widget_edd_downloads_calendar table caption, #edd_checkout_form_wrap legend { background-color: {$quota_primary_color}; }\n.headline-text a:hover { border-bottom: 2px solid {$quota_primary_color}; }";		
		endif;
		
		// Primary design color - hover
		if ('#034f75' != $quota_primary_color_hover ) :
			echo "button:hover, .product-button:hover, html input[type=\"button\"]:hover, input[type=\"reset\"]:hover, input[type=\"submit\"]:hover, .button:hover, .more-link:hover { background-color: {$quota_primary_color_hover}; }\n";		
		endif;
		
		// Secondary design color
		if ('#75ba95' != $quota_secondary_color ) :
			echo ".site-title a, .headline .social-icons a:hover { color: {$quota_secondary_color}; }\n.widget_calendar table > thead > tr, .widget_edd_downloads_calendar table > thead > tr, .single-post-footer { background-color: {$quota_secondary_color}; }\n.bypostauthor .comment-author { border-left: 3px solid {$quota_secondary_color}; }";		
		endif;
		
		// Secondary design color - hover
		if ('#5e9678' != $quota_secondary_color_hover ) :
			echo ".site-title a:hover { color: {$quota_secondary_color_hover}; }\n";		
		endif;
		
		// Primary text color
		if ('#404040' != $quota_text_color ) :
			echo "body, button, input, select, textarea, a.entry-title, .product-title, .edd_download_title a, .featured-downloads-title, .product-sidebar-price, .widget-title, .single-post-footer .post-footer-body, .menu-toggle, .entry-meta a, .comment-author a, .navigation-post a, .navigation-paging a, .navigation-image a, .widget_calendar table > tfoot td a, .widget_edd_downloads_calendar table > tfoot td a, .widget_recent_comments .recentcomments a:first-child, .widget_rss .rss-date { color: {$quota_text_color}; }\n";		
		endif; 
		
		// Responsive
		// Primary design color
		if ('#0c6b9b' != $quota_primary_color ) :
			echo "@media all and (max-width: 768px) { .headline-area { background: {$quota_primary_color}; } .headline-text { color: #fff; } }";
		endif;
	
	echo '</style>';
	
}
add_action( 'wp_head', 'quota_customizer_head_styles' );



/** ===============
 * Add Customizer style to the <head> only on Customizer page
 */
function quota_customizer_styles() { ?>
	<style type="text/css">
		body { background: #fff; }
		#customize-controls #customize-theme-controls .description { display: block; color: #999; margin: 2px 0 15px; font-style: italic; }
		textarea, input, select, .customize-description { font-size: 12px !important; }
		.customize-control-title { font-size: 13px !important; margin: 10px 0 3px !important; }
		.customize-control label { font-size: 12px !important; }
		#customize-control-quota_read_more, #customize-control-quota_store_front_count { margin-bottom: 1.5em; }
		#customize-control-quota_store_front_count input { width: 50px; }
	</style>
<?php }
add_action( 'customize_controls_print_styles', 'quota_customizer_styles' );



/** ===============
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function quota_customize_preview_js() {
	wp_enqueue_script( 'quota_customizer', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview' ), '20130601', true );
}
add_action( 'customize_preview_init', 'quota_customize_preview_js' );