<?php
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<?php get_template_part( 'template-parts/page-hero', null, [
    'label'    => 'Catálogo',
    'title'    => 'Nuestros Juegos',
    'subtitle' => 'Universos construidos con pasión. Cada título es una historia que espera ser vivida.',
] ); ?>

<!-- ═══════════════════════════════════════════════════════════════
     JUEGOS GRID
     ═══════════════════════════════════════════════════════════════ -->
<section class="section section--dark">
    <div class="container">

        <div class="juegos-grid animate-on-scroll">

            <!-- Placeholder game card — duplicar y personalizar desde el admin en futuras iteraciones con CPT -->
            <article class="juego-card">
                <div class="juego-card__cover">
                    <div class="juego-card__cover-placeholder" aria-hidden="true"></div>
                    <div class="juego-card__badges">
                        <span class="badge badge--gold">Nuevo</span>
                        <span class="badge badge--dark">2025</span>
                    </div>
                </div>
                <div class="juego-card__body">
                    <h2 class="juego-card__title">Título del Juego</h2>
                    <p class="juego-card__genre">Acción / Aventura</p>
                    <p class="juego-card__desc">Descripción del juego. Agrega el contenido real editando esta página desde el panel de WordPress.</p>
                    <div class="juego-card__platforms">
                        <span class="juego-card__platform">PC</span>
                        <span class="juego-card__platform">PS5</span>
                        <span class="juego-card__platform">Xbox</span>
                    </div>
                    <a href="#" class="btn btn--primary">Ver Detalles</a>
                </div>
            </article>

            <?php
            // Renderiza el contenido editable de la página si lo hay
            if ( have_posts() ) : while ( have_posts() ) : the_post();
                if ( get_the_content() ) :
                    echo '<div class="page-content-block">';
                    the_content();
                    echo '</div>';
                endif;
            endwhile; endif;
            ?>

        </div>

    </div>
</section>


<!-- ═══════════════════════════════════════════════════════════════
     FEATURES DEL JUEGO
     ═══════════════════════════════════════════════════════════════ -->
<section class="section section--surface">
    <div class="container">
        <header class="section__header animate-on-scroll">
            <span class="section__label">Características</span>
            <h2><span class="gradient-text">¿Qué Nos Hace Únicos?</span></h2>
        </header>

        <div class="features-grid">
            <div class="feature-card animate-on-scroll animate-delay-1">
                <div class="feature-card__icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.4 2.245 4.5 4.5 0 008.4-2.245c0-.399-.078-.78-.22-1.128zm0 0a15.998 15.998 0 003.388-1.62m-5.043-.025a15.994 15.994 0 011.622-3.395m3.42 3.42a15.995 15.995 0 004.764-4.648l3.876-5.814a1.151 1.151 0 00-1.597-1.597L14.146 6.32a15.996 15.996 0 00-4.649 4.763m3.42 3.42a6.776 6.776 0 00-3.42-3.42"/>
                    </svg>
                </div>
                <h3>Arte Visual Único</h3>
                <p>Estética artesanal que define nuestra identidad. Cada escena es una obra de arte.</p>
            </div>
            <div class="feature-card animate-on-scroll animate-delay-2">
                <div class="feature-card__icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 010 12.728M16.463 8.288a5.25 5.25 0 010 7.424M6.75 8.25l4.72-4.72a.75.75 0 011.28.53v15.88a.75.75 0 01-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.01 9.01 0 012.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75z"/>
                    </svg>
                </div>
                <h3>Audio Inmersivo</h3>
                <p>Banda sonora original y diseño de sonido que te sumerge en el mundo del juego.</p>
            </div>
            <div class="feature-card animate-on-scroll animate-delay-3">
                <div class="feature-card__icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6"/>
                    </svg>
                </div>
                <h3>Historia Profunda</h3>
                <p>Narrativas que importan. Personajes memorables con arcos de desarrollo ricos en matices.</p>
            </div>
        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════════════════════════
     PLATAFORMAS
     ═══════════════════════════════════════════════════════════════ -->
<section class="section section--dark">
    <div class="container">
        <header class="section__header animate-on-scroll">
            <span class="section__label">Disponible en</span>
            <h2><span class="gradient-text">Plataformas</span></h2>
        </header>
        <div class="platforms-grid platforms-grid--single animate-on-scroll">
            <div class="platform-card">
                <div class="platform-card__icon">
                    <img src="<?php echo esc_url( wp_upload_dir()['baseurl'] . '/2026/04/steam-icon-logo.webp' ); ?>"
                         alt="Steam" width="40" height="40" style="width:40px;height:40px;object-fit:contain;">
                </div>
                <h4>PC</h4>
                <span>Steam</span>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
