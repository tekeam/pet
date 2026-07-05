<?php
/* Template Name: Pettt Account */
get_header();
?>
<section class="pettt-account-hero">
  <div class="pettt-container">
    <span class="pettt-kicker">Pet Profile</span>
    <h1>حساب کاربری و پروفایل پت</h1>
    <p>اطلاعات حیوان خانگی، بیماری‌ها، غذای محبوب، یادآورها و پیشنهادهای خرید را مدیریت کنید.</p>
  </div>
</section>

<section class="pettt-container pettt-account-layout">
  <?php if (!is_user_logged_in()): ?>
    <div class="pettt-account-login">
      <h2>برای ساخت پروفایل پت وارد شوید</h2>
      <p>ثبت‌نام فعلاً بر اساس ایمیل و حساب کاربری وردپرس انجام می‌شود. بعداً ورود با شماره موبایل و پیامک هم اضافه می‌شود.</p>
      <?php wp_login_form(['redirect'=>get_permalink()]); ?>
      <a class="pettt-secondary" href="<?php echo esc_url(wp_registration_url()); ?>">ثبت‌نام با ایمیل</a>
    </div>
  <?php else: $user_id = get_current_user_id(); $pets = pettt_account_get_pets($user_id); $reminders = pettt_account_get_reminders($user_id); ?>
    <aside class="pettt-account-sidebar">
      <div class="pettt-account-user">
        <?php echo get_avatar($user_id, 92); ?>
        <h3><?php echo esc_html(wp_get_current_user()->display_name); ?></h3>
        <p><?php echo esc_html(wp_get_current_user()->user_email); ?></p>
      </div>
      <?php echo do_shortcode('[pettt_account_link]'); ?>
      <a href="<?php echo esc_url(wp_logout_url(home_url('/'))); ?>">خروج از حساب</a>
    </aside>

    <div class="pettt-account-main">
      <div class="pettt-account-card">
        <h2>افزودن پت جدید</h2>
        <form method="post" class="pettt-account-form">
          <?php wp_nonce_field('pettt_account_save','pettt_account_nonce'); ?>
          <label>اسم پت<input name="pet_name" required placeholder="مثلاً بیلی"></label>
          <label>جنسیت<select name="pet_gender"><option>نر</option><option>ماده</option></select></label>
          <label>نژاد<input name="pet_breed" placeholder="مثلاً گلدن رتریور"></label>
          <label>وزن<input name="pet_weight" placeholder="مثلاً ۲۵ کیلو"></label>
          <label>غذای محبوب<input name="pet_food" placeholder="مثلاً Royal Canin Gastrointestinal"></label>
          <label>بیماری یا حساسیت<input name="pet_disease" placeholder="مثلاً گوارشی، حساسیت پوستی"></label>
          <label>لینک عکس پت<input name="pet_photo" placeholder="آدرس تصویر آپلودشده"></label>
          <button class="pettt-primary" name="pettt_save_pet" value="1">ذخیره پت</button>
        </form>
      </div>

      <div class="pettt-account-card">
        <h2>پت‌های من</h2>
        <div class="pettt-pet-list">
          <?php if($pets): foreach($pets as $pet): ?>
            <article class="pettt-pet-item">
              <?php if(!empty($pet['photo'])) echo '<img src="'.esc_url($pet['photo']).'" alt="'.esc_attr($pet['name']).'">'; ?>
              <div>
                <h3><?php echo esc_html($pet['name']); ?></h3>
                <p><?php echo esc_html(($pet['breed'] ?? '') . ' | ' . ($pet['gender'] ?? '')); ?></p>
                <span>غذای محبوب: <?php echo esc_html($pet['food'] ?? 'ثبت نشده'); ?></span>
                <small>بیماری/حساسیت: <?php echo esc_html($pet['disease'] ?? 'ندارد'); ?></small>
              </div>
            </article>
          <?php endforeach; else: ?>
            <p>هنوز پتی ثبت نکرده‌اید.</p>
          <?php endif; ?>
        </div>
      </div>

      <?php if($pets): echo pettt_render_recommendations_for_pet($pets[0]); endif; ?>

      <div class="pettt-account-card">
        <h2>تقویم یادآور ایرانی</h2>
        <form method="post" class="pettt-account-form reminder">
          <?php wp_nonce_field('pettt_account_save','pettt_account_nonce'); ?>
          <label>عنوان<input name="reminder_title" required placeholder="نوبت دامپزشکی یا خرید غذا"></label>
          <label>تاریخ ایرانی<input name="reminder_date" required placeholder="۱۴۰۳/۱۰/۰۱"></label>
          <label>ساعت<input name="reminder_time" placeholder="۱۸:۳۰"></label>
          <label>نوع<select name="reminder_type"><option>دامپزشکی</option><option>خرید غذا</option><option>واکسیناسیون</option><option>آرایشگاه</option></select></label>
          <button class="pettt-primary" name="pettt_save_reminder" value="1">افزودن یادآور</button>
        </form>
        <div class="pettt-reminder-list">
          <?php if($reminders): foreach(array_reverse($reminders) as $item): ?>
            <article><strong><?php echo esc_html($item['title']); ?></strong><span><?php echo esc_html($item['date'].' - '.$item['time']); ?></span><small><?php echo esc_html($item['type']); ?></small></article>
          <?php endforeach; else: ?>
            <p>یادآوری ثبت نشده است.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  <?php endif; ?>
</section>
<?php get_footer(); ?>
