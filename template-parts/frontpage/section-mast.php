<?php

/**
 * @uses front-page.php
 *  */

defined('ABSPATH') || exit;

$_data = get_query_var('mast_data');

if ($_data): ?>
   <section class="hero__section section__mast" style="--background-tint: 15%;">
      <?php if ($_data) :
         echo wp_get_attachment_image($_data['id'], 'full', '', ['class' => 'bg']);
      endif; ?>

      <div class="social-media-strip hero__content">
         <?php do_action('impression_social_media'); ?>
      </div>
   </section>
<?php endif; ?>