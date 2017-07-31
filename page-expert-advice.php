<?php get_header(); ?>
<main id="main">
  <section id="latestArticles">
    <div class="container">
      <h1><?php echo get_field('page_intro_title') ? get_field('page_intro_title') : 'Latest Articles'; ?></h1>
      <div class="sorting">
        <?php
          $cats = get_categories('taxonomy=article_categories&post_type=expert_advice_article');
          $article_category = (isset($_GET['article-category'])) ? $_GET['article-category'] : '';
          if(!empty($cats)): ?>
            <form id="articleFilter" action="" method="GET">
              <select id="filters" name="article-category" onchange="submit();">
                <option value=""<?php echo ($article_category == '') ? ' selected="selected"' : ''; ?>>Filter by</option>
                <?php foreach($cats as $cat): ?>
                  <option value="<?php echo $cat->name; ?>"<?php echo ($article_category == $cat->name) ? ' selected="selected"' : ''; ?>><?php echo $cat->name; ?></option>
                <?php endforeach; ?>
              </select>
            </form>
        <?php endif; ?>
      </div>
      <div class="clearfix"></div>
      <div class="row">
        <?php
          $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
          if($article_category == ''){
            $articles = new WP_Query(array(
              'post_type' => 'expert_advice_articles',
              'posts_per_page' => 9,
              'paged' => $paged
            ));
          }
          else{
            $articles = new WP_Query(array(
              'post_type' => 'expert_advice_articles',
              'posts_per_page' => 9,
              'paged' => $paged,
              'tax_query' => array(
                array(
                  'taxonomy' => 'article_categories',
                  'field' => 'name',
                  'terms' => $article_category
                )
              )
            ));
          }

          if($articles->have_posts()): $i=0; while($articles->have_posts()) : $articles->the_post();
            if($i%3==0){ echo '<div class="clearfix"></div>'; } ?>
            <div class="col-sm-4">
              <div class="blog-summary">
                <img src="<?php the_field('featured_image'); ?>" class="img-responsive center-block" alt="" />
                <h2><?php the_title(); ?></h2>
                <?php the_excerpt(); ?>
                <a href="<?php the_permalink(); ?>">more...</a>
              </div>
            </div>
        <?php endwhile; else: ?>
          <p>There are no articles in the selected category.</p>
        <?php endif; wp_pagenavi(array('query' => $articles)); wp_reset_postdata(); ?>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>