<?php
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<!-- Page Hero -->
<div class="page-hero">
    <div class="container">
        <span class="page-hero__label">Actualizaciones</span>
        <h1 class="page-hero__title">Noticias</h1>
        <p class="page-hero__subtitle">Actualizaciones, anuncios y detrás de cámaras del estudio.</p>
        <span class="page-hero__line" aria-hidden="true"></span>
    </div>
</div>

<section class="section section--dark">
    <div class="container">

        <!-- Category filters -->
        <?php
        $categories = get_categories( [ 'hide_empty' => true ] );
        if ( $categories ) :
        ?>
        <div class="filter-bar" id="blogFilters">
            <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>"
               class="filter-btn <?php echo ! is_category() ? 'active' : ''; ?>">
                Todos
            </a>
            <?php foreach ( $categories as $cat ) : ?>
                <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>"
                   class="filter-btn <?php echo is_category( $cat->term_id ) ? 'active' : ''; ?>">
                    <?php echo esc_html( $cat->name ); ?>
                </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Posts grid -->
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
                $cats = get_the_category();
                $cat_name  = $cats ? esc_html( $cats[0]->name ) : 'General';
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
                        <a href="<?php the_permalink(); ?>" class="news-card__link" aria-label="Leer <?php the_title_attribute(); ?>">
                            Leer más
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                            </svg>
                        </a>
                    </div>
                </article>
            <?php $i++; endwhile; ?>
        </div>

        <!-- Pagination -->
        <nav class="blog-pagination" aria-label="Paginación del blog">
            <?php
            the_posts_pagination( [
                'prev_text' => '&larr; Anterior',
                'next_text' => 'Siguiente &rarr;',
                'mid_size'  => 2,
            ] );
            ?>
        </nav>

        <?php else : ?>
        <div style="text-align:center; padding:var(--space-20) 0; color:var(--color-muted);">
            <p>Aún no hay publicaciones. Vuelve pronto.</p>
        </div>
        <?php endif; ?>

    </div>
</section>

<?php get_footer(); ?>
