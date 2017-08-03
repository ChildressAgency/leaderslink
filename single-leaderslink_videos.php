<?php get_header(); ?>
<main id="main">
  <section class="main-section">
    <div class="container">
      <?php if(have_posts()): while(have_posts()): the_post(); ?>
        <div class="page-intro">
          <h1><?php echo get_field('page_title') ? get_field('page_title') : get_the_title(); ?></h1>
          <?php if(get_field('intro_text')): ?>
            <?php the_field('intro_text'); ?>
          <?php endif; ?>
        </div>
        <div class="embed-responsive embed-responsive-16by9">
          <?php the_field('video'); ?>
        </div>
        <?php the_content(); ?>
      <?php endwhile; endif; ?>
    </div>
  </section>
</main>
<?php get_footer(); ?>