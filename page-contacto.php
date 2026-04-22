<?php
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<?php get_template_part( 'template-parts/page-hero', null, [
    'label'    => 'Hablemos',
    'title'    => 'Contacto',
    'subtitle' => 'Tienes preguntas, propuestas o quieres colaborar con nosotros. Escríbenos.',
] ); ?>

<section class="section section--dark">
    <div class="container">
        <div class="contact-grid">

            <!-- Formulario WPForms -->
            <div class="animate-on-scroll">
                <h2 style="font-size:var(--text-2xl); margin-bottom:var(--space-8); color:var(--color-fg);">Envíanos un mensaje</h2>
                <?php echo do_shortcode('[wpforms id="29"]'); ?>
            </div>

            <!-- Info de contacto -->
            <aside class="contact-info animate-on-scroll animate-delay-2">

                <h3 style="font-size:var(--text-xl); margin-bottom:var(--space-8); color:var(--color-fg);">Información de Contacto</h3>

                <?php if ( $telefono = karman_opt( 'telefono' ) ) : ?>
                <div class="contact-info__item">
                    <div class="contact-info__icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.338c0-.277.02-.551.058-.82C3.156 2.028 7.763.82 9.373 3.17l1.034 1.552a2.25 2.25 0 01-.093 2.634l-.746.995a.75.75 0 00-.08.759c.345.737.83 1.428 1.447 2.045.618.618 1.308 1.102 2.045 1.447a.75.75 0 00.76-.08l.994-.746a2.25 2.25 0 012.634-.094l1.552 1.035c2.348 1.61 1.141 6.217-2.348 7.064a6.27 6.27 0 01-.821.058C8.722 19.5 2.25 13.028 2.25 6.338z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="contact-info__label">Teléfono</p>
                        <a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $telefono ) ); ?>" class="contact-info__value">
                            <?php echo esc_html( $telefono ); ?>
                        </a>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ( $email1 = karman_opt( 'email_1' ) ) : ?>
                <div class="contact-info__item">
                    <div class="contact-info__icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                        </svg>
                    </div>
                    <div>
                        <p class="contact-info__label">Correo principal</p>
                        <a href="mailto:<?php echo esc_attr( $email1 ); ?>" class="contact-info__value">
                            <?php echo esc_html( $email1 ); ?>
                        </a>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ( $email2 = karman_opt( 'email_2' ) ) : ?>
                <div class="contact-info__item">
                    <div class="contact-info__icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                        </svg>
                    </div>
                    <div>
                        <p class="contact-info__label">Correo secundario</p>
                        <a href="mailto:<?php echo esc_attr( $email2 ); ?>" class="contact-info__value">
                            <?php echo esc_html( $email2 ); ?>
                        </a>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Redes sociales -->
                <?php $socials = karman_social_links(); if ( $socials ) : ?>
                <div style="margin-top:var(--space-10);">
                    <p class="contact-info__label" style="margin-bottom:var(--space-4);">Redes Sociales</p>
                    <div class="contact-info__social">
                        <?php foreach ( $socials as $net => $url ) : ?>
                            <a href="<?php echo esc_url( $url ); ?>"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="contact-social-btn"
                               aria-label="<?php echo esc_attr( ucfirst( $net ) ); ?>">
                                <?php echo karman_social_icon_svg( $net ); ?>
                                <?php echo esc_html( ucfirst( $net ) ); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>


            </aside>
        </div>
    </div>
</section>

<?php get_footer(); ?>
