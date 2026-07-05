<?php
if (!defined('ABSPATH')) { exit; }

define('PETTT_PRO_VERSION', '1.0.0');

action_scheduler_init_placeholder();
function action_scheduler_init_placeholder() {}

add_action('after_setup_theme', function () {
    load_theme_textdomain('pettt-pro', get_template_directory() . '/languages');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', ['search-form','comment-form','comment-list','gallery','caption','style','script']);
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
    register_nav_menus([
        'primary' => 'منوی اصلی',
        'footer'  => 'منوی فوتر',
        'mobile'  => 'منوی موبایل',
    ]);
});

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('pettt-pro-font', 'https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800;900&display=swap', [], null);
    wp_enqueue_style('pettt-pro-style', get_stylesheet_uri(), [], PETTT_PRO_VERSION);
    wp_enqueue_script('pettt-pro-main', get_template_directory_uri() . '/assets/js/theme.js', ['jquery'], PETTT_PRO_VERSION, true);
});

add_action('init', function () {
    pettt_register_cpt('pettt_brand', 'برندها', 'برند', 'dashicons-awards', ['title','editor','thumbnail','excerpt']);
    pettt_register_cpt('pettt_food', 'مدل‌های غذا', 'مدل غذا', 'dashicons-carrot', ['title','editor','thumbnail','excerpt']);
    pettt_register_cpt('pettt_video', 'ویدیوهای آموزشی', 'ویدیو', 'dashicons-video-alt3', ['title','editor','thumbnail','excerpt']);
    pettt_register_cpt('pettt_service', 'خدمات شهری', 'خدمت', 'dashicons-location-alt', ['title','editor','thumbnail','excerpt']);
    register_taxonomy('pettt_service_type', ['pettt_service'], [
        'label' => 'نوع خدمت',
        'public' => true,
        'show_admin_column' => true,
        'hierarchical' => true,
        'rewrite' => ['slug' => 'service-type'],
    ]);
    register_taxonomy('pettt_food_problem', ['pettt_food'], [
        'label' => 'مشکل یا نیاز پت',
        'public' => true,
        'show_admin_column' => true,
        'hierarchical' => true,
        'rewrite' => ['slug' => 'food-problem'],
    ]);
});

function pettt_register_cpt($type, $plural, $single, $icon, $supports) {
    register_post_type($type, [
        'labels' => ['name'=>$plural, 'singular_name'=>$single, 'add_new_item'=>'افزودن '.$single, 'edit_item'=>'ویرایش '.$single],
        'public' => true,
        'has_archive' => true,
        'menu_icon' => $icon,
        'supports' => $supports,
        'show_in_rest' => true,
        'rewrite' => ['slug' => str_replace('pettt_', '', $type)],
    ]);
}

add_action('add_meta_boxes', function () {
    add_meta_box('pettt_brand_fields', 'اطلاعات برند', 'pettt_brand_fields_cb', 'pettt_brand', 'normal', 'high');
    add_meta_box('pettt_food_fields', 'اطلاعات غذا و خرید', 'pettt_food_fields_cb', 'pettt_food', 'normal', 'high');
    add_meta_box('pettt_video_fields', 'اطلاعات ویدیو', 'pettt_video_fields_cb', 'pettt_video', 'normal', 'high');
    add_meta_box('pettt_service_fields', 'اطلاعات خدمت شهری', 'pettt_service_fields_cb', 'pettt_service', 'normal', 'high');
});

