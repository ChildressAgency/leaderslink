<?php get_header(); ?>
<main id="main">
  <div class="container">
    <div class="page-intro" style="padding-top:25px;">
      <h1><?php echo get_field('page_title') ? get_field('page_title') : 'Shop'; ?></h1>
      <?php if(get_field('intro_text')): ?>
        <?php the_field('intro_text'); ?>
      <?php endif; ?>
    </div>
    <hr />
    <section id="products">
      <?php if(have_rows('products')): ?>
        <h2>Latest Products</h2>
        <div class="row">
          <?php $i=0; while(have_rows('products')): the_row(); ?>
            <?php if($i%3==0){ echo '<div class="clearfix"></div>'; } ?>
            <div class="col-sm-4">
              <div class="product-block">
                <img src="<?php echo get_sub_field('product_image') ? get_sub_field('product_image') : get_stylesheet_directory_uri() . '/images/logo-placeholder.jpg'; ?>" class="img-responsive center-block" alt="<?php the_sub_field('product_title'); ?>" />
                <h3><?php the_sub_field('product_title'); ?></h3>
                <p><?php the_sub_field('product_description'); ?></p>
                <a href="<?php the_sub_field('product_link'); ?>" class="btn-main" target="_blank">Shop Now</a>
              </div>
            </div>
          <?php $i++; endwhile; ?>
        </div>
      <?php //wp_pagenavi(); 
      endif; ?>
    </section>
  </div>
</main>
<?php get_footer(); ?>