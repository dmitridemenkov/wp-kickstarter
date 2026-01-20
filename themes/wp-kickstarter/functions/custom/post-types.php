<?php
/**
 * Custom Post Types & Taxonomies
 */

// Register Product CPT
add_action('init', function() {
    register_post_type('product', [
        'labels' => [
            'name'               => 'Каталог',
            'singular_name'      => 'Продукт',
            'add_new'            => 'Добавить продукт',
            'add_new_item'       => 'Добавить новый продукт',
            'edit_item'          => 'Редактировать продукт',
            'new_item'           => 'Новый продукт',
            'view_item'          => 'Просмотр продукта',
            'search_items'       => 'Поиск в каталоге',
            'not_found'          => 'Продукты не найдены',
            'not_found_in_trash' => 'В корзине ничего не найдено',
            'menu_name'          => 'Каталог',
        ],
        'public'              => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-cart',
        'supports'            => ['title', 'editor', 'thumbnail', 'excerpt'],
        'has_archive'         => 'catalog', 
        'rewrite'             => [
            'slug'       => 'catalog/item',
            'with_front' => false
        ],
        'show_in_rest'        => true,
    ]);

    // Register Catalog Category Taxonomy
    register_taxonomy('catalog_category', ['product'], [
        'labels' => [
            'name'              => 'Категории',
            'singular_name'     => 'Категория',
            'search_items'      => 'Поиск категорий',
            'all_items'         => 'Все категории',
            'parent_item'       => 'Родительская категория',
            'parent_item_colon' => 'Родительская категория:',
            'edit_item'         => 'Редактировать категорию',
            'update_item'       => 'Обновить категорию',
            'add_new_item'      => 'Добавить новую категорию',
            'new_item_name'     => 'Имя новой категории',
            'menu_name'         => 'Категории',
        ],
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => [
            'slug'         => 'catalog',
            'with_front'   => false,
            'hierarchical' => true
        ],
        'show_in_rest'      => true, 
    ]);
});
