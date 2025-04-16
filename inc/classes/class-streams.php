<?php

/**
 * Live Streams
 * @package WordPress
 * @subpackage Impression
 * @since 1.0.0
 * @see WP_Customize_Control
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!class_exists('Impression_Streams')) {
    class Impression_Streams
    {
        private $yt_api_key;
        private $twitch_client_id;
        private $twitch_client_secret;
        private $twitch_token;


        public function __construct()
        {
            // Set your API key here or via a settings page
            $this->yt_api_key = 'AIzaSyAbgKj-88nBjIp598UcklgvXK5wLmGs7IY';
            $this->twitch_client_id = 'ikhrr56i0t42xc7y9hj58v36pf2446';
            $this->twitch_client_secret = 'tqsr5dzeswd421pctwo6fu0teyjz0u';
            $this->twitch_token = get_transient('twitch_access_token');

            if (!$this->twitch_token) {
                $this->twitch_token = $this->get_twitch_access_token();
                set_transient('twitch_access_token', $this->twitch_token, 3600);
            }

            add_action('impression_twitch_stream', array($this, 'render_twitch_livestream'), 10, 1);
            add_action('impression_youtube_stream', array($this, 'youtube_render_livestream'), 10, 1);
        }

        private function get_twitch_access_token()
        {
            $response = wp_remote_post('https://id.twitch.tv/oauth2/token', [
                'body' => [
                    'client_id' => $this->twitch_client_id,
                    'client_secret' => $this->twitch_client_secret,
                    'grant_type' => 'client_credentials'
                ]
            ]);

            if (is_wp_error($response)) return '';

            $body = json_decode(wp_remote_retrieve_body($response), true);
            return $body['access_token'] ?? '';
        }

        public function render_twitch_livestream($id)
        {
            if (!$id) {
                echo '<p>No Twitch channel specified.</p>';
                return;
            }

            $api_url = "https://api.twitch.tv/helix/streams?user_login={$id}";
            $response = wp_remote_get($api_url, [
                'headers' => [
                    'Client-ID'     => $this->twitch_client_id,
                    'Authorization' => 'Bearer ' . $this->twitch_token
                ]
            ]);

            if (is_wp_error($response)) {
                echo '<p>Failed to connect to Twitch.</p>';
                return;
            }

            $body = json_decode(wp_remote_retrieve_body($response), true);
            $stream = $body['data'][0] ?? null;

            $is_live = !!$stream;
            $title = $is_live ? esc_html($stream['title']) : 'Offline';
            $viewers = $is_live ? $stream['viewer_count'] : null;
            $thumbnail = $is_live
                ? str_replace(['{width}', '{height}'], [320, 180], $stream['thumbnail_url'])
                : 'https://static-cdn.jtvnw.net/previews-ttv/live_user_' . $id . '-320x180.jpg';

            $url = 'https://www.twitch.tv/' . $id;

            $template_path = locate_template('template-parts/partials/stream-twitch.php');
            if ($template_path) {
                (function () use ($template_path, $id, $title, $thumbnail, $is_live, $viewers, $url) {
                    include $template_path;
                })();
            }
        }

        /**
         * Outputs livestream block HTML
         *
         * @param string $video_id YouTube Video ID
         */
        public function youtube_render_livestream($video_id)
        {
            if (empty($video_id)) {
                echo '<p>No video ID provided.</p>';
                return;
            }

            $api_url = "https://www.googleapis.com/youtube/v3/videos?part=snippet,liveStreamingDetails&id=$video_id&key={$this->yt_api_key}";
            $response = wp_remote_get($api_url);

            if (is_wp_error($response)) {
                echo '<p>Unable to get livestream data.</p>';
                return;
            }

            $body = wp_remote_retrieve_body($response);
            $data = json_decode($body, true);

            if (empty($data['items'][0])) {
                echo '<p>Video not found.</p>';
                return;
            }



            $video = $data['items'][0];
            $title = esc_html($video['snippet']['title']);
            $thumbnail = esc_url($video['snippet']['thumbnails']['medium']['url']);
            $live_details = $video['liveStreamingDetails'] ?? [];
            /*
            Schedule
            array(4) {
            ["actualStartTime"]=>
            string(20) "2025-04-14T20:30:47Z"
            ["scheduledStartTime"]=>
            string(20) "2025-04-14T20:45:00Z"
            ["concurrentViewers"]=>
            string(3) "618"
            ["activeLiveChatId"]=>
            string(75) "Cg0KC3M5MV81TGxBZG1VKicKGFVDaWZDZXNnLUVVa2pLeVFlZGFCM2hSZxILczkxXzVMbEFkbVU"
            }
   */
            $is_live = isset($live_details['actualStartTime']);
            $viewers = $live_details['concurrentViewers'] ?? null;
            $url = "https://www.youtube.com/watch?v=" . $video['id'];

            $template_path = locate_template('template-parts/partials/stream-youtube.php');
            if ($template_path) {
                (function () use ($template_path, $thumbnail, $title, $is_live, $viewers, $url) {
                    include $template_path;
                })();
            }
            /* $template_path = locate_template('template-parts/partials/stream-youtube.php');
            if ($template_path) {
                // Make variables available in template scope
                include $template_path;
            } else {
                echo '<p>Livestream template not found.</p>';
            }*/
        }
    }
}
