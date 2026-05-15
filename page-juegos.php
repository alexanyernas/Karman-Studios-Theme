<?php
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

// ─── Featured game ────────────────────────────────────────────────────────────
$featured = new WP_Query( [
    'post_type'      => 'juego',
    'post_status'    => 'publish',
    'posts_per_page' => 1,
    'meta_query'     => [ [ 'key' => 'juego_destacado', 'value' => '1' ] ],
] );

$estado_labels = [
    'desarrollo'   => 'En Desarrollo',
    'demo'         => 'Demo Disponible',
    'early_access' => 'Acceso Anticipado',
    'lanzado'      => 'Lanzado',
    'proximamente' => 'Próximamente',
];

$feature_icons = [
    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1M4.22 4.22l.707.707M18.364 18.364l.707.707M3 12H4m16 0h1M4.22 19.78l.707-.707M18.364 5.636l.707-.707M15.536 8.464a5 5 0 11-7.072 7.072 5 5 0 017.072-7.072z"/></svg>',
    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 9m0 8V9m0 0L9 7"/></svg>',
    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3"/></svg>',
    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.091z"/></svg>',
    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7a6.046 6.046 0 01-2.7-2.7"/></svg>',
];

if ( $featured->have_posts() ) :
    $featured->the_post();
    $gid         = get_the_ID();
    $logo        = get_field( 'juego_logo',            $gid );
    $hero_bg     = get_field( 'juego_hero_bg',         $gid );
    $hero_video  = get_field( 'juego_hero_video_bg',   $gid );
    $tagline     = get_field( 'juego_tagline',         $gid );
    $genero      = get_field( 'juego_genero',          $gid );
    $estado      = get_field( 'juego_estado',          $gid );
    $fecha       = get_field( 'juego_fecha',           $gid );
    $resumen     = get_field( 'juego_resumen',         $gid );
    $steam       = get_field( 'juego_plataforma_steam',  $gid );
    $ps5         = get_field( 'juego_plataforma_ps5',    $gid );
    $xbox        = get_field( 'juego_plataforma_xbox',   $gid );
    $switch      = get_field( 'juego_plataforma_switch', $gid );
    $steam_url   = get_field( 'juego_steam_url',   $gid );
    $ps5_url     = get_field( 'juego_ps5_url',    $gid );
    $xbox_url    = get_field( 'juego_xbox_url',   $gid );
    $switch_url  = get_field( 'juego_switch_url', $gid );
    $trailer_url = get_field( 'juego_trailer_url', $gid );
    $game_title  = get_the_title();

    // Galería: imágenes individuales
    $galeria = [];
    for ( $n = 1; $n <= 10; $n++ ) {
        $img = get_field( "juego_img_{$n}", $gid );
        if ( $img ) $galeria[] = $img;
    }

    $galeria_videos = [];
    for ( $v = 1; $v <= 4; $v++ ) {
        $url = get_field( "juego_galeria_video_{$v}", $gid );
        if ( $url ) $galeria_videos[] = $url;
    }

    $estado_label = isset( $estado_labels[ $estado ] ) ? $estado_labels[ $estado ] : '';
    // Only apply bg-image inline style when there's no video (video takes over)
    $bg_style = ( ! $hero_video && $hero_bg ) ? 'background-image:url(' . esc_url( $hero_bg['url'] ) . ')' : '';
?>

<!-- ═══════════════════════════════════════════════════════════════
     JUEGO HERO — cinematic full-screen
     ═══════════════════════════════════════════════════════════════ -->
