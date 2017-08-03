<?php get_header(); ?>
<main id="main">
  <?php if(get_field('featured_video')): ?>
    <section id="featuredVideo">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <h1>Featured Video</h1>
            <?php the_field('featured_video_text'); ?>
          </div>
          <div class="col-sm-6">
            <div class="embed-responsive embed-responsive-16by9">
              <?php 
                $featured_video_id = get_field('featured_video');
                the_field('video', $featured_video_id);
              ?>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div class="container">
      <hr />
    </div>
  <?php endif; ?>
  <section id="latestVideos">
    <div class="container">
      <h1>Latest Videos</h1>
      <div class="filtering dropdown">
        <?php $video_cats = get_terms('video_categories'); ?>
        <button class="btn-filter dropdown-toggle" type="button" id="filter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Filter By <i class="fa fa-angle-down"></i></button>
        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="filter">
          <li><a href="<?php echo home_url('leadership-videos'); ?>">Show All</li>
          <?php foreach($video_cats as $cat){
            echo '<li><a href="' . get_term_link($cat) . '">' . $cat->name . '</a></li>';
          } ?>
        </ul>
      </div>
      <div class="clearfix"></div>
      <div class="row">
        <?php
          $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
          $videos = new WP_Query(array(
            'post_type' => 'leaderslink_videos',
            'posts_per_page' => 9,
            'paged' => $paged
          ));
          if($videos->have_posts()): $i=0; while($videos->have_posts()): $videos->the_post();
            if($i%3==0){ echo '<div class="clearfix"'; } ?>
            <div class="col-sm-4">
              <div class="video-block">
                <div class="embed-responsive embed-responsive-16by9">
                  <img src="<?php echo get_field('video_image') ? get_field('video_image') : get_stylesheet_directory_uri() . '/images/video-placeholder.png'; ?>" class="embed-responsive-item" alt="Video placeholder image" />
                </div>
                <h2><?php the_title(); ?></h2>
                <?php the_excerpt(); ?>
                <a href="<?php the_permalink(); ?>" class="read-more">more...</a>
              </div>
            </div>
          <?php $i++; endwhile; else: ?>
            <p>There are no videos in the selected category.</p>
          <?php endif; wp_pagenavi(array('query' => $videos)); wp_reset_postdata(); ?>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>