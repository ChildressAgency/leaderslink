<?php get_header(); ?>
<main id="main">
  <section class="main-section">
    <div class="container">
      <?php if(have_posts()): while(have_posts()): the_post(); ?>
        <?php if(get_field('page_title') || get_field('intro_text')): ?>
          <div class="page-intro">
            <?php if(get_field('page_title')): ?>
              <h1><?php the_field('intro_text'); ?></h1>
            <?php endif; ?>
            <?php if(get_field('intro_text')): ?>
              <?php the_field('intro_text'); ?>
            <?php endif; ?>
          </div>
        <?php endif; ?>
        <div class="embed-responsive embed-responsive-16by9">
          <?php the_field('video'); ?>
        </div>
        <h1 class="text-center"><?php the_title(); ?></h1>
        <?php the_content(); ?>
      <?php endwhile; endif; ?>
    </div>
  </section>
</main>
<?php get_footer(); ?>