<section class="juego-hero" style="<?php echo $bg_style; ?>" aria-label="<?php echo esc_attr( $game_title ); ?>">

    <?php if ( $hero_video ) : ?>
        <video class="juego-hero__video-bg" autoplay muted loop playsinline preload="auto"
               poster="<?php echo $hero_bg ? esc_url( $hero_bg['url'] ) : ''; ?>">
            <source src="<?php echo esc_url( $hero_video ); ?>"
                    type="<?php echo str_ends_with( $hero_video, '.webm' ) ? 'video/webm' : 'video/mp4'; ?>">
        </video>
    <?php endif; ?>

    <div class="juego-hero__overlay" aria-hidden="true"></div>

    <div class="juego-hero__content">

        <?php if ( $logo ) : ?>
            <div class="juego-hero__logo-wrap">
                <img src="<?php echo esc_url( $logo['url'] ); ?>"
                     alt="<?php echo esc_attr( $game_title ); ?> logo"
                     class="juego-hero__logo"
                     width="<?php echo esc_attr( $logo['width'] ); ?>"
                     height="<?php echo esc_attr( $logo['height'] ); ?>">
            </div>
        <?php else : ?>
            <h1 class="juego-hero__title"><?php echo esc_html( $game_title ); ?></h1>
        <?php endif; ?>

        <?php if ( $tagline ) : ?>
            <p class="juego-hero__tagline"><?php echo esc_html( $tagline ); ?></p>
        <?php endif; ?>

        <div class="juego-hero__meta">
            <?php if ( $genero ) : ?>
                <span class="juego-hero__badge juego-hero__badge--genre"><?php echo esc_html( $genero ); ?></span>
            <?php endif; ?>
            <?php if ( $estado_label ) : ?>
                <span class="juego-hero__badge juego-hero__badge--estado juego-hero__badge--<?php echo esc_attr( $estado ); ?>"><?php echo esc_html( $estado_label ); ?></span>
            <?php endif; ?>
            <?php if ( $fecha ) : ?>
                <span class="juego-hero__badge juego-hero__badge--fecha"><?php echo esc_html( $fecha ); ?></span>
            <?php endif; ?>
        </div>

        <div class="juego-hero__platforms">
            <?php
            $plat_badges = [
                [ 'active' => $steam,  'url' => $steam_url,  'title' => 'PC — Steam',      'label' => 'Steam',  'logo_key' => 'plat_steam_logo'       ],
                [ 'active' => $ps5,    'url' => $ps5_url,    'title' => 'PlayStation 5',   'label' => 'PlayStation',    'logo_key' => 'plat_playstation_logo' ],
                [ 'active' => $xbox,   'url' => $xbox_url,   'title' => 'Xbox',            'label' => 'Xbox',   'logo_key' => 'plat_xbox_logo'        ],
                [ 'active' => $switch, 'url' => $switch_url, 'title' => 'Nintendo Switch', 'label' => 'Nintendo', 'logo_key' => 'plat_nintendo_logo'    ],
            ];
            foreach ( $plat_badges as $p ) :
                if ( ! $p['active'] ) continue;
                $tag      = $p['url'] ? 'a' : 'span';
                $attrs    = $p['url'] ? sprintf( ' href="%s" target="_blank" rel="noopener noreferrer"', esc_url( $p['url'] ) ) : '';
                $logo_img = karman_opt( $p['logo_key'] );
            ?>
                <<?php echo $tag; ?> class="juego-hero__platform" title="<?php echo esc_attr( $p['title'] ); ?>"<?php echo $attrs; ?>>
                    <?php if ( $logo_img ) : ?>
                        <img src="<?php echo esc_url( $logo_img ); ?>" alt="<?php echo esc_attr( $p['title'] ); ?>" style="height:20px;width:auto;object-fit:contain;">
                    <?php endif; ?>
                    <span><?php echo esc_html( $p['label'] ); ?></span>
                </<?php echo $tag; ?>>
            <?php endforeach; ?>
        </div>

        <div class="juego-hero__cta">
            <?php if ( $steam_url ) : ?>
                <a href="<?php echo esc_url( $steam_url ); ?>" class="btn btn--primary" target="_blank" rel="noopener noreferrer">
                    Ver en Steam
                </a>
            <?php endif; ?>
            <?php if ( $trailer_url ) : ?>
                <a href="<?php echo esc_url( $trailer_url ); ?>" class="btn btn--outline juego-hero__trailer-btn" target="_blank" rel="noopener noreferrer">
                    <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18" aria-hidden="true"><path d="M8 5v14l11-7z"/></svg>
                    Ver Tráiler
                </a>
            <?php endif; ?>
        </div>

    </div>

    <div class="juego-hero__scroll-hint" aria-hidden="true">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="24" height="24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
        </svg>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════════
     SINOPSIS
     ═══════════════════════════════════════════════════════════════ -->
<?php if ( $resumen ) : ?>
<section class="section section--dark juego-synopsis">
    <div class="container">
        <div class="juego-synopsis__inner animate-on-scroll">
            <div class="juego-synopsis__label-col">
                <span class="section__label">Acerca del Juego</span>
                <h2 class="juego-synopsis__title"><?php echo esc_html( $game_title ); ?></h2>
                <div class="juego-synopsis__divider"></div>
            </div>
            <div class="juego-synopsis__text-col">
                <p class="juego-synopsis__text"><?php echo nl2br( esc_html( $resumen ) ); ?></p>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ═══════════════════════════════════════════════════════════════
     CARACTERÍSTICAS
     ═══════════════════════════════════════════════════════════════ -->
