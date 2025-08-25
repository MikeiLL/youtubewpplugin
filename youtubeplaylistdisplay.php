<?php

/**
 *
 * @package   YouTubePlaylistDisplay
 * @author    Mike iLL <mike@mzoo.org>
 * @copyright 2025 mZoo.org
 * @license   GPL 2.0+
 * @link      http://mzoo.org
 *
 * Plugin Name:     YouTube Playlist Display
 * Plugin URI:      https://mzoo.org
 * Description:     Display All videos from a YouTube Playlist.
 * Version:         1.0.0
 * Author:          Mike iLL
 * Author URI:      http://mzoo.org
 * Text Domain:     youtube-playlist-display
 * License:         GPL 2.0+
 * License URI:     http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:     /languages
 * Requires PHP:    7.2
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'We\'re sorry, but you can not directly access this file.' );
}

if (! defined( 'YT_PLAYLIST_DISPLAY_YOUTUBE_API_KEY')) {
  die( "You need to disable this plugin or add a YT_PLAYLIST_DISPLAY_YOUTUBE_API_KEY to the config file: define('YT_PLAYLIST_DISPLAY_YOUTUBE_API_KEY', 'HERE')" );
}

define( 'YTPD_VERSION', '1.0.0' );
define( 'YTPD_TEXTDOMAIN', 'youtube-playlist-display' );
define( 'YTPD_NAME', 'YouTube Playlist Display' );
define( 'YTPD_PLUGIN_ROOT', plugin_dir_path( __FILE__ ) );
define( 'YTPD_PLUGIN_ABSOLUTE', __FILE__ );

add_shortcode("youtube-playlist-display", "display_videos");
function display_videos() {
  $subbutton = "<p class=ytpdcta>Get notified when I make a new video: <a class='ytsubscribebutton'
  href='http://www.youtube.com/channel/UC-UzEgtvGoc5B9cLY7fM_AQ?sub_confirmation=1&feature=subscribe-embed-click'>
  <svg width='16' height='17' viewBox='0 0 16 16' fill='none' xmlns='http://www.w3.org/2000/svg'>
    <path
      d='M6.66732 10.0634L10.1273 8.0634L6.66732 6.0634V10.0634ZM14.374 4.8434C14.4607 5.15673 14.5207 5.57673 14.5607 6.11006C14.6073 6.6434 14.6273 7.1034 14.6273 7.5034L14.6673 8.0634C14.6673 9.5234 14.5607 10.5967 14.374 11.2834C14.2073 11.8834 13.8207 12.2701 13.2207 12.4367C12.9073 12.5234 12.334 12.5834 11.454 12.6234C10.5873 12.6701 9.79398 12.6901 9.06065 12.6901L8.00065 12.7301C5.20732 12.7301 3.46732 12.6234 2.78065 12.4367C2.18065 12.2701 1.79398 11.8834 1.62732 11.2834C1.54065 10.9701 1.48065 10.5501 1.44065 10.0167C1.39398 9.4834 1.37398 9.0234 1.37398 8.6234L1.33398 8.0634C1.33398 6.6034 1.44065 5.53006 1.62732 4.8434C1.79398 4.2434 2.18065 3.85673 2.78065 3.69006C3.09398 3.6034 3.66732 3.5434 4.54732 3.5034C5.41398 3.45673 6.20732 3.43673 6.94065 3.43673L8.00065 3.39673C10.794 3.39673 12.534 3.5034 13.2207 3.69006C13.8207 3.85673 14.2073 4.2434 14.374 4.8434Z'
      fill='currentColor'></path>
  </svg>
  Subscribe
</a></p>";
  return "<div class=ytpldisplaywrapper>$subbutton<div style='width: 100%;display: flex; flex-wrap: wrap; justify-content: space-evenly; gap:1em;' id='mz-youtube-playlist-display-playlist'></div>$subbutton</div>
";
}

add_action('plugins_loaded', 'YT_PLAYLIST_DISPLAY_enqueue_styles');
add_action('plugins_loaded', 'YT_PLAYLIST_DISPLAY_enqueue_scripts');
/**
 * Register and enqueue public-facing style sheet.
 *
 * @since 1.0.0
 *
 * @return void
 */
function YT_PLAYLIST_DISPLAY_enqueue_styles() {
  wp_enqueue_style( YTPD_TEXTDOMAIN . '-plugin-styles', plugins_url( 'style.css', YTPD_PLUGIN_ABSOLUTE ), array(), YTPD_VERSION );
}


/**
 * Register and enqueues public-facing JavaScript files.
 *
 * @since 1.0.0
 *
 * @return void
 */
function YT_PLAYLIST_DISPLAY_enqueue_scripts() {
  wp_register_script( YTPD_TEXTDOMAIN . '-plugin-script', plugins_url( 'script.js', YTPD_PLUGIN_ABSOLUTE ), array(), YTPD_VERSION );
  wp_localize_script(
    YTPD_TEXTDOMAIN . '-plugin-script',
    'ytpd_js_vars',
    array(
      'YOUTUBE_API_KEY' => YT_PLAYLIST_DISPLAY_YOUTUBE_API_KEY,
    )
  );
  wp_enqueue_script(YTPD_TEXTDOMAIN . '-plugin-script');
}
