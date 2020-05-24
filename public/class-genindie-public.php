<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://remkus.devries.frl
 * @since      0.1.0
 *
 * @package    Genindie
 * @subpackage Genindie/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version
 *
 * @package    Genindie
 * @subpackage Genindie/public
 * @author     Remkus de Vries <remkus@burokreas.nl>
 */
class Genindie_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    0.1.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    0.1.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    0.1.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	public function modify_via_filters() {
		add_filter( 'genesis_attr_entry-title', 'entry_title' );
		add_filter( 'genesis_attr_entry-content', 'entry_content' );
		add_filter( 'genesis_attr_comment-content', 'comment_content' );
		add_filter( 'genesis_attr_comment-author', 'comment_author' );
		add_filter( 'genesis_attr_comment-author', 'comment_entry_author' );
		add_filter( 'genesis_attr_entry-time', 'time_stamps' );
		add_filter( 'genesis_attr_comment-time', 'time_stamps' );
		add_filter( 'author-box', 'author_description' );
		add_filter( 'genesis_attr_author-archive-description', 'author_archive_description' );
		add_filter( 'post_class', 'post_content', 10, 3 );
		add_filter( 'genesis_post_categories_shortcode', 'category_shortcode_class' ); 
		add_filter( 'genesis_post_title_output', 'singular_entry_title_link', 10, 3 );
	}

	public function adding() {
		add_action( 'wp_head', 'microformats_header' );
		add_action( 'genesis_comments', 'display_webmention_likes', 1 ); 

	}

	public function entry_title( $attributes ) {
	 
	 $attributes['class'] .= ' p-entry-title p-name';
	 return $attributes;
	}

	
	public function entry_content( $attributes ) {
	 
	 $attributes['class'] .= ' e-entry-content e-content';
	 return $attributes;
	}

	
	public function comment_content() {
		$attributes['class'] .= 'comment-content p-summary p-name'; 
		return $attributes;
	}

	
	public function comment_author() {
		$attributes['class'] .= 'comment-author p-author vcard hcard h-card'; 
		return $attributes;
	}

	
	public function comment_entry_author() {
		$attributes['class'] .= 'p-author vcard hcard h-card'; 
		return $attributes;
	}


	
	public function time_stamps( $attributes ) {
	 
	 $attributes['class'] .= ' dt-updated dt-published';
	 return $attributes;
	}

	
	public function author_description( $attributes ) {
	 
	 $attributes['class'] .= ' p-note';
	 return $attributes;
	}

	
	public function author_archive_description( $attributes ) {
	 
	 $attributes['class'] .= ' vcard h-card';
	 return $attributes;
	}

	

	public function post_content( $classes, $class, $post_id ) {

		$classes[] .= 'h-entry';
	 
	    return $classes;
	}
	

	
	public function microformats_header() {
		?>
		<link rel="profile" href="http://microformats.org/profile/specs" />
		<link rel="profile" href="http://microformats.org/profile/hatom" />
		<?php
	}

	
	public function category_shortcode_class( $output ) {
		$output = str_replace( '<a ', '<a class="p-category"', $output );
		return $output;
	}

	/**
	 * Wrap post title with a link on singular entries.
	 *
	 * @param string $output The original title output.
	 * @param string $wrap The title tag.
	 * @param string $title The content of the title tag.
	 * @return string The new title output.
	 */
	public function singular_entry_title_link( $output, $wrap, $title ) {
		if ( ! is_singular() ) {
			return $output;
		}

		$title = genesis_markup(
			[
				'open'    => '<a %s>',
				'close'   => '</a>',
				'content' => $title,
				'context' => 'entry-title-link',
				'atts' => [ 'class' => 'entry-title-link u-url', ],
				'echo'    => false,
			]
		);

		$output = genesis_markup(
			[
				'open'    => "<{$wrap} %s>",
				'close'   => "</{$wrap}>",
				'content' => $title,
				'context' => 'entry-title',
				'params'  => [
					'wrap' => $wrap,
				],
				'echo'    => false,
			]
		);

		return $output;
	}

	/**
	 * [display_webmention_likes description]
	 * @return [type] [description]
	 */
	public function display_webmention_likes() {

		if ( ! class_exists( 'Semantic_Linkbacks_Plugin' ) ) {
			return;
		}

		if ( has_linkbacks( 'like' ) && is_single() ) {

			echo '<h3>Likes:</h3>'; 
			list_linkbacks(
				array(
					'type' => 'like',
				),
				get_linkbacks( 'like' )
			);

			// list_linkbacks(
			// 	array(
			// 		'type' => 'reacji',
			// 	),
			// 	Semantic_Linkbacks_Walker_Comment::$reactions
			// );
		}

	}

}
