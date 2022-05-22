<?php

/**
 * Example Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'example-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'example';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$text = get_field('example') ?: 'Your example here...';
$author = get_field('author') ?: 'Author name';
$role = get_field('role') ?: 'Author role';
$image = get_field('image') ?: 295;

?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <blockquote class="example-blockquote">
        <p class="example-text"><strong><?php echo $text; ?></strong></p>
        <p>
            <span class="example-author"><?php echo $author; ?></span>
            <span class="example-role"><?php echo $role; ?></span>
        </p>
    </blockquote>
</div>

<style>
    #<?php echo $id; ?> .example-blockquote {
        background-image: url(<?= wp_get_attachment_image_url( $image, 'full' ); ?>);
    }
</style>