<?php get_header(); ?>
<main id="main">
  <section id="latestArticles">
    <div class="container">
      <div class="page-intro">
        <?php $cur_term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy')); ?>
        <h1>Latest Articles - <?php echo $cur_term->name; ?></h1>
      </div>
      <div class="filtering dropdown">
        <?php $article_cats = get_terms('article_categories'); ?>
        <button class="btn-filter dropdown-toggle" type="button" id="filter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Filter By <i class="fa fa-angle-down"></i></button>
        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="filter">
          <li><a href="<?php echo home_url('expert-advice'); ?>">Show All</li>
          <?php foreach($article_cats as $cat){
            echo '<li><a href="' . get_term_link($cat) . '">' . $cat->name . '</a></li>';
          } ?>
        </ul>
      </div>
      <div class="clearfix"></div>
      <div class="row">
        <?php
          global $wp_query;
          $category = $wp_query->get_queried_object();
          $cat_name = $category->name;
          $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
          $articles = new WP_Query(array(
            'post_type' => 'expertadvice_article',
            'posts_per_page' => 9,
            'paged' => $paged,
            'tax_query' => array(
              array(
                'taxonomy' => 'article_categories',
                'field' => 'name',
                'terms' => $cat_name
              )
            )
          ));
          if($articles->have_posts()): $i=0; while($articles->have_posts()) : $articles->the_post();
            if($i%3==0){ echo '<div class="clearfix"></div>'; } ?>
            <div class="col-sm-4">
              <div class="blog-summary">
                <?php if(get_field('featured_image')): ?>
                  <img src="<?php the_field('featured_image'); ?>" class="img-responsive center-block" alt="" />
                <?php else: 
                  //wp_get_attachment_image(get_queried_object_id(), 'full', '', array('class' => 'img-responsive center-block'));
                  $terms = get_the_terms(get_the_ID(), 'article_categories');
                  $term = $terms[0]; ?>
                  <img src="<?php the_field('category_image', 'article_categories_' . $term->term_id); ?>" class="img-responsive center-block" alt="" />
                <? endif; ?>
                <h2><?php the_title(); ?></h2>
                <?php the_excerpt(); ?>
                <a href="<?php the_permalink(); ?>">more...</a>
              </div>
            </div>
        <?php $i++; endwhile; else: ?>
          <p>There are no articles in the selected category.</p>
        <?php endif; wp_pagenavi(array('query' => $articles)); wp_reset_postdata(); ?>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>