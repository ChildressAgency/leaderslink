<?php get_header(); ?>
<main id="main">
  <section class="main-section">
    <div class="container">
      <div class="row">
        <?php if(have_posts()): $i=0; while(have_posts()): the_post();
          if($i%3==0){ echo '<div class="clearfix"'; } ?>
          <div class="col-sm-4">
            <img src="<?php echo get_field('featured_image') ? get_field('featured_image') : get_stylesheet_directory_uri() . '/images/icon-placeholder.jpg'; ?>" class="img-responsive center-block" alt="Featured Image" />
            <h2><?php the_title(); ?></h2>
            <?php the_excerpt(); ?>
            <a href="<?php the_permalink(); ?>">more...</a>
          </div>
        <?php endwhile; endif; ?>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>