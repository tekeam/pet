<?php
if (!defined('ABSPATH')) { exit; }

function ninjapet_service_types(){ return ['پت‌شاپ','دامپزشکی','آرایشگر حیوانات','پانسیون']; }
function ninjapet_pet_types(){ return ['سگ','گربه','پرنده','خرگوش','همه حیوانات']; }

add_shortcode('ninjapet_submit_service', function(){
    if (!empty($_POST['ninjapet_submit_service']) && isset($_POST['ninjapet_service_nonce']) && wp_verify_nonce($_POST['ninjapet_service_nonce'], 'ninjapet_submit_service')) {
        $id = wp_insert_post(['post_type'=>'pettt_service','post_status'=>'pending','post_title'=>sanitize_text_field($_POST['service_name'] ?? ''),'post_content'=>wp_kses_post($_POST['description'] ?? '')]);
        if ($id) {
            wp_set_object_terms($id, [sanitize_text_field($_POST['service_type'] ?? '')], 'pettt_service_type');
            $map = ['province'=>'_pettt_province','city'=>'_pettt_city','address'=>'_pettt_address','phone'=>'_pettt_phone','whatsapp'=>'_pettt_whatsapp','instagram'=>'_pettt_instagram','working_hours'=>'_pettt_working_hours','website'=>'_pettt_website','video_url'=>'_pettt_video_url','google_map_embed'=>'_pettt_google_map_embed','pet_types'=>'_pettt_pet_types','manager_name'=>'_pettt_manager_name'];
            foreach($map as $field=>$meta) if(isset($_POST[$field])) update_post_meta($id, $meta, wp_kses_post($_POST[$field]));
            return '<div class="np-success">اطلاعات شما ثبت شد و بعد از بررسی مدیر در سایت نمایش داده می‌شود.</div>';
        }
    }
    ob_start(); ?>
    <form class="np-submit-form" method="post">
      <h2>ثبت مرکز در NinjaPet</h2>
      <p>پت‌شاپ، دامپزشکی، آرایشگاه یا پانسیون خود را ثبت کنید تا بعد از تأیید مدیر در لیست نمایش داده شود.</p>
      <?php wp_nonce_field('ninjapet_submit_service', 'ninjapet_service_nonce'); ?>
      <input type="hidden" name="ninjapet_submit_service" value="1">
      <label>نام مجموعه<input name="service_name" required></label>
      <label>نوع مرکز<select name="service_type"><?php foreach(ninjapet_service_types() as $t) echo '<option>'.esc_html($t).'</option>'; ?></select></label>
      <label>نام مسئول<input name="manager_name"></label>
      <label>شماره تماس<input name="phone" required></label>
      <label>واتساپ<input name="whatsapp"></label>
      <label>اینستاگرام<input name="instagram" placeholder="@ninjapet"></label>
      <label>استان<input name="province" required></label>
      <label>شهر<input name="city" required></label>
      <label>آدرس<input name="address"></label>
      <label>ساعت کاری<input name="working_hours"></label>
      <label>نوع حیوان قابل پذیرش<select name="pet_types"><?php foreach(ninjapet_pet_types() as $t) echo '<option>'.esc_html($t).'</option>'; ?></select></label>
      <label>وب‌سایت یا لینک رزرو<input name="website"></label>
      <label>لینک ویدئو<input name="video_url"></label>
      <label class="wide">کد Google Map<textarea name="google_map_embed" placeholder="iframe گوگل مپ"></textarea></label>
      <label class="wide">توضیحات<textarea name="description"></textarea></label>
      <button class="pettt-primary">ارسال برای بررسی</button>
    </form>
    <?php return ob_get_clean();
});

add_shortcode('ninjapet_submit_explore', function(){
    if (!is_user_logged_in()) return do_shortcode('[ninjapet_login]');
    $msg='';
    if (!empty($_POST['ninjapet_submit_explore']) && isset($_POST['ninjapet_explore_nonce']) && wp_verify_nonce($_POST['ninjapet_explore_nonce'], 'ninjapet_submit_explore')) {
        $id = wp_insert_post(['post_type'=>'pettt_explore','post_status'=>'pending','post_title'=>sanitize_text_field($_POST['post_title'] ?? 'پست جدید نینجا پت'),'post_content'=>wp_kses_post($_POST['caption'] ?? ''),'post_author'=>get_current_user_id()]);
        if($id){ update_post_meta($id,'_pettt_pet_name',sanitize_text_field($_POST['pet_name'] ?? '')); update_post_meta($id,'_pettt_pet_breed',sanitize_text_field($_POST['pet_breed'] ?? '')); update_post_meta($id,'_pettt_pet_food',sanitize_text_field($_POST['pet_food'] ?? '')); $msg='<div class="np-success">پست شما ثبت شد و در انتظار تأیید مدیر است.</div>'; }
    }
    ob_start(); echo $msg; ?>
    <form class="np-submit-form" method="post">
      <h2>ارسال پست اکسپلور</h2><?php wp_nonce_field('ninjapet_submit_explore','ninjapet_explore_nonce'); ?><input type="hidden" name="ninjapet_submit_explore" value="1">
      <label>عنوان پست<input name="post_title" required></label><label>اسم پت<input name="pet_name"></label><label>نژاد<input name="pet_breed"></label><label>غذای محبوب<input name="pet_food"></label><label class="wide">متن پست<textarea name="caption"></textarea></label><button class="pettt-primary">ارسال برای تأیید</button>
    </form>
    <?php return ob_get_clean();
});

add_action('template_redirect', function(){
    if(!is_user_logged_in()) return;
    if(!empty($_GET['np_delete_explore']) && wp_verify_nonce($_GET['_wpnonce'] ?? '', 'np_delete_explore')){
        $id=absint($_GET['np_delete_explore']); $p=get_post($id); if($p && $p->post_type==='pettt_explore' && (int)$p->post_author===get_current_user_id()){ wp_trash_post($id); wp_safe_redirect(remove_query_arg(['np_delete_explore','_wpnonce'])); exit; }
    }
});
