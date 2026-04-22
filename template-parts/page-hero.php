<?php
/**
 * Reusable page hero.
 *
 * Variables (set before get_template_part):
 *   $args['label']    — small label above the title
 *   $args['title']    — main h1 text
 *   $args['subtitle'] — optional subtitle paragraph
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$label    = $args['label']    ?? '';
$title    = $args['title']    ?? get_the_title();
$subtitle = $args['subtitle'] ?? '';
?>
<div class="page-hero">
    <div class="container">
        <?php if ( $label ) : ?>
            <span class="page-hero__label"><?php echo esc_html( $label ); ?></span>
        <?php endif; ?>
        <h1 class="page-hero__title"><?php echo esc_html( $title ); ?></h1>
        <?php if ( $subtitle ) : ?>
            <p class="page-hero__subtitle"><?php echo esc_html( $subtitle ); ?></p>
        <?php endif; ?>
        <span class="page-hero__line" aria-hidden="true"></span>
    </div>
</div>
