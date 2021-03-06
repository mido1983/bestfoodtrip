<?php
/**
 * @author : Jegtheme
 */
namespace JNews\Module\Block;

Class Block_39_View extends BlockViewAbstract
{
    public function render_block_type($post, $image_size)
    {
        $thumbnail = $this->get_thumbnail($post->ID, $image_size);
        $additional_class = (!has_post_thumbnail($post->ID)) ? ' no_thumbnail' : '';
        $primary_category   = $this->get_primary_category($post->ID);

        $output =
            "<article " . jnews_post_class("jeg_post jeg_pl_md_1" . $additional_class, $post->ID) . ">
                <div class='box_wrap'>
                    <div class=\"jeg_thumb\">
                        " . jnews_edit_post( $post->ID ) . "
                        <a href=\"" . get_the_permalink($post) . "\">" . $thumbnail . "</a>
                        <div class=\"jeg_post_category\">
                            <span>{$primary_category}</span>
                        </div>
                    </div>
                    <div class=\"jeg_postblock_content\">
                        <h3 class=\"jeg_post_title\">
                            <a href=\"" . get_the_permalink($post) . "\">" . get_the_title($post) . "</a>
                        </h3>
                        " . $this->post_meta_1($post, true) . "
                    </div>
                </div>
            </article>";

        return $output;
    }

    public function build_column($results)
    {
        $first_block = '';
        for($i = 0; $i < sizeof($results); $i++) {
            $first_block .= $this->render_block_type($results[$i], 'jnews-360x180'); //other size jnews-750x536, jnews-120x86
        }

        $output =
            "<div class=\"jeg_posts_wrap\">
                <div class=\"jeg_posts jeg_load_more_flag\">
                    {$first_block}
                </div>
            </div>";

        return $output;
    }

    public function build_column_alt($results)
    {
        $first_block = '';
        for($i = 0; $i < sizeof($results); $i++) {
            $first_block .= $this->render_block_type($results[$i], 'jnews-120x86');
        }

        $output = $first_block;

        return $output;
    }

    public function render_output($attr, $column_class)
    {
        if ( isset( $attr['results'] ) ) {
            $results = $attr['results'];
        } else {
            $results = $this->build_query($attr);
        }

        $navigation = $this->render_navigation($attr, $results['next'], $results['prev'], $results['total_page']);

        if(!empty($results['result'])) {
            $content = $this->render_column($results['result'], $column_class);
        } else {
            $content = $this->empty_content();
        }

        return
            "<div class=\"jeg_block_container\">
                {$this->get_content_before($attr)}
                {$content}
                {$this->get_content_after($attr)}
            </div>
            <div class=\"jeg_block_navigation\">
                {$this->get_navigation_before($attr)}
                {$navigation}
                {$this->get_navigation_after($attr)}
            </div>";
    }

    public function render_column($result, $column_class)
    {
        /*switch($column_class)
        {
            case "jeg_col_1o3" :*/
                $content = $this->build_column($result);
        /*        break;
            case "jeg_col_3o3" :
                $content = $this->build_column($result);
                break;
            case "jeg_col_2o3" :
            default :
                $content = $this->build_column($result);
                break;
        }*/

        return $content;
    }

    public function render_column_alt($result, $column_class)
    {
        $content = $this->build_column_alt($result);
        return $content;
    }
}
