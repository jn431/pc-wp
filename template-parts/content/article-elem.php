<article class="post post--horizontal">
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
      <div class="article-thumbnail-wrap">
         <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('post-thumbnails'); ?>
         </a>
      </div>
   <?php endif; ?>
   <div class="article-content-wrap">
      <h3 class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
   </div>
   <div class="arrow-wrap">
      <svg width="16" height="19" viewBox="0 0 16 19" fill="none"
         xmlns="http://www.w3.org/2000/svg">
         <path d="M9.87689 0.713379H0.425841L6.5003 9.71844C4.47689 12.7108 2.44671 15.7142 0.381836 18.7701H9.87435C11.9105 15.7599 13.8475 12.8014 15.8803 9.7963C15.9756 9.66976 15.9128 9.5777 15.8621 9.50335L15.8616 9.50265L9.87689 0.713379Z"
            fill="white" />
      </svg>
   </div>
</article>