<?php
/*
 * Template Part: Talent Tall Card
 *
 * Expects a $talent array with the following structure:
 *
 * $talent = [
 *   'name'     => (string) Talent name (e.g., "Origins"),
 *   'category' => (string) Category name (e.g., "Phase 1"),
 *   'overlay'  => (array) Image attachment details (from ACF image field):
 *     [
 *       'ID', 'url', 'alt', 'title', 'filename', 'filesize',
 *       'width', 'height', 'sizes' => [ ... ],
 *       ... (standard WP attachment fields)
 *     ],
 *   'media'    => (array) Video attachment details (from ACF file or video field):
 *     [
 *       'ID', 'url', 'mime_type', 'width', 'height', 'filename',
 *       ... (standard WP attachment fields)
 *     ],
 *   'url'      => (string) Optional URL string (could be empty)
 * ];
 *
 * Example usage:
 * echo $talent['name'];
 * echo $talent['overlay']['url'];
 * echo $talent['media']['mime_type']; // "video/mp4"
 */

$talent = get_query_var('talent');

?>

<div class="talent-card">
   <div class="talent-details">
      <?php if (!empty($talent['category'])): ?>
         <div class="cname"><?= esc_html($talent['category']) ?></div>
      <?php endif; ?>

      <?php if (!empty($talent['name'])): ?>
         <div class="name"><?= esc_html($talent['name']) ?></div>
      <?php endif; ?>

   </div>
   <div class="talent-media-container">
      <div class="black-tint"></div>
      <?php if (!empty($talent['overlay'])) : ?>
         <img src="<?php echo $talent['overlay']['url']; ?>" alt="Overlay" class="overlay-name">
      <?php endif; ?>
      <?php if (!empty($talent['media'])) : ?>
         <?php if (isset($talent['media']['mime_type']) && str_contains($talent['media']['mime_type'], 'video')) : ?>
            <video class="media" playsinline loop autoplay muted loading="lazy">
               <source src="<?= esc_url($talent['media']['url']) ?>" type="<?= esc_attr($talent['media']['mime_type']) ?>">
            </video>
         <?php else:  ?>
            <img src="<?php echo $talent['media']['url']; ?>" alt="<?php echo $talent['media']['alt']; ?>" class="media">
         <?php endif; ?>
      <?php endif; ?>
   </div>
</div>