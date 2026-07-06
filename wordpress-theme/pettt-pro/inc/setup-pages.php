<?php
if (!defined('ABSPATH')) { exit; }

function ninjapet_ensure_page($title, $slug, $content='', $template='') {
    $existing = get_page_by_path($slug);
    if ($existing) {
        if ($template) update_post_meta($existing->ID, '_wp_page_template', $template);
        return $existing->ID;
    }
    $id = wp_insert_post(['post_type'=>'page','post_status'=>'publish','post_title'=>$title,'post_name'=>$slug,'post_content'=>$content]);
    if($id && !is_wp_error($id) && $template) update_post_meta($id, '_wp_page_template', $template);
    return $id;
}

function ninjapet_setup_default_pages() {
    ninjapet_ensure_page('پروفایل من','pettt-account','', 'page-ninjapet-account.php');
    ninjapet_ensure_page('ثبت مرکز پت','submit-service','[ninjapet_submit_service]', 'page-submit-service.php');
    ninjapet_ensure_page('ارسال پست اکسپلور','submit-explore','[ninjapet_submit_explore]', 'page-submit-explore.php');
    ninjapet_ensure_page('پیشنهاد غذای پت','food-advisor','[ninjapet_food_advisor]', 'page-food-advisor.php');
}
add_action('after_switch_theme', 'ninjapet_setup_default_pages');
add_action('admin_init', function(){ if(!get_option('ninjapet_pages_checked')){ ninjapet_setup_default_pages(); update_option('ninjapet_pages_checked', 1); } });
