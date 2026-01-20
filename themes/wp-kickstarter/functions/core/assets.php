<?php
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style(
        'kickstarter-style',
        get_template_directory_uri() . '/assets/app.css',
        [],
        filemtime(get_template_directory() . '/assets/app.css')
    );

    if (file_exists(get_template_directory() . '/assets/main.css')) {
        wp_enqueue_style(
            'kickstarter-main-style',
            get_template_directory_uri() . '/assets/main.css',
            [],
            filemtime(get_template_directory() . '/assets/main.css')
        );
    }
    
    wp_enqueue_script(
        'kickstarter-script',
        get_template_directory_uri() . '/assets/main.js',
        [],
        filemtime(get_template_directory() . '/assets/main.js'),
        true
    );
});