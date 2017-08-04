<?php get_header(); ?>
<main id="hp-main">
  <section id="intro">
    <div class="container">
      <div class="row">
        <div class="col-sm-5">
          <h1><?php the_field('home_page_intro_title'); ?></h1>
          <?php the_field('home_page_intro'); ?>
          <?php if(get_field('home_page_intro_link')): ?>
            <a href="<?php the_field('home_page_intro_link'); ?>" class="btn-main"><?php the_field('home_page_intro_link_text'); ?></a>
          <?php endif; ?>
        </div>
        <div class="col-sm-7">
          <div class="video">
            <?php 
              if(have_rows('intro_video_or_image')): while(have_rows('intro_video_or_image')): the_row();
              if(get_row_layout() == 'video'): ?>
                <div class="embed-responsive embed-responsive-16by9">
                  <?php the_sub_field('home_page_video'); ?>
                </div>
              <?php else:
                $home_page_image = get_sub_field('home_page_image') ? get_sub_field('home_page_image') : get_stylesheet_directory_uri() . '/images/video-placeholder.png'; ?>
                <img src="<?php echo $home_page_image; ?>" class="img-responsive center-block" alt="" />
            <?php endif; endwhile; endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php if(have_rows('get_involved_section')): ?>
    <section id="getInvolved">
      <h1 class="section-title">Get Involved</h1>
      <div class="container-fluid container-sm-height">
        <?php $i=1; while(have_rows('get_involved_section')): the_row(); ?>
          <div class="row row-sm-height">
            <div class="col-sm-6 col-sm-height<?php if($i%2==0){ echo ' col-sm-push-6'; } ?>">
              <div class="text-side">
                <h2><?php the_sub_field('get_involved_section_title'); ?></h2>
                <?php the_sub_field('get_involved_section_text'); ?>
                <?php if(get_sub_field('get_involved_section_link')): ?>
                  <a href="<?php get_sub_field('get_involved_section_link'); ?>" class="btn-main"><?php get_sub_field('get_involved_section_link_text'); ?></a>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-sm-6 col-sm-height image-side<?php if($i%2==0){ echo ' col-sm-pull-6'; } ?>" style="background-image:url(<?php the_sub_field('get_involved_section_image'); ?>);<?php the_sub_field('get_involved_section_image-css'); ?>">
            </div>
          </div>
        <?php $i++; endwhile; ?>
      </div>
    </section>
  <?php endif; ?>
  <section id="greyCallout">
    <div class="container">
      <div class="media">
        <div class="media-left media-middle">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/2x-icon.png" class="media-object" alt="2x icon" />
        </div>
        <div class="media-body">
          <h3><?php the_field('grey_callout_text'); ?></h3>
        </div>
      </div>
    </div>
  </section>
  <section id="sliderBar">
    <ul class="slider-bar">
      <?php if(have_rows('slider_links')): while(have_rows('slider_links')): the_row(); ?>
        <li>
          <div class="img-wrapper">
            <div class="img-inner" style="background-image:url(<?php the_sub_field('slide_image'); ?>);<?php the_sub_field('slide_image_css'); ?>">
              <div class="overlay"></div>
            </div>
            <h3 class="slide-title"><?php the_sub_field('slide_title'); ?></h3>
          </div>
          <div class="caption">
            <p><?php the_sub_field('slide_caption'); ?></p>
          </div>
          <a href="<?php the_sub_field('slide_link'); ?>" class="btn-main btn-clear"><?php the_sub_field('slide_link_text'); ?></a>
        </li>
      <?php endwhile; endif; ?>
    </ul>
  </section>
</main>
<?php get_footer(); ?>