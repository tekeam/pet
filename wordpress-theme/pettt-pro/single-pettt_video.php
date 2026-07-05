<?php get_header(); the_post(); ?>
<section class="pettt-container pettt-video-page">
  <article class="pettt-video-card">
    <h1><?php the_title(); ?></h1>
    <div class="pettt-video-box">
      <?php
      $embed = pettt_meta(get_the_ID(), '_pettt_aparat_script');
      $file = pettt_meta(get_the_ID(), '_pettt_video_file');
      if ($embed) {
          echo do_shortcode($embed);
      } elseif ($file) {
          echo '<video controls src="'.esc_url($file).'"></video>';
      } else {
          echo '<p>ویدیویی ثبت نشده است.</p>';
      }
      ?>
    </div>
    <div class="pettt-entry-text"><?php the_content(); ?></div>
  </article>
</section>
<?php get_footer(); ?>
