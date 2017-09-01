<?php

add_action('wp_footer', 'show_template');
function show_template() {
	global $template;
	print_r($template);
}

add_filter('show_admin_bar', '__return_false');

add_action('wp_enqueue_scripts', 'jquery_cdn', 100);
function jquery_cdn(){
  if(!is_admin()){
		wp_deregister_script('jquery');
		wp_deregister_script('bp-legacy-js');
    wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js', false, null, true);
    wp_enqueue_script('jquery');
  }
}

add_action('wp_enqueue_scripts', 'leaderslink_scripts', 100);
function leaderslink_scripts(){
  wp_register_script(
    'bootstrap-script', 
    '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', 
    array('jquery'), 
    '', 
    true
  );

  wp_register_script(
    'fontawesome',
    '//use.fontawesome.com/004c3c54fb.js',
    array('jquery'),
    '',
    false
  );

  wp_register_script(
    'lightslider',
    get_template_directory_uri() . '/js/lightslider.min.js',
    array('jquery'),
    '',
    true
  );

  wp_register_script(
    'parallax',
    get_template_directory_uri() . '/js/jquery.stellar.min.js',
    array('jquery'),
    '',
    true
  );

	  wp_register_script(
    'google-maps',
    '//maps.googleapis.com/maps/api/js?key=' . get_field('google_maps_api_key', 'option'),
    array('jquery'),
    '',
    false
  );

  wp_register_script(
    'leaderslink-scripts', 
    get_template_directory_uri() . '/js/leaderslink-scripts.js', 
    array('jquery'), 
    '', 
    true
  );
  
  wp_enqueue_script('bootstrap-script');
  wp_enqueue_script('fontawesome');
  wp_enqueue_script('lightslider');
  wp_enqueue_script('parallax');
	if(is_page('projects-map')){
		wp_enqueue_script('google-maps');
	}
  wp_enqueue_script('leaderslink-scripts');  
}

