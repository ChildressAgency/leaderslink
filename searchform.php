<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
  <div class="input-group">
    <label for="s" class="sr-only">Search</label>
    <input type="text" name="s" value="<?php echo get_search_query(); ?>" class="form-control" placeholder="Search..." />
    <span class="input-group-btn">
      <button class="btn-main btn-marine" type="button"><i class="fa fa-search"></i></button>
    </span>
  </div>
</form>