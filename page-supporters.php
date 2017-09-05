<?php get_header(); ?>
<main id="main">
  <section id="supporterInfo">
    <div class="container">
      <div class="page-intro">
        <?php if(get_field('page_title')): ?>
          <h1><?php the_field('page_title'); ?></h1>
        <?php endif; ?>
        <?php if(get_field('intro_text')): ?>
          <?php the_field('intro_text'); ?>
        <?php endif; ?>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="donate-block">
            <h1>Individuals</h1>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/individual-icon.png" class="img-responsive center-block" alt="Individual Donation Icon" />
            <p><?php the_field('individual_donation_text'); ?></p>
            <a href="<?php the_field('individual_donation_link'); ?>" class="btn-main btn-red visible-xs-inline-block">Donate Now</a>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="donate-block">
            <h1>Organizations</h1>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/organizations-icon.png" class="img-responsive center-block" alt="Organizations Donation Icon" />
            <p><?php the_field('organization_donation_text'); ?></p>
            <a href="<?php the_field('organization_donation_link'); ?>" class="btn-main btn-red visible-xs-inline-block">Donate Now</a>
          </div>
        </div>
      </div>
      <div class="row hidden-xs text-center">
        <div class="col-sm-6">
          <a href="<?php the_field('individual_donation_link'); ?>" class="btn-main btn-red hidden-xs">Donate Now</a>
        </div>
        <div class="col-sm-6">
          <a href="<?php the_field('organization_donation_link'); ?>" class="btn-main btn-red hidden-xs">Donate Now</a>
        </div>
      </div>
      <p class="sponsorship">For sponsorship information, contact founder <a href="mailto:kathleenkoch@leaderslink.com">Kathleen Koch</a>.</p>
    </div>
  </section>
  <?php if(get_field('grey_callout_text')): ?>
    <section id="greyCallout">
      <div class="container">
        <h3><?php the_field('grey_callout_text'); ?></h3>
        <?php if(get_field('grey_callout_link')): ?>
          <a href="<?php the_field('grey_callout_link'); ?>" class="btn-main btn-clear"><?php the_field('grey_callout_link_text'); ?></a>
        <?php else: ?>
          <p>&nbsp;</p>
        <?php endif; ?>
      </div>
    </section>
  <?php endif; ?>
</main>
<?php get_footer(); ?>