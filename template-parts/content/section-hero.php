<?php

$hero = get_field('hero_section_group');

if ($hero): ?>
   <section class="hero__section" style="--background-tint: <?php echo $hero['background_tint']; ?>%;">
      <?php if ($hero['hero_image']) :
         echo wp_get_attachment_image($hero['hero_image']['id'], 'full', '', ['class' => 'foo bar']);
      endif; ?>
      <div class="hero__content content--<?php echo $hero['content_alignment']; ?> page-width">
         <div class="content-container">
            <h2 class="hero__title"><?php echo $hero['title']; ?></h2>
            <?php if ($hero['subtitle']) : ?>
               <div class="hero--text">Foo bar lorem ipsum</div>
            <?php endif; ?>
         </div>
      </div>
   </section>
<?php endif; ?>