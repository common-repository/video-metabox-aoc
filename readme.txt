=== Video Metabox AOC ===
Contributors: ankittiwaari
Donate link: 
Tags: post videos, featured video, featured post video
Requires at least: 4.0
Tested up to: 5.8
Stable tag: trunk
Requires PHP: 5.2.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Video Metabox AOC allows you to upload a video as a post meta.

== Description ==

This plugin aims at providing users the capability to upload video to a post. It uses wp.media js object to open an uploader frame and choose/upload videos. Once the video is selected, it will save the id of uploaded media object in a custom field.

== Installation ==

1. Upload the plugin folder to the `/wp-content/plugins/` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress


== Frequently Asked Questions ==


== Getting uploaded images ==

You can use the function aoc_get_post_video($post_id) to retrieve the url of video that has been uploaded to a post. This function accepts the id of post (for which the video is to be fetched) as a parameter.

== Screenshots ==

== Changelog ==

= 1.1 =
* Add shortcode `aoc_video_box`

= 1.0 =
* Bugfix - return video URL instead of video ID

= 0.1 =
* First stable version

== Upgrade Notice ==

= 0.1 =
This is the first version, subsequent improvements will be pushed later