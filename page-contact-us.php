<?php get_header(); ?>
<main id="hp-main">
  <section id="contactUs">
    <div class="container">
      <div class="page-intro">
        <?php if(get_field('page_title')): ?>
          <h1><?php the_field('page_title'); ?></h1>
        <?php endif; ?>
        <?php if(get_field('intro_text')): ?>
          <?php the_field('intro_text'); ?>
        <?php endif; ?>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="contact-info">
            <h2>MAILING</h2>
            <p>LeadersLink<br /><?php the_field('street_address'); ?><br /><?php the_field('city_state_zip'); ?></p>
          </div>
          <?php if(get_field('help_hotline_number')): ?>
            <div class="contact-info">
              <h2>HELP HOTLINE</h2>
              <p><?php the_field('help_hotline_number'); ?><br /><?php the_field('help_hotline_hours'); ?><br /><?php the_field('help_hotline_email'); ?></p>
            </div>
          <?php else: ?>
            <div class="contact-info">
              <h2>EMAIL</h2>
              <p><?php the_field('help_hotline_email'); ?></p>
            </div>
          <?php endif; ?>
          <div class="contact-info social-links">
            <h2>SOCIAL MEDIA</h2>
            <?php if(get_field('facebook', 'option')): ?>
              <a href="<?php the_field('facebook', 'option'); ?>" target="_blank"><i class="fa fa-facebook-official"></i></a>
            <?php endif; if(get_field('twitter', 'option')): ?> 
              <a href="<?php the_field('twitter', 'option'); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
            <?php endif; if(get_field('instagram', 'option')): ?>
              <a href="<?php the_field('instagram', 'option'); ?>" target="_blank"><i class="fa fa-instagram"></i></a>
            <?php endif; if(get_field('linkedin', 'option')): ?>
              <a href="<?php the_field('linkedin', 'option'); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
            <?php endif; ?>
          </div>
        </div>
        <div class="col-sm-7">
          <?php if(have_posts()): while(have_posts()): the_post(); ?>
            <?php the_content(); ?>
          <?php endwhile; endif; ?>
        </div>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>