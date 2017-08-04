<?php get_header(); ?>
<main id="main">
  <section id="country">
    <div class="container">
      <div class="page-intro">
        <?php if(get_field('page_title')): ?>
          <h1><?php the_field('page_title'); ?></h1>
        <?php endif; ?>
        <?php if(get_field('intro_text')): ?>
          <?php the_field('intro_text'); ?>
        <?php endif; ?>
      </div>
      <?php
        $map_projects = new WP_Query(array(
          'post_type' => 'leaderslink_projects',
          'posts_per_page' => -1,
          'meta_query' => array(
            array(
              'key' => 'show_on_map',
              'compare' => '==',
              'value' => '1'
            )
          )
        ));
        if($map_projects->have_posts()): ?>
          <script>
            var leaderslinkMarker = "<?php echo get_stylesheet_directory_uri() . '/images/leaderslink-marker.png'; ?>";
          </script>
          <div id="projectMap" class="project-map acf-map">
            <?php while($map_projects->have_posts()): $map_projects->the_post(); 
              $location = get_field('location'); ?>
              <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
                <div class="map-info-window">
                  <div class="map-info-window-title">
                    <h1><?php the_field('city_state'); ?></h1>
                  </div>
                  <div class="map-info-window-body">
                    <h2><?php the_field('disaster_name'); ?></h2>
                    <?php the_excerpt(); ?>
                    <a href="<?php the_permalink(); ?>" class="read-more">more...</a>
                  </div>
                  <div class="map-info-window-gradient"></div>
                </div>
              </div> 
            <?php endwhile; ?>
          </div>
      <?php endif; wp_reset_postdata(); ?>           
    </div>
  </section>
  <section id="connectedList">
    <div class="container">
      <h1><?php the_field('full_list_title'); ?></h1>
      <?php
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
        $projects = new WP_Query(array(
          'post_type' => 'leaderslink_projects',
          'posts_per_page' => 6,
          'paged' => $paged
        ));
        if($projects->have_posts()): ?>
          <div class="clearfix"></div>
          <ul class="list-unstyled">
            <?php while($projects->have_posts()): $projects->the_post(); ?>
              <li>
                <h3><?php the_field('city_state'); ?><span><?php the_field('disaster_name'); ?></span></h3>
                <?php the_excerpt(); ?>
                <a href="<?php the_permalink(); ?>" class="read-more">more...</a>
              </li>
            <?php endwhile; ?>
          </ul>
      <?php endif; wp_pagenavi(array('query' => $projects)); wp_reset_postdata(); ?>
    </div>
  </section>
  <?php if(get_field('grey_callout_text')): ?>
    <section id="greyCallout">
      <div class="container">
        <h3><?php the_field('grey_callout_text'); ?></h3>
        <?php if(get_field('grey_callout_link')): ?>
          <a href="<?php the_field('grey_callout_link'); ?>" class="btn-main btn-clear"><?php the_field('grey_callout_link_text'); ?></a>
        <?php endif; ?>
      </div>
    </section>
  <?php endif; ?>
</main>
<?php get_footer(); ?>