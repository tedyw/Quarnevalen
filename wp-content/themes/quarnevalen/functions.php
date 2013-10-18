<?php

/**
 * class required_walker
 *
 * Custom output to enable the the ZURB Navigation style.
 * Courtesy of Kriesi.at. http://www.kriesi.at/archives/improve-your-wordpress-navigation-menu-output
 *
 * @since  required+ Foundation 0.1.0
 *
 * @return string the code of the full navigation menu
 */
class Quarnevalen_Walker extends Walker_Nav_Menu {

	/**
	 * Specify the item type to allow different walkers
	 * @var array
	 */
	var $nav_bar = '';

	function __construct( $nav_args = '' ) {

		$defaults = array(
			'item_type' => 'li',
			'in_top_bar' => false,
		);
		$this->nav_bar = apply_filters( 'req_nav_args', wp_parse_args( $nav_args, $defaults ) );
	}

	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

        $id_field = $this->db_fields['id'];
        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        }
        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$title = sanitize_title($item->title);

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID . ' menu-item-' . $title;

		// Check for flyout
		$flyout_toggle = '';
		if ( $args->has_children && $this->nav_bar['item_type'] == 'li' ) {

			if ( $depth == 0 && $this->nav_bar['in_top_bar'] == false ) {

				$classes[] = 'has-flyout';
				$flyout_toggle = '<a href="#" class="flyout-toggle"><span></span></a>';

			} else if ( $this->nav_bar['in_top_bar'] == true ) {

				$classes[] = 'has-dropdown';
				$flyout_toggle = '';
			}

		}
        /**
         * Add class names to the li.divider from parent menu item
         * @var string
         *
         * @since  required+ Foundation 1.0.7
         */
        $class_names_divider = join( ' ', $item->classes );
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		if ( $depth > 0 ) {
			$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
		} else {
			$output .= $indent . ( $this->nav_bar['in_top_bar'] == true ? '' : '' ) . '<' . $this->nav_bar['item_type'] . ' id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
		}

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$item_output  = $args->before;
		$item_output .= '<a '. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $flyout_toggle; // Add possible flyout toggle
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	function end_el( &$output, $item, $depth = 0, $args = array() ) {

		if ( $depth > 0 ) {
			$output .= "</li>\n";
		} else {
			$output .= "</" . $this->nav_bar['item_type'] . ">\n";
		}
	}

	function start_lvl( &$output, $depth = 0, $args = array() ) {

		if ( $depth == 0 && $this->nav_bar['item_type'] == 'li' ) {
			$indent = str_repeat("\t", 1);
    		$output .= $this->nav_bar['in_top_bar'] == true ? "\n$indent<ul class=\"dropdown\">\n" : "\n$indent<ul class=\"flyout\">\n";
    	} else {
			$indent = str_repeat("\t", $depth);
    		$output .= $this->nav_bar['in_top_bar'] == true ? "\n$indent<ul class=\"dropdown\">\n" : "\n$indent<ul class=\"level-$depth\">\n";
		}
  	}
}

/**
 * This makes the child theme work. If you need any
 * additional features or let's say menus, do it here.
 *
 * @return void
 */
function required_starter_themesetup() {

	load_child_theme_textdomain( 'requiredstarter', get_stylesheet_directory() . '/languages' );
	load_child_theme_textdomain( 'requiredfoundation', get_stylesheet_directory() . '/languages' );
	load_child_theme_textdomain( 'quarnevalen', get_stylesheet_directory() . '/languages' );

	// Register an additional Menu Location
	register_nav_menus( array(
		'meta' => __( 'Meta Menu', 'requiredstarter' )
	) );

	// Add support for custom backgrounds and overwrite the parent backgorund color
	add_theme_support( 'custom-background', array( 'default-color' => 'f7f7f7' ) );

}
add_action( 'after_setup_theme', 'required_starter_themesetup' );


/**
 * With the following function you can disable theme features
 * used by the parent theme without breaking anything. Read the
 * comments on each and follow the link, if you happen to not
 * know what the function is for. Remove the // in front of the
 * remove_theme_support('...'); calls to make them execute.
 *
 * @return void
 */
function required_starter_after_parent_theme_setup() {

	/**
	 * Hack added: 2012-10-04, Silvan Hagen
	 *
	 * This is a hack, to calm down PHP Notice, since
	 * I'm not sure if it's a bug in WordPress or my
	 * bad I'll leave it here: http://wordpress.org/support/topic/undefined-index-custom_image_header-in-after_setup_theme-of-child-theme
	 */
	if ( ! isset( $GLOBALS['custom_image_header'] ) )
		$GLOBALS['custom_image_header'] = array();

	if ( ! isset( $GLOBALS['custom_background'] ) )
		$GLOBALS['custom_background'] = array();

	update_option('thumbnail_size_w', 480);
	update_option('thumbnail_size_h', 480);
	update_option('thumbnail_crop', 1);
	update_option('large_size_w', 1920);
	update_option('large_size_h', 1080);
	update_option('large_crop', 1);
	remove_theme_support('post-formats');

	// Remove custom header support: http://codex.wordpress.org/Custom_Headers
	//remove_theme_support( 'custom-header' );

	// Remove support for post formats: http://codex.wordpress.org/Post_Formats
	//remove_theme_support( 'post-formats' );

	// Remove featured images support: http://codex.wordpress.org/Post_Thumbnails
	//remove_theme_support( 'post-thumbnails' );

	// Remove custom background support: http://codex.wordpress.org/Custom_Backgrounds
	//remove_theme_support( 'custom-background' );

	// Remove automatic feed links support: http://codex.wordpress.org/Automatic_Feed_Links
	//remove_theme_support( 'automatic-feed-links' );

	// Remove editor styles: http://codex.wordpress.org/Editor_Style
	//remove_editor_styles();

	// Remove a menu from the theme: http://codex.wordpress.org/Navigation_Menus
	//unregister_nav_menu( 'secondary' );

}
add_action( 'after_setup_theme', 'required_starter_after_parent_theme_setup', 11 );

