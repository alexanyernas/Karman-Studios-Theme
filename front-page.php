<?php
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<!-- ═══════════════════════════════════════════════════════════════
     HERO
     ═══════════════════════════════════════════════════════════════ -->
<section class="hero" id="inicio">

    <div class="hero__bg">
        <div class="hero__grid"></div>
    </div>

    <div class="hero__content">

        <h1 class="hero__title">
            <?php echo esc_html( get_bloginfo( 'name' ) ); ?>
        </h1>

        <p class="hero__tagline">
            <?php echo esc_html( get_bloginfo( 'description' ) ?: 'Forjando mundos. Contando historias.' ); ?>
        </p>

        <?php
        $cta_text = karman_opt( 'hero_cta_text', 'Explorar Juegos' );
        $cta_url  = karman_opt( 'hero_cta_url', home_url( '/juegos/' ) );
        $news_url = get_permalink( get_option( 'page_for_posts' ) );
        ?>
        <div class="hero__ctas">
            <a href="<?php echo esc_url( $cta_url ); ?>" class="btn btn--primary btn--lg">
                <?php echo esc_html( $cta_text ); ?>
            </a>
            <a href="<?php echo esc_url( $news_url ); ?>" class="btn btn--outline btn--lg">
                Ver Noticias
            </a>
        </div>

        <?php
        $plat_hero_labels = [
            'plat_steam'       => 'PC &mdash; Steam',
            'plat_xbox'        => 'Xbox',
            'plat_playstation' => 'PlayStation',
            'plat_nintendo'    => 'Nintendo Switch',
        ];
        $active_hero_plats = array_filter( $plat_hero_labels, fn( $k ) => karman_opt( $k ) === '1', ARRAY_FILTER_USE_KEY );
        ?>
        <?php if ( $active_hero_plats ) : ?>
        <div class="hero__platforms">
            <?php foreach ( $active_hero_plats as $label ) : ?>
                <span class="hero__platform"><?php echo $label; ?></span>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>

    <div class="hero__scroll-cue" aria-hidden="true">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
        </svg>
    </div>

</section>


<!-- ═══════════════════════════════════════════════════════════════
     FEATURES
     ═══════════════════════════════════════════════════════════════ -->
<section class="section section--surface" id="features">
    <div class="container">
        <header class="section__header animate-on-scroll">
            <span class="section__label">Nuestro ADN</span>
            <h2><span class="gradient-text">Lo Que Nos Define</span></h2>
            <p>Creamos experiencias que trascienden la pantalla, con pasión, técnica y una historia que contar.</p>
        </header>

        <div class="features-grid">

            <div class="feature-card animate-on-scroll animate-delay-1">
                <div class="feature-card__icon">
                    <!-- World icon -->
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"/>
                    </svg>
                </div>
                <h3>Mundos Expansivos</h3>
                <p>Diseñamos universos ricos en detalle, donde cada rincón esconde una historia y cada decisión importa.</p>
            </div>

            <div class="feature-card animate-on-scroll animate-delay-2">
                <div class="feature-card__icon">
                    <!-- Code icon -->
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75L22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3l-4.5 16.5"/>
                    </svg>
                </div>
                <h3>Tecnología Artesanal</h3>
                <p>Código y arte trabajando en armonía. Optimizamos cada frame para que la experiencia sea fluida y memorable.</p>
            </div>

            <div class="feature-card animate-on-scroll animate-delay-3">
                <div class="feature-card__icon">
                    <!-- Users icon -->
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
                    </svg>
                </div>
                <h3>Comunidad Primero</h3>
                <p>Escuchamos a nuestra comunidad. Sus ideas, reportes y pasión son el motor que impulsa cada actualización.</p>
            </div>

        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════════════════════════
     GALERÍA PREVIEW
     ═══════════════════════════════════════════════════════════════ -->
<?php
$gallery_query = new WP_Query( [
    'post_type'      => 'galeria-item',
    'posts_per_page' => 6,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
    'meta_query'     => [
        [
            'key'     => 'destacado',
            'value'   => '1',
            'compare' => '=',
        ],
    ],
] );
// Fallback: si no hay items destacados, mostramos los últimos 6
if ( ! $gallery_query->have_posts() ) {
    $gallery_query = new WP_Query( [
        'post_type'      => 'galeria-item',
        'posts_per_page' => 6,
        'post_status'    => 'publish',
    ] );
}
?>

