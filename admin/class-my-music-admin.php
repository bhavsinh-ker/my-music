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
	
	/**
	 * Register custom taxonomy for Genre and music-tag
	 *
	 * @since    1.0.0
	 */
	public function my_music_taxonomy_registration() {
		/* Register Genres taxonomy */
		$labels = array(
			'name'              => _x( 'Genres', 'taxonomy general name', 'my-music' ),
			'singular_name'     => _x( 'Genre', 'taxonomy singular name', 'my-music' ),
			'search_items'      => __( 'Search Genres', 'my-music' ),
			'all_items'         => __( 'All Genres', 'my-music' ),
			'parent_item'       => __( 'Parent Genre', 'my-music' ),
			'parent_item_colon' => __( 'Parent Genre:', 'my-music' ),
			'edit_item'         => __( 'Edit Genre', 'my-music' ),
			'update_item'       => __( 'Update Genre', 'my-music' ),
			'add_new_item'      => __( 'Add New Genre', 'my-music' ),
			'new_item_name'     => __( 'New Genre Name', 'my-music' ),
			'menu_name'         => __( 'Genre', 'my-music' ),
		);
	 
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'genre' ),
		);
	 
		register_taxonomy( 'genre', array( 'music' ), $args );
		/* EOF Register Genres taxonomy */

		unset( $args );
		unset( $labels );
	
		/* Register Music Tag taxonomy */
		$labels = array(
			'name'                       => _x( 'Music Tags', 'taxonomy general name', 'my-music' ),
			'singular_name'              => _x( 'Music Tag', 'taxonomy singular name', 'my-music' ),
			'search_items'               => __( 'Search Music Tags', 'my-music' ),
			'popular_items'              => __( 'Popular Music Tags', 'my-music' ),
			'all_items'                  => __( 'All Music Tags', 'my-music' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit Music Tag', 'my-music' ),
			'update_item'                => __( 'Update Music Tag', 'my-music' ),
			'add_new_item'               => __( 'Add New Music Tag', 'my-music' ),
			'new_item_name'              => __( 'New Music Tag Name', 'my-music' ),
			'separate_items_with_commas' => __( 'Separate Music Tags with commas', 'my-music' ),
			'add_or_remove_items'        => __( 'Add or remove Music Tags', 'my-music' ),
			'choose_from_most_used'      => __( 'Choose from the most used Music Tags', 'my-music' ),
			'not_found'                  => __( 'No Music Tags found.', 'my-music' ),
			'menu_name'                  => __( 'Music Tags', 'my-music' ),
		);
	
		$args = array(
			'hierarchical'          => false,
			'labels'                => $labels,
			'show_ui'               => true,
			'show_admin_column'     => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'music-tag' ),
		);
	
		register_taxonomy( 'music-tag', 'music', $args );
		/* EOF Register Music Tag taxonomy */
	}

	/**
	 * Add custom metabox for music post type
	 *
	 * @since    1.0.0
	 */
	public function my_music_meta_box() {
		add_meta_box(
            'my_music_meta_box_id',
            'Music Information',
            array(
				$this, 
				'my_music_custom_meta_box_html'
			),
            'music'
        );
	}

	/**
	 * Callback function for music custom meta box
	 *
	 * @since    1.0.0
	 */
	public function my_music_custom_meta_box_html( $post ) {
		$meta = new My_Music_Meta();
		$post_id = $post->ID;
		$meta_data = $meta->get_music_meta($post_id);
		$composer_name = (isset($meta_data['composer_name']) && !empty($meta_data['composer_name'])) ? $meta_data['composer_name'] : "";
		$publisher = (isset($meta_data['publisher']) && !empty($meta_data['publisher'])) ? $meta_data['publisher'] : "";
		$year_of_recording = (isset($meta_data['year_of_recording']) && !empty($meta_data['year_of_recording'])) ? $meta_data['year_of_recording'] : "";
		$additional_contributors = (isset($meta_data['additional_contributors']) && !empty($meta_data['additional_contributors'])) ? $meta_data['additional_contributors'] : "";
		$music_url = (isset($meta_data['music_url']) && !empty($meta_data['music_url'])) ? $meta_data['music_url'] : "";
		$music_price = (isset($meta_data['music_price']) && !empty($meta_data['music_price'])) ? $meta_data['music_price'] : "";
		$currency_symbol = array(
			"USD" => "&#36;",
			"EUR" => "&#128;",
			"GBP" => "&#163;"
		);
		$currency = get_option( 'my_music_currency', 'USD' );
		$currency = (isset($currency_symbol[$currency])) ? $currency_symbol[$currency] : "$";
		?>
		<table class="my-music-meta-box-table">
			<tbody>
				<tr>
					<th>
						<label for="my-music-composer-name"><?php _e( 'Composer Name', 'my-music' ); ?>:</label>
					</th>
					<td>
						<input type="text" id="my-music-composer-name" name="composer_name" value="<?php echo $composer_name; ?>">
					</td>
				</tr>

				<tr>
					<th>
						<label for="my-music-publisher"><?php _e( 'Publisher', 'my-music' ); ?>:</label>
					</th>
					<td>
						<input type="text" id="my-music-publisher" name="publisher" value="<?php echo $publisher; ?>">
					</td>
				</tr>
				
				<tr>
					<th>
						<label for="my-music-year-of-recording"><?php _e( 'Year of Recording', 'my-music' ); ?>:</label>
					</th>
					<td>
						<input type="number" id="my-music-year-of-recording" name="year_of_recording" value="<?php echo $year_of_recording; ?>">
					</td>
				</tr>

				<tr>
					<th>
						<label for="my-music-additional-contributors"><?php _e( 'Additional Contributors', 'my-music' ); ?>:</label>
					</th>
					<td>
						<input type="text" id="my-music-additional-contributors" name="additional_contributors" value="<?php echo $additional_contributors; ?>">
					</td>
				</tr>

				<tr>
					<th>
						<label for="my-music-url"><?php _e( 'URL', 'my-music' ); ?>:</label>
					</th>
					<td>
						<input type="url" id="my-music-url" name="music_url" value="<?php echo $music_url; ?>">
					</td>
				</tr>

				<tr>
					<th>
						<label for="my-music-price"><?php _e( 'Price', 'my-music' ); ?>:</label>
					</th>
					<td>
						<span class="my-music-price-icon"><?php echo $currency; ?></span>
						<input type="number" id="my-music-price" name="music_price" value="<?php echo $music_price; ?>">
					</td>
				</tr>
			</tbody>
		</table>
		<?php
	}

	/**
	 * Callback function for add/update music meta data
	 *
	 * @since    1.0.0
	 */
	public function my_music_save_meta_data( $post_id ) {
		$meta = new My_Music_Meta();
		$allowed_fields = array(
			'composer_name',
			'publisher',
			'year_of_recording',
			'additional_contributors',
			'music_url',
			'music_price'
		);
		if(!isset($_POST) || empty($_POST)) {
			return;
		}
		foreach ($_POST as $key => $value) {
			if(in_array( $key, $allowed_fields )) {
				$meta->update_music_meta( $post_id, $key, $value );
			}
		}
	}

	/**
	 * Callback function for delete music meta data
	 *
	 * @since    1.0.0
	 */
	public function my_music_delete_meta_data( $post_id ) {
		$meta = new My_Music_Meta();
		$meta->delete_music_meta( $post_id );
	}

	/**
	 * Add admin menu for setting page
	 *
	 * @since    1.0.0
	 */
	public function my_music_admin_menu() {
		add_submenu_page(
			'edit.php?post_type=music',
			__( 'Music Settings', 'my-music' ),
			__( 'Music Settings', 'my-music' ),
			'manage_options',
			'my-music-settings',
			array(
				$this, 
				'my_music_setting_page_callback'
			)
		);
	}

	/**
	 * Setting page HTML
	 *
	 * @since    1.0.0
	 */
	public function my_music_setting_page_callback() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/my-music-admin-display.php';
	}

	/**
	 * Setting registration
	 *
	 * @since    1.0.0
	 */
	public function my_music_setting_registration() {
		$settings = array(
			'my_music_currency',
			'my_music_musics_per_page'
		);
		foreach ($settings as $setting) {
			register_setting( 'my_music_settings_group', $setting );
		}
	}

	/**
	 * Shortcode registration
	 *
	 * @since    1.0.0
	 */
	public function my_music_shortcode_registration() {
		add_shortcode( 'music', array(
			$this,
			'my_music_shortcode'
		) );
	}

	/**
	 * Music Shortcode Function
	 *
	 * @since    1.0.0
	 */
	public function my_music_shortcode($atts) {
		$atts = shortcode_atts( array(
			'year' => '',
			'genre' => ''
		), $atts );		

		/* General query */
		$args = array(
			'post_type'          	=> 'music',
            'nopaging'            	=> true,
            'post_status'        	=> array( 'publish' ),
            'fields'           		=> 'ids',
            'suppress_filters'		=> false,
			'numberposts' 		=> -1
		);
		/* EOF general query */

		/* Year filter */
		if($atts['year']!='') {
			$year = $atts['year'];
			global $wpdb;
			$table_name = $wpdb->prefix . 'musicmeta';
			$music_ids = $wpdb->get_results(
				"SELECT `music_id` FROM `$table_name` WHERE `music_meta_key` = 'year_of_recording' AND `music_meta_value` = '$year';",
				ARRAY_N
			);
			if(!empty($music_ids) && is_array($music_ids)) {
				foreach ($music_ids as $music_id) {
					if(isset($music_id[0])) {
						$args['post__in'][] = $music_id[0];
					}
				}
			}
		}
		/* EOF Year filter */

		/* Genre filter */
		if($atts['genre']!='') {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'genre',
					'field'    => 'slug',
					'terms'    => $atts['genre']
				),
			);
		}
		/* EOF genre filter */

		/* Pagination process */
		$limit = get_option("my_music_musics_per_page", "10");
		$paged = (isset($_GET['music_paged'])) ? $_GET['music_paged'] : 1;
		$offset_data = "0";
		$all_music_posts = get_posts($args);
		$total_music_data = count($all_music_posts);
		$numer_of_pages = $total_music_data / $limit;
        if (is_float($numer_of_pages)) {
            $numer_of_pages = ((int) $numer_of_pages) + 1;
        }
		if (isset($paged) && $paged != '1') {
            $offset_data = ($paged - 1) * $limit;
        }
		$current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		ob_start();
		/* EOF pagination process */

		unset($args['fields']);
		unset($args['nopaging']);
		$args['numberposts'] = $limit;
		$args['offset'] = $offset_data;
		$music_posts = get_posts($args);
		?>
		<div class="my-music">
			<?php if(!is_wp_error($music_posts) && !empty($music_posts)) { ?>
			<div class="my-music-list">
				<ul>
					<?php 
						$music_meta_obj = new My_Music_Meta();
						foreach ($music_posts as $music_post) {
							$music_id = $music_post->ID;
							$music_title = $music_post->post_title;
							if(has_post_thumbnail( $music_id )) {
								$music_img = get_the_post_thumbnail_url( $music_id, array(500,300) );
							} else {
								$music_img = "https://via.placeholder.com/500x300.png?text=".$music_title;
							}
							$music_meta = $music_meta_obj->get_music_meta( $music_id );
							$composer_name = (isset($music_meta['composer_name'])) ? $music_meta['composer_name'] : '';
							$publisher = (isset($music_meta['publisher'])) ? $music_meta['publisher'] : '';
							$year_of_recording = (isset($music_meta['year_of_recording'])) ? $music_meta['year_of_recording'] : '';
							$additional_contributors = (isset($music_meta['additional_contributors'])) ? $music_meta['additional_contributors'] : '';
							$music_price = (isset($music_meta['music_price'])) ? $music_meta['music_price'] : '';
							$music_link = (isset($music_meta['music_url'])) ? $music_meta['music_url'] : '#';
							$music_excerpt = apply_filters('the_excerpt', $music_post->post_excerpt);
							$music_genre = wp_get_post_terms( $music_id, 'genre', array( 'fields' => 'names' ) );
							$music_genre_str = false;
							if(!is_wp_error($music_genre) && !empty($music_genre)) {
								$music_genre_str = implode(", ", $music_genre);
							}
					?>
					<li>
						<div class="my-music-card">
							<a href="<?php echo $music_link; ?>" target="_blank" title="<?php echo $music_title; ?>">
								<img src="<?php echo $music_img; ?>" alt="<?php echo $music_title; ?>">
							</a>
							<div class="my-music-card-body">
								<a href="<?php echo $music_link; ?>" target="_blank" title="<?php echo $music_title; ?>">
									<h3><?php echo $music_title; ?></h3>
								</a>
								<div class="my-music-card-meta">
									<ul>
										<?php if($music_genre_str!=false) { ?>
										<li>
											<b><?php _e( 'Genre', 'my-music' ); ?></b>: <span><?php echo $music_genre_str; ?></span>
										</li>
										<?php } if($composer_name!="") { ?>
										<li>
											<b><?php _e( 'Composer Name', 'my-music' ); ?></b>: <span><?php echo $composer_name; ?></span>
										</li>
										<?php } if($publisher!="") { ?>
										<li>
											<b><?php _e( 'Publisher', 'my-music' ); ?></b>: <span><?php echo $publisher; ?></span>
										</li>
										<?php } if($year_of_recording!="") { ?>
										<li>
											<b><?php _e( 'Year of Recording', 'my-music' ); ?></b>: <span><?php echo $year_of_recording; ?></span>
										</li>
										<?php } if($additional_contributors!="") { ?>
										<li>
											<b><?php _e( 'Additional Contributors', 'my-music' ); ?></b>: <span><?php echo $additional_contributors; ?></span>
										</li>
										<?php } if($music_price!="") { ?>
										<li>
											<b><?php _e( 'Price', 'my-music' ); ?></b>: <span><?php echo $currency.$music_price; ?></span>
										</li>
										<?php } ?>
									</ul>
								</div>
								<?php if($music_excerpt!="") { ?>
								<div class="my-music-card-excerpt">
								<?php echo $music_excerpt; ?>
								</div>
								<?php } ?>
								<a href="<?php echo $music_link; ?>" class="music-btn" target="_blank" title="<?php echo $music_title; ?>">
									<?php _e( 'Listen', 'my-music' ); ?>
								</a>
							</div>
						</div>
					</li>
					<?php 
						}
					?>
				</ul>
			</div>
			<?php 
				} if($numer_of_pages>1) {
					$next_page = $paged+1;
					$previos_page = $paged-1;
					$next_page_link = $previos_page_link = false;
					if($next_page<=$numer_of_pages) {
						$next_page_link = add_query_arg( 'music_paged', $next_page, $current_url );
					}
					if($previos_page>=1) {
						$previos_page_link = add_query_arg( 'music_paged', $previos_page, $current_url );
					}
			?>
			<div class="my-music-pagination">
				<ul>
					<li class="my-music-pagination-link my-music-pagination-link-previos <?php echo ($previos_page_link===false) ? 'disable' : ''; ?>">
						<?php 
							if($previos_page_link!==false) {
						?>
						<a href="<?php echo $previos_page_link; ?>">
						<?php 
							}
						?>
							<span><?php _e( 'Previos', 'my-music' ); ?></span>
						<?php 
							if($previos_page_link!==false) {
						?>
						</a>
						<?php 
							}
						?>
					</li>
					<?php 
						$i = 1;
						while ($i <= $numer_of_pages) {
							$page_link = add_query_arg( 'music_paged', $i, $current_url );
					?>
					<li class="my-music-pagination-link <?php echo ($i==$paged) ? 'active' : ''; ?>">
						<a href="<?php echo $page_link; ?>">
							<span><?php _e( $i, 'my-music' ); ?></span>
						</a>
					</li>
					<?php
							$i++; 
						}
					?>
					<li class="my-music-pagination-link my-music-pagination-link-next <?php echo ($next_page_link===false) ? 'disable' : ''; ?>">
						<?php 
							if($next_page_link!==false) {
						?>
						<a href="<?php echo $next_page_link; ?>">
						<?php 
							}
						?>
							<span><?php _e( 'Next', 'my-music' ); ?></span>
						<?php 
							if($next_page_link!==false) {
						?>
						</a>
						<?php 
							}
						?>
					</li>
				</ul>
			</div>
			<?php 
				}
			?>
		</div>
		<?php
		$shortcode_html = ob_get_contents();
		ob_end_clean();
		return $shortcode_html;
	}
}