<?php
$features = [];
for ( $n = 1; $n <= 6; $n++ ) {
    $t = get_field( "juego_feature_{$n}_titulo", $gid );
    $d = get_field( "juego_feature_{$n}_desc",   $gid );
    if ( $t ) $features[] = [ 'titulo' => $t, 'desc' => $d ];
}
if ( $features ) :
?>
<section class="section section--surface juego-features">
    <div class="container">
        <header class="section__header animate-on-scroll">
            <span class="section__label">Mecánicas</span>
            <h2><span class="gradient-text">Características del Juego</span></h2>
        </header>
        <div class="juego-features-grid">
            <?php foreach ( $features as $i => $feat ) : ?>
            <div class="juego-feature-card animate-on-scroll animate-delay-<?php echo ( $i % 3 ) + 1; ?>">
                <div class="juego-feature-card__icon" aria-hidden="true">
                    <?php echo $feature_icons[ $i % count( $feature_icons ) ]; ?>
                </div>
                <h3 class="juego-feature-card__title"><?php echo esc_html( $feat['titulo'] ); ?></h3>
                <?php if ( $feat['desc'] ) : ?>
                    <p class="juego-feature-card__desc"><?php echo esc_html( $feat['desc'] ); ?></p>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ═══════════════════════════════════════════════════════════════
     GALERÍA
     ═══════════════════════════════════════════════════════════════ -->
<?php if ( $galeria || $galeria_videos ) : ?>
<section class="section section--dark juego-galeria-section">
    <div class="container">
        <header class="section__header animate-on-scroll">
            <span class="section__label">Capturas</span>
            <h2><span class="gradient-text">Galería</span></h2>
        </header>
        <div class="juego-galeria-grid animate-on-scroll">

            <?php if ( $galeria ) : ?>
                <?php foreach ( $galeria as $img ) : ?>
                    <div class="juego-galeria-item juego-galeria-item--img"
                         data-src="<?php echo esc_url( $img['url'] ); ?>"
                         tabindex="0"
                         role="button"
                         aria-label="<?php echo esc_attr( $img['alt'] ?: $game_title ); ?>">
                        <img src="<?php echo esc_url( $img['sizes']['large'] ?? $img['url'] ); ?>"
                             alt="<?php echo esc_attr( $img['alt'] ?: $game_title ); ?>"
                             loading="lazy">
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php foreach ( $galeria_videos as $vid_url ) :
                $embed = preg_replace( '/watch\?v=/', 'embed/', $vid_url );
                $embed = preg_replace( '/youtu\.be\//', 'youtube.com/embed/', $embed );
                // Append autoplay=0 to prevent auto-start inside gallery
                $embed = add_query_arg( [ 'rel' => '0' ], $embed );
            ?>
                <div class="juego-galeria-item juego-galeria-item--video">
                    <iframe src="<?php echo esc_url( $embed ); ?>"
                            title="<?php echo esc_attr( $game_title ); ?> — video"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                            loading="lazy">
                    </iframe>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>

<!-- Lightbox -->
<div class="juego-lightbox" id="juego-lightbox" role="dialog" aria-modal="true" aria-label="Imagen ampliada">
    <button class="juego-lightbox__close" id="juego-lightbox-close" aria-label="Cerrar">&times;</button>
    <button class="juego-lightbox__nav juego-lightbox__prev" id="juego-lightbox-prev" aria-label="Anterior">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/></svg>
    </button>
    <div class="juego-lightbox__inner">
        <img src="" alt="" class="juego-lightbox__img" id="juego-lightbox-img">
    </div>
    <button class="juego-lightbox__nav juego-lightbox__next" id="juego-lightbox-next" aria-label="Siguiente">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
    </button>
    <span class="juego-lightbox__counter" id="juego-lightbox-counter"></span>
</div>

