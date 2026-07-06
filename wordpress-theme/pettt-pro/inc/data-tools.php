<?php
if (!defined('ABSPATH')) { exit; }

add_action('admin_menu', function(){
    add_submenu_page('pettt-dashboard', 'خروجی، ایمپورت و بکاپ', 'ایمپورت/اکسپورت', 'manage_options', 'ninjapet-data-tools', 'ninjapet_data_tools_page');
});

function ninjapet_data_tools_page(){
    ?>
    <div class="wrap pettt-admin-wrap">
      <h1>خروجی، ایمپورت و بکاپ NinjaPet</h1>
      <div class="pettt-admin-grid">
        <div class="pettt-admin-card"><h2>خروجی CSV مراکز</h2><p>دامپزشکی، پت‌شاپ، آرایشگر و پانسیون.</p><a class="button button-primary" href="<?php echo esc_url(wp_nonce_url(admin_url('admin-post.php?action=ninjapet_export_services'), 'ninjapet_export_services')); ?>">دانلود CSV</a></div>
        <div class="pettt-admin-card"><h2>بکاپ کامل JSON</h2><p>برندها، غذاها، خدمات، اکسپلور و تنظیمات قالب.</p><a class="button button-primary" href="<?php echo esc_url(wp_nonce_url(admin_url('admin-post.php?action=ninjapet_backup_json'), 'ninjapet_backup_json')); ?>">دانلود بکاپ</a></div>
        <div class="pettt-admin-card"><h2>ایمپورت CSV مراکز</h2><form method="post" enctype="multipart/form-data" action="<?php echo esc_url(admin_url('admin-post.php')); ?>"><input type="hidden" name="action" value="ninjapet_import_services"><?php wp_nonce_field('ninjapet_import_services'); ?><input type="file" name="services_csv" accept=".csv" required><p><button class="button button-primary">ایمپورت</button></p></form></div>
      </div>
      <div class="pettt-admin-panel"><h2>ستون‌های CSV</h2><p><code>title,type,province,city,address,phone,whatsapp,instagram,hours,pet_types,website,video_url,map_embed,description</code></p></div>
    </div>
    <?php
}

add_action('admin_post_ninjapet_export_services', function(){
    if (!current_user_can('manage_options') || !check_admin_referer('ninjapet_export_services')) wp_die('Forbidden');
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=ninjapet-services-'.date('Y-m-d').'.csv');
    echo "\xEF\xBB\xBF";
    $out = fopen('php://output', 'w');
    fputcsv($out, ['title','type','province','city','address','phone','whatsapp','instagram','hours','pet_types','website','video_url','map_embed','description']);
    $q = new WP_Query(['post_type'=>'pettt_service','posts_per_page'=>-1,'post_status'=>['publish','pending','draft']]);
    while($q->have_posts()){ $q->the_post(); $id=get_the_ID(); $terms=wp_get_post_terms($id,'pettt_service_type',['fields'=>'names']);
        fputcsv($out, [get_the_title(), implode('|',$terms), pettt_meta($id,'_pettt_province'), pettt_meta($id,'_pettt_city'), pettt_meta($id,'_pettt_address'), pettt_meta($id,'_pettt_phone'), pettt_meta($id,'_pettt_whatsapp'), pettt_meta($id,'_pettt_instagram'), pettt_meta($id,'_pettt_working_hours'), pettt_meta($id,'_pettt_pet_types'), pettt_meta($id,'_pettt_website'), pettt_meta($id,'_pettt_video_url'), pettt_meta($id,'_pettt_google_map_embed'), wp_strip_all_tags(get_the_content())]);
    }
    wp_reset_postdata(); fclose($out); exit;
});

add_action('admin_post_ninjapet_import_services', function(){
    if (!current_user_can('manage_options') || !check_admin_referer('ninjapet_import_services')) wp_die('Forbidden');
    if (empty($_FILES['services_csv']['tmp_name'])) wp_safe_redirect(admin_url('admin.php?page=ninjapet-data-tools'));
    $handle = fopen($_FILES['services_csv']['tmp_name'], 'r');
    $headers = fgetcsv($handle);
    while(($row=fgetcsv($handle))!==false){
        $data = array_combine($headers, $row); if(!$data || empty($data['title'])) continue;
        $id = wp_insert_post(['post_type'=>'pettt_service','post_status'=>'pending','post_title'=>sanitize_text_field($data['title']),'post_content'=>wp_kses_post($data['description'] ?? '')]);
        if(!empty($data['type'])) wp_set_object_terms($id, array_map('trim', explode('|',$data['type'])), 'pettt_service_type');
        foreach(['province','city','address','phone','whatsapp','instagram','hours'=>'working_hours','pet_types','website','video_url','map_embed'=>'google_map_embed'] as $src=>$dst){
            if(is_int($src)){ $src=$dst; }
            if(isset($data[$src])) update_post_meta($id, '_pettt_'.$dst, wp_kses_post($data[$src]));
        }
    }
    fclose($handle); wp_safe_redirect(admin_url('admin.php?page=ninjapet-data-tools&imported=1')); exit;
});

add_action('admin_post_ninjapet_backup_json', function(){
    if (!current_user_can('manage_options') || !check_admin_referer('ninjapet_backup_json')) wp_die('Forbidden');
    $types = ['pettt_brand','pettt_food','pettt_service','pettt_video','pettt_explore','post'];
    $backup = ['generated_at'=>current_time('mysql'),'settings'=>get_option('pettt_settings', []),'items'=>[]];
    foreach($types as $type){
        $q = new WP_Query(['post_type'=>$type,'posts_per_page'=>-1,'post_status'=>['publish','pending','draft']]);
        while($q->have_posts()){ $q->the_post(); $id=get_the_ID(); $backup['items'][]=['type'=>$type,'title'=>get_the_title(),'status'=>get_post_status(),'content'=>get_the_content(),'meta'=>get_post_meta($id),'terms'=>wp_get_object_terms($id, get_object_taxonomies($type), ['fields'=>'all_with_object_id'])]; }
        wp_reset_postdata();
    }
    header('Content-Type: application/json; charset=utf-8'); header('Content-Disposition: attachment; filename=ninjapet-backup-'.date('Y-m-d').'.json'); echo wp_json_encode($backup, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT); exit;
});
