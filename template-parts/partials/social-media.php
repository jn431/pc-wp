<?php if (!empty($social_links)): ?>
    <ul class="no-style sm-list">
        <?php foreach ($social_links as $key => $link): ?>
            <li class="sm">
                <a href="<?php echo esc_url($link); ?>" target="_blank" rel="noopener">
                    <?php

                    $svg_path = get_template_directory() . "/assets/images/icons/icon-$key.svg";

                    // Check if the file exists before including
                    if (file_exists($svg_path)) {
                        // Output the raw SVG content
                        echo file_get_contents($svg_path);
                    } else {
                        // Fallback text or placeholder icon
                        echo "<span>[$key icon missing]</span>";
                    }
                    ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>