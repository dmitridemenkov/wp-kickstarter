<?php
/**
 * Настройки слайдера на главной
 */

function lavanda_slider_settings_init() {
    register_setting('lavanda_slider_settings', 'lavanda_hero_slides', 'lavanda_sanitize_slides');

    add_settings_section(
        'lavanda_slider_section',
        'Слайды на главной',
        'lavanda_slider_section_cb',
        'lavanda-slider-settings'
    );

    add_settings_field(
        'hero_slides',
        'Список слайдов',
        'lavanda_hero_slides_cb',
        'lavanda-slider-settings',
        'lavanda_slider_section'
    );
}
add_action('admin_init', 'lavanda_slider_settings_init');

function lavanda_slider_menu() {
    $hook = add_submenu_page(
        'lavanda-settings', // Parent slug (from theme-settings.php check)
        'Слайдер',
        'Слайдер',
        'manage_options',
        'lavanda-slider-settings',
        'lavanda_slider_settings_page'
    );
    
    add_action('admin_enqueue_scripts', function($current_hook) use ($hook) {
        if ($current_hook !== $hook) return;
        wp_enqueue_media();
    });
}
add_action('admin_menu', 'lavanda_slider_menu', 20);

function lavanda_slider_section_cb() {
    echo '<p>Добавьте слайды для главного экрана. Перетаскивайте элементы для сортировки (пока без сортировки, просто список).</p>';
}