<?php if ( $gallery_query->have_posts() ) : ?>
<section class="section section--surface" id="galeria-preview">
    <div class="container">
        <header class="section__header animate-on-scroll">
            <span class="section__label">Arte & Capturas</span>
            <h2><span class="gradient-text">Galería</span></h2>
            <p>Un vistazo a los mundos que estamos construyendo.</p>
        </header>

        <div class="gallery-grid animate-on-scroll">
            <?php while ( $gallery_query->have_posts() ) : $gallery_query->the_post();
                $tipo     = get_field( 'tipo' ) ?: 'imagen';
                $img_data = get_field( 'archivo_imagen' );
                $img_url  = $img_data['url'] ?? get_the_post_thumbnail_url( get_the_ID(), 'large' );
                $video_url = get_field( 'url_video' );
                $descripcion = get_field( 'descripcion_item' );
                $thumb    = ( $tipo === 'video' && $video_url ) ? karman_get_video_thumbnail( $video_url ) : $img_url;
                $embed    = ( $tipo === 'video' && $video_url ) ? karman_get_video_embed( $video_url ) : '';
            ?>
                <div class="gallery-card <?php echo $tipo === 'video' ? 'gallery-card--video' : ''; ?>"
                     data-type="<?php echo esc_attr( $tipo ); ?>"
                     data-src="<?php echo $tipo === 'video' ? esc_attr( $embed ) : esc_attr( $img_url ); ?>"
                     data-caption="<?php echo esc_attr( get_the_title() . ( $descripcion ? ' — ' . $descripcion : '' ) ); ?>"
                     role="button"
                     tabindex="0"
                     aria-label="<?php echo esc_attr( 'Ver ' . get_the_title() ); ?>">
                    <?php if ( $thumb ) : ?>
                        <img src="<?php echo esc_url( $thumb ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" loading="lazy">
                    <?php endif; ?>
                    <div class="gallery-card__overlay">
                        <div class="gallery-card__info">
                            <span><?php echo $tipo === 'video' ? 'Video' : 'Imagen'; ?></span>
                            <h4><?php the_title(); ?></h4>
                        </div>
                    </div>
                </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>

        <div style="text-align:center; margin-top:var(--space-12);">
            <a href="<?php echo esc_url( home_url( '/galeria/' ) ); ?>" class="btn btn--outline">
                Ver Galería Completa
            </a>
        </div>
    </div>
</section>
<?php endif; ?>


<!-- ═══════════════════════════════════════════════════════════════
     NOTICIAS PREVIEW
     ═══════════════════════════════════════════════════════════════ -->
<?php
$news_query = new WP_Query( [
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
] );
?>

<?php if ( $news_query->have_posts() ) : ?>
<section class="section section--dark" id="noticias-preview">
    <div class="container">
        <header class="section__header animate-on-scroll">
            <span class="section__label">Actualizaciones</span>
            <h2><span class="gradient-text">Últimas Noticias</span></h2>
            <p>Mantente al día con el desarrollo, anuncios y detrás de cámaras del estudio.</p>
        </header>

        <div class="news-grid">
            <?php
            $accent_colors = [
                'linear-gradient(90deg, var(--color-gold), var(--color-gold-dark))',
                'linear-gradient(90deg, #c084fc, #818cf8)',
                'linear-gradient(90deg, #34d399, #059669)',
            ];
            $i = 0;
            while ( $news_query->have_posts() ) : $news_query->the_post();
                $cats = get_the_category();
                $cat_name = $cats ? esc_html( $cats[0]->name ) : 'General';
                $read_time = karman_reading_time( get_the_ID() );
            ?>
                <article class="news-card animate-on-scroll animate-delay-<?php echo $i + 1; ?>">
                    <div class="news-card__accent" style="background:<?php echo $accent_colors[ $i % 3 ]; ?>;"></div>
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
                            <span><?php echo $read_time; ?> min de lectura</span>
                            <span>&bull;</span>
                            <span><?php echo get_the_date( 'd M Y' ); ?></span>
                        </div>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <p><?php the_excerpt(); ?></p>
                        <a href="<?php the_permalink(); ?>" class="news-card__link">
                            Leer más
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                            </svg>
                        </a>
                    </div>
                </article>
            <?php $i++; endwhile; wp_reset_postdata(); ?>
        </div>

        <div style="text-align:center; margin-top:var(--space-12);">
            <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="btn btn--outline">
                Ver Todas las Noticias
            </a>
        </div>
    </div>
</section>
<?php endif; ?>


<!-- ═══════════════════════════════════════════════════════════════
     PLATAFORMAS
     ═══════════════════════════════════════════════════════════════ -->
