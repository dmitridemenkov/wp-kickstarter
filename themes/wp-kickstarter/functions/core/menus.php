<?php
/**
 * Navigation Menu Filters
 */

// Add classes to menu link (<a>)
add_filter('nav_menu_link_attributes', function($atts, $item, $args) {
    if ($args->theme_location === 'primary') {
        $classes = 'hover:text-primary transition-colors';
    } else {
        $classes = 'hover:opacity-70 transition-opacity';
    }
    
    if (isset($atts['class'])) {
        $atts['class'] .= ' ' . $classes;
    } else {
        $atts['class'] = $classes;
    }
    
    return $atts;
}, 10, 3);

// Ensure menu items (<li>) have no bullets and behave as flex items if parent is flex
add_filter('nav_menu_css_class', function($classes, $item, $args) {
    $classes[] = 'list-none';
    return $classes;
}, 10, 3);
