<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="">

    <meta http-equiv="cache-control" content="public">
    <meta http-equiv="cache-control" content="private">
    <title>LeadersLink</title>

    <?php wp_head(); ?>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!--[if gte IE 9]
      <style type="text/css">
        .overlay {
          filter: none;
        }
      </style>
    <![endif]-->
  </head>
  <body <?php body_class(); ?>>
    <nav id="header-nav">
      <div class="container-fluid">
        <div class="navbar-header">
          <a href="<?php echo home_url(); ?>" class="header-logo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-white-bg.png" class="img-responsive" alt="Leaders Link Logo" /></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="expanded" aria-controls="navbar">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <div class="header-donate">
            <a href="<?php the_field('donations_link', 'option'); ?>">Donate</a>
          </div>
          <?php
            $nav_defaults = array(
              'theme_location' => 'header-nav',
              'menu' => '',
              'container' => '',
              'container_class' => '',
              'menu_class' => 'nav navbar-nav navbar-right',
              'menu_id' => '',
              'echo' => true,
              'fallback_cb' => 'leaderslink_fallback_menu',
              'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
              'depth' => 2,
              'walker' => new wp_bootstrap_navwalker()
            );
            wp_nav_menu($nav_defaults);

            function leaderslink_fallback_menu(){ ?>
              <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Get Involved<i class="fa fa-caret-down"></i></a>
                  <ul class="dropdown-menu">
                    <li<?php if(is_page('elected-officials')){ echo ' class="active"'; } ?>><a href="<?php echo home_url('elected-officials'); ?>">Elected Officials</a></li>
                    <li<?php if(is_page('disaster-experts')){ echo ' class="active"'; } ?>><a href="<?php echo home_url('disaster-experts'); ?>">Disaster Experts</a></li>
                    <li<?php if(is_page('supporters')){ echo ' class="active"'; } ?>><a href="<?php echo home_url('supporters'); ?>">Supporters</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Resources<i class="fa fa-caret-down"></i></a>
                  <ul class="dropdown-menu">
                    <li<?php if(is_page('expert-advice')){ echo ' class="active"'; } ?>><a href="<?php echo home_url('expert-advice'); ?>">Expert Advice</a></li>
                    <li<?php if(is_page('resource-hub')){ echo ' class="active"'; } ?>><a href="<?php echo home_url('resource-hub'); ?>">Resource Hub</a></li>
                    <li<?php if(is_page('leadership-videos')){ echo ' class="active"'; } ?>><a href="<?php echo home_url('leadership-videos'); ?>">Leadership Videos</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">About Us<i class="fa fa-caret-down"></i></a>
                  <ul class="dropdown-menu">
                    <li<?php if(is_page('our-team')){ echo ' class="active"'; } ?>><a href="<?php echo home_url('our-team'); ?>">Our Team</a></li>
                    <li<?php if(is_page('our-partners')){ echo ' class="active"'; } ?>><a href="<?php echo home_url('our-partners'); ?>">Our Partners</a></li>
                  </ul>
                </li>
                <li<?php if(is_page('shop')){ echo ' class="active"'; } ?>><a href="<?php echo home_url('shop'); ?>">Shop</a></li>
                <li<?php if(is_page('contact-us')){ echo ' class="active"'; } ?>><a href="<?php echo home_url('contact-us'); ?>">Contact Us</a></li>
              </ul>
            <?php } ?>
        </div>
      </div>
    </nav>
    <?php if(get_field('header_image')): ?>
      <section class="hero<?php if(is_front_page()){ echo ' hp-hero'; } ?> parallax-window" data-parallax="scroll" data-image-src="<?php the_field('header_image'); ?>">
        <?php if(get_field('header_title')): ?>
          <div class="container">
            <div class="caption-wrapper">
              <div class="caption">
                <p><?php the_field('header_title'); ?></p>
              </div>
            </div>
          </div>
        <?php endif; ?>
        <div class="overlay"></div>
      </section>
    <?php else: ?>
      <span class="header-cheat"></span>
    <?php endif; ?>
    <?php if(get_field('header_image_caption')): ?>
      <div class="hero-caption">
        <p><?php the_field('header_image_caption'); ?></p>
      </div>
    <?php endif; ?>