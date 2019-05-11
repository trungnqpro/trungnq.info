<?php
/**
 * Blog Lite Theme Customizer.
 *
 * @package Blog_Lite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function blog_lite_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
}
add_action( 'customize_register', 'blog_lite_customize_register' );

/**
 * Options for Blog Lite Theme Customizer.
 */
function blog_lite_customizer( $wp_customize ) {


	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'blog_customize_partial_blogname',        
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'bloglite_customize_partial_blogdescription',
		
	) );


	$wp_customize->add_setting('blog_lite[site_identity]', array(
		'default' 			=> 'title-text',
		'sanitize_callback' => 'blog_lite_sanitize_select'
		));

	$wp_customize->add_control('blog_lite[site_identity]', array(
		'type' 		=> 'radio',
		'label' 	=> __('Show', 'blog-lite'),
		'section' 	=> 'title_tagline',
		'choices' 	=> array(
			'logo-only' 	=> __('Logo Only', 'blog-lite'),
			'logo-text' 	=> __('Logo + Tagline', 'blog-lite'),
			'title-only' 	=> __('Title Only', 'blog-lite'),
			'title-text' 	=> __('Title + Tagline', 'blog-lite')
			)
		));

	// Blog Lite Option Panel Starts
	$wp_customize->add_panel('blog_lite_basic_panel', array(
		'title'				=> __('Blog Lite Options', 'blog-lite'),
		'priority' 			=> 30,		
		'description' 	 	=> __('Option to change general settings', 'blog-lite') 
		));


	// Header Setting Section starts
	$wp_customize->add_section('blog_lite_header', array(    
		'title'       => __('Header', 'blog-lite'),
		'panel'       => 'blog_lite_basic_panel'    
		));	

	// Sticky header
	$wp_customize->add_setting('blog_lite[sticky_header]', array(
		'default'           => 1,		
		'sanitize_callback' => 'blog_lite_checkbox_sanitization'
		));

	$wp_customize->add_control('blog_lite[sticky_header]', array(
		'label'       => __('Enable sticky header', 'blog-lite'),
		'section'     => 'blog_lite_header',   
		'settings'    => 'blog_lite[sticky_header]',		
		'type'        => 'checkbox'
		));

	// Show top bar in header
	$wp_customize->add_setting('blog_lite[top_bar]', array(
		'default'           => 1,		
		'sanitize_callback' => 'blog_lite_checkbox_sanitization'
		));

	$wp_customize->add_control('blog_lite[top_bar]', array(
		'label'       => __('Show top header bar', 'blog-lite'),
		'section'     => 'blog_lite_header',   
		'settings'    => 'blog_lite[top_bar]',		
		'type'        => 'checkbox'
		));
	
	// Left part of top navigation
	$wp_customize->add_setting('blog_lite[top_bar_left]', array(
		'default' 			=> 'social-icons',
		'sanitize_callback' => 'blog_lite_sanitize_select',

		));

	$wp_customize->add_control('blog_lite[top_bar_left]', array(		
		'label' 	=> __('Top Bar Left Element', 'blog-lite'),
		'section' 	=> 'blog_lite_header',
		'settings'  => 'blog_lite[top_bar_left]',
		'type' 		=> 'radio',
		'choices' 	=> array(
			'social-icons' 	=> __('Social Icons', 'blog-lite'),
			'menu' 			=> __('Menu', 'blog-lite'),							
			'address' 		=> __('Address', 'blog-lite'),			
			),
		'active_callback' 	=> 'blog_lite_top_header_show',
		));

	// Right part of top navigation
	$wp_customize->add_setting('blog_lite[top_bar_right]', array(
		'default' 			=> 'search-form',		
		'sanitize_callback' => 'blog_lite_sanitize_select',			
		));

	$wp_customize->add_control('blog_lite[top_bar_right]', array(		
		'label' 	=> __('Top Bar Right Element', 'blog-lite'),
		'section' 	=> 'blog_lite_header',
		'settings'  => 'blog_lite[top_bar_right]',
		'type' 		=> 'radio',
		'choices' 	=> array(
			'social-icons' 	=> __('Social Icons', 'blog-lite'),
			'menu' 			=> __('Menu', 'blog-lite'),
			'search-form' 	=> __('Search Form', 'blog-lite'),
			'address' 		=> __('Address', 'blog-lite'),			
			),
		'active_callback' 	=> 'blog_lite_top_header_show',
		));

	// Header Address
	$wp_customize->add_setting('blog_lite[top_address]', array(
		'default'           =>  '',		
		'sanitize_callback' => 'sanitize_text_field'
		));

	$wp_customize->add_control('blog_lite[top_address]', array(
		'label'       		=> __('Address', 'blog-lite'),  
		'section'     		=> 'blog_lite_header',  
		'settings'    		=> 'blog_lite[top_address]',		
		'type'        		=> 'text',
		'active_callback' 	=> 'blog_lite_top_header_show',
		));	 

	// Slider Setting Section starts
	$wp_customize->add_section('blog_lite_slider', array(    
		'title'       => __('Slider', 'blog-lite'),
		'panel'       => 'blog_lite_basic_panel'    
		));	  

	// Enable/Disable Slider
	$wp_customize->add_setting('blog_lite[slider_enable]', array(
		'default'           => 0,		
		'sanitize_callback' => 'blog_lite_checkbox_sanitization'
		));

	$wp_customize->add_control('blog_lite[slider_enable]', array(
		'label'       => __('Enable Slider or Banner', 'blog-lite'),
		'section'     => 'blog_lite_slider',   
		'settings'    => 'blog_lite[slider_enable]',		
		'type'        => 'checkbox'
		));	

	// Show/Hide Date
	$wp_customize->add_setting('blog_lite[date_enable]', array(
		'default'           => 1,		
		'sanitize_callback' => 'blog_lite_checkbox_sanitization'
		));

	$wp_customize->add_control('blog_lite[date_enable]', array(
		'label'       => __('Show Posted Date or Sub Title', 'blog-lite'),
		'section'     => 'blog_lite_slider',   
		'settings'    => 'blog_lite[date_enable]',		
		'type'        => 'checkbox'
		));

	// Show/Hide Read More button
	$wp_customize->add_setting('blog_lite[read_more_enable]', array(
		'default'           => 1,	
		'sanitize_callback' => 'blog_lite_checkbox_sanitization'
		));

	$wp_customize->add_control('blog_lite[read_more_enable]', array(
		'label'       => __('Show Read More button', 'blog-lite'),
		'section'     => 'blog_lite_slider',   
		'settings'    => 'blog_lite[read_more_enable]',		
		'type'        => 'checkbox'
		));

	// Slider type
	$wp_customize->add_setting('blog_lite[main_slider_type]', array(
		'default' 			=> 'slider',		
		'sanitize_callback' => 'blog_lite_sanitize_select'
		));

	$wp_customize->add_control('blog_lite[main_slider_type]', array(		
		'label' 	=> __('Slider Type', 'blog-lite'),
		'section' 	=> 'blog_lite_slider',
		'settings'  => 'blog_lite[main_slider_type]',
		'type' 		=> 'radio',
		'choices' 	=> array(
			'slider' 		=> __('Slider', 'blog-lite'),
			'banner-image' 	=> __('Banner Image', 'blog-lite'),				
			)
		));	

	//Slider category
	$wp_customize->add_setting('blog_lite[slider_cat]', array(
		'default'         => '',		
		'sanitize_callback' => 'blog_lite_number_sanitization'
		));

	$wp_customize->add_control(
		new Blog_lite_Customize_Category_Control(
			$wp_customize,
			'blog_lite[slider_cat]',
			array(
				'label'       => __( 'Category for slider', 'blog-lite' ),
				'description' => __( 'Posts of selected category will be used as slides', 'blog-lite' ),
				'settings'    => 'blog_lite[slider_cat]',
				'section'     => 'blog_lite_slider', 
				'active_callback' 	=> 'blog_lite_slider_type_category',        
				)
			)
		); 
	// Read More Text Setting
	$wp_customize->add_setting('blog_lite[slider_readmore_text]', array(
		'default'           => __( 'Continue Reading', 'blog-lite' ),
		'sanitize_callback' => 'sanitize_text_field'
		));

	$wp_customize->add_control('blog_lite[slider_readmore_text]', array(
		'label'       => __('Read More Text', 'blog-lite'),  
		'description' => __('Change text if you want to use other than "Continue Reading"', 'blog-lite'),   
		'settings'    => 'blog_lite[slider_readmore_text]',
		'section'     => 'blog_lite_slider',
		'type'        => 'text',
		));

		// Slider Effect
	$wp_customize->add_setting('blog_lite[main_slider_effect]', array(
		'default' 			=> 'none',
		'sanitize_callback' => 'blog_lite_sanitize_select'
		));

	$wp_customize->add_control('blog_lite[main_slider_effect]', array(		
		'label' 	=> __('Transition Effect', 'blog-lite'),
		'section' 	=> 'blog_lite_slider',
		'settings'  => 'blog_lite[main_slider_effect]',
		'active_callback' 	=> 'blog_lite_slider_type_category',    
		'type' 		=> 'select',
		'choices'	=> array( 
				'none'			=> esc_html__( 'Select', 'blog-lite' ),
				'fadeOut'		=> esc_html__( 'fadeOut', 'blog-lite' ),
				'fadeIn'		=> esc_html__( 'fadeIn', 'blog-lite' ),
				'fadeOutDown'	=> esc_html__( 'fadeOutDown', 'blog-lite' ),
				'fadeOutLeft'	=> esc_html__( 'fadeOutLeft', 'blog-lite' ),
				'fadeOutRight'	=> esc_html__( 'fadeOutRight', 'blog-lite' ),
				'fadeOutUp'		=> esc_html__( 'fadeOutUp', 'blog-lite' ),
				'fadeInDown'	=> esc_html__( 'fadeInDown', 'blog-lite' ),
				'lightSpeedIn'	=> esc_html__( 'lightSpeedIn', 'blog-lite' ),
				'rotateInDownLeft'=> esc_html__( 'rotateInDownLeft', 'blog-lite' ),
				'rotateOut'		=> esc_html__( 'rotateOut', 'blog-lite' ),
				'rotateIn'		=> esc_html__( 'rotateIn', 'blog-lite' ),
				'flipInX'		=> esc_html__( 'flipInX', 'blog-lite' ),
			)
		));

	// Enable for auto slider
	$wp_customize->add_setting('blog_lite[blog_Lite_autoslide]', array(
		'default'			=>'false',
		'type'				=>'theme_mod',
		'capability'		=>'edit_theme_options',
		'theme_supports'	=>'',
		'transport'			=>'refresh',		
		'sanitize_callback'	=>'blog_lite_checkbox_sanitization'
		));
	$wp_customize->add_control('blog_lite[blog_Lite_autoslide]', array(
		'label'				=>__('Check to enable auto slider','blog-lite'),
		'type'				=>'checkbox',
		'section'			=>'blog_lite_slider',
		'settings'			=>'blog_lite[blog_Lite_autoslide]',
		'active_callback'	=> 'blog_lite_slider_type_category',		
		));

	
	// Banner Image
	$wp_customize->add_setting('blog_lite[banner_image]', array(
		'default'           	=> '',		
		'sanitize_callback' 	=> 'esc_url_raw',
		'sanitize_js_callback'  =>  'esc_url'
		));

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'blog_lite[banner_image]',
			array(
				'label'        => __( 'Banner Image', 'blog-lite' ),                
				'settings'     => 'blog_lite[banner_image]',
				'section'      => 'blog_lite_slider',
				'active_callback' 	=> 'blog_lite_slider_type_banner', 
				)
			)
		);

	// Banner Title
	$wp_customize->add_setting('blog_lite[banner_title]', array(
		'default'           =>  __('Blog Lite - Responsive Blog Theme', 'blog-lite'),	
		'sanitize_callback' => 'sanitize_text_field'
		));	

	$wp_customize->add_control('blog_lite[banner_title]', array(
	  'label'       => __('Title', 'blog-lite'),    
	  'settings'    => 'blog_lite[banner_title]',
	  'section'     => 'blog_lite_slider',
	  'type'        => 'text',
	  'active_callback' 	=> 'blog_lite_slider_type_banner', 
	));	

	// Banner Sub Title
	$wp_customize->add_setting('blog_lite[banner_sub_title]', array(
		'default'           =>  __('For stunning blogs and websites', 'blog-lite'),		
		'sanitize_callback' => 'sanitize_text_field'
		));	

	$wp_customize->add_control('blog_lite[banner_sub_title]', array(
	  'label'       => __('Sub Title', 'blog-lite'),    
	  'settings'    => 'blog_lite[banner_sub_title]',
	  'section'     => 'blog_lite_slider',
	  'type'        => 'text',
	  'active_callback' 	=> 'blog_lite_slider_type_banner', 
	));	

	// Banner Link
	$wp_customize->add_setting( 'blog_lite[banner_link]', array(
		'sanitize_callback'     => 'esc_url_raw',
		'sanitize_js_callback'  =>  'esc_url'
		));

	$wp_customize->add_control( 'blog_lite[banner_link]', array(
		'label'     		=> __('Link', 'blog-lite'), 
		'type'      		=> 'text',
		'section'   		=> 'blog_lite_slider',
		'settings'  		=> 'blog_lite[banner_link]',
		'active_callback' 	=> 'blog_lite_slider_type_banner', 
		));

	// Breadcrumb Setting Section start
	$wp_customize->add_section('blog_lite_breadcrumb', array(    
		'title'       => __('Breadcrumb Options', 'blog-lite'),
		'panel'       => 'blog_lite_basic_panel'    
		));	

	// Enable breadcumb on home page
	$wp_customize->add_setting( 'blog_lite[breadcumb_onhomepage]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> 0,
		'sanitize_callback' => 'blog_lite_checkbox_sanitization'
		) );

	$wp_customize->add_control( 'blog_lite[breadcumb_onhomepage]', array(
		'label'    => __( 'Check to enable Breadcrumb on Homepage', 'blog-lite' ),
		'section'  => 'blog_lite_breadcrumb',
		'settings' => 'blog_lite[breadcumb_onhomepage]',
		'type'     => 'checkbox',
		) );

	//Enable breadcumb 
	$wp_customize->add_setting( 'blog_lite[breadcrumb_enable]', array(
		'default'			=>0,
		'sanitize_callback'			=>'blog_lite_checkbox_sanitization'
		));

	$wp_customize->add_control('blog_lite[breadcrumb_enable]', array(
		'label'		=>__('Check to enable breadcrumb','blog-lite'),
		'type'		=>'checkbox',
		'section'	=>'blog_lite_breadcrumb',
		'settings'  =>'blog_lite[breadcrumb_enable]'
		));

	// Breadcrumb seperator
	$wp_customize->add_setting( 'blog_lite[breadcumb_seperator]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> '>>',
		'sanitize_callback'	=> 'sanitize_text_field',
		) );

	$wp_customize->add_control( 'blog_lite[breadcumb_seperator]', array(
		'input_attrs' => array(
		'style' => 'width: 40px;'
		),
		'label'    	=> __( 'Separator between Breadcrumbs', 'blog-lite' ),
		'section' 	=> 'blog_lite_breadcrumb',
		'settings' 	=> 'blog_lite[breadcumb_seperator]',
		'type'     	=> 'text'
		));

	// Featured Posts Setting Section starts
	$wp_customize->add_section('blog_lite_featured', array(    
		'title'       => __('Featured Block', 'blog-lite'),
		'panel'       => 'blog_lite_basic_panel'    
		));	  

	// Enable/Disable Featured Posts
	$wp_customize->add_setting('blog_lite[featured_enable]', array(
		'default'           => 0,		
		'sanitize_callback' => 'blog_lite_checkbox_sanitization'
		));

	$wp_customize->add_control('blog_lite[featured_enable]', array(
		'label'       => __('Enable Featured Block', 'blog-lite'),
		'section'     => 'blog_lite_featured',   
		'settings'    => 'blog_lite[featured_enable]',		
		'type'        => 'checkbox'
		));	

	// Block type
	$wp_customize->add_setting('blog_lite[blocks_type]', array(
		'default' 			=> 'category',
		'sanitize_callback' => 'blog_lite_sanitize_select'
		));

	$wp_customize->add_control('blog_lite[blocks_type]', array(		
		'label' 	=> __('Blocks Type', 'blog-lite'),
		'section' 	=> 'blog_lite_featured',
		'settings'  => 'blog_lite[blocks_type]',
		'type' 		=> 'radio',
		'choices' 	=> array(
			'category' 		=> __('Category', 'blog-lite'),
			'post_ids' 	=> __('Post IDs', 'blog-lite'),				
			)
		));	

	//Featured Blocks Category
	$wp_customize->add_setting('blog_lite[blocks_cat]', array(
		'default'         => '',
		'sanitize_callback' => 'blog_lite_number_sanitization'
		));

	$wp_customize->add_control(
		new Blog_lite_Customize_Category_Control(
			$wp_customize,
			'blog_lite[blocks_cat]',
			array(
				'label'       => __( 'Category for featured blocks', 'blog-lite' ),
				'description' => __( 'Posts of selected category will be used as 3 featured blocks below main slider', 'blog-lite' ),
				'settings'    => 'blog_lite[blocks_cat]',
				'section'     => 'blog_lite_featured', 	
				'active_callback' 	=> 'blog_lite_block_type_cat', 		   
				)
			)
		); 

	// Block type post ids
	$wp_customize->add_setting('blog_lite[block_post_ids]', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field'
		));	

	$wp_customize->add_control('blog_lite[block_post_ids]', array(
	  'label'       => __('Post IDs', 'blog-lite'),  
	  'description' => __( 'Enter id of posts in comma seperated form to display as featured blocks. Ex: 911, 766, 1004', 'blog-lite' ),  
	  'settings'    => 'blog_lite[block_post_ids]',
	  'section'     => 'blog_lite_featured',
	  'type'        => 'text',
	  'active_callback' 	=> 'blog_lite_block_type_post', 
	));
			
	
	//For Social Option
	$wp_customize->add_section('blog_lite_social', array(    
		'title'       => __('Social Links', 'blog-lite'),
		'panel'       => 'blog_lite_basic_panel'    
		));

	//Social link text field
	$social_options = array('facebook', 'twitter', 'google_plus', 'instagram' );

	foreach($social_options as $social) {		

		$label = '';

		switch ($social) {

			case 'facebook':
			$label = __('Facebook', 'blog-lite');
			break;

			case 'twitter':
			$label = __( 'Twitter', 'blog-lite' );
			break;

			case 'google_plus':
			$label = __( 'Google Plus', 'blog-lite' );
			break;

			case 'instagram':
			$label = __( 'Instagram', 'blog-lite' );
			break;
		}
		
		$wp_customize->add_setting( 'blog_lite['.$social.']', array(
			'sanitize_callback'     => 'esc_url_raw',
			'sanitize_js_callback'  =>  'esc_url'
			));

		$wp_customize->add_control( 'blog_lite['.$social.']', array(
			'label'     => $label,
			'type'      => 'text',
			'section'   => 'blog_lite_social',
			'settings'  => 'blog_lite['.$social.']'
			));
	}

	// Post Options 
	$wp_customize->add_section('blog_lite_layout', array(    
		'title'       => __('Post Options', 'blog-lite' ),
		'panel'       => 'blog_lite_basic_panel'    
		));

	$wp_customize->add_setting('blog_lite[sidebar]', array(
		'default'           => 'right',
		'sanitize_callback' => 'blog_lite_sanitize_select'
		));

	$wp_customize->add_control(
		new Blog_Lite_Customize_Sidebar_Control(
			$wp_customize, 
			'blog_lite[sidebar]', 
			array(
				'type' => 'radio-image',
				'label' => __('Sidebar', 'blog-lite' ),
				'section' => 'blog_lite_layout',
				'settings' => 'blog_lite[sidebar]',
				'choices' => array(
					'left' 	=> get_template_directory_uri() . '/rigorous-themes/customizer/images/left-sidebar.png',
					'right' => get_template_directory_uri() . '/rigorous-themes/customizer/images/right-sidebar.png',
					'no-sidebar' => get_template_directory_uri() . '/rigorous-themes/customizer/images/sidebar-no.png',
					)
				)
			)
		); 
	
	// Hide Meta Data
	$wp_customize->add_setting('blog_lite[hide_meta]', array(
		'default'           => 0,
		'sanitize_callback' => 'blog_lite_checkbox_sanitization'
		));

	$wp_customize->add_control('blog_lite[hide_meta]', array(
		'label'       => __('Check to hide meta data below title', 'blog-lite'),
		'section'     => 'blog_lite_layout',   
		'settings'    => 'blog_lite[hide_meta]',		
		'type'        => 'checkbox'
		));

	// Read More Text Setting
	$wp_customize->add_setting('blog_lite[readmore_text]', array(
		'default'           => __( 'Continue Reading', 'blog-lite' ),
		'sanitize_callback' => 'sanitize_text_field'
		));

	$wp_customize->add_control('blog_lite[readmore_text]', array(
		'label'       => __('Read More Text', 'blog-lite'),  
		'description' => __('Change text if you want to use other than "Continue Reading"', 'blog-lite'),   
		'settings'    => 'blog_lite[readmore_text]',
		'section'     => 'blog_lite_layout',
		'type'        => 'text'
		));

	//Excerpt length
	$wp_customize->add_setting('blog_lite[excerpt_length]', array(
		'default'           => 40,
		'sanitize_callback' => 'blog_lite_number_sanitization'
		));

	$wp_customize->add_control('blog_lite[excerpt_length]', array(
		'label'       => __('Excerpt Length', 'blog-lite'),  
		'description' => __('Change length of the words used in post', 'blog-lite'),   
		'settings'    => 'blog_lite[excerpt_length]',
		'section'     => 'blog_lite_layout',
		'type'        => 'number'
		));
	// Footer Options 
	$wp_customize->add_section('blog_lite_footer', array(    
		'title'       => __('Footer', 'blog-lite' ),
		'panel'       => 'blog_lite_basic_panel'    
		));

	// Enable/Disable social link  
	$wp_customize->add_setting('blog_lite[footer_social]', array(
	  'default'           => 0,
	  'sanitize_callback' => 'blog_lite_checkbox_sanitization'
	));

	$wp_customize->add_control('blog_lite[footer_social]', array(
	  'label'       => __('Disable Social links in footer', 'blog-lite'),    
	  'settings'    => 'blog_lite[footer_social]',
	  'section'     => 'blog_lite_footer',
	  'type'        => 'checkbox'
	));	

	// Footer Copyright
	$wp_customize->add_setting('blog_lite[copyright]', array(
	  'default'           =>  __('Copyright 2016. All rights reserved', 'blog-lite'),
	  'sanitize_callback' => 'sanitize_text_field'
	));

	$wp_customize->add_control('blog_lite[copyright]', array(
	  'label'       => __('Copyright Text', 'blog-lite'),    
	  'settings'    => 'blog_lite[copyright]',
	  'section'     => 'blog_lite_footer',
	  'type'        => 'text'
	));	

	// Enable/Disable scroll to top  
	$wp_customize->add_setting('blog_lite[scroll_top]', array(
	  'default'           => 0,
	  'sanitize_callback' => 'blog_lite_checkbox_sanitization'
	));

	$wp_customize->add_control('blog_lite[scroll_top]', array(
	  'label'       => __('Disable Scroll to Top', 'blog-lite'),    
	  'settings'    => 'blog_lite[scroll_top]',
	  'section'     => 'blog_lite_footer',
	  'type'        => 'checkbox'
	));

}

add_action( 'customize_register', 'blog_lite_customizer' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function blog_lite_customize_preview_js() {
	wp_enqueue_script( 'blog_lite_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
	
}
add_action( 'customize_preview_init', 'blog_lite_customize_preview_js' );

/**
 * Enqueue scripts for customizer
 */
function blog_lite_customizer_js() {
    wp_enqueue_script('blog-lite-customizer', get_template_directory_uri() . '/assets/js/blog-lite-customizer.js', array('jquery'), '1.3.0', 1);

    wp_localize_script( 'blog-lite-customizer', 'blog_lite_customizer_js_obj', array(
        'pro' => __('Upgrade To  Blog Pro','blog-lite')
    ) );

     wp_enqueue_style( 'blog-lite-customizer', get_template_directory_uri() . '/assets/css/blog-lite-customizer.css');
    
}
add_action( 'customize_controls_enqueue_scripts', 'blog_lite_customizer_js' );


/**
 * Render the site title for the selective refresh partial.
 */
function bloglite_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 */
function bloglite_customize_partial_blogdescription() {
	bloginfo( 'description' );
}
