<?php get_header(); ?>

<div class="min-h-screen bg-gradient-to-br from-primary to-secondary flex items-center justify-center">
    <div class="bg-light rounded-2xl shadow-2xl p-10 max-w-container text-center">
        <h1 class="text-3xl font-bold text-dark mb-4">🚀 WP Kickstarter</h1>
        <p class="text-dark/70 mb-6">Тема работает, Tailwind подключён!</p>
        <a href="<?php echo admin_url(); ?>" class="inline-block bg-accent hover:bg-accent/90 text-white font-semibold py-3 px-6 rounded-lg transition-colors">
            Перейти в админку
        </a>
    </div>
</div>

<?php get_footer(); ?>