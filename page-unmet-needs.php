<?php get_header(); ?>
<main id="main">
  <section class="main-content">
    <div class="container">
      <div class="page-intro">
        <h1><?php echo get_field('page_title') ? get_field('page_title') : ''; ?></h1>
        <?php if(get_field('intro_text')): ?>
          <?php the_field('intro_text'); ?>
        <?php endif; ?>
      </div>
      <?php if(have_rows('disasters')): $i=0; $c=0; while(have_rows('disasters')): the_row(); ?>
        <h1><?php the_sub_field('disaster_name'); ?></h1>
        <?php if(have_rows('cities')): ?>
          <div class="faqs">
            <div class="panel-group" id="faqs-<?php echo $i; ?>" role="tablist" aria-multiselectable="true">
              <?php while(have_rows('cities')): the_row(); ?>
                <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="question<?php echo $c; ?>">
                    <h3 class="panel-title">
                      <a href="#answer<?php echo $c; ?>" role="button" data-toggle="collapse" data-parent="#faqs-<?php echo $i; ?>" aria-expanded="true" aria-controls="answer<?php echo $c; ?>"><?php the_sub_field('city_name'); ?></a>
                    </h3>
                  </div>
                  <div id="answer<?php echo $c; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="question<?php echo $c; ?>">
                    <div class="panel-body">
                      <?php the_sub_field('city_needs'); ?>
                    </div>
                  </div>
                </div>
              <?php $c++; endwhile; ?>
            </div>
          </div>
        <?php endif; ?>
      <?php $i++; endwhile; endif; ?>
    </div>
  </section>
</main>
<?php get_footer(); ?>