add_action('wp_enqueue_scripts', 'leaderslink_styles');
function leaderslink_styles(){
  wp_register_style('bootstrap-css', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css');
  wp_register_style('lightslider-css', get_template_directory_uri() . '/css/lightslider.min.css');
  wp_register_style('leaderslink', get_template_directory_uri() . '/style.css');
  
  wp_enqueue_style('bootstrap-css');
  wp_enqueue_style('lightslider-css');
  wp_enqueue_style('leaderslink');
}
/*
function dequeue_buddypress() {
	if (!is_admin()) {
		wp_dequeue_style('bp-legacy-css');
		wp_deregister_script('bp-jquery-query');
		wp_deregister_script('bp-confirm');
	}
}
add_action('wp_enqueue_scripts', 'dequeue_buddypress');
*/
register_nav_menu( 'header-nav', 'Header Navigation' );
/**
 * Class Name: wp_bootstrap_navwalker
 * GitHub URI: https://github.com/twittem/wp-bootstrap-navwalker
 * Description: A custom WordPress nav walker class to implement the Bootstrap 3 navigation style in a custom theme using the WordPress built in menu manager.
 * Version: 2.0.4
 * Author: Edward McIntyre - @twittem
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

class wp_bootstrap_navwalker extends Walker_Nav_Menu {

	/**
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul role=\"menu\" class=\" dropdown-menu\">\n";
	}

	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		/**
		 * Dividers, Headers or Disabled
		 * =============================
		 * Determine whether the item is a Divider, Header, Disabled or regular
		 * menu item. To prevent errors we use the strcasecmp() function to so a
		 * comparison that is not case sensitive. The strcasecmp() function returns
		 * a 0 if the strings are equal.
		 */
		if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} else if ( strcasecmp( $item->title, 'divider') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} else if ( strcasecmp( $item->attr_title, 'dropdown-header') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
		} else if ( strcasecmp($item->attr_title, 'disabled' ) == 0 ) {
			$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
		} else {

			$class_names = $value = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

			if ( $args->has_children )
				$class_names .= ' dropdown';

			if ( in_array( 'current-menu-item', $classes ) )
				$class_names .= ' active';

			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $value . $class_names .'>';

			$atts = array();
			$atts['title']  = ! empty( $item->title )	? $item->title	: '';
			$atts['target'] = ! empty( $item->target )	? $item->target	: '';
			$atts['rel']    = ! empty( $item->xfn )		? $item->xfn	: '';

			// If item has_children add atts to a.
			if ( $args->has_children && $depth === 0 ) {
				$atts['href']   		= '#';
                                $atts['href'] = ! empty( $item->url ) ? $item->url : '';
				$atts['data-toggle']	= 'dropdown';
				$atts['class']			= 'dropdown-toggle';
				$atts['aria-haspopup']	= 'true';
			} else {
				$atts['href'] = ! empty( $item->url ) ? $item->url : '';
			}

			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$item_output = $args->before;

			/*
			 * Glyphicons
			 * ===========
			 * Since the the menu item is NOT a Divider or Header we check the see
			 * if there is a value in the attr_title property. If the attr_title
			 * property is NOT null we apply it as the class name for the glyphicon.
			 */

			 $item_output .= '<a' . $attributes . '>';
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			if ( ! empty( $item->attr_title ) ){
				$item_output .= '&nbsp;<span class="' . esc_attr( $item->attr_title ) . '"></span>';
			}

			$item_output .= ( $args->has_children && 0 === $depth ) ? ' </a>' : '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}

	/**
	 * Traverse elements to create list from elements.
	 *
	 * Display one element if the element doesn't have any children otherwise,
	 * display the element and its children. Will only traverse up to the max
	 * depth and no ignore elements under that depth.
	 *
	 * This method shouldn't be called directly, use the walk() method instead.
	 *
	 * @see Walker::start_el()
	 * @since 2.5.0
	 *
	 * @param object $element Data object
	 * @param array $children_elements List of elements to continue traversing.
	 * @param int $max_depth Max depth to traverse.
	 * @param int $depth Depth of current element.
	 * @param array $args
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return null Null on failure with no changes to parameters.
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element )
            return;

        $id_field = $this->db_fields['id'];

        // Display this element.
        if ( is_object( $args[0] ) )
           $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

	/**
	 * Menu Fallback
	 * =============
	 * If this function is assigned to the wp_nav_menu's fallback_cb variable
	 * and a manu has not been assigned to the theme location in the WordPress
	 * menu manager the function with display nothing to a non-logged in user,
	 * and will add a link to the WordPress menu manager if logged in as an admin.
	 *
	 * @param array $args passed from the wp_nav_menu function.
	 *
	 */
	public static function fallback( $args ) {
		if ( current_user_can( 'manage_options' ) ) {

			extract( $args );

			$fb_output = null;

			if ( $container ) {
				$fb_output = '<' . $container;

				if ( $container_id )
					$fb_output .= ' id="' . $container_id . '"';

				if ( $container_class )
					$fb_output .= ' class="' . $container_class . '"';

				$fb_output .= '>';
			}

			$fb_output .= '<ul';

			if ( $menu_id )
				$fb_output .= ' id="' . $menu_id . '"';

			if ( $menu_class )
				$fb_output .= ' class="' . $menu_class . '"';

			$fb_output .= '>';
			$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';
			$fb_output .= '</ul>';

			if ( $container )
				$fb_output .= '</' . $container . '>';

			echo $fb_output;
		}
	}
}

if(function_exists('acf_add_options_page')){
  acf_add_options_page(array(
    'page_title' => 'Global Site Settings', 
    'menu_title' => 'Global Site Settings',
    'menu_slug' => 'global-settings',
    'capability' => 'edit_posts',
    'redirect' => false
  ));

	acf_add_options_sub_page(array(
		'page_title' => 'Social Links',
		'menu_title' => 'Social Links',
		'parent_slug' => 'global-settings'
	));

	acf_add_options_sub_page(array(
		'page_title' => 'Testimonials',
		'menu_title' => 'Testimonials',
		'parent_slug' => 'global-settings'
	));  
}

