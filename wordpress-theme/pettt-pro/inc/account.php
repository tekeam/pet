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
        'type' => sanitize_text_field($data['pet_type'] ?? ''),
        'gender' => sanitize_text_field($data['pet_gender'] ?? ''),
        'breed' => sanitize_text_field($data['pet_breed'] ?? ''),
        'age' => sanitize_text_field($data['pet_age'] ?? ''),
        'weight' => sanitize_text_field($data['pet_weight'] ?? ''),
        'food' => sanitize_text_field($data['pet_food'] ?? ''),
        'problems' => array_map('sanitize_text_field', (array)($data['pet_problems'] ?? [])),
        'disease' => sanitize_text_field($data['pet_disease'] ?? ''),
        'photo' => esc_url_raw($data['pet_photo'] ?? ''),
        'created_at' => current_time('mysql'),
    ];
    if (!empty($pet['name'])) {
        $edit_index = isset($data['pet_index']) && $data['pet_index'] !== '' ? absint($data['pet_index']) : null;
        if ($edit_index !== null && isset($pets[$edit_index])) $pets[$edit_index] = $pet; else $pets[] = $pet;
        update_user_meta($user_id, 'pettt_pets', array_values($pets));
    }
}

function pettt_account_delete_pet($user_id, $index) {
    $pets = pettt_account_get_pets($user_id);
    if (isset($pets[$index])) { unset($pets[$index]); update_user_meta($user_id, 'pettt_pets', array_values($pets)); }
}

function pettt_account_get_reminders($user_id) {
    $items = get_user_meta($user_id, 'pettt_reminders', true);
    return is_array($items) ? $items : [];
}

function pettt_account_save_reminder($user_id, $data) {
    $items = pettt_account_get_reminders($user_id);
    $item = ['title'=>sanitize_text_field($data['reminder_title'] ?? ''),'date'=>sanitize_text_field($data['reminder_date'] ?? ''),'time'=>sanitize_text_field($data['reminder_time'] ?? ''),'type'=>sanitize_text_field($data['reminder_type'] ?? ''),'created_at'=>current_time('mysql')];
    if (!empty($item['title']) && !empty($item['date'])) { $items[] = $item; update_user_meta($user_id, 'pettt_reminders', $items); }
}

add_action('template_redirect', function () {
    if (!is_user_logged_in() || empty($_POST['pettt_account_nonce'])) return;
    if (!wp_verify_nonce($_POST['pettt_account_nonce'], 'pettt_account_save')) return;
    $user_id = get_current_user_id();
    if (isset($_POST['pettt_save_pet'])) pettt_account_save_pet($user_id, $_POST);
    if (isset($_POST['pettt_save_reminder'])) pettt_account_save_reminder($user_id, $_POST);
    wp_safe_redirect(remove_query_arg(['pet_edit','pet_delete'])); exit;
});

add_action('template_redirect', function(){
    if(!is_user_logged_in() || !isset($_GET['pet_delete'])) return;
    if(!wp_verify_nonce($_GET['_wpnonce'] ?? '', 'ninjapet_delete_pet')) return;
    pettt_account_delete_pet(get_current_user_id(), absint($_GET['pet_delete']));
    wp_safe_redirect(remove_query_arg(['pet_delete','_wpnonce'])); exit;
});

add_shortcode('pettt_account_link', function () {
    $url = get_permalink(get_page_by_path('pettt-account')) ?: home_url('/pettt-account/');
    return '<a class="pettt-primary" href="'.esc_url($url).'">پروفایل پت من</a>';
});
