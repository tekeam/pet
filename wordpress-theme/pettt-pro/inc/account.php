<?php
if (!defined('ABSPATH')) { exit; }

function pettt_account_get_pets($user_id) {
    $pets = get_user_meta($user_id, 'pettt_pets', true);
    return is_array($pets) ? $pets : [];
}

function pettt_account_save_pet($user_id, $data) {
    $pets = pettt_account_get_pets($user_id);
    $pet = [
        'name' => sanitize_text_field($data['pet_name'] ?? ''),
        'gender' => sanitize_text_field($data['pet_gender'] ?? ''),
        'breed' => sanitize_text_field($data['pet_breed'] ?? ''),
        'weight' => sanitize_text_field($data['pet_weight'] ?? ''),
        'food' => sanitize_text_field($data['pet_food'] ?? ''),
        'disease' => sanitize_text_field($data['pet_disease'] ?? ''),
        'photo' => esc_url_raw($data['pet_photo'] ?? ''),
        'created_at' => current_time('mysql'),
    ];
    if (!empty($pet['name'])) {
        $pets[] = $pet;
        update_user_meta($user_id, 'pettt_pets', $pets);
    }
}

function pettt_account_get_reminders($user_id) {
    $items = get_user_meta($user_id, 'pettt_reminders', true);
    return is_array($items) ? $items : [];
}

function pettt_account_save_reminder($user_id, $data) {
    $items = pettt_account_get_reminders($user_id);
    $item = [
        'title' => sanitize_text_field($data['reminder_title'] ?? ''),
        'date' => sanitize_text_field($data['reminder_date'] ?? ''),
        'time' => sanitize_text_field($data['reminder_time'] ?? ''),
        'type' => sanitize_text_field($data['reminder_type'] ?? ''),
        'created_at' => current_time('mysql'),
    ];
    if (!empty($item['title']) && !empty($item['date'])) {
        $items[] = $item;
        update_user_meta($user_id, 'pettt_reminders', $items);
    }
}

add_action('template_redirect', function () {
    if (!is_page_template('page-pettt-account.php')) return;
    if (!is_user_logged_in() || empty($_POST['pettt_account_nonce'])) return;
    if (!wp_verify_nonce($_POST['pettt_account_nonce'], 'pettt_account_save')) return;
    $user_id = get_current_user_id();
    if (isset($_POST['pettt_save_pet'])) pettt_account_save_pet($user_id, $_POST);
    if (isset($_POST['pettt_save_reminder'])) pettt_account_save_reminder($user_id, $_POST);
    wp_safe_redirect(get_permalink());
    exit;
});

add_shortcode('pettt_account_link', function () {
    $url = get_permalink(get_page_by_path('pettt-account')) ?: home_url('/pettt-account/');
    return '<a class="pettt-primary" href="'.esc_url($url).'">پروفایل پت من</a>';
});
