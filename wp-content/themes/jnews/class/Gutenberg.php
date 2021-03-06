<?php
/**
 * @author : Jegtheme
 */

namespace JNews;

class Gutenberg
{
	private static $instance;

	public static function getInstance()
	{
		if ( null === static::$instance ) {
			static::$instance = new static();
		}
		return static::$instance;
	}

	private function __construct()
	{
		if ( ! function_exists('register_block_type') || class_exists('Classic_Editor') ) return;

		$this->setup_hook();
	}

	protected function setup_hook() {

		add_action( 'admin_enqueue_scripts',    array( $this, 'post_metabox' ) );
		add_action( 'save_post',                array( $this, 'save_post_format'), 99 );
		add_action( 'edit_post',                array( $this, 'save_post_format'), 99 );

		add_action( 'admin_enqueue_scripts',	array( $this, 'load_font') );
		add_action( 'admin_print_styles',		array( $this, 'load_style'), 99 );

		add_filter( 'jnews_single_subtitle',    array( $this, 'get_subtitle' ), 10, 2 );
		add_filter( 'get_the_terms',            array( $this, 'get_post_format' ) , 10, 3 );
		add_filter( 'get_post_metadata',        array( $this, 'get_post_format_video' ), 10, 3 );
		add_filter( 'get_post_metadata',        array( $this, 'get_post_format_gallery' ), 10, 3 );
		add_filter( 'jnews_load_post_subtitle', '__return_false' );
	}

	public function load_style() {
		$body_font      = get_theme_mod( 'jnews_body_font' );
		$title_font     = get_theme_mod( 'jnews_h1_font' );
		$paragraph_font = get_theme_mod( 'jnews_p_font' );
		?>
		<style type="text/css">
			/*Font Style*/
			<?php if ( ! empty( $body_font ) ): ?>
		        .wp-block {
		            font-family: <?php echo esc_attr( $body_font['font-family'] . ' !important' ) ?>;
		        }
			<?php endif ?>

			<?php if ( ! empty( $title_font ) ): ?>
		        .wp-block.editor-post-title__block textarea {
		            font-family: <?php echo esc_attr( $title_font['font-family'] . ' !important' ) ?>;
		        }
			<?php endif ?>

			<?php if ( ! empty( $paragraph_font ) ): ?>
		        .wp-block p {
		            font-family: <?php echo esc_attr( $paragraph_font['font-family'] . ' !important' ) ?>;
		        }
			<?php endif ?>
	    </style>
		<?php
	}

	public function load_font() {
		if ( class_exists( '\Jeg\Util\Style_Generator' ) ) {
			$style_instance = \Jeg\Util\Style_Generator::get_instance();
	        $font_url       = $style_instance->get_font_url();

			if ( $font_url ) {
				wp_enqueue_style( 'jeg_customizer_font', $font_url );
			}
		}
	}

	public function save_post_format( $post_id ) {
		$format = vp_metabox( 'jnews_single_post.format', NULL, $post_id );

		if ( $format ) {
			set_post_format( $post_id, $format );
		}
	}

	public function post_metabox() {

		$screen = get_current_screen();

		if ( $screen->id === 'post' ) {

			$post_id = get_the_ID();

			$this->post_subtitle( $post_id );
			$this->post_format( $post_id );
			$this->post_format_video( $post_id );
			$this->post_format_gallery( $post_id );
		}
	}

	protected function post_subtitle( $post_id ) {

		$subtitle = vp_metabox( 'jnews_single_post.subtitle', NULL, $post_id );

		if ( empty( $subtitle ) ) {

			// get old post subtitle
			$subtitle = esc_html( get_post_meta( $post_id, 'post_subtitle', true ) );

			if ( ! empty( $subtitle ) ) {

				$single_post = get_post_meta( $post_id, 'jnews_single_post', true );
				$single_post['subtitle'] = $subtitle;

				// save into post subtitle metabox
				update_post_meta( $post_id, 'jnews_single_post', $single_post );
			}
		}
	}

	protected function post_format( $post_id ) {

		$format = vp_metabox( 'jnews_single_post.format', NULL, $post_id );

		if ( empty( $format ) ) {

			// get old post format
			$format = get_post_format( $post_id );
			$single_post = get_post_meta( $post_id, 'jnews_single_post', true );

			if ( $format ) {
				$single_post['format'] = $format;
			} else {
			    if ( empty($single_post) ) {
                    $single_post = array(
                        'format' => 'standard'
                    );
                } else {
			        $single_post['format'] = 'standard';
                }
			}

			// save into post format metabox
			update_post_meta( $post_id, 'jnews_single_post', $single_post );
		}
	}

	protected function post_format_video( $post_id ) {

		$video = vp_metabox( 'jnews_single_post.video', NULL, $post_id );

		if ( empty( $video ) ) {

			// get old post video
			$video = get_post_meta( $post_id, '_format_video_embed', true );

			if ( ! empty( $video ) ) {

				$single_post = get_post_meta( $post_id, 'jnews_single_post', true );
				$single_post['video'] = $video;

				// save into post video metabox
				update_post_meta( $post_id, 'jnews_single_post', $single_post );
			}
		}
	}

	protected function post_format_gallery( $post_id ) {

		$gallery = vp_metabox( 'jnews_single_post.gallery', NULL, $post_id );

		if ( empty( $gallery ) ) {

			// get old post gallery
			$gallery = get_post_meta( $post_id, '_format_gallery_images', true );

			if ( ! empty( $gallery ) ) {

				$single_post = get_post_meta( $post_id, 'jnews_single_post', true );
				$single_post['gallery'] = implode(',', $gallery);

				// save into post gallery metabox
				update_post_meta( $post_id, 'jnews_single_post', $single_post );
			}
		}
	}

	public function get_subtitle( $subtitle, $post_id ) {

		$new_subtitle = vp_metabox( 'jnews_single_post.subtitle', NULL, $post_id );

		if ( ! empty( $new_subtitle ) ) {
			$subtitle = wp_kses( $new_subtitle, wp_kses_allowed_html() );

			update_post_meta( $post_id, 'post_subtitle', $subtitle );
		}

		return $subtitle;
	}

	public function get_post_format( $term, $post_id, $taxonomy ) {

		if ( $taxonomy === 'post_format' && isset( $term[0] ) ) {

			$post_format = vp_metabox( 'jnews_single_post.format', NULL, $post_id );

			if ( $post_format ) {
				$term[0]->slug = 'post-format-' . $post_format;
			}
		}

		return $term;
	}

	public function get_post_format_video( $value, $object_id, $meta_key ) {

		if ( isset( $meta_key ) && $meta_key === '_format_video_embed' ) {

			$video = vp_metabox( 'jnews_single_post.video', NULL, $object_id );

			if ( ! empty( $video ) )
				$value = $video;
		}

		return $value;
	}

	public function get_post_format_gallery( $value, $object_id, $meta_key ) {

		if ( isset( $meta_key ) && $meta_key === '_format_gallery_images' ) {

			$video = vp_metabox( 'jnews_single_post.gallery', NULL, $object_id );

			if ( ! empty( $video ) )
				$value = array( explode( ',', $video ) );
		}

		return $value;
	}
}
