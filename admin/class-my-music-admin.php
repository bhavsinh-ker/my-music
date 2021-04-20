<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/bhavsinh-ker
 * @since      1.0.0
 *
 * @package    My_Music
 * @subpackage My_Music/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    My_Music
 * @subpackage My_Music/admin
 * @author     Bhavik Ker <bhavik.ker@gmail.com>
 */
class My_Music_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in My_Music_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The My_Music_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/my-music-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in My_Music_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The My_Music_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/my-music-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register custom post type for music
	 *
	 * @since    1.0.0
	 */
	public function my_music_post_type_registration() {
		$labels = array(
			'name'                  => _x( 'Music', 'Post type general name', 'my-music' ),
			'singular_name'         => _x( 'Music', 'Post type singular name', 'my-music' ),
			'menu_name'             => _x( 'Music', 'Admin Menu text', 'my-music' ),
			'name_admin_bar'        => _x( 'Music', 'Add New on Toolbar', 'my-music' ),
			'add_new'               => __( 'Add New', 'my-music' ),
			'add_new_item'          => __( 'Add New Music', 'my-music' ),
			'new_item'              => __( 'New Music', 'my-music' ),
			'edit_item'             => __( 'Edit Music', 'my-music' ),
			'view_item'             => __( 'View Music', 'my-music' ),
			'all_items'             => __( 'All Music', 'my-music' ),
			'search_items'          => __( 'Search Music', 'my-music' ),
			'parent_item_colon'     => __( 'Parent Music:', 'my-music' ),
			'not_found'             => __( 'No music found.', 'my-music' ),
			'not_found_in_trash'    => __( 'No music found in Trash.', 'my-music' ),
			'featured_image'        => _x( 'Music Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'my-music' ),
			'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'my-music' ),
			'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'my-music' ),
			'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'my-music' ),
			'archives'              => _x( 'Music archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'my-music' ),
			'insert_into_item'      => _x( 'Insert into Music', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'my-music' ),
			'uploaded_to_this_item' => _x( 'Uploaded to this Music', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'my-music' ),
			'filter_items_list'     => _x( 'Filter Music list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'my-music' ),
			'items_list_navigation' => _x( 'Music list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'my-music' ),
			'items_list'            => _x( 'Music list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'my-music' ),
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'music' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 
				'title', 
				'editor', 
				'author', 
				'thumbnail', 
				'excerpt'
			),
		);
		register_post_type( 'music', $args );
	}

}