function pettt_field($id, $label, $type='text', $placeholder='') {
    $value = esc_attr(get_post_meta(get_the_ID(), $id, true));
    echo '<p><label style="font-weight:700;display:block;margin-bottom:6px">'.esc_html($label).'</label><input style="width:100%;padding:10px" type="'.esc_attr($type).'" name="'.esc_attr($id).'" value="'.$value.'" placeholder="'.esc_attr($placeholder).'"></p>';
}
function pettt_textarea($id, $label, $placeholder='') {
    $value = esc_textarea(get_post_meta(get_the_ID(), $id, true));
    echo '<p><label style="font-weight:700;display:block;margin-bottom:6px">'.esc_html($label).'</label><textarea style="width:100%;min-height:110px;padding:10px" name="'.esc_attr($id).'" placeholder="'.esc_attr($placeholder).'">'.$value.'</textarea></p>';
}
function pettt_brand_fields_cb() {
    wp_nonce_field('pettt_meta_save','pettt_meta_nonce');
    pettt_field('_pettt_country','کشور برند');
    pettt_field('_pettt_tier','سطح برند', 'text', 'سوپرپرمیوم / پرمیوم / اقتصادی');
    pettt_textarea('_pettt_history','تاریخچه برند');
    pettt_textarea('_pettt_models','مدل‌های غذا، هر خط یک مدل');
    pettt_field('_pettt_gallery','آیدی تصاویر گالری', 'text', 'مثال: 12,24,35');
}
function pettt_food_fields_cb() {
    wp_nonce_field('pettt_meta_save','pettt_meta_nonce');
    pettt_field('_pettt_brand_id','آیدی یا نام برند مرتبط');
    pettt_field('_pettt_price','قیمت حدودی');
    pettt_field('_pettt_buy_url','لینک خرید');
    pettt_field('_pettt_pet_type','نوع پت', 'text', 'گربه / سگ');
    pettt_field('_pettt_life_stage','سن یا مرحله زندگی');
    pettt_textarea('_pettt_feeding_table','جدول تغذیه');
    pettt_textarea('_pettt_analysis','آنالیز تضمینی');
}
function pettt_video_fields_cb() {
    wp_nonce_field('pettt_meta_save','pettt_meta_nonce');
    pettt_field('_pettt_video_file','لینک فایل ویدیو');
    pettt_textarea('_pettt_aparat_script','کد اسکریپت آپارات');
}
function pettt_service_fields_cb() {
    wp_nonce_field('pettt_meta_save','pettt_meta_nonce');
    pettt_field('_pettt_province','استان');
    pettt_field('_pettt_city','شهر');
    pettt_field('_pettt_phone','شماره تماس');
    pettt_field('_pettt_address','آدرس');
}

add_action('save_post', function ($post_id) {
    if (!isset($_POST['pettt_meta_nonce']) || !wp_verify_nonce($_POST['pettt_meta_nonce'], 'pettt_meta_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    $keys = ['_pettt_country','_pettt_tier','_pettt_history','_pettt_models','_pettt_gallery','_pettt_brand_id','_pettt_price','_pettt_buy_url','_pettt_pet_type','_pettt_life_stage','_pettt_feeding_table','_pettt_analysis','_pettt_video_file','_pettt_aparat_script','_pettt_province','_pettt_city','_pettt_phone','_pettt_address'];
    foreach ($keys as $key) if (isset($_POST[$key])) update_post_meta($post_id, $key, wp_kses_post($_POST[$key]));
});

function pettt_meta($id, $key, $default='') { $v = get_post_meta($id, $key, true); return $v ? $v : $default; }
function pettt_query($type, $count=6) { return new WP_Query(['post_type'=>$type, 'posts_per_page'=>$count, 'post_status'=>'publish']); }

add_action('widgets_init', function () {
    register_sidebar(['name'=>'فوتر ۱','id'=>'footer-1','before_widget'=>'<div class="footer-widget">','after_widget'=>'</div>']);
    register_sidebar(['name'=>'فوتر ۲','id'=>'footer-2','before_widget'=>'<div class="footer-widget">','after_widget'=>'</div>']);
});

add_action('customize_register', function($wp_customize){
    $wp_customize->add_section('pettt_home', ['title'=>'تنظیمات صفحه اصلی Pettt']);
    foreach (['hero_title'=>'عنوان پوستر اصلی','hero_text'=>'متن پوستر اصلی','contact_phone'=>'شماره تماس','contact_email'=>'ایمیل تماس'] as $id=>$label) {
        $wp_customize->add_setting($id, ['default'=>'', 'sanitize_callback'=>'sanitize_text_field']);
        $wp_customize->add_control($id, ['label'=>$label, 'section'=>'pettt_home', 'type'=>'text']);
    }
});

add_action('woocommerce_before_shop_loop_item_title', function(){ echo '<div class="pettt-product-badge">Pettt Shop</div>'; }, 5);
