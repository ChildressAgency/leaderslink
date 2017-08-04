<?php get_header(); ?>
<main id="main">
  <section class="main-content">
    <div class="container">
      <?php if(have_posts()): while(have_posts()): the_post(); ?>
        <div class="page-intro">
          <h1><?php the_field('city_state'); ?></h1>
          <?php 
            if(get_field('intro_text')){
              the_field('intro_text');
            }
            else{
              the_field('disaster_name');
            } 
          ?>
        </div>
        <?php the_content(); ?>
      <?php endwhile; endif; ?>
    </div>
  </section>
</main>
<?php get_footer(); ?>