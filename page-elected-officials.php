<?php get_header(); ?>
<main id="main">
  <section id="electedOfficials">
    <div class="container">
      <div class="page-intro">
        <h1><?php the_field('page_title'); ?></h1>
        <?php if(get_field('intro_text')){ the_field('intro_text'); } ?>
      </div>
    </div>
    <div class="container container-sm-height">
      <?php if(have_rows('content_row')): while(have_rows('content_row')): the_row(); ?>
        <div class="row row-sm-height">
          <div class="col-sm-6 col-sm-height">
            <div class="text-side">
              <?php the_sub_field('row_content'); ?>
            </div>
          </div>
          <div class="col-sm-6 col-sm-height">
            <div class="image-side">
              <?php
                if(have_rows('video_or_image')): while(have_rows('video_or_image')): the_row();
                  if(get_row_layout() == 'video'): ?>
                    <div class="embed-responsive embed-responsive-16by9">
                      <?php the_sub_field('content_row_video'); ?>
                    </div>
                <?php else:
                  $content_row_image = get_sub_field('content_row_image') ? get_sub_field('content_row_image') : get_stylesheet_directory_uri() . '/images/video-placeholder.png'; ?>
                  <img src="<?php echo $content_row_image['url']; ?>" class="img-responsive center-block" alt="<?php echo $content_row_image['alt']; ?>" />
                <?php endif; ?>
              <?php endwhile; endif; ?>
            </div>
          </div>
        </div>
      <?php endwhile; endif; ?>
    </div>
  </section>
  <?php if(get_field('grey_callout_text')): ?>
    <section id="greyCallout">
      <div class="container">
        <h3><?php the_field('grey_callout_text'); ?></h3>
        <?php if(get_field('grey_callout_link')): ?>
          <a href="<?php the_field('grey_callout_link'); ?>" class="btn-main btn-clear"><?php the_field('grey_callout_link_text'); ?></a>
        <?php else: ?>
          <p>&nbsp;</p>
        <?php endif; ?>
      </div>
    </section>
  <?php endif; ?>
</main>
<?php get_footer(); ?>