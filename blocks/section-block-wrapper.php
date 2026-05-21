<?php
/**
 * Section wrapper with Automatic Text Contrast
 */
global $bith_block_order;

if ( ! isset( $bith_block_order ) ) {
    $bith_block_order = 0;
    $is_first_block = true;
} else {
    $bith_block_order++;
    $is_first_block = false;
}
   
$id = !empty($block['anchor']) ? $block['anchor'] : 'section-' . $block['id'];
$class_name = 'section-block-wrapper content-section';
$containerClassName = '';

// Standard Block Classes
if (!empty($block['className'])) { $class_name .= ' ' . $block['className']; }
if (!empty($block['align'])) { $class_name .= ' align' . $block['align']; }

// Background & Gradient Classes
if (!empty($block['backgroundColor'])) {
    $class_name .= ' has-' . $block['backgroundColor'] . '-background-color';
}
if (!empty($block['gradient'])) {
    $class_name .= ' has-' . $block['gradient'] . '-gradient-background';
}

// Automatic Text Color Logic
$bg_color = $block['backgroundColor'] ?? '';
$gradient = $block['gradient'] ?? '';

// Define "Dark" backgrounds that should use White text
$dark_backgrounds = ['bith-onyx', 'bith-slate', 'bith-blue-100', 'bith-green-100', 'bith-blue'];

if ( in_array($bg_color, $dark_backgrounds) || in_array($gradient, $dark_backgrounds) ) {
    $class_name .= ' has-bith-white-color';
} else {
    $class_name .= ' has-bith-onyx-color';
}

// ACF Padding Classes
if (get_field('remove_top_padding')) { $class_name .= ' no-top-padding'; }
if (get_field('remove_bottom_padding')) { $class_name .= ' no-bottom-padding'; }
if (get_field('extra_top_padding_40px')) { $containerClassName .= ' extra-top-padding_40px'; }
if (get_field('extra_bottom_padding_40px')) { $containerClassName .= ' extra-bottom-padding_40px'; }

$horizontal_alignment = get_field('horizontal_alignment') ?? null;;
$content_width = get_field('content_width');
$content_width_class = '12-12';
$content_width = get_field('content_width');
$content_width_class = ' small-12';

$bp = get_field('content_width_breakpoint') ?: 'small';

// Determine if we need the small-12 prefix
$prefix = ($bp === 'small') ? '' : ' small-12';

switch ($content_width) {
    case '11-12': $content_width_class = "{$prefix} {$bp}-11 align-center"; break;
    case '10-12': $content_width_class = "{$prefix} {$bp}-10 align-center"; break;
    case '9-12':  $content_width_class = "{$prefix} {$bp}-9 align-center";  break;
    case '8-12':  $content_width_class = "{$prefix} {$bp}-8 align-center";  break;
    case '7-12':  $content_width_class = "{$prefix} {$bp}-7 align-center";  break;
    case '6-12':  $content_width_class = "{$prefix} {$bp}-6 align-center";  break;
    case '5-12':  $content_width_class = "{$prefix} {$bp}-5 align-center";  break;
    case '4-12':  $content_width_class = "{$prefix} {$bp}-4 align-center";  break;
    case '3-12':  $content_width_class = "{$prefix} {$bp}-3 align-center";  break;
    case '2-12':  $content_width_class = "{$prefix} {$bp}-2 align-center";  break;
    case '1-12':  $content_width_class = "{$prefix} {$bp}-1 align-center";  break;
    case '12-12': 
    default:      $content_width_class = ' small-12'; break;
}


?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($class_name); ?>">
    <?php if ( $is_first_block ): ?>
        <div class="header-spacer"></div>
    <?php endif; ?>
    <div class="grid-container<?=$containerClassName;?>">
        <div class="grid-x grid-padding-x <?=esc_attr($horizontal_alignment);?>">
            <div class="cell<?=esc_attr( $content_width_class );?>">
                <?php echo '<InnerBlocks />'; ?>
            </div>
        </div>
    </div>
</section>
