<?php
get_header();
?>
<main class="<?php echo esc_attr(get_post_field('post_name', get_post())); ?>">

   <?php

   $mast = get_field('mast') ?? null;
   if ($mast) :
      set_query_var('mast_data', $mast);
      get_template_part('template-parts/frontpage/section', 'mast');
   endif;

   get_template_part('template-parts/frontpage/section', 'news-events');

   ?>

   <section id="schedule">
      <div class="page-width">
         <h2 class="hxl main--title uppercase">
            Schedule
         </h2>
         <?php
         $streams = get_field('streamers');
         $count = is_array($streams) ? count($streams) : 0;
         $grid_class = $count == 3 ? "stream-ct--3" : ($count == 5 ? "stream-ct--5" : "stream-ct--1");

         ?>
         <?php if ($streams) : ?>
            <div class="streamers-wrapper <?php echo $grid_class; ?>">
               <?php foreach ($streams as $index => $streamer) : ?>
                  <?php
                  $url = $streamer['streamer_url'];
                  $host = parse_url($url, PHP_URL_HOST);
                  $stream_id = '';
                  $do_action = 'impression_youtube_stream';

                  if (strpos($host, 'youtube.com') !== false) {
                     parse_str(parse_url($url, PHP_URL_QUERY), $query);
                     $stream_id = $query['v'] ?? '';
                     //do_action('impression_youtube_stream', $stream_id);
                  } elseif (strpos($host, 'youtu.be') !== false) {
                     $path = trim(parse_url($url, PHP_URL_PATH), '/');
                     $stream_id = $path;
                     //do_action('impression_youtube_stream', $stream_id);
                  } elseif (strpos($host, 'twitch.tv') !== false) {
                     $path = trim(parse_url($url, PHP_URL_PATH), '/');
                     $parts = explode('/', $path);
                     $do_action = 'impression_twitch_stream';

                     if (count($parts) === 1) {
                        $stream_id = $parts[0];
                     }

                     if (count($parts) === 2 && $parts[0] === 'videos') {
                        $stream_id = $parts[1];
                     }
                  }
                  ?>

                  <?php if ($index === 0) : ?>
                     <!-- Featured Video Block -->
                     <div class="featured-thumbnail">
                        <?php do_action($do_action, $stream_id); ?>
                     </div>

                     <!-- Begin side thumbnails -->
                     <?php if (count($streams) > 1) : ?>
                        <div class="side-thumbnails">
                        <?php endif; ?>
                     <?php else : ?>
                        <!-- Thumbnail Item -->
                        <?php do_action($do_action, $stream_id); ?>
                     <?php endif; ?>
                  <?php endforeach; ?>

                  <?php if (count($streams) > 1) : ?>
                        </div> <!-- Close side-thumbnails -->
                     <?php endif; ?>
            </div> <!-- Close video-grid -->
         <?php endif; ?>

      </div>
   </section>

   <section id="talents">
      <div class="page-width talent-wrapper">
         <?php
         $talents = get_field('talents');
         foreach ($talents as $talent) {
            $talent = $talent['talent'];
            if ($talent['media']) {
               // Display the video element
               $url = $talent['media']['url'];
               echo '<video class="gen-card-media" playsinline loop autoplay muted loading="lazy">';
               echo "<source  src='$url' type='video/mp4'>";
               echo 'Your browser does not support the video tag.';
               echo '</video>';
           }
         }

         /* echo "<pre style='text-align: left'>";
         var_dump($talents);
         echo "</pre>"; */
         ?>
      </div>
   </section>

</main>

<?php get_footer(); ?>