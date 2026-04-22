<?php if ( ! defined( 'ABSPATH' ) ) exit;
$telefono = karman_opt( 'telefono' );
$email1   = karman_opt( 'email_1' );
$email2   = karman_opt( 'email_2' );
$socials  = karman_social_links();

$social_labels = [
    'youtube'   => 'YouTube',
    'twitter'   => 'Twitter / X',
    'instagram' => 'Instagram',
    'tiktok'    => 'TikTok',
    'twitch'    => 'Twitch',
    'discord'   => 'Discord',
    'facebook'  => 'Facebook',
];
?>

<!-- ========== FOOTER ========== -->
<footer class="footer">
    <div class="container">
        <div class="footer__grid">

            <!-- Columna 1: Marca -->
            <div class="footer__brand">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer__logo-link" aria-label="<?php bloginfo( 'name' ); ?>">
                    <img src="<?php echo esc_url( KS_IMG ); ?>/2026/04/logo.png"
                         alt="<?php bloginfo( 'name' ); ?>"
                         width="150" height="100">
                </a>
                <p class="footer__tagline">
                    <?php echo esc_html( get_bloginfo( 'description' ) ?: 'Estudio independiente de videojuegos. Forjando mundos, contando historias.' ); ?>
                </p>
                <?php if ( $socials ) : ?>
                <div class="footer__social">
                    <?php foreach ( $socials as $net => $url ) : ?>
                        <a href="<?php echo esc_url( $url ); ?>"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="footer__social-icon"
                           aria-label="<?php echo esc_attr( $social_labels[ $net ] ?? ucfirst( $net ) ); ?>">
                            <?php echo karman_social_icon_svg( $net ); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Columna 2: Páginas -->
            <div class="footer__col">
                <h4 class="footer__heading">Páginas</h4>
                <ul class="footer__links">
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Inicio</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/juegos/' ) ); ?>">Juegos</a></li>
                    <li><a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>">Noticias</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/galeria/' ) ); ?>">Galería</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/equipo/' ) ); ?>">Equipo</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/preguntas-frecuentes/' ) ); ?>">Preguntas Frecuentes</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>">Contacto</a></li>
                </ul>
            </div>

            <!-- Columna 3: Síguenos -->
            <?php if ( $socials ) : ?>
            <div class="footer__col">
                <h4 class="footer__heading">Síguenos</h4>
                <ul class="footer__links">
                    <?php foreach ( $socials as $net => $url ) : ?>
                        <li>
                            <a href="<?php echo esc_url( $url ); ?>"
                               target="_blank"
                               rel="noopener noreferrer">
                                <?php echo esc_html( $social_labels[ $net ] ?? ucfirst( $net ) ); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <!-- Columna 4: Contacto -->
            <div class="footer__col">
                <h4 class="footer__heading">Contacto</h4>

                <?php if ( $telefono ) : ?>
                <div class="footer__contact-item">
                    <span class="footer__contact-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.338c0-.277.02-.551.058-.82C3.156 2.028 7.763.82 9.373 3.17l1.034 1.552a2.25 2.25 0 01-.093 2.634l-.746.995a.75.75 0 00-.08.759c.345.737.83 1.428 1.447 2.045.618.618 1.308 1.102 2.045 1.447a.75.75 0 00.76-.08l.994-.746a2.25 2.25 0 012.634-.094l1.552 1.035c2.348 1.61 1.141 6.217-2.348 7.064a6.27 6.27 0 01-.821.058C8.722 19.5 2.25 13.028 2.25 6.338z"/>
                        </svg>
                    </span>
                    <a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $telefono ) ); ?>">
                        <?php echo esc_html( $telefono ); ?>
                    </a>
                </div>
                <?php endif; ?>

                <?php if ( $email1 ) : ?>
                <div class="footer__contact-item">
                    <span class="footer__contact-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                        </svg>
                    </span>
                    <a href="mailto:<?php echo esc_attr( $email1 ); ?>">
                        <?php echo esc_html( $email1 ); ?>
                    </a>
                </div>
                <?php endif; ?>

                <?php if ( $email2 ) : ?>
                <div class="footer__contact-item">
                    <span class="footer__contact-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                        </svg>
                    </span>
                    <a href="mailto:<?php echo esc_attr( $email2 ); ?>">
                        <?php echo esc_html( $email2 ); ?>
                    </a>
                </div>
                <?php endif; ?>

            </div>

        </div><!-- .footer__grid -->

        <!-- Copyright -->
        <div class="footer__bottom">
            <p>
                &copy; <?php echo date( 'Y' ); ?>
                <span><?php bloginfo( 'name' ); ?></span>.
                Todos los derechos reservados.
            </p>
        </div>

    </div><!-- .container -->
</footer>

<!-- ========== SCROLL TO TOP ========== -->
<button class="scroll-top" id="scrollTop" aria-label="Volver arriba">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5"/>
    </svg>
</button>

<!-- ========== MEDIA MODAL (galería) ========== -->
<div class="ks-modal-overlay" id="ksModal" aria-hidden="true" role="dialog" aria-modal="true" aria-label="Visor de medios">
    <div class="ks-modal">
        <button class="ks-modal__close" id="ksModalClose" aria-label="Cerrar">&times;</button>
        <div class="ks-modal__content" id="ksModalContent"></div>
        <div class="ks-modal__caption" id="ksModalCaption"></div>
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>
