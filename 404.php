<?php
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<main class="page-404">
    <div class="container">
        <div class="page-404__inner animate-on-scroll">
            <p class="page-404__code">404</p>
            <h1 class="page-404__title">Página no encontrada</h1>
            <p class="page-404__text">La página que buscas no existe o fue movida. Vuelve al inicio y sigue explorando.</p>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary">
                Volver al Inicio
            </a>
        </div>
    </div>
</main>

<?php get_footer(); ?>