/**
 * Add our theme specific js file and some Google Fonts
 * @return void
 */
function required_starter_scripts() {

	/**
	 * Registers the child-theme.js
	 *
	 * Remove if you don't need this file,
	 * it's empty by default.
	 */

	if( !is_admin() ) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"), false, 'latest', false);
    wp_enqueue_script('jquery');
	}
	wp_enqueue_script(
		'modernizr-js',
		get_stylesheet_directory_uri() . '/javascripts/modernizr.custom.min.js',
		array( 'jquery' ),
		required_get_theme_version( false ),
		false
	);
	wp_enqueue_script(
		'dlmenu-js',
		get_stylesheet_directory_uri() . '/javascripts/jquery.dlmenu.min.js',
		array( 'jquery' ),
		required_get_theme_version( false ),
		true
	);
	wp_enqueue_script(
		'transitions-js',
		get_stylesheet_directory_uri() . '/javascripts/pagetransitions.min.js',
		array( 'jquery' ),
		required_get_theme_version( false ),
		true
	);
	wp_enqueue_script(
		'transitions-extend-js',
		get_stylesheet_directory_uri() . '/javascripts/_funcTransition.js',
		array( 'jquery' ),
		required_get_theme_version( false ),
		true
	);

	wp_enqueue_script(
		'child-theme-js',
		get_stylesheet_directory_uri() . '/javascripts/child-theme.min.js',
		array( 'theme-js' ),
		required_get_theme_version( false ),
		true
	);

	/**
	 * Registers the app.css
	 *
	 * If you don't need it, remove it.
	 * The file is empty by default.
	 */
	wp_register_style(
        'app-css', //handle
        get_stylesheet_directory_uri() . '/stylesheets/app.css',
        array( 'foundation-css' ),	// needs foundation
        required_get_theme_version( false ) //version
  	);
  	wp_enqueue_style( 'app-css' );
  	wp_register_style(
        'component-css', //handle
        get_stylesheet_directory_uri() . '/stylesheets/component.css',
        array( 'foundation-css' ),	// needs foundation
        required_get_theme_version( false ) //version
  	);
  	wp_enqueue_style( 'component-css' );
  	wp_register_style(
        'animation-css', //handle
        get_stylesheet_directory_uri() . '/stylesheets/animations.css',
        array( 'foundation-css' ),	// needs foundation
        required_get_theme_version( false ) //version
  	);
  	wp_enqueue_style( 'animation-css' );

}
add_action('wp_enqueue_scripts', 'required_starter_scripts');

/**
 * Overwrite the default continue reading link
 *
 * This function is an example on how to overwrite
 * the parent theme function to create continue reading
 * links.
 *
 * @return string HTML link with text and permalink to the post/page/cpt
 */
function required_continue_reading_link() {
	return ' <a class="read-more" href="'. esc_url( get_permalink() ) . '">' . __( ' Read on! &rarr;', 'requiredstarter' ) . '</a>';
}

/**
 * Overwrite the defaults of the Orbit shortcode script
 *
 * Accepts all the parameters from http://foundation.zurb.com/docs/orbit.php#optCode
 * to customize the options for the orbit shortcode plugin.
 *
 * @param  array $args default args
 * @return array       your args
 */
function required_orbit_script_args( $defaults ) {
	$args = array(
		'animation' 	=> 'fade',
		'advanceSpeed' 	=> 8000,
	);
	return wp_parse_args( $args, $defaults );
}
add_filter( 'req_orbit_script_args', 'required_orbit_script_args' );

// Check if page is direct child
function is_child($page_id = "") { 
    global $post; 
    if( is_page() && ($post->post_parent == $page_id) ) {
       return true;
    } else { 
       return false; 
    }
}

// Check if page is an ancestor
function is_ancestor($post_id) {
    global $wp_query;
    $ancestors = $wp_query->post->ancestors;
    if ( in_array($post_id, $ancestors) ) {
        return true;
    } else {
        return false;
    }
}

function the_slug($id) {
	$post_data = get_post($id, ARRAY_A);
	$slug = $post_data['post_name'];
	return $slug; 
}

function custom_post_company() {
	register_post_type( 'company',
		array(
			'labels' => array(
				'name' => __( 'Companies' ),
				'singular_name' => __( 'Company' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'companies'),
			'supports' => array( 'title', 'thumbnail', 'custom-fields', 'revisions', 'page-attributes' )
		)
	);
}
add_action( 'init', 'custom_post_company' );

function custom_post_superior() {
	register_post_type( 'superior',
		array(
			'labels' => array(
				'name' => __( 'Superiors' ),
				'singular_name' => __( 'Superior' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'superiors'),
			'supports' => array( 'title', 'thumbnail', 'custom-fields', 'revisions', 'page-attributes' )
		)
	);
}
add_action( 'init', 'custom_post_superior' );