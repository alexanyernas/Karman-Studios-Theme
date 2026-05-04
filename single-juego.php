<?php
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

if ( ! have_posts() ) { get_footer(); exit; }
the_post();

$gid   = get_the_ID();
$game_title = get_the_title();

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
$switch_plat = get_field( 'juego_plataforma_switch', $gid );
$steam_url   = get_field( 'juego_steam_url',       $gid );
$trailer_url = get_field( 'juego_trailer_url',     $gid );

$estado_labels = [
    'desarrollo'   => 'En Desarrollo',
    'demo'         => 'Demo Disponible',
    'early_access' => 'Acceso Anticipado',
    'lanzado'      => 'Lanzado',
    'proximamente' => 'Próximamente',
];
$estado_label = isset( $estado_labels[ $estado ] ) ? $estado_labels[ $estado ] : '';

$features = [];
for ( $n = 1; $n <= 6; $n++ ) {
    $t = get_field( "juego_feature_{$n}_titulo", $gid );
    $d = get_field( "juego_feature_{$n}_desc",   $gid );
    if ( $t ) $features[] = [ 'titulo' => $t, 'desc' => $d ];
}

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

$bg_style = ( ! $hero_video && $hero_bg ) ? 'background-image:url(' . esc_url( $hero_bg['url'] ) . ')' : '';

$feature_icons = [
    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1M4.22 4.22l.707.707M18.364 18.364l.707.707M3 12H4m16 0h1M4.22 19.78l.707-.707M18.364 5.636l.707-.707M15.536 8.464a5 5 0 11-7.072 7.072 5 5 0 017.072-7.072z"/></svg>',
    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 9m0 8V9m0 0L9 7"/></svg>',
    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3"/></svg>',
    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.091z"/></svg>',
    '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7a6.046 6.046 0 01-2.7-2.7"/></svg>',
];
?>

<!-- ═══════════════════════════════════════════════════════════════
     HERO
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
            <?php if ( $steam ) : ?>
                <span class="juego-hero__platform" title="PC — Steam">
                    <svg viewBox="0 0 24 24" fill="currentColor" aria-label="Steam"><path d="M11.979 0C5.678 0 .511 4.86.022 11.037l6.432 2.658c.545-.371 1.203-.59 1.912-.59.063 0 .125.004.188.006l2.861-4.142V8.91c0-2.495 2.028-4.524 4.524-4.524 2.494 0 4.524 2.031 4.524 4.527s-2.03 4.525-4.524 4.525h-.105l-4.076 2.911c0 .052.004.105.004.159 0 1.875-1.515 3.396-3.39 3.396-1.635 0-3.016-1.173-3.331-2.727L.436 15.27C1.862 20.307 6.486 24 11.979 24c6.627 0 11.999-5.373 11.999-12S18.606 0 11.979 0zM7.54 18.21l-1.473-.61c.262.543.714.999 1.314 1.25 1.297.539 2.793-.076 3.332-1.375.263-.63.264-1.319.005-1.949s-.75-1.121-1.377-1.383c-.624-.26-1.29-.249-1.878-.03l1.523.63c.956.4 1.409 1.5 1.009 2.455-.397.957-1.497 1.41-2.455 1.012H7.54zm11.415-9.303c0-1.662-1.353-3.015-3.015-3.015-1.665 0-3.015 1.353-3.015 3.015 0 1.665 1.35 3.015 3.015 3.015 1.663 0 3.015-1.35 3.015-3.015zm-5.273-.005c0-1.252 1.013-2.266 2.265-2.266 1.249 0 2.266 1.014 2.266 2.266 0 1.251-1.017 2.265-2.266 2.265-1.252 0-2.265-1.014-2.265-2.265z"/></svg>
                    <span>Steam</span>
                </span>
            <?php endif; ?>
            <?php if ( $ps5 ) : ?>
                <span class="juego-hero__platform" title="PlayStation 5">
                    <svg viewBox="0 0 24 24" fill="currentColor" aria-label="PlayStation"><path d="M8.984 2.596v14.347l3.274 1.01V5.66s2.757-.485 3.494 1.426c.868 2.28-1.177 3.44-1.177 3.44s3.527.68 5.156-2.507c1.23-2.38-.05-5.423-5.01-5.423-2.044 0-5.737 0-5.737 0zm-2.667 15.24L2 16.168v2.09l4.317 1.545v-2.04-.927zm0 2.967v-.927L2 18.258v2.09l4.317-1.545zm10.667-5.42s-1.258.448-2.41.69v1.847s2.397-.534 3.87-1.603c1.475-1.07 1.655-2.783.003-3.44-1.653-.657-3.79-.1-3.79-.1v1.716s1.37-.433 2.327.065c.956.499.001 1.34.001 1.34l-.001-.515z"/></svg>
                    <span>PS5</span>
                </span>
            <?php endif; ?>
            <?php if ( $xbox ) : ?>
                <span class="juego-hero__platform" title="Xbox">
                    <svg viewBox="0 0 24 24" fill="currentColor" aria-label="Xbox"><path d="M4.102 4.102C4.102 4.102 6.54 1.5 12 1.5s7.898 2.602 7.898 2.602S17.04 0 12 0 4.102 4.102 4.102 4.102zM5.906 5.58C3.76 7.163 2.082 9.43 1.246 12.07c-.042.135-.042.274-.042.413 0 .862.21 1.677.581 2.393C2.617 16.32 4.89 24 12 24s9.383-7.68 10.215-9.124c.37-.716.581-1.531.581-2.393 0-.139 0-.278-.042-.413-.836-2.64-2.514-4.907-4.66-6.49-.672-.5-1.376-.926-2.124-1.266C14.64 5.4 13.374 5.1 12 5.1c-1.374 0-2.64.3-3.97.814-.748.34-1.452.766-2.124 1.266z"/></svg>
                    <span>Xbox</span>
                </span>
            <?php endif; ?>
            <?php if ( $switch_plat ) : ?>
                <span class="juego-hero__platform" title="Nintendo Switch">
                    <svg viewBox="0 0 24 24" fill="currentColor" aria-label="Nintendo Switch"><path d="M14.176 24h3.674A6.15 6.15 0 0024 17.85V6.15A6.15 6.15 0 0017.85 0H14.176v24zM18 6.75a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM6.15 0A6.15 6.15 0 000 6.15v11.7A6.15 6.15 0 006.15 24h5.326V0H6.15zm.6 16.5a1.5 1.5 0 110-3 1.5 1.5 0 010 3z"/></svg>
                    <span>Switch</span>
                </span>
            <?php endif; ?>
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
            <a href="<?php echo esc_url( home_url( '/juegos/' ) ); ?>" class="btn btn--ghost juego-single__back">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
                </svg>
                Todos los juegos
            </a>
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
<?php if ( $features ) : ?>
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

            <?php foreach ( $galeria_videos as $vid_url ) :
                $embed = preg_replace( '/watch\?v=/', 'embed/', $vid_url );
                $embed = preg_replace( '/youtu\.be\//', 'youtube.com/embed/', $embed );
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

