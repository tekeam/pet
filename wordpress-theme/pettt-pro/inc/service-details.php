<?php
if (!defined('ABSPATH')) { exit; }

add_action('add_meta_boxes', function () {
    add_meta_box('pettt_service_extra_fields', 'رسانه و ارتباطات خدمت', 'pettt_service_extra_fields_cb', 'pettt_service', 'normal', 'high');
});

function pettt_service_extra_fields_cb() {
    wp_nonce_field('pettt_service_extra_save', 'pettt_service_extra_nonce');
    pettt_field('_pettt_instagram', 'پیج اینستاگرام', 'text', '@petshop یا لینک کامل');
    pettt_field('_pettt_whatsapp', 'واتساپ', 'text', 'شماره یا لینک واتساپ');
    pettt_field('_pettt_pet_types', 'نوع حیوان قابل پذیرش', 'text', 'سگ / گربه / همه حیوانات');
    pettt_field('_pettt_website', 'وب‌سایت یا لینک رزرو', 'url', 'https://example.com');
    pettt_field('_pettt_working_hours', 'ساعت کاری', 'text', 'شنبه تا پنجشنبه ۱۰ تا ۲۲');
    pettt_field('_pettt_video_url', 'لینک ویدئو معرفی', 'url', 'https://...');
    pettt_textarea('_pettt_video_embed', 'کد ویدئو معرفی یا شورت‌کد');
    pettt_textarea('_pettt_google_map_embed', 'کد Google Map iframe');
}

add_action('save_post_pettt_service', function ($post_id) {
    if (!isset($_POST['pettt_service_extra_nonce']) || !wp_verify_nonce($_POST['pettt_service_extra_nonce'], 'pettt_service_extra_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    $keys = ['_pettt_instagram','_pettt_whatsapp','_pettt_pet_types','_pettt_website','_pettt_working_hours','_pettt_video_url','_pettt_video_embed','_pettt_google_map_embed'];
    foreach ($keys as $key) {
        if (!isset($_POST[$key])) continue;
        $value = in_array($key, ['_pettt_video_embed','_pettt_google_map_embed'], true) ? wp_kses_post($_POST[$key]) : sanitize_text_field($_POST[$key]);
        update_post_meta($post_id, $key, $value);
    }
});

function pettt_service_instagram_url($value) {
    $value = trim((string) $value);
    if (!$value) return '';
    if (strpos($value, 'http') === 0) return esc_url($value);
    return esc_url('https://instagram.com/' . ltrim($value, '@'));
}

function pettt_service_allowed_embed($html) {
    return wp_kses($html, [
        'iframe' => ['src'=>true,'width'=>true,'height'=>true,'style'=>true,'loading'=>true,'allowfullscreen'=>true,'allow'=>true,'referrerpolicy'=>true,'frameborder'=>true],
        'script' => ['src'=>true,'type'=>true,'async'=>true],
        'div' => ['class'=>true,'id'=>true,'style'=>true],
        'span' => ['class'=>true,'style'=>true],
    ]);
}

add_filter('manage_pettt_service_posts_columns', function($columns){
    $columns['pettt_instagram'] = 'اینستاگرام';
    $columns['pettt_whatsapp'] = 'واتساپ';
    $columns['pettt_pet_types'] = 'پذیرش';
    $columns['pettt_map'] = 'مپ';
    return $columns;
});
add_action('manage_pettt_service_posts_custom_column', function($column, $post_id){
    if ($column === 'pettt_instagram') echo esc_html(pettt_meta($post_id, '_pettt_instagram', '-'));
    if ($column === 'pettt_whatsapp') echo esc_html(pettt_meta($post_id, '_pettt_whatsapp', '-'));
    if ($column === 'pettt_pet_types') echo esc_html(pettt_meta($post_id, '_pettt_pet_types', '-'));
    if ($column === 'pettt_map') echo pettt_meta($post_id, '_pettt_google_map_embed') ? 'ثبت شده' : 'ثبت نشده';
}, 10, 2);
