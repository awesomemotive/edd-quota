<?php
/**
 * Quota Theme Customizer
 */
 


function quota_customize_register( $wp_customize ) {



	/** ===============
	 * Extends SECTIONS class to add description text
	 */
	class quota_custom_section extends WP_Customize_Section {
		public $description = '';
		protected function render() { ?>
		
		<li id="accordion-section-<?php echo esc_attr( $this->id ); ?>" class="control-section accordion-section customize-section">
			<h3 class="accordion-section-title customize-section-title" tabindex="0"><?php echo esc_html( $this->title ); ?></h3>
			<ul class="accordion-section-content customize-section-content">
				<span class="customize-description"><?php echo esc_html( $this->description ); ?></span>
				<?php
				foreach ( $this->controls as $control )
					$control->maybe_render();
				?>
			</ul>
		</li>
		
		<?php }
	}



	/** ===============
	 * Add NEW Quota customizer SECTIONS
	 */
	$add_sections = array(
		'content'			=> array(
			'id'			=> 'quota_content_section',
			'title'			=> __( 'Content Options', 'quota' ),
			'description'	=> __( 'Adjust the display of content on your website. All options have a default value that can be left as-is but you are free to customize.', 'quota' ),
			'priority'		=> 30
		),
		'edd'				=> array(
			'id'			=> 'quota_edd_options',
			'title'			=> __( 'Easy Digital Downloads', 'quota' ),
			'description'	=> __( 'You must set the "Store Front Headline" if using the Store Front page template. All other EDD options are under Dashboard => Downloads.', 'quota' ),
			'priority'		=> 40
		),
		'social networks'	=> array(
			'id'			=> 'quota_social_networks',
			'title'			=> __( 'Social Networking Profiles', 'quota' ),
			'description'	=> __( 'Paste full URLs to profiles. The URLs will be used in various places around the theme like the post footer author section on single posts.', 'quota' ),
			'priority'		=> 70
		),
	);
	// Build the sections based on the $add_sections array
	foreach ( $add_sections as $section ) {
		$wp_customize->add_section( new quota_custom_section( $wp_customize, $section[ 'id' ], array(
	    	'title'       	=> $section[ 'title' ],
			'description' 	=> $section[ 'description' ],
			'priority'   	=> $section[ 'priority' ],
		) ) );
	}
	
	
	
	/** ===============
	 * Add NEW Quota customizer SETTINGS
	 */
	$add_settings = array(
		'store front title'	=> array(
			'id'			=> 'quota_store_front_headlines',
			'default'		=> null
		),
		'site copyright'	=> array(
			'id'			=> 'quota_credits_copyright',
			'default'		=> null
		),
		'post content'		=> array(
			'id'			=> 'quota_post_content',
			'default'		=> 'option2'
		),
		'excerpt link'		=> array(
			'id'			=> 'quota_read_more',
			'default'		=> 'Read More &rarr;'
		),
		'featured img'		=> array(
			'id'			=> 'quota_single_featured_image',
			'default'		=> 'option1'
		),
		'post footer'		=> array(
			'id'			=> 'quota_post_footer',
			'default'		=> 'option1'
		),
		'page comments'		=> array(
			'id'			=> 'quota_page_comments',
			'default'		=> 'option2'
		),
		'download comments'	=> array(
			'id'			=> 'quota_download_comments',
			'default'		=> 'option2'
		),
		'product button'	=> array(
			'id'			=> 'quota_product_info_button',
			'default'		=> 'View Details'
		),
		'twitter'			=> array(
			'id'			=> 'quota_twitter',
			'default'		=> null
		),
		'facebook'			=> array(
			'id'			=> 'quota_facebook',
			'default'		=> null
		),
		'gplus'				=> array(
			'id'			=> 'quota_gplus',
			'default'		=> null
		),
		'linkedin'				=> array(
			'id'			=> 'quota_linkedin',
			'default'		=> null
		),
	);
	// Build the settings based on the $add_settings
	foreach ( $add_settings as $setting ) {
		$wp_customize->add_setting( $setting[ 'id' ], array( 
			'default' => $setting[ 'default' ] 
		) );
	}
	
	
	
	/** ===============
	 * Add NEW Quota customizer CONTROLS ** by control type **
	 */	
	
	// Text input control types
	$add_text_controls = array(
		'quota_store_front_headlines'	=> array(
			'id'		=> 'quota_store_front_headlines',
			'label'		=> __( 'Store Front Headline', 'quota' ),
			'section'	=> 'quota_edd_options',
			'settings'	=> 'quota_store_front_headlines',
		),
		'quota_credits_copyright'	=> array(
			'id'		=> 'quota_credits_copyright',
			'label'		=> __( 'Footer Credits & Copyright', 'quota' ),
			'section'	=> 'quota_content_section',
			'settings'	=> 'quota_credits_copyright',
		),
		'quota_read_more'	=> array(
			'id'		=> 'quota_read_more',
			'label'		=> __( 'Excerpt & More Link Text', 'quota' ),
			'section'	=> 'quota_content_section',
			'settings'	=> 'quota_read_more',
		),
		'quota_product_info_button'	=> array(
			'id'		=> 'quota_product_info_button',
			'label'		=> __( 'Store Front Item Detail Button', 'quota' ),
			'section'	=> 'quota_edd_options',
			'settings'	=> 'quota_product_info_button',
		),
		'quota_twitter'	=> array(
			'id'		=> 'quota_twitter',
			'label'		=> __( 'Twitter Profile URL', 'quota' ),
			'section'	=> 'quota_social_networks',
			'settings'	=> 'quota_twitter',
		),
		'quota_facebook'	=> array(
			'id'		=> 'quota_facebook',
			'label'		=> __( 'Facebook Profile URL', 'quota' ),
			'section'	=> 'quota_social_networks',
			'settings'	=> 'quota_facebook',
		),
		'quota_gplus'	=> array(
			'id'		=> 'quota_gplus',
			'label'		=> __( 'Google Plus Profile URL', 'quota' ),
			'section'	=> 'quota_social_networks',
			'settings'	=> 'quota_gplus',
		),
		'quota_linkedin'	=> array(
			'id'		=> 'quota_linkedin',
			'label'		=> __( 'LinkedIn Profile URL', 'quota' ),
			'section'	=> 'quota_social_networks',
			'settings'	=> 'quota_linkedin',
		),
	);
	// Build the text input controls based on the $add_text_controls
	foreach ( $add_text_controls as $control ) {
		$wp_customize->add_control( $control[ 'id' ], array(
		    'label' 	=> $control[ 'label' ],
		    'section' 	=> $control[ 'section' ],
			'settings' 	=> $control[ 'settings' ]
		) );
	}
	
	
	// Radio input control types	
	$add_radio_controls = array(
		'quota_post_content'	=> array(
			'id'		=> 'quota_post_content',
			'label'		=> __( 'Post Feed Content', 'quota' ),
			'section'	=> 'quota_content_section',
			'settings'	=> 'quota_post_content',
			'option1'	=> 'Excerpts',
			'option2'	=> 'Full Content'
		),
		'quota_single_featured_image'	=> array(
			'id'		=> 'quota_single_featured_image',
			'label'		=> __( 'Show Featured Images on Single Posts?', 'quota' ),
			'section'	=> 'quota_content_section',
			'settings'	=> 'quota_single_featured_image',
			'option1'	=> 'Yes',
			'option2'	=> 'No'
		),
		'quota_post_footer'	=> array(
			'id'		=> 'quota_post_footer',
			'label'		=> __( 'Show Post Footer on Single Posts?', 'quota' ),
			'section'	=> 'quota_content_section',
			'settings'	=> 'quota_post_footer',
			'option1'	=> 'Yes',
			'option2'	=> 'No'
		),
		'quota_page_comments'	=> array(
			'id'		=> 'quota_page_comments',
			'label'		=> __( 'Display Comments on Standard Pages?', 'quota' ),
			'section'	=> 'quota_content_section',
			'settings'	=> 'quota_page_comments',
			'option1'	=> 'Yes',
			'option2'	=> 'No'
		),
		'quota_download_comments'	=> array(
			'id'		=> 'quota_download_comments',
			'label'		=> __( 'Display Comments on Download Pages?', 'quota' ),
			'section'	=> 'quota_edd_options',
			'settings'	=> 'quota_download_comments',
			'option1'	=> 'Yes',
			'option2'	=> 'No'
		),
	);
	// Build the radio input controls based on the $add_radio_controls
	foreach ( $add_radio_controls as $control ) {
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, $control[ 'id' ], array(
			'label'     => $control[ 'label' ],
			'section'   => $control[ 'section' ],
			'settings'  => $control[ 'settings' ],
			'type'      => 'radio',
			'choices'   => array(
			    'option1'   => $control[ 'option1' ],
			    'option2'   => $control[ 'option2' ],
			),
		) ) );
	}
    
	
	
	/** ===============
	 * Add to, take away from, and edit EXISTING WordPress sections
	 */
	
	// Image uploader setting
	$wp_customize->add_setting( 'quota_logo', array( 'default' => null ) );
	 
	// Image uploader control
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'quota_logo', array(
		'label'    => __( 'Custom Site Logo', 'quota' ),
		'section'  => 'title_tagline',
		'settings' => 'quota_logo',
	) ) );
	 	 
	// Color customization options
	$colors = array();
	$colors[] = array(
		'slug'=>'quota_primary_color', 
		'default' => '#0c6b9b',
		'label' => __('Primary Design Color', 'Quota')
	);
	$colors[] = array(
		'slug'=>'quota_primary_color_hover', 
		'default' => '#034f75',
		'label' => __('Primary Design Color - Hover', 'Quota')
	);
	$colors[] = array(
		'slug'=>'quota_secondary_color', 
		'default' => '#75ba95',
		'label' => __('Secondary Design Color', 'Quota')
	);
	$colors[] = array(
		'slug'=>'quota_secondary_color_hover', 
		'default' => '#5e9678',
		'label' => __('Secondary Design Color - Hover', 'Quota')
	);
	$colors[] = array(
		'slug'=>'quota_text_color', 
		'default' => '#404040',
		'label' => __('Main Text Color', 'Quota')
	);
	// Build settings from $colors array
	foreach( $colors as $color ) {
	
		// customizer settings
		$wp_customize->add_setting( $color['slug'], array(
				'default' => $color['default'],
				'type' => 'option', 
				'capability' => 
				'edit_theme_options'
			)
		);
		
		// customizer controls
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $color['slug'], array(
				'label' => $color['label'], 
				'section' => 'colors',
				'settings' => $color['slug'])
			)
		);
	}
	
	/**
	 * change default section titles
	 */
	$wp_customize->get_section( 'title_tagline' )->title = __( 'Site Title (Logo) & Tagline', 'quota' );
	$wp_customize->get_section( 'colors' )->title = __( 'Color Settings', 'quota' );
	$wp_customize->get_section( 'nav' )->title = __( 'Navigation Menu', 'quota' );
	
	/**
	 * change default section order
	 */
	$wp_customize->get_section( 'title_tagline' )->priority = 10;
	$wp_customize->get_section( 'colors' )->priority = 20;
	$wp_customize->get_section( 'nav' )->priority = 50;
	$wp_customize->get_section( 'static_front_page' )->priority = 60;
	
	
	
	/** ===============
	 * live updates for better user experience
	 */
	$post_message = array( 
		'blogname', 
		'blogdescription', 
		'quota_store_front_headlines', 
		'quota_credits_copyright',
		'quota_read_more',
		'quota_product_info_button'
	);
	foreach ( $post_message as $pm ) {
		$wp_customize->get_setting( $pm )->transport = 'postMessage';
	}
}
add_action( 'customize_register', 'quota_customize_register' );



