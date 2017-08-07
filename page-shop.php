<?php get_header(); ?>
<main id="main">
  <div class="container">
    <h1 class="shop-title">Shop</h1>
    <hr />
    <section id="products">
      <?php if(get_field('page_title') || get_field('intro_text')): ?>
        <div class="page-intro">
          <?php if(get_field('page_title')): ?>
            <h1><?php the_field('page_title'); ?></h1>
          <?php endif; ?>
          <?php if(get_field('intro_text')): ?>
            <?php the_field('intro_text'); ?>
          <?php endif; ?>
        </div>
      <?php endif; ?>
      <?php if(have_rows('products')): ?>
        <h2>Latest Products</h2>
        <div class="row">
          <?php $i=0; while(have_rows('products')): the_row(); ?>
            <div class="col-sm-4">
              <div class="product-block">
                <img src="<?php echo get_field('product_image') ? get_field('product_image') : get_stylesheet_directory_uri() . '/images/logo-placeholder.jpg'; ?>" class="img-responsive center-block" alt="<?php the_field('product_title'); ?>" />
                <h3><?php the_field('product_title'); ?></h3>
                <p><?php the_field('product_description'); ?></p>
                <a href="<?php the_field('product_link'); ?>" class="btn-main" target="_blank">Shop Now</a>
              </div>
            </div>
          <?php $i++; endwhile; ?>
        </div>
      <?php wp_pagenavi(); endif; ?>
    </section>
  </div>
</main>
<?php get_footer(); ?>