<!-- ═══════════════════════════════════════════════════════════════
     BACK / OTROS JUEGOS
     ═══════════════════════════════════════════════════════════════ -->
<?php
$otros = new WP_Query( [
    'post_type'      => 'juego',
    'posts_per_page' => 3,
    'post__not_in'   => [ $gid ],
    'orderby'        => 'rand',
] );

if ( $otros->have_posts() ) :
?>
<section class="section section--dark juego-otros-section">
    <div class="container">
        <header class="section__header animate-on-scroll">
            <span class="section__label">Más títulos</span>
            <h2><span class="gradient-text">Otros Juegos</span></h2>
        </header>
        <div class="juego-otros-grid">
        <?php
        $estado_labels_local = [
            'desarrollo'   => 'En Desarrollo',
            'demo'         => 'Demo Disponible',
            'early_access' => 'Acceso Anticipado',
            'lanzado'      => 'Lanzado',
            'proximamente' => 'Próximamente',
        ];
        while ( $otros->have_posts() ) : $otros->the_post();
            $oid    = get_the_ID();
            $obg    = get_field( 'juego_hero_bg', $oid );
            $ologo  = get_field( 'juego_logo',    $oid );
            $oestado = get_field( 'juego_estado', $oid );
            $ogenero = get_field( 'juego_genero', $oid );
            $oestado_label = isset( $estado_labels_local[ $oestado ] ) ? $estado_labels_local[ $oestado ] : '';
            $obg_style = $obg ? 'background-image:url(' . esc_url( $obg['url'] ) . ')' : '';
        ?>
            <a href="<?php the_permalink(); ?>" class="juego-otros-card animate-on-scroll" style="<?php echo $obg_style; ?>" aria-label="<?php echo esc_attr( get_the_title() ); ?>">
                <div class="juego-otros-card__overlay"></div>
                <div class="juego-otros-card__body">
                    <?php if ( $ologo ) : ?>
                        <img src="<?php echo esc_url( $ologo['url'] ); ?>"
                             alt="<?php echo esc_attr( get_the_title() ); ?>"
                             class="juego-otros-card__logo">
                    <?php else : ?>
                        <h3 class="juego-otros-card__title"><?php the_title(); ?></h3>
                    <?php endif; ?>
                    <div class="juego-otros-card__meta">
                        <?php if ( $ogenero ) : ?>
                            <span class="juego-hero__badge juego-hero__badge--genre"><?php echo esc_html( $ogenero ); ?></span>
                        <?php endif; ?>
                        <?php if ( $oestado_label ) : ?>
                            <span class="juego-hero__badge juego-hero__badge--estado juego-hero__badge--<?php echo esc_attr( $oestado ); ?>"><?php echo esc_html( $oestado_label ); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </a>
        <?php endwhile; wp_reset_postdata(); ?>
        </div>

        <div style="text-align:center;margin-top:var(--space-10);">
            <a href="<?php echo esc_url( home_url( '/juegos/' ) ); ?>" class="btn btn--outline">
                Ver todos los juegos
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>
