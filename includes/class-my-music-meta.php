<?php

/**
 * The file that defines the core methods for music meta database table
 *
 * @link       https://github.com/bhavsinh-ker
 * @since      1.0.0
 *
 * @package    My_Music
 * @subpackage My_Music/includes
 */

/**
 * The music meta class.
 *
 * This is used to perform select, insert, update and delete operation on music meta database table
 *
 * @since      1.0.0
 * @package    My_Music
 * @subpackage My_Music/includes
 * @author     Bhavik Ker <bhavik.ker@gmail.com>
 */
class My_Music_Meta {

	/**
	 * Database table name
	 *
	 * @since    1.0.0
	 * @access   protected
	 */
	protected $table_name;

	/**
	 * Database object
	 *
	 * @since    1.0.0
	 * @access   protected
	 */
	protected $dbobj;

	/**
	 * Define the core functionality of the class.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		global $wpdb;
		$this->table_name = $wpdb->prefix . 'musicmeta';
		$this->dbobj = $wpdb;
	}

	/**
	 * Add music meta
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function add_music_meta( $music_id, $meta_key, $meta_value ) {
		
		return $this->dbobj->query(
			$this->dbobj->prepare(
			   "
			   INSERT INTO $this->table_name
			   ( music_id, music_meta_key, music_meta_value )
			   VALUES ( %d, %s, %s )
			   ",
			   $music_id,
			   $meta_key,
			   $this->clean_music_meta_value($meta_value)
			)
		);
	}

	/**
	 * update music meta
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function update_music_meta( $music_id, $meta_key, $meta_value ) {

		$music_meta_id = $this->dbobj->get_results(
			"SELECT `music_meta_id` FROM `$this->table_name` WHERE `music_id` = $music_id AND `music_meta_key` = $meta_key;"
		);

		if(!$music_meta_id || empty($music_meta_id)) {
			return $this->add_music_meta( $music_id, $meta_key, $meta_value );
		}

		return $this->dbobj->query(
			$this->dbobj->prepare(
			   "
			   UPDATE `$this->table_name` SET `music_meta_value` = %s WHERE `music_id` = %d AND `music_meta_key` = %s;
			   ",
			   $this->clean_music_meta_value($meta_value),
			   $music_id,
			   $meta_key
			)
		);
	}

	/**
	 * delete music meta
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function delete_music_meta( $music_id, $meta_key = '' ) {
		
		$where_condition = array(
			'music_id' => $music_id
		);
		if($meta_key!='') {
			$where_condition['meta_key'] = $meta_key;
		}
		return $this->dbobj->delete( $this->table_name, $where_condition );
		
	}

	/**
	 * get music meta
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function get_music_meta( $music_id, $meta_key = '', $single = false ) {

		/* Get all music meta based on music id */
		if($meta_key=='') {
			$result = $this->dbobj->get_results(
				"SELECT `music_meta_key`, `music_meta_value` FROM `$this->table_name` WHERE `music_id` = '$music_id';"
			);
			if(!$result || empty($result)) {
				return false;
			}
			$return_data = array();
			foreach ($result as $data) {
				$return_data[$data->music_meta_key] = $data->music_meta_value;
			}
			return $return_data;
		}
		/* EOF get all music meta based on music id */

		$music_meta_value = $this->dbobj->get_results(
			"
			SELECT `music_meta_key`, `music_meta_value` FROM `$this->table_name` WHERE `music_id` = '$music_id' AND `music_meta_key` = '$meta_key'
			"
		);

		echo '<pre>'.print_r($music_meta_value, true).'</pre>';

		if(!$music_meta_value || empty($music_meta_value)) {
			return false;
		}
		
		if($single===false) {
			return $music_meta_value;
		}

		return (isset($music_meta_value[$meta_key])) ? maybe_unserialize($music_meta_value[$meta_key]) : false;
	}

	/**
	 * Clean music meta value
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function clean_music_meta_value( $music_meta_value ) {
		return sanitize_text_field($music_meta_value);
	}
}
