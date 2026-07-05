<?php
if (!defined('ABSPATH')) { exit; }

add_action('admin_menu', function () {
    add_submenu_page('pettt-dashboard', 'دمو دیتا', 'دمو دیتا', 'manage_options', 'pettt-demo-data', 'pettt_demo_data_page');
});

function pettt_demo_data_page() {
    if (!current_user_can('manage_options')) return;
    if (isset($_POST['pettt_seed_demo']) && check_admin_referer('pettt_seed_demo_action','pettt_seed_demo_nonce')) {
        pettt_seed_demo_data();
        echo '<div class="notice notice-success"><p>دمو دیتای Pettt با موفقیت ساخته شد.</p></div>';
    }
    ?>
    <div class="wrap pettt-admin-wrap">
      <h1>نصب دمو دیتای Pettt</h1>
      <p>با این گزینه چند برند، مدل غذا، ویدیو، مقاله، خدمت شهری و محصول فروشگاه نمونه ساخته می‌شود.</p>
      <form method="post">
        <?php wp_nonce_field('pettt_seed_demo_action','pettt_seed_demo_nonce'); ?>
        <button class="button button-primary button-hero" name="pettt_seed_demo" value="1">ساخت دمو دیتا</button>
      </form>
    </div>
    <?php
}

function pettt_seed_demo_data() {
    if (get_option('pettt_demo_seeded')) return;

    $brands = [
        ['رویال کنین','فرانسه','سوپرپرمیوم','Royal Canin','Gastrointestinal\nRenal\nSterilised\nUrinary'],
        ['آکانا','کانادا','پرمیوم','Acana','Indoor Entrée\nWild Prairie\nGrasslands'],
        ['هیلز','آمریکا','درمانی','Hills','Digestive Care\nMetabolic\nKidney Care'],
        ['ویسکاس','تایلند','اقتصادی','Whiskas','Adult Chicken\nTuna\nKitten'],
    ];
    foreach ($brands as $b) {
        $id = wp_insert_post(['post_type'=>'pettt_brand','post_status'=>'publish','post_title'=>$b[0],'post_excerpt'=>$b[3],'post_content'=>'توضیحات کامل برند '.$b[0].' در این بخش توسط مدیر قابل ویرایش است.']);
        update_post_meta($id, '_pettt_country', $b[1]);
        update_post_meta($id, '_pettt_tier', $b[2]);
        update_post_meta($id, '_pettt_history', 'تاریخچه برند '.$b[0].'، فلسفه تولید، کیفیت ترکیبات و جایگاه آن در بازار غذای حیوانات خانگی.');
        update_post_meta($id, '_pettt_models', $b[4]);
    }

    $foods = [
        ['گاسترواینتستینال گربه','رویال کنین','۱,۸۵۰,۰۰۰','گربه','بالغ','https://example.com/royal-gastro','گوارشی'],
        ['رنال گربه','رویال کنین','۱,۹۲۰,۰۰۰','گربه','بالغ','https://example.com/renal','کلیوی'],
        ['ایندور آکانا','آکانا','۲,۲۰۰,۰۰۰','گربه','بالغ','https://example.com/acana','کنترل وزن'],
        ['دایجستیو کر هیلز','هیلز','۱,۷۲۰,۰۰۰','گربه','بالغ','https://example.com/hills','گوارشی'],
    ];
    foreach ($foods as $f) {
        $id = wp_insert_post(['post_type'=>'pettt_food','post_status'=>'publish','post_title'=>$f[0],'post_content'=>'شرح محصول، ترکیبات، موارد مصرف و هشدارهای تغذیه‌ای.']);
        update_post_meta($id, '_pettt_brand_id', $f[1]);
        update_post_meta($id, '_pettt_price', $f[2]);
        update_post_meta($id, '_pettt_pet_type', $f[3]);
        update_post_meta($id, '_pettt_life_stage', $f[4]);
        update_post_meta($id, '_pettt_buy_url', $f[5]);
        update_post_meta($id, '_pettt_feeding_table', "۲ کیلو: ۳۰ گرم\n۴ کیلو: ۵۰ گرم\n۶ کیلو: ۷۰ گرم");
        update_post_meta($id, '_pettt_analysis', "پروتئین: ۳۴٪\nچربی: ۱۵٪\nفیبر: ۳٪");
        wp_set_object_terms($id, [$f[6]], 'pettt_food_problem');
    }

    $services = [
        ['پت شاپ مرکزی','پت‌شاپ','تهران','تهران','تهران، سعادت آباد','021-11111111','@pettt_shop','شنبه تا پنجشنبه ۱۰ تا ۲۲'],
        ['کلینیک دامپزشکی مهر','دامپزشکی','تهران','تهران','تهران، ونک','021-22222222','@mehr_vet','هر روز ۹ تا ۲۳'],
        ['آرایشگاه پت پامرانین','آرایشگر','تهران','تهران','تهران، جردن','021-33333333','@pet_grooming','با تعیین وقت قبلی'],
    ];
    foreach ($services as $s) {
        $id = wp_insert_post(['post_type'=>'pettt_service','post_status'=>'publish','post_title'=>$s[0],'post_content'=>'توضیحات خدمت، ساعت کاری و شرایط مراجعه.']);
        wp_set_object_terms($id, [$s[1]], 'pettt_service_type');
        update_post_meta($id, '_pettt_province', $s[2]);
        update_post_meta($id, '_pettt_city', $s[3]);
        update_post_meta($id, '_pettt_address', $s[4]);
        update_post_meta($id, '_pettt_phone', $s[5]);
        update_post_meta($id, '_pettt_instagram', $s[6]);
        update_post_meta($id, '_pettt_working_hours', $s[7]);
        update_post_meta($id, '_pettt_website', 'https://example.com');
        update_post_meta($id, '_pettt_video_embed', '[pettt_aparat_demo]');
        update_post_meta($id, '_pettt_google_map_embed', '<iframe src="https://www.google.com/maps?q=Tehran&output=embed" width="100%" height="420" style="border:0;" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>');
    }

    wp_insert_post(['post_type'=>'post','post_status'=>'publish','post_title'=>'چطور غذای مناسب پت دارای مشکل گوارشی انتخاب کنیم؟','post_content'=>'برای پت‌هایی که معده حساس دارند، تغییر غذا باید آهسته انجام شود و بهتر است از رژیم‌های با هضم آسان استفاده شود.']);
    wp_insert_post(['post_type'=>'post','post_status'=>'publish','post_title'=>'نشانه‌های حساسیت غذایی در سگ و گربه','post_content'=>'خارش، ریزش مو، التهاب گوش و مشکلات مزمن گوارشی می‌تواند نشانه حساسیت غذایی باشد.']);

    $video = wp_insert_post(['post_type'=>'pettt_video','post_status'=>'publish','post_title'=>'آموزش خواندن جدول تغذیه روی بسته غذا','post_content'=>'در این ویدیو یاد می‌گیرید جدول تغذیه و آنالیز غذا را درست بخوانید.']);
    update_post_meta($video, '_pettt_aparat_script', '[pettt_aparat_demo]');

    if (class_exists('WooCommerce')) {
        $pid = wp_insert_post(['post_type'=>'product','post_status'=>'publish','post_title'=>'غذای خشک نمونه Pettt','post_content'=>'محصول نمونه فروشگاه Pettt.']);
        update_post_meta($pid, '_regular_price', '1850000');
        update_post_meta($pid, '_price', '1850000');
        update_post_meta($pid, '_stock_status', 'instock');
    }

    update_option('pettt_demo_seeded', 1);
}

add_shortcode('pettt_aparat_demo', function(){
    return '<div class="pettt-demo-video">نمونه محل نمایش ویدیو آپارات</div>';
});