function lavanda_slider_settings_page() {
    ?>
    <div class="wrap">
        <h1>Настройки слайдера</h1>
        <form action="options.php" method="post">
            <?php
            settings_fields('lavanda_slider_settings');
            do_settings_sections('lavanda-slider-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

function lavanda_hero_slides_cb() {
    $slides = get_option('lavanda_hero_slides', []);
    if (empty($slides)) {
        $slides = [['title' => '', 'subtitle' => '', 'btn_text' => '', 'btn_link' => '', 'img_desktop' => '', 'img_mobile' => '']];
    }
    ?>
    <div id="hero-slides-wrapper" class="lavanda-repeater">
        <?php foreach ($slides as $index => $slide): ?>
            <div class="lavanda-slide-item" data-index="<?php echo $index; ?>" style="background:#fff; border:1px solid #ccc; padding:20px; margin-bottom:15px; border-radius:4px;">
                <h3 style="margin-top:0;">Слайд #<span class="slide-number"><?php echo $index + 1; ?></span> 
                    <button type="button" class="button button-link-delete remove-slide" style="float:right; color:#b32d2e;">Удалить</button>
                </h3>
                
                <div style="display:grid; grid-template-columns: 1fr 1fr; gap:20px; margin-bottom:15px;">
                    <div>
                        <label>Изображение (Desktop):</label><br>
                        <div class="media-uploader-preview" style="margin-top:5px; margin-bottom:10px;">
                            <?php if (!empty($slide['img_desktop'])): ?>
                                <img src="<?php echo esc_url($slide['img_desktop']); ?>" style="max-width:100%; height:auto; max-height:150px;">
                            <?php endif; ?>
                        </div>
                        <input type="hidden" name="lavanda_hero_slides[<?php echo $index; ?>][img_desktop]" class="media-url-input" value="<?php echo esc_attr($slide['img_desktop'] ?? ''); ?>">
                        <button type="button" class="button media-upload-btn">Выбрать картинку</button>
                    </div>
                    <div>
                        <label>Изображение (Mobile):</label><br>
                        <div class="media-uploader-preview" style="margin-top:5px; margin-bottom:10px;">
                            <?php if (!empty($slide['img_mobile'])): ?>
                                <img src="<?php echo esc_url($slide['img_mobile']); ?>" style="max-width:100%; height:auto; max-height:150px;">
                            <?php endif; ?>
                        </div>
                        <input type="hidden" name="lavanda_hero_slides[<?php echo $index; ?>][img_mobile]" class="media-url-input" value="<?php echo esc_attr($slide['img_mobile'] ?? ''); ?>">
                        <button type="button" class="button media-upload-btn">Выбрать картинку</button>
                        <p class="description">Если не заполнено, используется Desktop.</p>
                    </div>
                </div>

                <div style="margin-bottom:10px;">
                    <label>Заголовок:</label>
                    <input type="text" name="lavanda_hero_slides[<?php echo $index; ?>][title]" value="<?php echo esc_attr($slide['title'] ?? ''); ?>" class="regular-text" style="width:100%;">
                </div>
                <div style="margin-bottom:10px;">
                    <label>Подзаголовок:</label>
                    <input type="text" name="lavanda_hero_slides[<?php echo $index; ?>][subtitle]" value="<?php echo esc_attr($slide['subtitle'] ?? ''); ?>" class="regular-text" style="width:100%;">
                </div>
                <div style="display:flex; gap:10px;">
                    <div style="flex:1;">
                        <label>Текст кнопки:</label>
                        <input type="text" name="lavanda_hero_slides[<?php echo $index; ?>][btn_text]" value="<?php echo esc_attr($slide['btn_text'] ?? ''); ?>" class="regular-text" style="width:100%;">
                    </div>
                    <div style="flex:1;">
                        <label>Ссылка кнопки:</label>
                        <input type="text" name="lavanda_hero_slides[<?php echo $index; ?>][btn_link]" value="<?php echo esc_attr($slide['btn_link'] ?? ''); ?>" class="regular-text" style="width:100%;">
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    
    <button type="button" class="button button-secondary" id="add-slide">Добавить слайд</button>

    <script>
    jQuery(document).ready(function($){
        // Media Uploder Logic (Reuse generic or specific?)
        // Let's attach event to body to handle dynamic elements
        $('body').on('click', '.media-upload-btn', function(e){
            e.preventDefault();
            var btn = $(this);
            var input = btn.siblings('.media-url-input');
            var preview = btn.siblings('.media-uploader-preview');
            
            var frame = wp.media({
                title: 'Выбрать изображение слайда',
                button: { text: 'Тспользовать' },
                multiple: false
            });
            
            frame.on('select', function(){
                var attachment = frame.state().get('selection').first().toJSON();
                input.val(attachment.url);
                preview.html('<img src="'+attachment.url+'" style="max-width:100%; height:auto; max-height:150px;">');
            });
            
            frame.open();
        });

        // Add Slide Logic
        $('#add-slide').on('click', function(){
            var wrapper = $('#hero-slides-wrapper');
            var items = wrapper.find('.lavanda-slide-item');
            var index = items.length; // New index
            
            // Clone first item or create template
            // Simpler to just append HTML string for now to avoid cloning populated fields
            var html = `
            <div class="lavanda-slide-item" data-index="${index}" style="background:#fff; border:1px solid #ccc; padding:20px; margin-bottom:15px; border-radius:4px;">
                <h3 style="margin-top:0;">Слайд #<span class="slide-number">${index + 1}</span> 
                    <button type="button" class="button button-link-delete remove-slide" style="float:right; color:#b32d2e;">Удалить</button>
                </h3>
                
                <div style="display:grid; grid-template-columns: 1fr 1fr; gap:20px; margin-bottom:15px;">
                    <div>
                        <label>Изображение (Desktop):</label><br>
                        <div class="media-uploader-preview" style="margin-top:5px; margin-bottom:10px;"></div>
                        <input type="hidden" name="lavanda_hero_slides[${index}][img_desktop]" class="media-url-input" value="">
                        <button type="button" class="button media-upload-btn">Выбрать картинку</button>
                    </div>
                    <div>
                        <label>Изображение (Mobile):</label><br>
                        <div class="media-uploader-preview" style="margin-top:5px; margin-bottom:10px;"></div>
                        <input type="hidden" name="lavanda_hero_slides[${index}][img_mobile]" class="media-url-input" value="">
                        <button type="button" class="button media-upload-btn">Выбрать картинку</button>
                        <p class="description">Если не заполнено, используется Desktop.</p>
                    </div>
                </div>

                <div style="margin-bottom:10px;">
                    <label>Заголовок:</label>
                    <input type="text" name="lavanda_hero_slides[${index}][title]" value="" class="regular-text" style="width:100%;">
                </div>
                <div style="margin-bottom:10px;">
                    <label>Подзаголовок:</label>
                    <input type="text" name="lavanda_hero_slides[${index}][subtitle]" value="" class="regular-text" style="width:100%;">
                </div>
                <div style="display:flex; gap:10px;">
                    <div style="flex:1;">
                        <label>Текст кнопки:</label>
                        <input type="text" name="lavanda_hero_slides[${index}][btn_text]" value="" class="regular-text" style="width:100%;">
                    </div>
                    <div style="flex:1;">
                        <label>Ссылка кнопки:</label>
                        <input type="text" name="lavanda_hero_slides[${index}][btn_link]" value="" class="regular-text" style="width:100%;">
                    </div>
                </div>
            </div>`;
            
            wrapper.append(html);
        });

        // Remove Slide Logic
        $('body').on('click', '.remove-slide', function(){
            if(confirm('Удалить этот слайд?')) {
                $(this).closest('.lavanda-slide-item').remove();
                // Re-index logic might be needed if PHP relies on sequential 0,1,2, but usually array_values in sanitize fixes it.
            }
        });
    });
    </script>
    <?php
}

function lavanda_sanitize_slides($input) {
    if (!is_array($input)) return [];
    
    $clean = [];
    foreach ($input as $slide) {
        if (empty($slide['title']) && empty($slide['img_desktop'])) continue; // Skip empty
        
        $clean[] = [
            'img_desktop' => esc_url_raw($slide['img_desktop'] ?? ''),
            'img_mobile'  => esc_url_raw($slide['img_mobile'] ?? ''),
            'title'       => sanitize_text_field($slide['title'] ?? ''),
            'subtitle'    => sanitize_text_field($slide['subtitle'] ?? ''),
            'btn_text'    => sanitize_text_field($slide['btn_text'] ?? ''),
            'btn_link'    => esc_url_raw($slide['btn_link'] ?? ''),
        ];
    }
    return $clean;
}
