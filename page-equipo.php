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
            'orderby'        => [ 'meta_value_num' => 'ASC', 'title' => 'ASC' ],
            'meta_key'       => 'orden',
        ] );
        ?>

        <?php if ( $equipo_query->have_posts() ) : ?>
        <div class="team-grid">
            <?php while ( $equipo_query->have_posts() ) : $equipo_query->the_post();
                $nombre = get_field( 'nombre_completo' ) ?: get_the_title();
                $cargo  = get_field( 'cargo' ) ?: '';
                $bio    = get_field( 'bio_corta' ) ?: '';
                $foto   = get_field( 'foto' );
                $foto_url = $foto['url'] ?? get_the_post_thumbnail_url( get_the_ID(), 'large' ) ?? '';
            ?>
                <article class="team-card animate-on-scroll">
                    <div class="team-card__photo">
                        <?php if ( $foto_url ) : ?>
                            <img src="<?php echo esc_url( $foto_url ); ?>"
                                 alt="<?php echo esc_attr( $nombre ); ?>"
                                 loading="lazy">
                        <?php else : ?>
                            <div class="team-card__photo-placeholder" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" style="width:48px;height:48px;color:var(--color-border);">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                                </svg>
                            </div>
                        <?php endif; ?>
                        <?php if ( $bio ) : ?>
                            <div class="team-card__bio-overlay">
                                <p><?php echo esc_html( $bio ); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="team-card__info">
                        <p class="team-card__name"><?php echo esc_html( $nombre ); ?></p>
                        <?php if ( $cargo ) : ?>
                            <p class="team-card__role"><?php echo esc_html( $cargo ); ?></p>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>

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
