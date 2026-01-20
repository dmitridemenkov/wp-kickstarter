<?php
/**
 * Gallery Settings Page
 */

add_action('admin_menu', function() {
    add_menu_page(
        'Галерея работ',
        'Галерея работ',
        'manage_options',
        'lavanda-gallery',
        'lavanda_gallery_page',
        'dashicons-format-gallery',
        25
    );
}, 30);

function lavanda_gallery_page() {
    wp_enqueue_media();
    $gallery_ids = get_option('lavanda_gallery_ids', '');
    $ids_array = array_filter(explode(',', $gallery_ids));
    ?>
    <div class="wrap">
        <h1>Галерея наших работ</h1>
        <form method="post" action="options.php">
            <?php settings_fields('lavanda_gallery_group'); ?>
            
            <div id="gallery-container" style="margin-top: 20px;">
                <input type="hidden" name="lavanda_gallery_ids" id="lavanda_gallery_ids" value="<?php echo esc_attr($gallery_ids); ?>">
                
                <div id="gallery-previews" style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 20px;">
                    <?php if (!empty($ids_array)): ?>
                        <?php foreach ($ids_array as $id): 
                            $img = wp_get_attachment_image_url($id, 'thumbnail');
                            if ($img): ?>
                                <div class="gallery-item" data-id="<?php echo $id; ?>" style="position: relative; width: 100px; height: 100px; border: 1px solid #ccc; border-radius: 4px; overflow: hidden; background: #eee;">
                                    <img src="<?php echo $img; ?>" style="width: 100%; height: 100%; object-cover: cover;">
                                    <button type="button" class="remove-gallery-item" style="position: absolute; top: 0; right: 0; background: red; color: white; border: none; cursor: pointer; padding: 2px 6px; font-size: 10px;">&times;</button>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <button type="button" id="add-to-gallery" class="button button-secondary">Добавить фотографии</button>
            </div>

            <?php submit_button(); ?>
        </form>
    </div>

    <script>
    jQuery(document).ready(function($) {
        var frame;
        $('#add-to-gallery').on('click', function(e) {
            e.preventDefault();
            if (frame) {
                frame.open();
                return;
            }
            frame = wp.media({
                title: 'Выберите фотографии для галереи',
                button: { text: 'Добавить в галерею' },
                multiple: true
            });
            frame.on('select', function() {
                var selection = frame.state().get('selection');
                var ids = $('#lavanda_gallery_ids').val() ? $('#lavanda_gallery_ids').val().split(',') : [];
                
                selection.each(function(attachment) {
                    attachment = attachment.toJSON();
                    if (!ids.includes(attachment.id.toString())) {
                        ids.push(attachment.id);
                        $('#gallery-previews').append(
                            '<div class="gallery-item" data-id="' + attachment.id + '" style="position: relative; width: 100px; height: 100px; border: 1px solid #ccc; border-radius: 4px; overflow: hidden; background: #eee;">' +
                            '<img src="' + (attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url) + '" style="width: 100%; height: 100%; object-fit: cover;">' +
                            '<button type="button" class="remove-gallery-item" style="position: absolute; top: 0; right: 0; background: red; color: white; border: none; cursor: pointer; padding: 2px 6px; font-size: 10px;">&times;</button>' +
                            '</div>'
                        );
                    }
                });
                $('#lavanda_gallery_ids').val(ids.join(','));
            });
            frame.open();
        });

        $(document).on('click', '.remove-gallery-item', function() {
            var id = $(this).closest('.gallery-item').data('id').toString();
            var ids = $('#lavanda_gallery_ids').val().split(',');
            ids = ids.filter(function(v) { return v !== id; });
            $('#lavanda_gallery_ids').val(ids.join(','));
            $(this).closest('.gallery-item').remove();
        });
        
        // Drag and drop sorting could be added here later if needed
    });
    </script>
    <?php
}

add_action('admin_init', function() {
    register_setting('lavanda_gallery_group', 'lavanda_gallery_ids');
});
