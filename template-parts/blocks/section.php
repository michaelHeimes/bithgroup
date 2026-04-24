<?php
/**
 * Section wrapper for all blocks Block Template with Gradient Support
 */

$id = !empty($block['anchor']) ? $block['anchor'] : 'section-' . $block['id'];
$className = 'section-block-wrapper';

// Standard Block Classes
if (!empty($block['className'])) { $className .= ' ' . $block['className']; }
if (!empty($block['align'])) { $className .= ' align' . $block['align']; }

// Native Color Classes
if (!empty($block['backgroundColor'])) {
    $className .= ' has-' . $block['backgroundColor'] . '-background-color';
}
if (!empty($block['textColor'])) {
    $className .= ' has-' . $block['textColor'] . '-color';
}

// Native Gradient Class
if (!empty($block['gradient'])) {
    // WordPress outputs the slug, we wrap it in the standard CSS class
    $className .= ' has-' . $block['gradient'] . '-gradient-background';
}

// ACF Padding Classes
if (get_field('remove_top_padding')) { $className .= ' no-top-padding'; }
if (get_field('remove_bottom_padding')) { $className .= ' no-bottom-padding'; }

// Container Style
$content_maxwidth = get_field('content_maxwidth');
$container_style = !empty($content_maxwidth) ? ' style="max-width: ' . esc_attr($content_maxwidth) . 'px;"' : '';
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="grid-container"<?php echo $container_style; ?>>
        <?php echo '<InnerBlocks />'; ?>
    </div>
</section>
