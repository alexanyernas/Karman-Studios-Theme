<?php
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<?php get_template_part( 'template-parts/page-hero', null, [
    'label'    => 'Arte & Medios',
    'title'    => 'Galería',
    'subtitle' => 'Imágenes, capturas y videos del desarrollo de nuestros juegos.',
] ); ?>

<section class="section section--dark">
    <div class="container">

        <?php
        // Obtener categorías de galería
        $galeria_cats = get_terms( [
            'taxonomy'   => 'categoria-galeria',
            'hide_empty' => true,
        ] );

        // Obtener todos los items para los filtros de tipo
        $has_videos  = get_posts( [ 'post_type' => 'galeria-item', 'numberposts' => 1, 'meta_key' => 'tipo', 'meta_value' => 'video' ] );
        $has_images  = get_posts( [ 'post_type' => 'galeria-item', 'numberposts' => 1, 'meta_key' => 'tipo', 'meta_value' => 'imagen' ] );
        wp_reset_postdata();
        ?>

        <!-- Filter bar -->
        <div class="filter-bar" id="galeriaFilters">
            <button class="filter-btn active" data-filter="all">Todos</button>
            <?php if ( $has_images ) : ?>
                <button class="filter-btn" data-filter="imagen">Imágenes</button>
            <?php endif; ?>
            <?php if ( $has_videos ) : ?>
                <button class="filter-btn" data-filter="video">Videos</button>
            <?php endif; ?>
            <?php if ( ! is_wp_error( $galeria_cats ) && $galeria_cats ) : ?>
                <?php foreach ( $galeria_cats as $cat ) : ?>
                    <button class="filter-btn" data-filter="cat-<?php echo esc_attr( $cat->slug ); ?>">
                        <?php echo esc_html( $cat->name ); ?>
                    </button>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Gallery grid -->
        <?php
        $galeria_query = new WP_Query( [
            'post_type'      => 'galeria-item',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
        ] );
        ?>

        <?php if ( $galeria_query->have_posts() ) : ?>
        <div class="gallery-grid" id="galeriaGrid">
            <?php while ( $galeria_query->have_posts() ) : $galeria_query->the_post();
                $tipo        = get_field( 'tipo' ) ?: 'imagen';
                $img_data    = get_field( 'archivo_imagen' );
                $img_url     = $img_data['url'] ?? get_the_post_thumbnail_url( get_the_ID(), 'large' ) ?? '';
                $video_url   = get_field( 'url_video' ) ?? '';
                $descripcion = get_field( 'descripcion_item' ) ?? '';
                $thumb       = ( $tipo === 'video' && $video_url ) ? karman_get_video_thumbnail( $video_url ) : $img_url;
                $embed       = ( $tipo === 'video' && $video_url ) ? karman_get_video_embed( $video_url ) : '';
                $modal_src   = $tipo === 'video' ? $embed : $img_url;

                // Categorías del item
                $item_cats   = get_the_terms( get_the_ID(), 'categoria-galeria' );
                $cat_classes = '';
                if ( $item_cats && ! is_wp_error( $item_cats ) ) {
                    foreach ( $item_cats as $ic ) {
                        $cat_classes .= ' cat-' . esc_attr( $ic->slug );
                    }
                }
            ?>
                <div class="gallery-card <?php echo $tipo === 'video' ? 'gallery-card--video' : ''; ?> animate-on-scroll"
                     data-type="<?php echo esc_attr( $tipo ); ?>"
                     data-cats="<?php echo esc_attr( $cat_classes ); ?>"
                     data-src="<?php echo esc_attr( $modal_src ); ?>"
                     data-caption="<?php echo esc_attr( get_the_title() . ( $descripcion ? ' — ' . $descripcion : '' ) ); ?>"
                     role="button"
                     tabindex="0"
                     aria-label="<?php echo esc_attr( 'Ver ' . get_the_title() ); ?>">

                    <?php if ( $thumb ) : ?>
                        <img src="<?php echo esc_url( $thumb ); ?>"
                             alt="<?php echo esc_attr( get_the_title() ); ?>"
                             loading="lazy">
                    <?php else : ?>
                        <div class="gallery-card__placeholder" aria-hidden="true"></div>
                    <?php endif; ?>

                    <div class="gallery-card__overlay">
                        <div class="gallery-card__info">
                            <span><?php echo $tipo === 'video' ? 'Video' : 'Imagen'; ?></span>
                            <h4><?php the_title(); ?></h4>
                        </div>
                    </div>

                </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>

        <?php else : ?>
        <div class="empty-state">
            <p>Aún no hay items en la galería. Agrega contenido desde <strong>wp-admin → Galería</strong>.</p>
        </div>
        <?php endif; ?>

    </div>
</section>

<?php get_footer(); ?>
