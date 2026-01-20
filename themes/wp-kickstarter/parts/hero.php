<?php
/**
 * Hero Section Template Part
 */
$slides = get_option('lavanda_hero_slides', []);
// Fallback if empty
if (empty($slides)) {
    $slides = [[
        'title' => 'Готовые шторы',
        'subtitle' => 'Широкий ассортимент готовых решений для вашего интерьера',
        'btn_text' => '',
        'img_desktop' => '', // Logic to handle empty img?
    ]];
}
?>
<section class="relative h-[680px] bg-[#f2f0f4] overflow-hidden group">
    <div class="hero-swiper swiper w-full h-full">
        <div class="swiper-wrapper">
            <?php foreach ($slides as $index => $slide): ?>
                <?php 
                $title_tag = ($index === 0) ? 'h1' : 'h2'; 
                $img_desktop = $slide['img_desktop'] ?: 'https://placehold.co/1920x1080/gray/white?text=No+Image'; // Fallback
                $img_mobile = $slide['img_mobile'] ?: $img_desktop;
                ?>
                <div class="swiper-slide relative w-full h-full">
                    <!-- Background -->
                    <div class="absolute inset-0 z-0">
                        <picture>
                             <?php if (!empty($slide['img_mobile'])): ?>
                                <source media="(max-width: 768px)" srcset="<?php echo esc_url($slide['img_mobile']); ?>">
                             <?php endif; ?>
                             <img src="<?php echo esc_url($img_desktop); ?>" alt="<?php echo esc_attr($slide['title']); ?>" class="w-full h-full object-cover">
                        </picture>
                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-b from-[rgba(37,20,58,0.11)] to-[rgba(53,18,97,0.35)]"></div>
                    </div>

                    <!-- Content -->
                    <div class="container h-full mx-auto px-4 relative flex flex-col items-center justify-center text-center text-white pt-20 z-10">
                        
                        <<?php echo $title_tag; ?> class="font-['Bona_Nova',serif] text-5xl md:text-[80px] leading-tight mb-8 drop-shadow-md">
                            <?php echo esc_html($slide['title']); ?>
                        </<?php echo $title_tag; ?>>

                        <?php if (!empty($slide['subtitle'])): ?>
                            <p class="font-['Montserrat',sans-serif] font-medium text-lg md:text-base max-w-2xl drop-shadow-sm mb-8">
                                <?php echo esc_html($slide['subtitle']); ?>
                            </p>
                        <?php endif; ?>

                        <?php if (!empty($slide['btn_text'])): ?>
                            <a href="<?php echo esc_url($slide['btn_link']); ?>" class="bg-white text-primary px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition inline-block">
                                <?php echo esc_html($slide['btn_text']); ?>
                            </a>
                        <?php endif; ?>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Arrows (Custom) -->
        <div class="absolute inset-0 z-20 pointer-events-none flex items-center justify-center">
            <div class="container h-full mx-auto px-4 relative">
                <button class="hero-prev absolute left-4 top-1/2 -translate-y-1/2 size-10 flex items-center justify-center hover:opacity-80 transition-opacity hidden xl:flex pointer-events-auto cursor-pointer">
                     <svg class="size-10" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                         <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                     </svg>
                </button>
                
                <button class="hero-next absolute right-4 top-1/2 -translate-y-1/2 size-10 flex items-center justify-center hover:opacity-80 transition-opacity hidden xl:flex pointer-events-auto cursor-pointer">
                    <svg class="size-10" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                         <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Pagination (Custom styles via CSS or Tailwind classes on active) -->
        <!-- We need to style the dots to look like Figma. Swiper default bullets are circles. 
             Figma: rounded-[10px] w-6 (active) w-1.5 (inactive).
             We can override simple swiper classes in global CSS or just accept default for now.
             Let's add a container and target it in CSS if needed, or rely on defaults.
        -->
        <div class="hero-pagination absolute bottom-16 left-1/2 -translate-x-1/2 flex gap-1.5 items-center z-20 justify-center"></div>
    </div>
</section>

<!-- Inline styles for custom pagination if not in css -->
<style>
.hero-pagination .swiper-pagination-bullet {
    background: rgba(255,255,255,0.6);
    opacity: 1;
    width: 6px;
    height: 6px;
    border-radius: 6px;
    transition: all 0.3s;
}
.hero-pagination .swiper-pagination-bullet-active {
    background: #fff;
    width: 24px;
}
</style>
