<?php
/**
 * Section wrapper with Automatic Text Contrast
 */
$id = !empty($block['anchor']) ? $block['anchor'] : 'section-' . $block['id'];
$className = 'section-block-wrapper';

// 1. Standard Block Classes
if (!empty($block['className'])) { $className .= ' ' . $block['className']; }
if (!empty($block['align'])) { $className .= ' align' . $block['align']; }

// 2. Background & Gradient Classes
if (!empty($block['backgroundColor'])) {
    $className .= ' has-' . $block['backgroundColor'] . '-background-color';
}
if (!empty($block['gradient'])) {
    $className .= ' has-' . $block['gradient'] . '-gradient-background';
}

// 3. 💡 Automatic Text Color Logic
$bg_color = $block['backgroundColor'] ?? '';
$gradient = $block['gradient'] ?? '';

// Define "Light" backgrounds that should use Onyx text
$light_backgrounds = ['bith-white', 'bith-blue-10', 'bith-white-to-cube', 'bith-cube-to-white'];

if ( in_array($bg_color, $light_backgrounds) || in_array($gradient, $light_backgrounds) ) {
    $className .= ' has-bith-onyx-color';
} else {
    // Default to white text for Blue, Slate, Green, and the Blue Gradient
    $className .= ' has-bith-white-color';
}

// 4. ACF Padding Classes
if (get_field('remove_top_padding')) { $className .= ' no-top-padding'; }
if (get_field('remove_bottom_padding')) { $className .= ' no-bottom-padding'; }

// 5. Container Style
$content_maxwidth = get_field('content_maxwidth');
$container_style = !empty($content_maxwidth) ? ' style="max-width: ' . esc_attr($content_maxwidth) . 'px;"' : '';
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="grid-container"<?php echo $container_style; ?>>
        <?php echo '<InnerBlocks />'; ?>
    </div>
</section>