add_action('init', 'leaderslink_create_post_types');
function leaderslink_create_post_types(){
  $expert_advice_labels = array(
    'name' => 'Expert Advice Articles',
    'singular_name' => 'Expert Advice Article',
    'menu_name' => 'Expert Advice Articles',
    'add_new_item' => 'Add New Article',
    'search_items' => 'Search Articles',
    'edit_item' => 'Edit Article',
    'view_item' => 'View Article',
    'all_items' => 'All Articles',
    'new_item' => 'New Expert Advice Article',
    'not_found' => 'Article Not Found'
  );
  $expert_advice_args = array(
    'labels' => $expert_advice_labels,
    'capability_type' => 'post',
    'public' => true,
    'menu_position' => 5,
		'menu_icon' => 'dashicons-media-text',
    'query_var' => 'expertadvice_article',
    'supports' => array(
      'title', 
      'editor', 
      'custom_fields', 
      'comments', 
      'revisions',
      'author')
  );
  register_post_type('expertadvice_article', $expert_advice_args);

  register_taxonomy('article_categories',
    'expertadvice_article',
    array(
      'hierarchical' => true,
      'labels' => array(
        'name' => 'Expert Advice Article Categories',
        'singular_name' => 'Article Category',
        'menu_name' => 'Expert Advice Article Categories',
        'all_items' => 'All Article Categories',
        'edit_item' => 'Edit Article Category',
        'view_item' => 'View Article Category',
        'update_item' => 'Update Article Category',
        'add_new_tem' => 'Add New Article Category',
        'new_item_name' => 'New Article Category',
        'search_items' => 'Search Article Categories',
        'not_found' => 'Article Category Not Found'
      )
    )
  );

	$videos_labels = array(
		'name' => 'Videos',
		'singular_name' => 'Video',
		'menu_name' => 'Videos',
		'add_new_item' => 'Add New Video',
		'search_items' => 'Search Videos',
		'edit_item' => 'Edit Video',
		'view_item' => 'View Video',
		'all_items' => 'All Videos',
		'new_item' => 'New Video',
		'not_found' => 'Video Not Found'
	);
	$videos_args = array(
		'labels' => $videos_labels,
		'capability_type' => 'post',
		'public' => true,
		'menu_position' => 6,
		'menu_icon' => 'dashicons-format-video',
		'query_var' => 'leaderslink_videos',
		'supports' => array(
			'title',
			'editor', 
			'custom_fields',
			'comments',
			'revisions',
			'author'
		)
	);
	register_post_type('leaderslink_videos', $videos_args);

	register_taxonomy('video_categories',
		'leaderslink_videos',
		array(
			'hierarchical' => true,
			'labels' => array(
				'name' => 'Video Categories',
				'singular_name' => 'Video Category',
				'menu_name' => 'Video Categories',
				'all_items' => 'All Video Categories',
				'edit_item' => 'Edit Video Category',
				'view_item' => 'View Video Category',
				'update_item' => 'Update Video Category',
				'add_new_item' => 'Add New Video Category',
				'new_item_name' => 'New Video Category',
				'search_items' => 'Search Video Category',
				'not_found' => 'Video Category Not Found'
			)
		)
	);

	$projects_labels = array(
		'name' => 'Projects',
		'singular_name' => 'Project',
		'menu_name' => 'Projects',
		'add_new_item' => 'Add New Project',
		'search_items' => 'Search Projects',
		'edit_item' => 'Edit Project',
		'view_item' => 'View Project',
		'all_items' => 'All Projects',
		'new_item' => 'New Project',
		'not_found' => 'Project Not Found'
	);
	$projects_args = array(
		'labels' => $projects_labels,
		'capability_type' => 'post',
		'public' => true,
		'menu_position' => 6,
		'menu_icon' => 'dashicons-location-alt',
		'query_var' => 'leaderslink_projects',
		'supports' => array(
			'title',
			'editor',
			'custom_fields',
			'comments',
			'revisions',
			'author'
		)
	);
	register_post_type('leaderslink_projects', $projects_args);
}

add_action('acf/init', 'leaderslink_acf_init');
function leaderslink_acf_init(){
	acf_update_setting('google_api_key', get_field('google_maps_api_key', 'option'));
}

