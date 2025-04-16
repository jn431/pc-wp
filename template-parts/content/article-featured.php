<article class="post article-featured">
   <?php
   $categories = get_the_category();
   if (!empty($categories)) : ?>
      <div class="post-meta">
         <?php $categories = get_the_category();
         if (!empty($categories)) : ?>
            <span class="post-category">
               <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>">
                  <?php echo esc_html($categories[0]->name); ?>
               </a>
            </span>
            <span class="slant-divider">/</span>
         <?php endif; ?>

         <span class="post-date"><?php echo get_the_date('F j, Y'); ?></span>
      </div>
   <?php endif; ?>

   <?php if (has_post_thumbnail()) : ?>
      <a href="<?php the_permalink(); ?>" class="article-thumbnail-wrap">
         <div class="shape--floppydisk-wrap">
            <div class="shape--floppydisk">
               <?php the_post_thumbnail('post-thumbnails'); ?>
            </div>
         </div>
      </a>
   <?php endif; ?>
   <div class="article-content-wrap">
      <?php if (!empty($categories)) : ?>
         <div class="category--main rainbow-outer">
            <div class="rainbow-inner"></div>
            <span class="rainbow-text">
               <?php echo esc_html($categories[0]->name); ?>
            </span>
         </div>
      <?php endif; ?>
      <h3 class="article-title main--title uppercase"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
      <div class="excerpt"><?php the_excerpt(); ?></div>
   </div>
</article>