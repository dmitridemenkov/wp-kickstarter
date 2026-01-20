<?php
/**
 * Shortcodes for Theme Settings
 */

// [lavanda_phone index="0" link="yes"]
add_shortcode('lavanda_phone', function($atts) {
    $a = shortcode_atts([
        'index' => 0,
        'link'  => 'yes'
    ], $atts);

    $phones = get_option('lavanda_phones', []);
    if (!is_array($phones) || empty($phones[$a['index']])) return '';

    $phone = $phones[$a['index']];
    if ($a['link'] === 'yes') {
        $clean_phone = preg_replace('/[^0-9+]/', '', $phone);
        return sprintf('<a href="tel:%s" class="theme-phone-link">%s</a>', $clean_phone, esc_html($phone));
    }

    return esc_html($phone);
});

// [lavanda_email link="yes"]
add_shortcode('lavanda_email', function($atts) {
    $a = shortcode_atts([
        'link' => 'yes'
    ], $atts);

    $email = get_option('lavanda_email', '');
    if (empty($email)) {
        $email = get_option('admin_email');
    }
    
    if (empty($email)) return '';

    if ($a['link'] === 'yes') {
        return sprintf('<a href="mailto:%s" class="theme-email-link">%s</a>', esc_attr($email), esc_html($email));
    }

    return esc_html($email);
});

// [lavanda_address]
add_shortcode('lavanda_address', function() {
    return esc_html(get_option('lavanda_address', ''));
});

// [lavanda_socials]
add_shortcode('lavanda_socials', function() {
    $socials = get_option('lavanda_socials', []);
    if (empty($socials) || !is_array($socials)) return '';

    $output = '<div class="theme-socials-shortcode flex gap-4 items-center">';
    foreach ($socials as $social) {
        if (empty($social['url'])) continue;
        
        $output .= sprintf(
            '<a href="%s" target="_blank" class="theme-social-link" title="%s">',
            esc_url($social['url']),
            esc_attr($social['label'] ?? '')
        );

        if (!empty($social['icon'])) {
            $output .= sprintf('<img src="%s" alt="" style="width:24px; height:24px; object-contain;">', esc_url($social['icon']));
        } else {
            $output .= esc_html($social['label'] ?? 'Link');
        }

        $output .= '</a>';
    }
    $output .= '</div>';

    return $output;
});
