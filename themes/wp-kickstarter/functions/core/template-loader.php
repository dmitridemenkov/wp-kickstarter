<?php
/**
 * Переопределение иерархии шаблонов WordPress
 * Все шаблоны ищем в папке /templates/
 */

add_filter('template_include', function($template) {
    $templates_dir = get_template_directory() . '/templates/';
    
    // Front Page
    if (is_front_page() || (is_home() && !is_front_page())) {
        if (file_exists($templates_dir . 'front-page.php')) return $templates_dir . 'front-page.php';
    }
    
    // 404
    if (is_404()) {
        if (file_exists($templates_dir . '404.php')) return $templates_dir . '404.php';
    }
    
    // Search
    if (is_search()) {
        if (file_exists($templates_dir . 'search.php')) return $templates_dir . 'search.php';
    }

    // Single Post/CPT
    if (is_single()) {
        $post_type = get_post_type();
        if (file_exists($templates_dir . "single-{$post_type}.php")) return $templates_dir . "single-{$post_type}.php";
        if (file_exists($templates_dir . 'single.php')) return $templates_dir . 'single.php';
    }
    
    // Page
    if (is_page()) {
        $page_template = get_page_template_slug();
        if ($page_template && file_exists($templates_dir . $page_template)) return $templates_dir . $page_template;
        if (file_exists($templates_dir . 'page.php')) return $templates_dir . 'page.php';
    }
    
    // Taxonomy archive
    if (is_tax() || is_category() || is_tag()) {
        $queried_object = get_queried_object();
        if ($queried_object) {
            $taxonomy = $queried_object->taxonomy;
            if (file_exists($templates_dir . "taxonomy-{$taxonomy}.php")) return $templates_dir . "taxonomy-{$taxonomy}.php";
        }
        if (file_exists($templates_dir . 'taxonomy.php')) return $templates_dir . 'taxonomy.php';
        if (file_exists($templates_dir . 'archive.php')) return $templates_dir . 'archive.php';
    }

    // Post Type archive
    if (is_post_type_archive()) {
        $post_type = get_query_var('post_type');
        if (is_array($post_type)) $post_type = reset($post_type);
        if (file_exists($templates_dir . "archive-{$post_type}.php")) return $templates_dir . "archive-{$post_type}.php";
        if (file_exists($templates_dir . 'archive.php')) return $templates_dir . 'archive.php';
    }
    
    // Generic Archive (Date, Author etc)
    if (is_archive()) {
        if (file_exists($templates_dir . 'archive.php')) return $templates_dir . 'archive.php';
    }
    
    return $template;
}, 99);