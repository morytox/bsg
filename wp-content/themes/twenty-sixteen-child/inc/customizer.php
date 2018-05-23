<?php 

// Source: http://buildwpyourself.com/customizing-client-options-using-the-theme-customizer/
function bwpy_customizer( $wp_customize ) {
	// customizer build code

// change section name to include logo
$wp_customize->get_section( 'title_tagline' )->title = __( 'Site Title, Logo, & Tagline', 'bwpy' );

// logo uploader
$wp_customize->add_setting( 'bwpy_logo', array( 'default' => null ) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bwpy_logo', array(
	'label'		=> __( 'Custom Site Logo (replaces title)', 'bwpy' ),
	'section'	=> 'title_tagline',
	'settings'	=> 'bwpy_logo',
	'priority'	=> 20
) ) );

// change priority of site title and tagline
$wp_customize->get_control( 'blogname' )->priority = 10;
$wp_customize->get_control( 'blogdescription' )->priority = 30;


// add "Post Excerpts" section
	$wp_customize->add_section( 'bwpy_content_options_section' , array(
		'title'      => __( 'Post Excerpt Display', 'bwpy' ),
		'priority'   => 50,
	) );
	
	// add setting for excerpts/full posts toggle
	$wp_customize->add_setting( 'bwpy_excerpts', array( 
		'default' => 0, // unchecked
		'sanitize_callback' => 'example_sanitize_checkbox'
	) );
	
	// add checkbox control for excerpts/full posts toggle
	$wp_customize->add_control( 'bwpy_excerpts', array(
		'label'     => __( 'Show post excerpts on blog page?', 'bwpy' ),
		'section'   => 'bwpy_content_options_section',
		'priority'  => 10,
		'type'      => 'checkbox'
	) );


	// add Border Display section
	$wp_customize->add_section( 'bwpy_border_section' , array(
		'title'      => __( 'Border Display', 'bwpy' ),
		'priority'   => 50,
	) );
	
	// add setting for border toggle
	$wp_customize->add_setting( 'bwpy_border', array( 
		'default' => 0, // unchecked
		'sanitize_callback' => 'example_sanitize_checkbox'
	) );
	
	// add checkbox control for border toggle
	$wp_customize->add_control( 'bwpy_border', array(
		'label'     => __( 'Hide border', 'bwpy' ),
		'description' => 'Note that when the border is hidden, any background set won\'t show.',
		'section'   => 'bwpy_border_section',
		'priority'  => 10,
		'type'      => 'checkbox'
	) );


	// add Footer display section
	$wp_customize->add_section( 'bwpy_footer_section' , array(
		'title'      => __( 'Footer Display', 'bwpy' ),
		'priority'   => 90,
	) );
	
	// add setting to hide Proudly powered by WordPress
	$wp_customize->add_setting( 'bwpy_footer', array( 
		'default' => 0, // unchecked
		'sanitize_callback' => 'example_sanitize_checkbox'
	) );
	
	// add checkbox control to hide Proudly powered by WordPress
	$wp_customize->add_control( 'bwpy_footer', array(
		'label'     => __( 'Hide "Proudly powered by WordPress"', 'bwpy' ),
		'section'   => 'bwpy_footer_section',
		'priority'  => 20,
		'type'      => 'checkbox'
	) );




}
add_action( 'customize_register', 'bwpy_customizer' ); 


// Sanitize the checkboxes
// From http://themefoundation.com/wordpress-theme-customizer/
function example_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}



// CSS to remove the border 
function remove_border(){

	if ( get_theme_mod( 'bwpy_border' ) == 1 ) {
		?>
		<style type="text/css">
		body:not(.custom-background-image):before, body:not(.custom-background-image):after {
    height: 0px;
		}

		.site-footer .site-title:after {
    content: "";
		}

@media screen and (min-width: 44.375em) {
.site {
 	margin: 0px;
}
}
		</style>
<?php
	} 
} 

add_action('wp_head','remove_border');


// CSS to remove the / before Proudly Powered by WordPress, removed when the notice is removed
function remove_slash(){

	if ( get_theme_mod( 'bwpy_footer' ) == 1 ) {
		?>
		<style type="text/css">
		.site-footer .site-title:after {
    	content: "";
		}
		</style>
<?php
	} 
} 

add_action('wp_head','remove_slash');

?>
