<?php
/**
 * Gallery Section Template Part
 */
$gallery_ids = get_option('lavanda_gallery_ids', '');
$ids_array = array_filter(explode(',', $gallery_ids));

if (empty($ids_array)) {
    return;
}
?>
<section class="bg-[#f2f0f4] py-[60px] md:py-20 overflow-hidden" id="gallery">
    <div class="container mx-auto px-4">
        <h2 class="font-['Bona_Nova',serif] text-[38px] md:text-[80px] leading-[120%] text-[#323232] text-center mb-[30px]">
            Галерея наших работ
        </h2>
    </div>
    
    <!-- Swiper Gallery -->
    <div class="swiper gallery-swiper w-full">
        <div class="swiper-wrapper">
            <?php foreach ($ids_array as $id): 
                $img_url = wp_get_attachment_image_url($id, 'large');
                if (!$img_url) continue;
            ?>
                <div class="swiper-slide !w-[280px] md:!w-[460px]">
                    <div class="h-[180px] md:h-[300px] rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-shadow duration-300">
                        <img src="<?php echo esc_url($img_url); ?>" alt="Gallery Image" class="w-full h-full object-cover">
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="container mx-auto px-4">
        <div class="flex justify-center mt-8 md:mt-12">
            <a href="/catalog/" class="bg-[#3a1e5e] text-white w-[240px] py-4 rounded-lg font-['Montserrat',sans-serif] font-medium text-base text-center hover:bg-[#2d1749] transition-all hover:scale-105 inline-block">
                Выбрать шторы
            </a>
        </div>
    </div>
</section>

<style>
/* Hide scrollbar for Chrome, Safari and Opera */
.no-scrollbar::-webkit-scrollbar {
    display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.no-scrollbar {
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
}
</style>
