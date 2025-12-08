<?php
/**
 * Шаблон главной страницы
 */

get_header();
?>

<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-primary to-secondary text-white py-20 md:py-32">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                Создаём современные сайты с удобством
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-white/90">
                WP Kickstarter — универсальная тема для быстрого старта проектов на WordPress
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="#features" class="bg-white text-primary px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition text-center">
                    Узнать больше
                </a>
                <a href="#contact" class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-primary transition text-center">
                    Связаться с нами
                </a>
            </div>
        </div>
    </div>
    
    <!-- Декоративный элемент -->
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 120" class="w-full h-auto">
            <path fill="#ffffff" d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z"></path>
        </svg>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="py-16 md:py-24 bg-light">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-5xl font-bold text-dark mb-4">
                Почему выбирают нас
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Современные технологии и удобный workflow для эффективной разработки
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition">
                <div class="w-16 h-16 bg-primary/10 rounded-lg flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-dark mb-4">Быстрая разработка</h3>
                <p class="text-gray-600">
                    Vite + Tailwind CSS для мгновенной сборки и современных стилей
                </p>
            </div>
            
            <!-- Feature 2 -->
            <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition">
                <div class="w-16 h-16 bg-secondary/10 rounded-lg flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-dark mb-4">Модульность</h3>
                <p class="text-gray-600">
                    Чистая структура кода и разделение на компоненты для лёгкой поддержки
                </p>
            </div>
            
            <!-- Feature 3 -->
            <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition">
                <div class="w-16 h-16 bg-accent/10 rounded-lg flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-dark mb-4">Готово к продакшену</h3>
                <p class="text-gray-600">
                    Docker, GitHub Actions и оптимизированная сборка из коробки
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Blog Posts Section -->
<?php
$recent_posts = new WP_Query([
    'post_type' => 'post',
    'posts_per_page' => 3,
    'orderby' => 'date',
    'order' => 'DESC',
]);

if ($recent_posts->have_posts()) :
?>
<section class="py-16 md:py-24 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-5xl font-bold text-dark mb-4">
                Последние статьи
            </h2>
            <p class="text-xl text-gray-600">
                Новости, обновления и полезные материалы
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
            <article class="bg-light rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition group">
                <?php if (has_post_thumbnail()) : ?>
                <div class="overflow-hidden">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('card', ['class' => 'w-full h-48 object-cover group-hover:scale-105 transition duration-300']); ?>
                    </a>
                </div>
                <?php endif; ?>
                
                <div class="p-6">
                    <div class="text-sm text-gray-500 mb-2">
                        <?php echo get_the_date(); ?>
                    </div>
                    
                    <h3 class="text-xl font-bold text-dark mb-3 group-hover:text-primary transition">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h3>
                    
                    <p class="text-gray-600 mb-4">
                        <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                    </p>
                    
                    <a href="<?php the_permalink(); ?>" class="text-primary font-semibold hover:underline">
                        Читать далее →
                    </a>
                </div>
            </article>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA Section -->
<section id="contact" class="py-16 md:py-24 bg-gradient-to-r from-primary to-secondary text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-5xl font-bold mb-6">
            Готовы начать проект?
        </h2>
        <p class="text-xl mb-8 text-white/90 max-w-2xl mx-auto">
            Свяжитесь с нами и мы поможем воплотить ваши идеи в жизнь
        </p>
        <a href="mailto:info@example.com" class="inline-block bg-white text-primary px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition">
            Написать нам
        </a>
    </div>
</section>

<?php get_footer(); ?>