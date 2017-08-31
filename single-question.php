<?php get_header(); ?>
<main id="main">
  <section class="main-content">
    <div class="container">
      <?php if(have_posts()): while(have_posts()): the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; endif; ?>
    </div>
  </section>
</main>
<?php get_footer(); ?>