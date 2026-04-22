<?php
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<?php get_template_part( 'template-parts/page-hero', null, [
    'label'    => 'Soporte',
    'title'    => 'Preguntas Frecuentes',
    'subtitle' => '¿Tienes dudas? Aquí encontrarás respuesta a las preguntas más comunes.',
] ); ?>

<section class="section section--dark">
    <div class="container">

        <?php
        $faq_cats = get_terms( [
            'taxonomy'   => 'categoria-faq',
            'hide_empty' => true,
        ] );
        ?>

        <?php if ( ! is_wp_error( $faq_cats ) && count( $faq_cats ) > 1 ) : ?>
        <div class="filter-bar" id="faqFilters" style="justify-content:center; margin-bottom:var(--space-12);">
            <button class="filter-btn active" data-faq-filter="all">Todas</button>
            <?php foreach ( $faq_cats as $cat ) : ?>
                <button class="filter-btn" data-faq-filter="<?php echo esc_attr( $cat->slug ); ?>">
                    <?php echo esc_html( $cat->name ); ?>
                </button>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php
        $faq_query = new WP_Query( [
            'post_type'      => 'pregunta-faq',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
            'orderby'        => [ 'meta_value_num' => 'ASC', 'date' => 'ASC' ],
            'meta_key'       => 'orden',
        ] );
        ?>

        <?php if ( $faq_query->have_posts() ) : ?>

        <?php if ( ! is_wp_error( $faq_cats ) && count( $faq_cats ) > 1 ) :
            // Render grouped by category
            foreach ( $faq_cats as $fcat ) :
                $faq_in_cat = new WP_Query( [
                    'post_type'      => 'pregunta-faq',
                    'posts_per_page' => -1,
                    'post_status'    => 'publish',
                    'orderby'        => [ 'meta_value_num' => 'ASC', 'date' => 'ASC' ],
                    'meta_key'       => 'orden',
                    'tax_query'      => [ [ 'taxonomy' => 'categoria-faq', 'field' => 'slug', 'terms' => $fcat->slug ] ],
                ] );
                if ( ! $faq_in_cat->have_posts() ) { wp_reset_postdata(); continue; }
        ?>
        <div class="faq-category-group animate-on-scroll" data-faq-cat="<?php echo esc_attr( $fcat->slug ); ?>">
            <h2 class="faq-category-title"><?php echo esc_html( $fcat->name ); ?></h2>
            <div class="faq-list">
                <?php while ( $faq_in_cat->have_posts() ) : $faq_in_cat->the_post(); ?>
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
        </div>
        <?php endforeach;

        else :
            // Render all without category grouping
        ?>
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
            <?php endwhile; ?>
        </div>
        <?php endif; wp_reset_postdata(); ?>

        <?php else : ?>
        <div class="empty-state">
            <p>Aún no hay preguntas frecuentes. Agrega contenido desde <strong>wp-admin → FAQ</strong>.</p>
        </div>
        <?php endif; ?>

        <!-- CTA -->
        <div class="faq-cta animate-on-scroll" style="text-align:center; margin-top:var(--space-16);">
            <p style="color:var(--color-muted); margin-bottom:var(--space-5); margin-inline:auto;">¿No encontraste tu respuesta? Contáctanos directamente.</p>
            <a href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>" class="btn btn--primary">
                Ir a Contacto
            </a>
        </div>

    </div>
</section>

<?php get_footer(); ?>