<?php
$plat_cards = [
    'plat_steam'       => [ 'title' => 'PC',          'sub' => 'Steam'      ],
    'plat_xbox'        => [ 'title' => 'Xbox',         'sub' => 'Series X|S' ],
    'plat_playstation' => [ 'title' => 'PlayStation',  'sub' => 'PS5'        ],
    'plat_nintendo'    => [ 'title' => 'Nintendo',     'sub' => 'Switch'     ],
];
$active_plat_cards = array_filter( $plat_cards, fn( $k ) => karman_opt( $k ) === '1', ARRAY_FILTER_USE_KEY );
?>
<?php if ( $active_plat_cards ) : ?>
<section class="section section--surface" id="plataformas">
    <div class="container">
        <header class="section__header animate-on-scroll">
            <span class="section__label">Disponibilidad</span>
            <h2><span class="gradient-text">Plataformas</span></h2>
        </header>

        <div class="platforms-grid <?php echo count( $active_plat_cards ) === 1 ? 'platforms-grid--single' : ''; ?> animate-on-scroll">
            <?php foreach ( $active_plat_cards as $key => $plat ) :
                $logo = karman_opt( $key . '_logo' );
            ?>
            <div class="platform-card">
                <?php if ( $logo ) : ?>
                <div class="platform-card__icon">
                    <img src="<?php echo esc_url( $logo ); ?>"
                         alt="<?php echo esc_attr( $plat['title'] ); ?>"
                         style="max-height:40px;max-width:80px;object-fit:contain;">
                </div>
                <?php endif; ?>
                <h4><?php echo esc_html( $plat['title'] ); ?></h4>
                <span><?php echo esc_html( $plat['sub'] ); ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>


<!-- ═══════════════════════════════════════════════════════════════
     FAQ PREVIEW
     ═══════════════════════════════════════════════════════════════ -->
<?php
$faq_query = new WP_Query( [
    'post_type'      => 'pregunta-faq',
    'posts_per_page' => 4,
    'post_status'    => 'publish',
    'orderby'        => [ 'meta_value_num' => 'ASC', 'date' => 'ASC' ],
    'meta_key'       => 'orden',
] );
?>

<?php if ( $faq_query->have_posts() ) : ?>
<section class="section section--dark" id="faq-preview">
    <div class="container">
        <header class="section__header animate-on-scroll">
            <span class="section__label">FAQ</span>
            <h2><span class="gradient-text">Preguntas Frecuentes</span></h2>
        </header>

        <div class="faq-list animate-on-scroll">
            <?php while ( $faq_query->have_posts() ) : $faq_query->the_post(); ?>
                <div class="accordion-item">
                    <button class="accordion-item__trigger" aria-expanded="false">
                        <?php the_title(); ?>
                        <span class="accordion-item__icon" aria-hidden="true">+</span>
                    </button>
                    <div class="accordion-item__content" aria-hidden="true">
                        <div class="accordion-item__body">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>

        <div style="text-align:center; margin-top:var(--space-10);">
            <a href="<?php echo esc_url( home_url( '/preguntas-frecuentes/' ) ); ?>" class="btn btn--ghost">
                Ver todas las preguntas
            </a>
        </div>
    </div>
</section>
<?php endif; ?>


<!-- ═══════════════════════════════════════════════════════════════
     CTA / COMUNIDAD
     ═══════════════════════════════════════════════════════════════ -->
<section class="cta-band" id="comunidad">
    <div class="container">
        <div class="animate-on-scroll">
            <h2 class="cta-band__title">
                Únete a la <span class="gradient-text">Comunidad</span>
            </h2>
            <p class="cta-band__subtitle">
                Síguenos en nuestras redes para estar al día con el desarrollo, anuncios exclusivos y contenido detrás de cámaras.
            </p>

            <?php
            $community_socials = karman_social_links();
            $community_labels  = [
                'youtube'   => 'YouTube',
                'twitter'   => 'Twitter / X',
                'instagram' => 'Instagram',
                'tiktok'    => 'TikTok',
                'twitch'    => 'Twitch',
                'discord'   => 'Discord',
                'facebook'  => 'Facebook',
            ];
            if ( $community_socials ) : ?>
            <div class="community-socials">
                <?php foreach ( $community_socials as $net => $url ) : ?>
                    <a href="<?php echo esc_url( $url ); ?>"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="community-social__item"
                       aria-label="<?php echo esc_attr( $community_labels[ $net ] ?? ucfirst( $net ) ); ?>">
                        <span class="community-social__icon">
                            <?php echo karman_social_icon_svg( $net ); ?>
                        </span>
                    </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
