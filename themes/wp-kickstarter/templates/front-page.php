<?php
/**
 * Шаблон главной страницы
 */

get_header();
?>

<!-- Hero Section -->
<?php get_template_part('parts/hero'); ?>

<?php get_template_part('parts/foroom'); ?>

<?php get_template_part('parts/catalog-grid'); ?>

<?php get_template_part('parts/about'); ?>

<?php get_template_part('parts/gallery'); ?>

<?php get_template_part('parts/foroom-official'); ?>


<?php get_footer(); ?>