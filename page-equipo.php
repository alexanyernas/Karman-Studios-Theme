<?php
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<?php get_template_part( 'template-parts/page-hero', null, [
    'label'    => 'Las Personas Detrás',
    'title'    => 'Nuestro Equipo',
    'subtitle' => 'Un grupo de apasionados construyendo mundos virtuales con dedicación y talento.',
] ); ?>

<section class="section section--dark">
    <div class="container">

        <?php
        $equipo_query = new WP_Query( [
            'post_type'      => 'miembro-equipo',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
        ] );

        $destacado   = null;
        $segunda     = [];
        $resto        = [];

        if ( $equipo_query->have_posts() ) {
            while ( $equipo_query->have_posts() ) {
                $equipo_query->the_post();
                $posicion = get_field( 'posicion_grid' ) ?: 'normal';
                $miembro  = [
                    'nombre'   => get_field( 'nombre_completo' ) ?: get_the_title(),
                    'cargo'    => get_field( 'cargo' ) ?: '',
                    'bio'      => get_field( 'bio_corta' ) ?: '',
                    'foto'     => get_field( 'foto' ),
                ];
                $miembro['foto_url'] = $miembro['foto']['url'] ?? get_the_post_thumbnail_url( get_the_ID(), 'large' ) ?? '';

                if ( $posicion === 'destacado' && ! $destacado ) {
                    $destacado = $miembro;
                } elseif ( $posicion === 'segunda_fila' && count( $segunda ) < 2 ) {
                    $segunda[] = $miembro;
                } else {
                    $resto[] = $miembro;
                }
            }
            wp_reset_postdata();
        }

        $tiene_miembros = $destacado || $segunda || $resto;
        ?>

        <?php if ( $tiene_miembros ) : ?>

            <?php /* ── Fila 1: Destacado ─────────────────────────────────── */ ?>
            <?php if ( $destacado ) : ?>
            <div class="team-row team-row--featured">
                <article class="team-card team-card--featured animate-on-scroll">
                    <div class="team-card__photo">
                        <?php if ( $destacado['foto_url'] ) : ?>
                            <img src="<?php echo esc_url( $destacado['foto_url'] ); ?>"
                                 alt="<?php echo esc_attr( $destacado['nombre'] ); ?>"
                                 loading="lazy">
                        <?php else : ?>
                            <div class="team-card__photo-placeholder" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" style="width:72px;height:72px;color:var(--color-border);">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                                </svg>
                            </div>
                        <?php endif; ?>
                        <?php if ( $destacado['bio'] ) : ?>
                            <div class="team-card__bio-overlay">
                                <p><?php echo esc_html( $destacado['bio'] ); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="team-card__info">
                        <p class="team-card__name"><?php echo esc_html( $destacado['nombre'] ); ?></p>
                        <?php if ( $destacado['cargo'] ) : ?>
                            <p class="team-card__role"><?php echo esc_html( $destacado['cargo'] ); ?></p>
                        <?php endif; ?>
                    </div>
                </article>
            </div>
            <?php endif; ?>

            <?php /* ── Fila 2: Segunda fila ─────────────────────────────── */ ?>
            <?php if ( $segunda ) : ?>
            <div class="team-row team-row--second">
                <?php foreach ( $segunda as $miembro ) : ?>
                <article class="team-card team-card--second animate-on-scroll">
                    <div class="team-card__photo">
                        <?php if ( $miembro['foto_url'] ) : ?>
                            <img src="<?php echo esc_url( $miembro['foto_url'] ); ?>"
                                 alt="<?php echo esc_attr( $miembro['nombre'] ); ?>"
                                 loading="lazy">
                        <?php else : ?>
                            <div class="team-card__photo-placeholder" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" style="width:48px;height:48px;color:var(--color-border);">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                                </svg>
                            </div>
                        <?php endif; ?>
                        <?php if ( $miembro['bio'] ) : ?>
                            <div class="team-card__bio-overlay">
                                <p><?php echo esc_html( $miembro['bio'] ); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="team-card__info">
                        <p class="team-card__name"><?php echo esc_html( $miembro['nombre'] ); ?></p>
                        <?php if ( $miembro['cargo'] ) : ?>
                            <p class="team-card__role"><?php echo esc_html( $miembro['cargo'] ); ?></p>
                        <?php endif; ?>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <?php /* ── Fila 3+: Grid normal ────────────────────────────── */ ?>
            <?php if ( $resto ) : ?>
            <div class="team-grid">
                <?php foreach ( $resto as $miembro ) : ?>
                <article class="team-card animate-on-scroll">
                    <div class="team-card__photo">
                        <?php if ( $miembro['foto_url'] ) : ?>
                            <img src="<?php echo esc_url( $miembro['foto_url'] ); ?>"
                                 alt="<?php echo esc_attr( $miembro['nombre'] ); ?>"
                                 loading="lazy">
                        <?php else : ?>
                            <div class="team-card__photo-placeholder" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" style="width:48px;height:48px;color:var(--color-border);">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                                </svg>
                            </div>
                        <?php endif; ?>
                        <?php if ( $miembro['bio'] ) : ?>
                            <div class="team-card__bio-overlay">
                                <p><?php echo esc_html( $miembro['bio'] ); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="team-card__info">
                        <p class="team-card__name"><?php echo esc_html( $miembro['nombre'] ); ?></p>
                        <?php if ( $miembro['cargo'] ) : ?>
                            <p class="team-card__role"><?php echo esc_html( $miembro['cargo'] ); ?></p>
                        <?php endif; ?>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

        <?php else : ?>
        <div class="empty-state">
            <p>Aún no hay miembros del equipo. Agrega desde <strong>wp-admin → Equipo</strong>.</p>
        </div>
        <?php endif; ?>

    </div>
</section>

<!-- CTA: ¿Quieres unirte? -->
<section class="cta-band">
    <div class="container">
        <div class="animate-on-scroll">
            <h2 class="cta-band__title">¿Quieres <span class="gradient-text">Unirte</span> al Equipo?</h2>
            <p class="cta-band__subtitle">Siempre estamos en busca de talento apasionado. Si crees que encajas, escríbenos.</p>
            <a href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>" class="btn btn--primary btn--lg">
                Contáctanos
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
