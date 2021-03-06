  <?php if(have_rows('testimonials', 'option')): ?>
    <section id="testimonials" class="parallax-window" style="background-image:url(<?php the_field('testimonials_background_image', 'option'); ?>); <?php the_field('testimonials_background_image_css', 'option'); ?>">
      <div class="overlay"></div>
      <div class="container">
        <ul id="testimonialSlider">
          <?php while(have_rows('testimonials', 'option')): the_row(); ?>
            <li>
              <p class="testimonial"><?php the_sub_field('testimonial', 'option'); ?></p>
              <p class="testimonial-author"><?php the_sub_field('testimonial_author', 'option'); ?></p>
            </li>
          <?php endwhile; ?>
        </ul>
      </div>
    </section>
  <?php endif; ?>
    <section id="signupBar">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <div class="stay-informed">
              <h1>Stay Informed</h1>
              <p>GET PERIODIC UPDATES AND ALERTS</p>
            </div>
          </div>
          <div class="col-sm-6">
            <?php echo do_shortcode('[contact-form-7 id="247" title="Newsletter Signup Form"]'); ?>
          </div>
        </div>
      </div>
    </section>
    <footer>
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-4">
            <a href="<?php echo home_url(); ?>" class="footer-logo">
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-white.png" class="img-responsive" alt="Leader Link Logo" />
            </a>
          </div>
          <div class="col-sm-6">
            <ul class="list-unstyled list-inline footer-nav">
              <li>
                <h4>Get Involved</h4>
                <ul>
                  <li><a href="<?php echo home_url('elected-officials'); ?>">Elected Officials</a></li>
                  <li><a href="<?php echo home_url('disaster-experts'); ?>">Disaster Experts</a></li>
                  <li><a href="<?php echo home_url('supporters'); ?>">Supporters</a></li>
                  <li><a href="<?Php echo home_url('questions'); ?>">Brainstorming Chamber</a></li>
                </ul>
              </li>
              <li>
                <h4>Resources</h4>
                <ul>
                  <li><a href="<?php echo home_url('expert-advice'); ?>">Expert Advice</a></li>
                  <li><a href="<?php echo home_url('resource-hub'); ?>">Resource Hub</a></li>
                  <li><a href="<?php echo home_url('leadership-videos'); ?>">Leadership Videos</a></li>
                </ul>
              </li>
              <li>
                <h4>About Us</h4>
                <ul>
                  <li><a href="<?php echo home_url('about'); ?>">Our Mission</li>
                  <li><a href="<?php echo home_url('our-team'); ?>">Our Team</a></li>
                  <li><a href="<?php echo home_url('our-partners'); ?>">Our Partners</a></li>
                </ul>
              </li>
              <li>
                <h4><a href="<?php echo home_url('shop'); ?>">Shop</a></h4>
              </li>
              <li>
                <h4><a href="<?php echo home_url('contact-us'); ?>">Contact Us</a></h4>
              </li>
            </ul>
          </div>
          <div class="col-sm-2">
            <div class="footer-social">
              <?php if(get_field('facebook', 'option')): ?>
                <a href="<?php the_field('facebook', 'option'); ?>"><i class="fa fa-facebook-official"></i></a>
              <?php endif; if(get_field('twitter', 'option')): ?>
                <a href="<?php the_field('twitter', 'option'); ?>"><i class="fa fa-twitter"></i></a>
              <?php endif; if(get_field('instagram', 'option')): ?>
                <a href="<?php the_field('instagram', 'option'); ?>"><i class="fa fa-instagram"></i></a>
              <?php endif; if(get_field('linkedin', 'option')): ?>
                <a href="<?php the_field('linkedin', 'option'); ?>"><i class="fa fa-linkedin"></i></a>
              <?php endif; ?>
            </div>
            <?php get_search_form(); ?>
          </div>
        </div>
        <div class="copyright">
          <p>By continuing to use this website, you agree to our <a href="<?php echo home_url('privacy-policy-terms-of-use-and-disclaimer'); ?>">Privacy Policy, Terms of Use and Disclaimer</a>.</p>
          <p>&copy<?php echo date('Y'); ?> LeadersLink</p>
          <p>website created by <a href="https://childressagency.com" target="_blank">The Childress Agency</a></p>
        </div>
      </div>
    </footer>
    <script>
      var sliderPause = <?php echo (get_field('slider_pause', 'option') * 1000); ?>;
    </script>
    <?php wp_footer(); ?>
  </body>
</html>