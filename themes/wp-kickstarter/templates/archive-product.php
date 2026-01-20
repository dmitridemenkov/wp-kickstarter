<?php
/**
 * Template for Product CPT Archive (/catalog/)
 */

get_header(); ?>

<main class="pt-20">
    <?php 
    get_template_part('parts/catalog-grid', null, [
        'title' => 'Шторы в Кирове'
    ]); 
    ?>

    <?php get_template_part('parts/foroom-official'); ?>
</main>

<?php get_footer(); ?>
