<?php
if (!defined('ABSPATH')) { exit; }

add_action('init', function () {
    register_post_type('pettt_explore', [
        'labels' => ['name'=>'اکسپلور پت‌ها','singular_name'=>'پست اکسپلور','add_new_item'=>'افزودن پست اکسپلور','edit_item'=>'ویرایش پست اکسپلور'],
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-camera',
        'supports' => ['title','editor','thumbnail','comments','author'],
        'show_in_rest' => true,
        'rewrite' => ['slug'=>'explore'],
    ]);
});

add_action('add_meta_boxes', function () {
    add_meta_box('pettt_explore_fields', 'اطلاعات پت در اکسپلور', 'pettt_explore_fields_cb', 'pettt_explore', 'normal', 'high');
});

function pettt_explore_fields_cb() {
    wp_nonce_field('pettt_meta_save','pettt_meta_nonce');
    pettt_field('_pettt_pet_name','اسم پت');
    pettt_field('_pettt_pet_breed','نژاد پت');
    pettt_field('_pettt_pet_food','غذای محبوب');
}

add_action('save_post_pettt_explore', function ($post_id) {
    if (!isset($_POST['pettt_meta_nonce']) || !wp_verify_nonce($_POST['pettt_meta_nonce'], 'pettt_meta_save')) return;
    foreach (['_pettt_pet_name','_pettt_pet_breed','_pettt_pet_food'] as $key) {
        if (isset($_POST[$key])) update_post_meta($post_id, $key, sanitize_text_field($_POST[$key]));
    }
});

add_action('wp_ajax_pettt_like_explore', 'pettt_like_explore');
add_action('wp_ajax_nopriv_pettt_like_explore', 'pettt_like_explore');
function pettt_like_explore() {
    $post_id = absint($_POST['post_id'] ?? 0);
    if (!$post_id) wp_send_json_error();
    $likes = (int) get_post_meta($post_id, '_pettt_likes', true);
    $likes++;
    update_post_meta($post_id, '_pettt_likes', $likes);
    wp_send_json_success(['likes'=>$likes]);
}

add_shortcode('pettt_explore_feed', function () {
    $q = new WP_Query(['post_type'=>'pettt_explore','posts_per_page'=>12,'post_status'=>'publish']);
    ob_start();
    echo '<div class="pettt-explore-feed">';
    while($q->have_posts()): $q->the_post();
        echo '<article class="pettt-explore-card">';
        if(has_post_thumbnail()) echo '<a href="'.esc_url(get_permalink()).'">'.get_the_post_thumbnail(get_the_ID(), 'pettt-card').'</a>';
        echo '<div class="pettt-explore-body"><span>'.esc_html(pettt_meta(get_the_ID(), '_pettt_pet_breed', 'پت')).'</span><h3>'.esc_html(pettt_meta(get_the_ID(), '_pettt_pet_name', get_the_title())).'</h3><p>'.esc_html(wp_trim_words(get_the_excerpt(), 18)).'</p><div class="pettt-explore-actions"><button class="pettt-like-btn" data-post="'.esc_attr(get_the_ID()).'">♥ <b>'.esc_html((int)get_post_meta(get_the_ID(), '_pettt_likes', true)).'</b></button><a href="'.esc_url(get_permalink()).'#comments">کامنت</a></div></div>';
        echo '</article>';
    endwhile; wp_reset_postdata();
    echo '</div>';
    return ob_get_clean();
});

add_action('wp_enqueue_scripts', function(){
    wp_localize_script('pettt-pro-main', 'petttExplore', ['ajax'=>admin_url('admin-ajax.php')]);
});
