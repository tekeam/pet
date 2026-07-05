<?php
if (!defined('ABSPATH')) { exit; }

add_action('woocommerce_before_shop_loop', function () {
    if (!is_shop() && !is_product_taxonomy()) return;
    $problems = get_terms(['taxonomy'=>'pettt_food_problem','hide_empty'=>false]);
    echo '<form class="pettt-shop-filter" method="get"><input type="search" name="s" value="'.esc_attr(get_search_query()).'" placeholder="جستجوی غذا، برند یا نیاز پت..."><select name="pettt_problem"><option value="">همه نیازها</option>';
    if (!is_wp_error($problems)) foreach ($problems as $term) echo '<option value="'.esc_attr($term->slug).'" '.selected($_GET['pettt_problem'] ?? '', $term->slug, false).'>'.esc_html($term->name).'</option>';
    echo '</select><button type="submit">فیلتر محصولات</button></form>';
}, 5);

add_action('pre_get_posts', function ($query) {
    if (is_admin() || !$query->is_main_query()) return;
    if (!class_exists('WooCommerce')) return;
    if (!is_shop() && !is_product_taxonomy()) return;
    if (!empty($_GET['pettt_problem'])) {
        $tax = (array) $query->get('tax_query');
        $tax[] = ['taxonomy'=>'pettt_food_problem','field'=>'slug','terms'=>sanitize_text_field($_GET['pettt_problem'])];
        $query->set('tax_query', $tax);
    }
});

add_action('woocommerce_single_product_summary', function () {
    global $product;
    if (!$product) return;
    echo '<div class="pettt-product-trust"><span>ارسال سریع</span><span>مناسب پت شما</span><span>پشتیبانی دامپزشکی</span></div>';
}, 25);

add_filter('woocommerce_product_tabs', function ($tabs) {
    $tabs['pettt_feeding'] = [
        'title' => 'راهنمای تغذیه',
        'priority' => 35,
        'callback' => function () { echo '<h2>راهنمای تغذیه</h2><p>برای انتخاب مقدار مناسب، وزن، سن، نژاد و شرایط سلامتی پت را در نظر بگیرید.</p>'; }
    ];
    return $tabs;
});

add_shortcode('pettt_shop_recommendations', function(){
    if (!is_user_logged_in()) return '';
    $pets = pettt_account_get_pets(get_current_user_id());
    if (!$pets) return '';
    return pettt_render_recommendations_for_pet($pets[0]);
});
