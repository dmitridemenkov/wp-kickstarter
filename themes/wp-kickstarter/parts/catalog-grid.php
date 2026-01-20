<?php
/**
 * Catalog Grid Template Part
 */

$terms = get_terms([
    'taxonomy'   => 'catalog_category',
    'hide_empty' => false, // Show even if empty
    'orderby'    => 'term_order', // Support for Simple Custom Post Order
    'order'      => 'ASC',
]);

if (empty($terms) || is_wp_error($terms)) {
    return;
}
?>
<section class="bg-[#f2f0f4] pt-8 pb-12 md:pt-[50px] md:pb-[100px]" id="catalog">
    <div class="container mx-auto px-4">
        <?php 
        $title = !empty($args['title']) ? $args['title'] : 'Каталог';
        ?>
        <h2 class="font-['Bona_Nova',serif] text-[38px] md:text-[80px] leading-[120%] text-[#323232] text-center mb-[30px]"><?php echo esc_html($title); ?></h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($terms as $term): 
                $term_id = 'catalog_category_' . $term->term_id;
                $image_data = get_field('category_image', $term_id);
                $image_url = '';

                if (is_array($image_data)) {
                    $image_url = $image_data['url'];
                } elseif (is_numeric($image_data)) {
                    $image_url = wp_get_attachment_image_url($image_data, 'full');
                } elseif (is_string($image_data)) {
                    $image_url = $image_data;
                }

                if (empty($image_url)) {
                    $image_url = 'https://placehold.co/600x400?text=No+Image';
                }

                $link = get_term_link($term);
            ?>
                <a href="<?php echo esc_url($link); ?>" class="block bg-white rounded-lg overflow-hidden h-[360px] group hover:shadow-[0px_24px_44px_-30px_rgba(34,21,49,0.47)] hover:border hover:border-[rgba(58,30,94,0.25)] transition-all border border-transparent relative">
                    <div class="h-[281px] overflow-hidden">
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($term->name); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-6 flex items-center justify-between relative z-10 bg-white">
                        <h3 class="font-['Montserrat',sans-serif] font-medium text-base text-[#1e1e1e] group-hover:text-[#3a1e5e] transition-colors">
                            <?php echo esc_html($term->name); ?>
                        </h3>
                        <svg class="size-6 transition-all" fill="none" viewBox="0 0 24 24">
                            <path d="M16 5C16 5.742 16.733 6.85 17.475 7.78C18.429 8.98 19.569 10.027 20.876 10.826C21.856 11.425 23.044 12 24 12M24 12C23.044 12 21.855 12.575 20.876 13.174C19.569 13.974 18.429 15.021 17.475 16.219C16.733 17.15 16 18.26 16 19M24 12H0" stroke="black" class="group-hover:stroke-[#3A1E5E] transition-colors" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
