<?php get_header(); ?>
<main id="main">
  <section class="main-content">
    <div class="container">
      <?php if(get_field('must_be_logged_in') && !is_user_logged_in()): ?>
        <?php if(get_field('not_logged_in_message')): ?>
          <p><?php the_field('not_logged_in_message'); ?></p>
        <?php else: ?>
          <p>You must be logged in to view this content. Click <a href="<?php echo wp_login_url(get_permalink()); ?>">here</a> to login.</p>
        <?php endif; ?>
      <?php else: ?>
        <?php if(have_posts()): while(have_posts()): the_post(); ?>
          <div class="page-intro">
            <h1><?php echo get_field('page_title') ? get_field('page_title') : ''; ?></h1>
            <?php if(get_field('intro_text')): ?>
              <?php the_field('intro_text'); ?>
            <?php endif; ?>
          </div>
          <?php the_content(); ?>
        <?php endwhile; endif; ?>
      <?php endif; ?>
    </div>
  </section>
</main>
<?php get_footer(); ?>