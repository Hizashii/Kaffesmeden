<?php

// Disable block editor for posts
add_filter('use_block_editor_for_post', '__return_false');

// Enable theme support for post thumbnails
add_theme_support('post-thumbnails');
/**
 * Helper function to handle Polylang translations for ACF fields and strings.
 *
 * @param mixed $field The ACF field value or string to translate.
 * @return mixed Translated value or original value if no translation available.
 */
function _pll($field) {
    if (function_exists('pll__')) {
        if (is_string($field)) {
            return pll__($field); // Translate static string
        }
    }
    return $field; // Return as-is if not a string
}


/**
 * Register static strings for Polylang translation.
 */
function register_static_strings_for_polylang() {
    if (function_exists('pll_register_string')) {
        // Hero Section
        pll_register_string('hero_subtitle', 'Enjoy a cup of coffee with us, and discover our unique coffee culture!', 'Theme Strings');
        pll_register_string('download_button_text', 'Download Our Menu', 'Theme Strings');

        // Awards Section
        pll_register_string('awards_title', 'Our Awards', 'Theme Strings');
        pll_register_string('award_image_alt', 'Award Image %d', 'Theme Strings');

        // Coffee Story Section
        pll_register_string('learn_more_button_text', 'Learn More', 'Theme Strings');

        // Sustainability Section
        pll_register_string('sustainability_image_alt', 'Sustainability Image %d', 'Theme Strings');

        // Follow Us Section
        pll_register_string('instagram_note', 'Follow us on Instagram to stay updated on our latest news, events, and offers!', 'Theme Strings');
    }
}
add_action('init', 'register_static_strings_for_polylang');
/**
 * Register static strings for menu items in Polylang.
 */
function register_menu_strings_for_polylang() {
    if (function_exists('pll_register_string')) {
        pll_register_string('menu_home', 'Home', 'Menu');
        pll_register_string('menu_menu', 'Menu', 'Menu');
        pll_register_string('menu_about', 'About Us', 'Menu');
        pll_register_string('menu_environment', 'Sustainability', 'Menu');
        pll_register_string('menu_contact', 'Contact', 'Menu');
        pll_register_string('logo_alt', 'Hero Logo', 'Header');
        pll_register_string('default_logo', 'Coffee Store', 'Header');
        pll_register_string('burger_menu_aria', 'Open Menu', 'Header');
    }
}
add_action('init', 'register_menu_strings_for_polylang');


// Shortcode to display PDF download button
function pdf_download_button() {
    $pdf_url = wp_get_attachment_url( get_field('menukort_kaffesmeden_pdf') ); // Assuming you have an ACF field
    if ( !$pdf_url ) {
        // Fallback to a default path if ACF field isn't set
        $pdf_url = get_template_directory_uri() . '/downloads/Menukort_kaffesmeden.pdf';
    }
    return '<a href="' . esc_url($pdf_url) . '" class="hero-subtitle-button" download>Download Our Menu</a>';
}
add_shortcode('pdf_download', 'pdf_download_button');

// Enqueue styles and scripts
function enqueue_theme_styles_and_scripts() {
    wp_enqueue_style('main-style', get_template_directory_uri() . '/style.css', [], '1.0.0');
    wp_enqueue_style('header-style', get_template_directory_uri() . '/header.css', [], '1.0.0');
}
add_action('wp_enqueue_scripts', 'enqueue_theme_styles_and_scripts');

?>