/******************************
* ask question button widget
******************************/
add_action('widgets_init', 'leaderslink_load_widget');
function leaderslink_load_widget(){
	register_widget('leaderslink_ask_button_widget');
}

class leaderslink_ask_button_widget extends WP_Widget{
	function __construct(){
		parent::__construct(
			'leaderslink_ask_button_widget',
			__('Ask Question Button', 'leaderslink_widget_domain'),
			array('description' => __('Show Ask a Question button', 'leaderslink_widget_domain'))
		);
	}

	public function widget($args, $instance){
		$title = apply_filters('widget_title', $instance['title']);

		echo $args['before_widget'];
		if(!empty($title)){
			echo $args['before_title'] . $title . $args['after_title'];
		}

		ap_ask_btn();

		echo $args['after_widget'];
	}

	public function form($instance){
		if(isset($instance['title'])){
			$title = $instance['title'];
		}
		else{
			$title = __('New title', 'leaderslink_widget_domain');
		}
	?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
	<?php
	}

	public function update($new_instance, $old_instance){
		$instance = array();
		$instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
		return $instance;
	}
}
/*******************************
* end ask question button widget
********************************/

add_filter('gettext', 'leaderslink_replace_ask_btn_text');
function leaderslink_replace_ask_btn_text($text){
	if($text == 'Ask question'){
		$text = 'Ask A Question';
	}
	elseif($text == 'Sorry! you are not allowed to read this question.'){
		$text = '<p class="text-center">You must be logged in to view this page.</p>';
		$text .= ap_get_template_part('login-signup');
	}
	return $text;
}

add_filter('ap_display_question_metas', 'leaderslink_question_metas');
function leaderslink_question_metas($metas, $question_id = false){
	if($question_id == false){
		$question_id = get_the_ID();
	}
	//$metas['solved'] = '';
	//$metas['views'] = '';
	//$metas['active'] = '';
	//$metas['history'] = '';
	//$metas['categories'] = '';

	unset($metas);

	$meta_categories = ap_question_categories_html(array('label' => ''));

	$last_active = ap_get_last_active($question_id);
	$metas['meta'] = '<p class="question-meta">Posted under ' . $meta_categories . ' - <span>Last Updated '. $last_active . '</span></p>';

	return $metas;
}

// wordpress login page css
add_action( 'login_enqueue_scripts', 'leaderslink_custom_login_css' );
function leaderslink_custom_login_css() { ?>
	<style type="text/css">
		body.login{
			background-color:#fff;
		}
    #login h1 a, .login h1 a {
      background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/logo-white-bg.png);
			height:62px;
			width:100%;
			max-width:245px;
			background-size: contain;
			background-repeat: no-repeat;
     	padding-bottom: 30px;
		}
		#loginform{
			border:1px solid #ddd;
		}
		#loginform input[type="text"],
		#loginform input[type="password"]{
			background-color:transparent;
			border-color:#666;
			color:#666;
		}
		#loginform label{
			color:#000;
		}
		#loginform input[type="submit"]{
			background-color:#267fae;
			border-color:#267fae;
			box-shadow:none;
			border-radius:0;
			-webkit-transition:all .3s ease;
			transition:all .3s ease;
		}
		#loginform input[type="submit"]:hover{
			background-color:#3a5a99;
			border-color:#3a5a99;
		}
  </style>
<?php }

function leaderslink_add_video_iframe_attr($video_iframe){
	// use preg_match to find iframe src
	preg_match('/src="(.+?)"/', $video_iframe, $matches);
	$src = $matches[1];

	// add extra params to iframe src
	$params = array(
			//'controls'    => 0,
			//'hd'        => 1,
			//'autohide'    => 1
			'rel' => 0
	);

	$new_src = add_query_arg($params, $src);

	$video_iframe = str_replace($src, $new_src, $video_iframe);	
	return $video_iframe;
}

add_action( 'template_redirect', 'leaderslink_ap_page_template_redirect' );
function leaderslink_ap_page_template_redirect(){
  if( is_ask() && ! is_user_logged_in() ){
    auth_redirect();
    exit();
  }
}