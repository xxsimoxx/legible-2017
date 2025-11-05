<?php

/**
 * Plugin Name: ODAM fonts and colors
 * Description: Adds legible fonts and backgeound color selector to TwentySeventeen.
 * Version: 1.0.0
 * Author: Simone Fioravanti
 * Requires CP: 2.5
 * Requires PHP: 8.0
 */

class FontLister {
	static $font_arr = array();
}

$list = [
	'Alegreya Sans',
	'Atkinson Hyperlegible',
	'Atkinson Hyperlegible Next',
	'Atkinson Hyperlegible Mono',
	'Lexend Deca',
];

FontLister::$font_arr = array( '' => '' );
foreach ( $list as $font ) {
	FontLister::$font_arr[str_replace(' ', '+', $font)] = $font;
}


if ( ! function_exists( 'boldthemes_customize_register' ) ) {
	function boldthemes_customize_register( $wp_customize ) {

		$wp_customize->add_section( 'boldthemes_section' , array(
			'title'      => esc_html__( 'ODAM', 'bt-twentyseventeen-customization' ),
			'priority'   => 1000,
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_register' );

// BODY FONT
if ( ! function_exists( 'boldthemes_customize_body_font' ) ) {
	function boldthemes_customize_body_font( $wp_customize ) {

		$wp_customize->add_setting( 'boldthemes_theme_options[body_font]', array(
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'body_font', array(
			'label'     => esc_html__( 'Body font', 'bt-twentyseventeen-customization' ),
			'section'   => 'boldthemes_section',
			'settings'  => 'boldthemes_theme_options[body_font]',
			'priority'  => 10,
			'type'      => 'select',
			'choices'   => FontLister::$font_arr
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_body_font' );

// TITLE FONT
if ( ! function_exists( 'boldthemes_customize_title_font' ) ) {
	function boldthemes_customize_title_font( $wp_customize ) {

		$wp_customize->add_setting( 'boldthemes_theme_options[title_font]', array(
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'title_font', array(
			'label'     => esc_html__( 'Title font', 'bt-twentyseventeen-customization' ),
			'section'   => 'boldthemes_section',
			'settings'  => 'boldthemes_theme_options[title_font]',
			'priority'  => 20,
			'type'      => 'select',
			'choices'   => FontLister::$font_arr
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_title_font' );

// HEADING FONT
if ( ! function_exists( 'boldthemes_customize_heading_font' ) ) {
	function boldthemes_customize_heading_font( $wp_customize ) {

		$wp_customize->add_setting( 'boldthemes_theme_options[heading_font]', array(
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'heading_font', array(
			'label'     => esc_html__( 'Heading font', 'bt-twentyseventeen-customization' ),
			'section'   => 'boldthemes_section',
			'settings'  => 'boldthemes_theme_options[heading_font]',
			'priority'  => 20,
			'type'      => 'select',
			'choices'   => FontLister::$font_arr
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_heading_font' );

// MENU FONT
if ( ! function_exists( 'boldthemes_customize_heading_menu_font' ) ) {
	function boldthemes_customize_heading_menu_font( $wp_customize ) {

		$wp_customize->add_setting( 'boldthemes_theme_options[menu_font]', array(
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control( 'menu_font', array(
			'label'     => esc_html__( 'Menu font', 'bt-twentyseventeen-customization' ),
			'section'   => 'boldthemes_section',
			'settings'  => 'boldthemes_theme_options[menu_font]',
			'priority'  => 30,
			'type'      => 'select',
			'choices'   => FontLister::$font_arr
		));
	}
}
add_action( 'customize_register', 'boldthemes_customize_heading_menu_font' );

// COLOR
if ( ! function_exists( 'boldthemes_customize_background_color' ) ) {
	function boldthemes_customize_background_color( $wp_customize ) {

		$wp_customize->add_setting( 'boldthemes_theme_options[bg_color]', array(
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'page_background_color', array(
                'label'         => __('Page Background Color', 'options-for-twenty-seventeen'),
                'description'   => __('Set the color of the website background.', 'options-for-twenty-seventeen'),
                'section'       => 'boldthemes_section',
            	'settings'      => 'boldthemes_theme_options[bg_color]',
            	'priority'      => 60,
            )));
	}
}

add_action( 'customize_register', 'boldthemes_customize_background_color' );

$theme_options = get_option( 'boldthemes_theme_options' );

if ( $theme_options ) {
	if ( ! function_exists( 'boldthemes_custom_fonts' ) ) {
		function boldthemes_custom_fonts() {
			$theme_options = get_option( 'boldthemes_theme_options' );
			echo '<style>';
				if ( isset( $theme_options[ 'body_font' ] ) && $theme_options[ 'body_font' ] != '' ) {
					echo 'body, button, input, select, textarea { font-family: "' . urldecode( $theme_options[ 'body_font' ] ) . '" } ';
					echo 'input::-webkit-input-placeholder { font-family: "' . urldecode( $theme_options[ 'body_font' ] ) . '"; } ';
					echo 'input::-moz-placeholder { font-family: "' . urldecode( $theme_options[ 'body_font' ] ) . '"; }';
					echo 'input:-ms-input-placeholder { font-family: "' . urldecode( $theme_options[ 'body_font' ] ) . '"; } ';
					echo 'input::placeholder { font-family: "' . urldecode( $theme_options[ 'body_font' ] ) . '"; } ';
				}
				if ( isset( $theme_options[ 'title_font' ] ) && $theme_options[ 'title_font' ] != '' ) {
					echo '.site-description, .entry-header h2.entry-title { font-family: "' . urldecode( $theme_options[ 'title_font' ] ) . '"; } ';
				}
				if ( isset( $theme_options[ 'heading_font' ] ) && $theme_options[ 'heading_font' ] != '' ) {
					echo 'h1, h2, h3, h4, h5, h6, p.site-title { font-family: "' . urldecode( $theme_options[ 'heading_font' ] ) . '" } ';
				}
				if ( isset( $theme_options[ 'menu_font' ] ) && $theme_options[ 'menu_font' ] != '' ) {
					echo '.main-navigation .menu { font-family: "' . urldecode( $theme_options[ 'menu_font' ] ) . '"; } ';
				}
				if ( isset( $theme_options[ 'bg_color' ] ) && $theme_options[ 'bg_color' ] != '' ) {
					echo '.site-content-contain { background-color: ' . urldecode( $theme_options[ 'bg_color' ] ) . '; } ';
				}
				//
			echo '</style>';
		}
	}
	add_action( 'wp_head', 'boldthemes_custom_fonts' );

	if ( ! function_exists( 'boldthemes_load_fonts' ) ) {
		function boldthemes_load_fonts() {

			$theme_options = get_option( 'boldthemes_theme_options' );

			$font_families = array();

			if ( isset( $theme_options[ 'body_font' ] ) && $theme_options[ 'body_font' ] != '' ) {
				$font_families[] = urldecode( $theme_options[ 'body_font' ] ) . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
			}

			if ( isset( $theme_options[ 'title_font' ] ) && $theme_options[ 'title_font' ] != '' ) {
				$font_families[] = urldecode( $theme_options[ 'title_font' ] ) . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
			}

			if ( isset( $theme_options[ 'heading_font' ] ) && $theme_options[ 'heading_font' ] != '' ) {
				$font_families[] = urldecode( $theme_options[ 'heading_font' ] ) . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
			}

			if ( isset( $theme_options[ 'menu_font' ] ) && $theme_options[ 'menu_font' ] != '' ) {
				$font_families[] = urldecode( $theme_options[ 'menu_font' ] ) . ':100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic';
			}

			if ( count( $font_families ) > 0 ) {
				$query_args = array(
					'family' => urlencode( implode( '|', $font_families ) ),
					'subset' => urlencode( 'latin,latin-ext' ),
				);
				$font_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
				wp_enqueue_style( 'boldthemes_fonts', $font_url, array(), '1.0.0' );
			}
		}
	}
	add_action( 'wp_enqueue_scripts', 'boldthemes_load_fonts' );
}
