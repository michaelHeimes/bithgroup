<?php
/**
 * Section wrapper with Automatic Text Contrast
 */
$id = !empty($block['anchor']) ? $block['anchor'] : 'section-' . $block['id'];
$className = 'section-block-wrapper content-section';
$containerClassName = '';

// Standard Block Classes
if (!empty($block['className'])) { $className .= ' ' . $block['className']; }
if (!empty($block['align'])) { $className .= ' align' . $block['align']; }

// Background & Gradient Classes
if (!empty($block['backgroundColor'])) {
    $className .= ' has-' . $block['backgroundColor'] . '-background-color';
}
if (!empty($block['gradient'])) {
    $className .= ' has-' . $block['gradient'] . '-gradient-background';
}

// Automatic Text Color Logic
$bg_color = $block['backgroundColor'] ?? '';
$gradient = $block['gradient'] ?? '';

// Define "Dark" backgrounds that should use White text
$dark_backgrounds = ['bith-onyx', 'bith-slate', 'bith-blue-100', 'bith-green-100', 'bith-blue'];

if ( in_array($bg_color, $dark_backgrounds) || in_array($gradient, $dark_backgrounds) ) {
    $className .= ' has-bith-white-color';
} else {
    $className .= ' has-bith-onyx-color';
}

// ACF Padding Classes
if (get_field('remove_top_padding')) { $className .= ' no-top-padding'; }
if (get_field('remove_bottom_padding')) { $className .= ' no-bottom-padding'; }
if (get_field('extra_top_padding_40px')) { $containerClassName .= ' extra-top-padding_40px'; }
if (get_field('extra_bottom_padding_40px')) { $containerClassName .= ' extra-bottom-padding_40px'; }

// Container Style
$content_maxwidth = get_field('content_maxwidth');
$container_style = !empty($content_maxwidth) ? ' style="max-width: ' . esc_attr($content_maxwidth) . 'px;"' : '';
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="grid-container<?=$containerClassName;?>"<?php echo $container_style; ?>>
        <?php echo '<InnerBlocks />'; ?>
    </div>
</section>
