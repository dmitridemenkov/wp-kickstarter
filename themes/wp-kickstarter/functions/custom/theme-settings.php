<?php
/**
 * Настройки сайта (Контакты и соцсети) - Расширенная версия
 */

add_action('admin_menu', function() {
    $hook = add_menu_page(
        'Настройки сайта',
        'Настройки сайта',
        'manage_options',
        'lavanda-settings',
        'lavanda_render_settings_page',
        'dashicons-admin-home',
        20
    );
    
    // Подключаем скрипты медиа-загрузчика только на нашей странице
    add_action('admin_enqueue_scripts', function($current_hook) use ($hook) {
        if ($current_hook !== $hook) return;
        wp_enqueue_media();
    });
});

add_action('admin_init', function() {
    register_setting('lavanda_settings_group', 'lavanda_address');
    register_setting('lavanda_settings_group', 'lavanda_email');
    
    register_setting('lavanda_settings_group', 'lavanda_phones', [
        'type' => 'array',
        'sanitize_callback' => 'lavanda_sanitize_array_filter'
    ]);
    
    register_setting('lavanda_settings_group', 'lavanda_socials', [
        'type' => 'array',
        'sanitize_callback' => function($input) {
            if (!is_array($input)) return [];
            return array_values(array_filter($input, function($item) {
                return !empty($item['url']); // Сохраняем только если есть ссылка
            }));
        }
    ]);
});

// Хелпер для очистки пустых строк в массиве
function lavanda_sanitize_array_filter($input) {
    if (!is_array($input)) return [];
    return array_values(array_filter($input, 'trim'));
}