<script>
(function () {
    const lb      = document.getElementById('juego-lightbox');
    const lbImg   = document.getElementById('juego-lightbox-img');
    const lbClose = document.getElementById('juego-lightbox-close');
    const lbPrev  = document.getElementById('juego-lightbox-prev');
    const lbNext  = document.getElementById('juego-lightbox-next');
    const lbCount = document.getElementById('juego-lightbox-counter');

    const items = Array.from(document.querySelectorAll('.juego-galeria-item--img'));
    let current = 0;

    function show(index) {
        current = index;
        const el = items[index];
        lbImg.src = el.dataset.src;
        lbImg.alt = el.querySelector('img').alt;
        lbPrev.disabled = index === 0;
        lbNext.disabled = index === items.length - 1;
        lbCount.textContent = (index + 1) + ' / ' + items.length;
        lb.classList.add('is-open');
        document.body.style.overflow = 'hidden';
    }

    items.forEach(function (el, i) {
        el.addEventListener('click', function () { show(i); });
        el.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') show(i);
        });
    });

    lbPrev.addEventListener('click', function () { if (current > 0) show(current - 1); });
    lbNext.addEventListener('click', function () { if (current < items.length - 1) show(current + 1); });

    function closeLb() {
        lb.classList.remove('is-open');
        document.body.style.overflow = '';
        lbImg.src = '';
    }

    lbClose.addEventListener('click', closeLb);
    lb.addEventListener('click', function (e) { if (e.target === lb) closeLb(); });
    document.addEventListener('keydown', function (e) {
        if (!lb.classList.contains('is-open')) return;
        if (e.key === 'Escape')      closeLb();
        if (e.key === 'ArrowLeft')   { if (current > 0) show(current - 1); }
        if (e.key === 'ArrowRight')  { if (current < items.length - 1) show(current + 1); }
    });
})();
</script>
<?php endif; ?>

<!-- ═══════════════════════════════════════════════════════════════
     TRÁILER
     ═══════════════════════════════════════════════════════════════ -->
<?php if ( $trailer_url ) :
    $embed_url = preg_replace( '/watch\?v=/', 'embed/', $trailer_url );
    $embed_url = preg_replace( '/youtu\.be\//', 'youtube.com/embed/', $embed_url );
?>
<section class="section section--surface juego-trailer-section">
    <div class="container">
        <header class="section__header animate-on-scroll">
            <span class="section__label">Tráiler</span>
            <h2><span class="gradient-text">Míralo en Acción</span></h2>
        </header>
        <div class="juego-trailer-wrap animate-on-scroll">
            <iframe
                src="<?php echo esc_url( $embed_url ); ?>"
                title="<?php echo esc_attr( $game_title ); ?> — Tráiler Oficial"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen
                loading="lazy">
            </iframe>
        </div>
    </div>
</section>
<?php endif; ?>

<?php
    wp_reset_postdata();
endif; // end featured game

// ─── Other games ──────────────────────────────────────────────────────────────
$otros = new WP_Query( [
    'post_type'      => 'juego',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'post__not_in'   => isset( $gid ) ? [ $gid ] : [],
] );

if ( $otros->have_posts() ) :
    $hay_destacado = isset( $gid );

    if ( ! $hay_destacado ) :
        get_template_part( 'template-parts/page-hero', null, [
            'label'    => 'Todos Nuestros Títulos',
            'title'    => 'Nuestros Juegos',
            'subtitle' => 'Explora los mundos que estamos construyendo.',
        ] );
    endif;
?>
<!-- ═══════════════════════════════════════════════════════════════
     OTROS JUEGOS
     ═══════════════════════════════════════════════════════════════ -->
<section class="section section--surface juego-otros-section">
    <div class="container">
        <?php if ( $hay_destacado ) : ?>
        <header class="section__header animate-on-scroll">
            <span class="section__label">Catálogo</span>
            <h2><span class="gradient-text">Más Títulos</span></h2>
        </header>
        <?php endif; ?>
        <div class="juego-otros-grid">
        <?php while ( $otros->have_posts() ) : $otros->the_post();
            $oid      = get_the_ID();
            $obg      = get_field( 'juego_hero_bg', $oid );
            $othumbnail = get_the_post_thumbnail_url( $oid, 'large' );
            $obg_url  = $obg['url'] ?? $othumbnail ?? '';
            $obg_style = $obg_url ? 'background-image:url(' . esc_url( $obg_url ) . ')' : '';
        ?>
            <a href="<?php the_permalink(); ?>" class="juego-otros-card animate-on-scroll" style="<?php echo $obg_style; ?>" aria-label="<?php echo esc_attr( get_the_title() ); ?>">
                <div class="juego-otros-card__overlay"></div>
                <div class="juego-otros-card__body">
                    <h3 class="juego-otros-card__title"><?php the_title(); ?></h3>
                    <span class="juego-otros-card__cta">
                        Ver juego
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                    </span>
                </div>
            </a>
        <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>
