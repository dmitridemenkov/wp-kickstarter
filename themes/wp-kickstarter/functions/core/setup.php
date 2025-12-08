<?php
// Отключаем комментарии полностью

// Убираем из админки
add_action('admin_menu', function() {
    remove_menu_page('edit-comments.php');
});

// Убираем из админбара
add_action('admin_bar_menu', function($wp_admin_bar) {
    $wp_admin_bar->remove_node('comments');
}, 999);

// Отключаем поддержку комментариев для всех типов постов
add_action('init', function() {
    remove_post_type_support('post', 'comments');
    remove_post_type_support('page', 'comments');
});

// Закрываем комментарии на фронте
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Прячем существующие комментарии
add_filter('comments_array', '__return_empty_array', 10, 2);