<?php if (!empty($social_links)): ?>
    <ul class="no-style sm-list">
        <?php foreach ($social_links as $key => $link): ?>
            <li class="sm">
                <a href="<?php echo esc_url($link); ?>" target="_blank" rel="noopener">
                    <img src="<?php echo IMPRESSION_THEME_URI . "assets/images/icon-$key.svg"; ?>" alt="<?php echo esc_html($key); ?>" width="30" height="auto">
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>