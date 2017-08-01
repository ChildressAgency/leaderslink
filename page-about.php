<?php get_header(); ?>
<main id="hp-main">
  <section id="intro">
    <div class="container">
      <div class="row">
        <div class="col-sm-5">
          <h1><?php the_field('page_title'); ?></h1>
          <?php the_field('intro_text'); ?>
          <?php if(get_field('intro_link')): ?>
            <a href="<?php the_field('intro_link'); ?>" class="btn-main"><?php the_field('intro_link_text'); ?></a>
          <?php endif; ?>
        </div>
        <div class="col-sm-7">
          <div class="video">
            <?php 
              if(have_rows('intro_video_or_image')): while(have_rows('intro_video_or_image')): the_row();
              if(get_row_layout() == 'video'): ?>
                <div class="embed-responsive embed-responsive-16by9">
                  <?php the_sub_field('about_page_video'); ?>
                </div>
              <?php else:
                $about_page_image = get_sub_field('about_page_image') ? get_sub_field('about_page_image') : get_stylesheet_directory_uri() . '/images/video-placeholder.png'; ?>
                <img src="<?php echo $about_page_image; ?>" class="img-responsive center-block" alt="" />
            <?php endif; endwhile; endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php if(have_rows('content_row')): ?>
    <section id="aboutInfo">
      <div class="container container-sm-height">
        <?php $c=1; while(have_rows('content_row')): the_row(); ?>
          <div class="row row-sm-height">
            <div class="col-sm-6 col-sm-height<?php if($c%2==0){ echo ' col-sm-push-6'; } ?>">
              <div class="text-side">
                <h2><?php the_sub_field('content_row_title'); ?></h2>
                <?php the_sub_field('content_row_text'); ?>
              </div>
            </div>
            <div class="col-sm-6 col-sm-height<?php if($c%2==0){ echo ' col-sm-pull-6'; } ?>">
              <div class="image-side">
                <?php $icon = get_sub_field('content_row_icon'); ?>
                <img src="<?php echo $icon ? $icon['url'] : get_stylesheet_directory_uri() . '/images/logo-placeholder.jpg'; ?>" class="img-responsive center-block" alt="<?php echo $icon ? $icon['alt'] : ''; ?>" />
              </div>
            </div>
          </div>
        <?php $c++; endwhile; ?>
      </div>
    </section>
  <?php endif; ?>
  <section id="foundedExperience">
    <div class="container">
      <div class="row">
        <div class="col-sm-5">
          <div class="image-side">
            <?php $founded_image = get_field('founded_from_experience_image'); 
            if($founded_image): ?>
              <img src="<?php echo $founded_image['url']; ?>" class="img-responsive center-block" alt="<?php echo $founded_image['alt']; ?>" />
            <?php endif; ?>
          </div>
        </div>
        <div class="col-sm-7">
          <div class="text-side">
            <h2><?php the_field('founded_from_experience_title'); ?></h2>
            <?php the_field('founded_from_experience_content'); ?>
            <?php if(get_field('founded_from_experience_link')): ?>
              <a href="<?php the_field('founded_from_experience_link'); ?>" class="btn-main btn-clear"><?php the_field('founded_from_experience_link_text'); ?></a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>