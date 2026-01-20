<?php
/**
 * Template for Single Product (Product CPT)
 */

get_header(); ?>

<main class="pt-20">
    <!-- Breadcrumbs / Header area -->
    <div class="bg-[#f2f0f4] py-8">
        <div class="container mx-auto px-4">
            <div class="text-sm text-[#1e1e1e]/60 mb-4 font-medium font-['Montserrat',sans-serif]">
                <a href="<?php echo home_url(); ?>" class="hover:text-primary">Главная</a>
                <span class="mx-2">/</span>
                <a href="<?php echo get_post_type_archive_link('product'); ?>" class="hover:text-primary">Каталог</a>
                <span class="mx-2">/</span>
                <span class="text-[#1e1e1e]"><?php the_title(); ?></span>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-12 md:py-20">
        <?php while (have_posts()) : the_post(); ?>
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20">
                <!-- Product Images -->
                <div class="lg:col-span-7">
                    <div class="sticky top-28">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="rounded-3xl overflow-hidden shadow-sm aspect-square md:aspect-video lg:aspect-square">
                                <?php the_post_thumbnail('full', ['class' => 'w-full h-full object-cover']); ?>
                            </div>
                        <?php else : ?>
                            <div class="rounded-3xl overflow-hidden bg-gray-100 aspect-square flex items-center justify-center">
                                <span class="dashicons dashicons-format-image text-gray-400 text-6xl"></span>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Additional gallery could go here -->
                    </div>
                </div>

                <!-- Product Info -->
                <div class="lg:col-span-5 flex flex-col justify-center">
                    <h1 class="font-['Bona_Nova',serif] text-[38px] md:text-[60px] leading-[120%] text-[#323232] mb-8">
                        <?php the_title(); ?>
                    </h1>

                    <div class="font-['Montserrat',sans-serif] text-[rgba(30,30,30,0.6)] leading-[160%] text-base md:text-lg mb-10 prose max-w-none">
                        <?php the_content(); ?>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-6 items-center">
                        <button type="button" class="w-full sm:w-[240px] bg-[#3a1e5e] text-white py-4 rounded-lg font-['Montserrat',sans-serif] font-medium text-base text-center hover:bg-[#2d1749] transition-all hover:scale-105">
                            Заказать звонок
                        </button>
                    </div>

                    <p class="mt-6 text-sm text-[rgba(30,30,30,0.4)] font-['Montserrat',sans-serif]">
                        * Стоимость рассчитывается индивидуально после замера
                    </p>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <!-- Other products/categories -->
    <div class="bg-[#f2f0f4] pt-20">
        <?php get_template_part('parts/catalog-grid', null, [
            'title' => 'Другие категории'
        ]); ?>
    </div>
</main>

<?php get_footer(); ?>
