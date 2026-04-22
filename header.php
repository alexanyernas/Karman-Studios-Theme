<?php
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<!-- ========== HEADER ========== -->
<header class="header" id="header">

    <!-- Topbar: teléfono · email · redes sociales (solo desktop) -->
    <?php
    $telefono = karman_opt( 'telefono' );
    $email1   = karman_opt( 'email_1' );
    $socials  = karman_social_links();
    if ( $telefono || $email1 || $socials ) :
    ?>
    <div class="header__topbar">
        <div class="container header__topbar-inner">
            <div class="header__topbar-left">
                <?php if ( $telefono ) : ?>
                    <a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $telefono ) ); ?>" class="header__topbar-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.338c0-.277.02-.551.058-.82C3.156 2.028 7.763.82 9.373 3.17l1.034 1.552a2.25 2.25 0 01-.093 2.634l-.746.995a.75.75 0 00-.08.759c.345.737.83 1.428 1.447 2.045.618.618 1.308 1.102 2.045 1.447a.75.75 0 00.76-.08l.994-.746a2.25 2.25 0 012.634-.094l1.552 1.035c2.348 1.61 1.141 6.217-2.348 7.064a6.27 6.27 0 01-.821.058C8.722 19.5 2.25 13.028 2.25 6.338z"/>
                        </svg>
                        <?php echo esc_html( $telefono ); ?>
                    </a>
                <?php endif; ?>
                <?php if ( $email1 ) : ?>
                    <a href="mailto:<?php echo esc_attr( $email1 ); ?>" class="header__topbar-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                        </svg>
                        <?php echo esc_html( $email1 ); ?>
                    </a>
                <?php endif; ?>
            </div>
            <div class="header__topbar-right">
                <?php foreach ( $socials as $net => $url ) : ?>
                    <a href="<?php echo esc_url( $url ); ?>"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="social-icon social-icon--sm"
                       aria-label="<?php echo esc_attr( ucfirst( $net ) ); ?>">
                        <?php echo karman_social_icon_svg( $net ); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Nav principal -->
    <div class="container header__inner">

        <!-- Logo -->
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header__logo" aria-label="<?php bloginfo( 'name' ); ?>">
            <img src="<?php echo esc_url( KS_IMG ); ?>/2026/04/logo.png"
                 alt="<?php bloginfo( 'name' ); ?>"
                 width="160" height="100">
        </a>

        <!-- Nav links (desktop) -->
        <nav class="nav" aria-label="Navegación principal">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"<?php echo karman_nav_class( 'home' ); ?>>Inicio</a>
            <a href="<?php echo esc_url( home_url( '/juegos/' ) ); ?>"<?php echo karman_nav_class( 'juegos' ); ?>>Juegos</a>
            <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>"<?php echo karman_nav_class( 'noticias' ); ?>>Noticias</a>
            <a href="<?php echo esc_url( home_url( '/galeria/' ) ); ?>"<?php echo karman_nav_class( 'galeria' ); ?>>Galería</a>
            <a href="<?php echo esc_url( home_url( '/equipo/' ) ); ?>"<?php echo karman_nav_class( 'equipo' ); ?>>Equipo</a>
            <a href="<?php echo esc_url( home_url( '/preguntas-frecuentes/' ) ); ?>"<?php echo karman_nav_class( 'preguntas-frecuentes' ); ?>>FAQ</a>
            <a style="color: #000" href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>"
               class="btn btn--primary<?php echo is_page( 'contacto' ) ? ' active' : ''; ?>">
               Contacto
            </a>
        </nav>

        <!-- Hamburger (mobile) — siempre a la derecha via margin-left: auto en CSS -->
        <button class="hamburger" id="hamburger" aria-label="Abrir menú" aria-expanded="false" aria-controls="mobile-nav">
            <span></span>
            <span></span>
            <span></span>
        </button>

    </div><!-- .header__inner -->
</header>

<!-- ========== MOBILE DRAWER ========== -->
<div class="mobile-nav" id="mobile-nav" aria-hidden="true">
    <div class="mobile-nav__overlay" id="mobile-overlay"></div>
    <nav class="mobile-nav__panel" aria-label="Menú móvil">
        <button class="mobile-nav__close" id="mobile-close" aria-label="Cerrar menú">&times;</button>

        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"<?php echo karman_nav_class( 'home' ); ?>>Inicio</a>
        <a href="<?php echo esc_url( home_url( '/juegos/' ) ); ?>"<?php echo karman_nav_class( 'juegos' ); ?>>Juegos</a>
        <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>"<?php echo karman_nav_class( 'noticias' ); ?>>Noticias</a>
        <a href="<?php echo esc_url( home_url( '/galeria/' ) ); ?>"<?php echo karman_nav_class( 'galeria' ); ?>>Galería</a>
        <a href="<?php echo esc_url( home_url( '/equipo/' ) ); ?>"<?php echo karman_nav_class( 'equipo' ); ?>>Equipo</a>
        <a href="<?php echo esc_url( home_url( '/preguntas-frecuentes/' ) ); ?>"<?php echo karman_nav_class( 'preguntas-frecuentes' ); ?>>FAQ</a>
        <a href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>"<?php echo karman_nav_class( 'contacto' ); ?>>Contacto</a>


    </nav>
</div>
