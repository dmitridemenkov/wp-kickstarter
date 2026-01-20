<?php
/**
 * Template name: Standard Page
 */

get_header(); ?>

<main class="pt-20">
    <div class="bg-[#f2f0f4] py-8">
        <div class="container mx-auto px-4">
            <!-- Breadcrumbs Placeholder -->
            <div class="text-sm text-[#1e1e1e]/60 mb-4 font-medium font-['Montserrat',sans-serif]">
                <a href="<?php echo home_url(); ?>" class="hover:text-primary">Главная</a>
                <span class="mx-2">/</span>
                <span class="text-[#1e1e1e]"><?php the_title(); ?></span>
            </div>
            
            <h1 class="font-['Bona_Nova',serif] text-[38px] md:text-[60px] leading-[120%] text-[#323232]">
                <?php the_title(); ?>
            </h1>
        </div>
    </div>

    <div class="container mx-auto px-4 py-16 md:py-24">
        <div class="max-w-4xl mx-auto prose prose-lg prose-headings:font-['Bona_Nova',serif] prose-headings:text-[#323232] prose-p:font-['Montserrat',sans-serif] prose-p:text-[#1e1e1e]/80 prose-a:text-primary hover:prose-a:opacity-80 transition-all font-['Montserrat',sans-serif]">
            <?php
            while (have_posts()) :
                the_post();
                the_content();
            endwhile;
            ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
