<?php

/**
 * Twitch Stream Template
 *
 * Variables expected:
 * @var string $thumbnail
 * @var string $title
 * @var bool $is_live
 * @var int|null $viewers
 */
?>

<div class="stream-wrapper stream-twitch">
   <img src="<?php echo esc_url($thumbnail); ?>" alt="Livestream Thumbnail">
   <div class="stream-details">
      <div class="viewers">
         <?php if ($is_live): ?>
            <span>🔴 Live</span>
            <?php echo file_get_contents(IMPRESSION_THEME_URI . 'assets/images/icons/visible.svg'); ?>
            <?php echo number_format($viewers); ?>
         <?php else: ?>
             Not Live
         <?php endif; ?>
      </div>

      <h3 class="uppercase"><a href="<?php echo $url; ?>" target="_blank"><?php echo esc_html($title); ?></a></h3>
   </div>
</div>