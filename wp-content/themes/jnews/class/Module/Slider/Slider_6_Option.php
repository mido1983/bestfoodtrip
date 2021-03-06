<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Slider;

Class Slider_6_Option extends SliderOptionAbstract
{
    protected $default_number = 5;
	protected $gradient_option = true;
	protected $design_option = true;

    public function get_module_name()
    {
        return esc_html__('JNews - Slider 6', 'jnews');
    }

	public function set_typography_option( $instance ) {

		$instance->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'        => 'title_typography',
				'label'       => __( 'Title Typography', 'jnews' ),
				'description' => __( 'Set typography for post title', 'jnews' ),
				'selector'    => '{{WRAPPER}} .jeg_post_title > a',
			]
		);

		$instance->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'        => 'meta_typography',
				'label'       => __( 'Meta Typography', 'jnews' ),
				'description' => __( 'Set typography for post meta', 'jnews' ),
				'selector'    => '{{WRAPPER}} .jeg_post_meta, {{WRAPPER}} .jeg_post_meta .fa, {{WRAPPER}}.jeg_postblock .jeg_subcat_list > li > a:hover, {{WRAPPER}} .jeg_pl_md_card .jeg_post_category a, {{WRAPPER}}.jeg_postblock .jeg_subcat_list > li > a.current, {{WRAPPER}} .jeg_pl_md_5 .jeg_post_meta, {{WRAPPER}} .jeg_pl_md_5 .jeg_post_meta .fa, {{WRAPPER}} .jeg_post_category a',
			]
		);

		$instance->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'        => 'content_typography',
				'label'       => __( 'Post Content Typography', 'jnews' ),
				'description' => __( 'Set typography for post content', 'jnews' ),
				'selector'    => '{{WRAPPER}} .jeg_post_excerpt, {{WRAPPER}} .jeg_readmore',
			]
		);
	}
}
