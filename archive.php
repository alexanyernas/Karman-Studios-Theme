<?php
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

if ( is_category() ) {
    $archive_label = 'Categoría';
    $archive_title = single_cat_title( '', false );
} elseif ( is_tag() ) {
    $archive_label = 'Etiqueta';
    $archive_title = single_tag_title( '', false );
} elseif ( is_author() ) {
    $archive_label = 'Autor';
    $archive_title = get_the_author();
} elseif ( is_year() ) {
    $archive_label = 'Archivo';
    $archive_title = get_the_date( 'Y' );
} elseif ( is_month() ) {
    $archive_label = 'Archivo';
    $archive_title = get_the_date( 'F Y' );
} else {
    $archive_label = 'Archivo';
    $archive_title = get_the_archive_title();
}

$archive_desc = get_the_archive_description();
?>

<div class="page-hero">
    <div class="container">
        <span class="page-hero__label"><?php echo esc_html( $archive_label ); ?></span>
        <h1 class="page-hero__title"><?php echo esc_html( $archive_title ); ?></h1>
        <?php if ( $archive_desc ) : ?>
            <p class="page-hero__subtitle"><?php echo wp_kses_post( $archive_desc ); ?></p>
        <?php endif; ?>
        <span class="page-hero__line" aria-hidden="true"></span>
    </div>
</div>

<section class="section section--dark">
    <div class="container">
        <?php if ( have_posts() ) : ?>
        <div class="news-grid">
            <?php
            $accent_colors = [
                'linear-gradient(90deg, var(--color-gold), var(--color-gold-dark))',
                'linear-gradient(90deg, #c084fc, #818cf8)',
                'linear-gradient(90deg, #34d399, #059669)',
                'linear-gradient(90deg, #38bdf8, #0ea5e9)',
                'linear-gradient(90deg, #fb923c, #ef4444)',
                'linear-gradient(90deg, #a78bfa, #8b5cf6)',
            ];
            $i = 0;
            while ( have_posts() ) : the_post();
                $cats     = get_the_category();
                $cat_name = $cats ? esc_html( $cats[0]->name ) : 'General';
                $read_time = karman_reading_time( get_the_ID() );
            ?>
            <article class="news-card animate-on-scroll">
                <div class="news-card__accent" style="background:<?php echo $accent_colors[ $i % count( $accent_colors ) ]; ?>;"></div>
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="news-card__image">
                        <a href="<?php the_permalink(); ?>" tabindex="-1">
                            <?php the_post_thumbnail( 'large', [ 'alt' => get_the_title(), 'loading' => 'lazy' ] ); ?>
                        </a>
                    </div>
                <?php endif; ?>
                <div class="news-card__body">
                    <div class="news-card__meta">
                        <span class="news-card__category"><?php echo $cat_name; ?></span>
                        <span>&bull;</span>
                        <span><?php echo $read_time; ?> min</span>
                        <span>&bull;</span>
                        <time datetime="<?php echo get_the_date( 'Y-m-d' ); ?>"><?php echo get_the_date( 'd M Y' ); ?></time>
                    </div>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p><?php the_excerpt(); ?></p>
                    <a href="<?php the_permalink(); ?>" class="news-card__link">
                        Leer más
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                        </svg>
                    </a>
                </div>
            </article>
            <?php $i++; endwhile; ?>
        </div>

        <nav class="blog-pagination" aria-label="Paginación">
            <?php
            the_posts_pagination( [
                'prev_text' => '&larr; Anterior',
                'next_text' => 'Siguiente &rarr;',
                'mid_size'  => 2,
            ] );
            ?>
        </nav>
        <?php else : ?>
        <p style="text-align:center;color:var(--color-muted);padding:var(--space-20) 0;">No se encontraron entradas.</p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
