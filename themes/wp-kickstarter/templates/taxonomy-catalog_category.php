<?php
/**
 * Template for Catalog Category Archive (e.g. /catalog/zhalyuzi/)
 */

get_header(); 
$term = get_queried_object();
?>

<main class="pt-20">
    <!-- Breadcrumbs / Header area -->
    <div class="bg-[#f2f0f4] py-8">
        <div class="container mx-auto px-4">
            <div class="text-sm text-[#1e1e1e]/60 mb-4 font-medium font-['Montserrat',sans-serif]">
                <a href="<?php echo home_url(); ?>" class="hover:text-primary">Главная</a>
                <span class="mx-2">/</span>
                <a href="<?php echo get_post_type_archive_link('product'); ?>" class="hover:text-primary">Каталог</a>
                <span class="mx-2">/</span>
                <span class="text-[#1e1e1e]"><?php echo $term->name; ?></span>
            </div>
            
            <h1 class="font-['Bona_Nova',serif] text-[38px] md:text-[60px] leading-[120%] text-[#323232]">
                <?php echo $term->name; ?>
            </h1>
        </div>
    </div>

    <div class="container mx-auto px-4 py-16 md:py-24">
        <?php if (have_posts()) : ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                <?php while (have_posts()) : the_post(); ?>
                    <a href="<?php the_permalink(); ?>" class="group block">
                        <div class="rounded-3xl overflow-hidden shadow-sm aspect-square mb-6 bg-gray-100">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('large', ['class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-500']); ?>
                            <?php else : ?>
                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                    <span class="dashicons dashicons-format-image text-5xl"></span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <h3 class="font-['Montserrat',sans-serif] font-medium text-lg md:text-xl text-[#323232] group-hover:text-primary transition-colors">
                            <?php the_title(); ?>
                        </h3>
                    </a>
                <?php endwhile; ?>
            </div>
            
            <!-- Pagination -->
            <div class="mt-16 flex justify-center">
                <?php 
                echo paginate_links([
                    'prev_text' => '<span class="dashicons dashicons-arrow-left-alt2"></span>',
                    'next_text' => '<span class="dashicons dashicons-arrow-right-alt2"></span>',
                    'class' => 'pagination-links'
                ]); 
                ?>
            </div>
        <?php else : ?>
            <div class="text-center py-20">
                <p class="font-['Montserrat',sans-serif] text-xl text-[rgba(30,30,30,0.6)]">В этой категории пока нет товаров.</p>
                <a href="<?php echo get_post_type_archive_link('product'); ?>" class="mt-8 inline-block text-primary font-medium hover:underline">Вернуться в каталог</a>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