function lavanda_render_settings_page() {
    // Получаем данные
    $address = get_option('lavanda_address', '');
    $email = get_option('lavanda_email', '');
    $phones = get_option('lavanda_phones', []);
    if (!is_array($phones)) $phones = [];
    if (empty($phones)) $phones = [''];

    $socials = get_option('lavanda_socials', []);
    if (!is_array($socials)) $socials = [];
    ?>
    <div class="wrap">
        <h1>Настройки сайта</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('lavanda_settings_group');
            do_settings_sections('lavanda_settings_group');
            ?>
            <table class="form-table">
                <!-- Адрес -->
                <tr valign="top">
                    <th scope="row">Адрес</th>
                    <td>
                        <input type="text" name="lavanda_address" value="<?php echo esc_attr($address); ?>" class="regular-text" />
                    </td>
                </tr>

                <!-- Email -->
                <tr valign="top">
                    <th scope="row">Email</th>
                    <td>
                        <input type="email" name="lavanda_email" value="<?php echo esc_attr($email); ?>" class="regular-text" placeholder="info@lavanda.ru" />
                    </td>
                </tr>

                <!-- Телефоны (Repeater) -->
                <tr valign="top">
                    <th scope="row">Телефоны</th>
                    <td>
                        <div id="phones-wrapper">
                            <?php foreach ($phones as $phone): ?>
                            <div class="phone-row" style="margin-bottom: 10px; display: flex; gap: 10px;">
                                <input type="text" name="lavanda_phones[]" value="<?php echo esc_attr($phone); ?>" class="regular-text" placeholder="+7 (999) 000-00-00" />
                                <button type="button" class="button remove-row">✕</button>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <button type="button" class="button" id="add-phone">Добавить телефон</button>
                    </td>
                </tr>

                <!-- Соцсети (Repeater + Media) -->
                <tr valign="top">
                    <th scope="row">Соцсети</th>
                    <td>
                        <div id="socials-wrapper">
                            <?php foreach ($socials as $index => $social): ?>
                            <div class="social-row" style="margin-bottom: 15px; border: 1px solid #ddd; padding: 15px; background: #fff; border-radius: 4px;">
                                <div style="display: flex; gap: 10px; margin-bottom: 10px; align-items: start;">
                                    <!-- Иконка Превью -->
                                    <div style="width: 50px; height: 50px; background: #f0f0f1; display: flex; align-items: center; justify-content: center; overflow: hidden; border-radius: 4px; border: 1px solid #ccc;">
                                        <?php if (!empty($social['icon'])): ?>
                                            <img src="<?php echo esc_url($social['icon']); ?>" style="max-width:100%; max-height:100%;" class="start-icon-preview">
                                        <?php else: ?>
                                            <span class="dashicons dashicons-format-image start-icon-placeholder" style="color:#ccc;"></span>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div style="flex-grow: 1;">
                                        <div style="margin-bottom: 5px;">
                                            <input type="text" name="lavanda_socials[<?php echo $index; ?>][icon]" value="<?php echo esc_attr($social['icon'] ?? ''); ?>" class="regular-text icon-url-input" placeholder="URL иконки" />
                                            <button type="button" class="button upload-icon-btn">Выбрать иконку</button>
                                        </div>
                                        <div>
                                            <input type="url" name="lavanda_socials[<?php echo $index; ?>][url]" value="<?php echo esc_attr($social['url'] ?? ''); ?>" class="regular-text" placeholder="Ссылка (https://...)" style="width: 100%;" />
                                        </div>
                                    </div>
                                </div>
                                <div style="display: flex; gap: 10px; align-items: center;">
                                    <input type="text" name="lavanda_socials[<?php echo $index; ?>][label]" value="<?php echo esc_attr($social['label'] ?? ''); ?>" class="regular-text" placeholder="Подпись (необязательно)" style="width: 100%;" />
                                    <button type="button" class="button remove-social-row" style="color: #b32d2e; border-color: #b32d2e;">Удалить</button>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <button type="button" class="button button-secondary" id="add-social">Добавить соцсеть</button>
                    </td>
                </tr>
            </table>

            <?php submit_button(); ?>
        </form>
    </div>

    <script>
    jQuery(document).ready(function($) {
        // --- Телефоны ---
        const phonesWrapper = $('#phones-wrapper');
        $('#add-phone').on('click', function() {
            phonesWrapper.append(`
                <div class="phone-row" style="margin-bottom: 10px; display: flex; gap: 10px;">
                    <input type="text" name="lavanda_phones[]" value="" class="regular-text" placeholder="+7 (999) 000-00-00" />
                    <button type="button" class="button remove-row">✕</button>
                </div>
            `);
        });

        phonesWrapper.on('click', '.remove-row', function() {
            if (phonesWrapper.find('.phone-row').length > 1) {
                $(this).closest('.phone-row').remove();
            } else {
                $(this).prev('input').val('');
            }
        });

        // --- Соцсети и Медиа Загрузчик ---
        const socialsWrapper = $('#socials-wrapper');
        let socialIndex = <?php echo count($socials); ?>;

        $('#add-social').on('click', function() {
            socialsWrapper.append(`
                <div class="social-row" style="margin-bottom: 15px; border: 1px solid #ddd; padding: 15px; background: #fff; border-radius: 4px;">
                    <div style="display: flex; gap: 10px; margin-bottom: 10px; align-items: start;">
                        <div style="width: 50px; height: 50px; background: #f0f0f1; display: flex; align-items: center; justify-content: center; overflow: hidden; border-radius: 4px; border: 1px solid #ccc;">
                            <span class="dashicons dashicons-format-image start-icon-placeholder" style="color:#ccc;"></span>
                        </div>
                        <div style="flex-grow: 1;">
                            <div style="margin-bottom: 5px;">
                                <input type="text" name="lavanda_socials[${socialIndex}][icon]" value="" class="regular-text icon-url-input" placeholder="URL иконки" />
                                <button type="button" class="button upload-icon-btn">Выбрать иконку</button>
                            </div>
                            <div>
                                <input type="url" name="lavanda_socials[${socialIndex}][url]" value="" class="regular-text" placeholder="Ссылка (https://...)" style="width: 100%;" />
                            </div>
                        </div>
                    </div>
                    <div style="display: flex; gap: 10px; align-items: center;">
                        <input type="text" name="lavanda_socials[${socialIndex}][label]" value="" class="regular-text" placeholder="Подпись (необязательно)" style="width: 100%;" />
                        <button type="button" class="button remove-social-row" style="color: #b32d2e; border-color: #b32d2e;">Удалить</button>
                    </div>
                </div>
            `);
            socialIndex++;
        });

        socialsWrapper.on('click', '.remove-social-row', function() {
            $(this).closest('.social-row').remove();
        });

        // Медиа загрузчик
        let frame;
        let currentBtn;

        socialsWrapper.on('click', '.upload-icon-btn', function(e) {
            e.preventDefault();
            currentBtn = $(this);

            if (frame) {
                frame.open();
                return;
            }

            frame = wp.media({
                title: 'Выберите иконку',
                button: { text: 'Вставить' },
                multiple: false
            });

            frame.on('select', function() {
                const attachment = frame.state().get('selection').first().toJSON();
                const row = currentBtn.closest('.social-row');
                
                row.find('.icon-url-input').val(attachment.url);
                
                // Обновляем превью
                const previewDiv = row.find('div[style*="width: 50px"]');
                previewDiv.html(`<img src="${attachment.url}" style="max-width:100%; max-height:100%;" class="start-icon-preview">`);
            });

            frame.open();
        });
    });
    </script>
    <?php
}

/**
 * Helper to get clean phones array
 */
function lavanda_get_phones() {
    $phones = get_option('lavanda_phones', []);
    if (!is_array($phones)) {
        // Fallback for old textarea data if it existed
        if (is_string($phones) && !empty($phones)) {
            return array_filter(array_map('trim', explode("\n", $phones)));
        }
        return [];
    }
    return array_filter($phones, 'trim');
}

/**
 * Helper to get socials
 */
function lavanda_get_socials() {
    $socials = get_option('lavanda_socials', []);
    if (!is_array($socials)) return [];
    return $socials;
}