/** ===============
 * Add Quota theme Customizer color style options to <head>
 */
function quota_customizer_head_styles() {
	$quota_primary_color = get_option('quota_primary_color');
	$quota_primary_color_hover = get_option('quota_primary_color_hover');
	$quota_secondary_color = get_option('quota_secondary_color');
	$quota_secondary_color_hover = get_option('quota_secondary_color_hover');
	$quota_text_color = get_option('quota_text_color'); 
	
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
			echo ".site-title a { color: {$quota_secondary_color}; }\n.widget_calendar table > thead > tr, .widget_edd_downloads_calendar table > thead > tr, .single-post-footer { background-color: {$quota_secondary_color}; }\n.bypostauthor .comment-author { border-left: 3px solid {$quota_secondary_color}; }";		
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
add_action( 'wp_head','quota_customizer_head_styles' );



/** ===============
 * Add Customizer style to the <head> only on Customizer page
 */
function quota_customizer_styles() { ?>
	<style type="text/css">
		.customize-description { display: block; color: #999; margin: 10px 0 1em; font-style: italic; }
	</style>
<?php }
add_action('customize_controls_print_styles', 'quota_customizer_styles');



/** ===============
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function quota_customize_preview_js() {
	wp_enqueue_script( 'quota_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130601', true );
}
add_action( 'customize_preview_init', 'quota_customize_preview_js' );