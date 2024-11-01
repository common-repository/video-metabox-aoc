<?php

/**
 * Author: Ankit Tiwari
 * Author uri: https://artofcoding.in
 * Plugin uri: https://artofcoding.in/video-metabox
 * Plugin name: Video Metabox AOC
 * Description: This plugin allows you to upload video as a custom field for a post/page.
 * Version: 1.1
 */
function aoc_vid_register_meta_boxes()
{

    add_meta_box('aoc-video-metabox', 'Select video to upload', 'aoc_vid_display_callback', get_post_types());
}

add_action('add_meta_boxes', 'aoc_vid_register_meta_boxes');

function aoc_vid_display_callback($post)
{
    $aoc_vid_video = get_post_meta($post->ID, 'aoc_vid_video', true);

    ?>

    <div class="aoc-vid-container">
        <?php wp_nonce_field('aoc_vid_save_video', 'aoc_vid_save_vid_nonce') ?>
        <?php if ($aoc_vid_video): ?>
            <div class="aoc-vid-wrap">
                <video width="320" height="240" controls>
                    <source src="<?= esc_url(wp_get_attachment_url(intval($aoc_vid_video))) ?>">
                    Your browser does not support the video tag.
                </video>
                <input type="hidden" name="aoc_vid_video" id="aoc_vid_vid_input" value="<?= intval($aoc_vid_video) ?>">
                <button data-vid-id="<?= intval($aoc_vid_video) ?>" class="aoc-del-vid" type="button">X</button>
            </div>
        <?php
        endif;
        ?>
    </div>
    <div style="clear:both"></div>
    <p><a href="javascript:void(0)" class="aoc_vid_add">Add video</a></p>
    <div style="clear:both"></div>
    <?php
}

function aoc_vid_save_meta_box($post_id)
{
    // if (!wp_verify_nonce($_POST['aoc_vid_save_vid_nonce'], 'aoc_vid_save_video')) {

    //     return;
    // }
    // echo $post_id;;die;
    update_post_meta($post_id, 'aoc_vid_video', sanitize_text_field($_POST['aoc_video']));
}

add_action('save_post', 'aoc_vid_save_meta_box');

add_action('admin_enqueue_scripts', 'aoc_vid_admin_scripts');

function aoc_vid_admin_scripts()
{
    wp_enqueue_media();
    wp_enqueue_script('aoc_vid_admin_script', plugin_dir_url(__FILE__) . 'assets/js/admin.js', ['jquery']);
    wp_enqueue_style('aoc_vid_admin_css', plugin_dir_url(__FILE__) . 'assets/css/admin.css');
}

function aoc_get_post_video($post_id)
{
    if (!$post_id) {
        return;
    }

    $vid = get_post_meta($post_id, 'aoc_vid_video', true);
    return wp_get_attachment_url($vid);
}

add_action('init', 'aoc_init_shortcode');
function aoc_init_shortcode()
{
    add_shortcode('aoc_video_box', 'aoc_video_box');
}

function aoc_video_box($atts)
{
    $id = get_queried_object_id();
    $video = get_post_meta($id, 'aoc_vid_video', true);

    if (!$video) {
        return '';
    }
    $video_url = wp_get_attachment_url($video);
    if (!$video_url) {
        return;
    }
    $attributes = '';
    if ($atts && is_array($atts)) {
        foreach ($atts as $key => $value) {
            $attributes .= $key . '= "' . $value . '" ';
        }
        if (isset($atts['controls']) && $atts['controls']) {
            $attributes .= ' controls="true"';
        }
    }
    return '<video ' . $attributes . '>
  <source src="' . $video_url . '">
  Your browser does not support the video tag.
</video>';
};