<?php get_header(); ?>
<main id="main">
  <section class="main-content">
    <div class="container">
      <div class="page-intro">
        <h1><?php echo get_field('page_title') ? get_field('page_title') : get_the_title(); ?></h1>
        <?php if(get_field('intro_text')): ?>
          <?php the_field('intro_text'); ?>
        <?php endif; ?>
      </div>
      <?php if(have_rows('faqs')): ?>
        <div class="faqs">
          <div class="panel-group" id="faqs" role="tablist" aria-muliselectable="true">
            <?php $i=0; while(have_rows('faqs')): the_row(); ?>

              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="question<?php echo $i; ?>">
                  <h3 class="panel-title">
                    <a href="#answer<?php echo $i; ?>" role="button" data-toggle="collapse" data-parent="#faqs" aria-expanded="true" aria-controls="answer<?php echo $i; ?>"><?php the_sub_field('question'); ?></a>
                  </h3>
                </div>
                <div id="answer<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="question<?php echo $i; ?>">
                  <div class="panel-body">
                    <?php the_sub_field('answer'); ?>
                  </div>
                </div>
              </div>

            <?php $i++; endwhile; ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </section>
</main>
<?php get_footer(); ?>