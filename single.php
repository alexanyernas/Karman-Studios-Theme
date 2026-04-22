<?php
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

while ( have_posts() ) : the_post();
    $cats      = get_the_category();
    $cat_name  = $cats ? $cats[0]->name : 'General';
    $read_time = karman_reading_time( get_the_ID() );
    $tags      = get_the_tags();
?>

<!-- Post Hero -->
<div class="page-hero post-hero">
    <div class="container">
        <div class="post-hero__meta">
            <span class="badge badge--gold"><?php echo esc_html( $cat_name ); ?></span>
            <span class="post-hero__read-time"><?php echo (int) $read_time; ?> min de lectura</span>
        </div>
        <h1 class="page-hero__title"><?php the_title(); ?></h1>
        <div class="post-hero__author">
            <?php echo get_avatar( get_the_author_meta( 'ID' ), 36, '', get_the_author(), [ 'class' => 'post-hero__avatar' ] ); ?>
            <div>
                <span class="post-hero__author-name"><?php the_author(); ?></span>
                <time class="post-hero__date" datetime="<?php echo get_the_date( 'Y-m-d' ); ?>">
                    <?php echo get_the_date( 'd \d\e F, Y' ); ?>
                </time>
            </div>
        </div>
        <span class="page-hero__line" aria-hidden="true"></span>
    </div>
</div>

<!-- Featured image -->
<?php if ( has_post_thumbnail() ) : ?>
<div class="post-featured-image">
    <div class="container">
        <?php the_post_thumbnail( 'full', [ 'alt' => get_the_title(), 'class' => 'post-featured-image__img' ] ); ?>
    </div>
</div>
<?php endif; ?>

<!-- Content -->
<div class="section section--dark">
    <div class="container">
        <div class="post-layout">

            <!-- Main content -->
            <article class="post-content">
                <?php the_content(); ?>

                <!-- Tags -->
                <?php if ( $tags ) : ?>
                <div class="post-tags">
                    <span class="post-tags__label">Etiquetas:</span>
                    <?php foreach ( $tags as $tag ) : ?>
                        <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="badge badge--dark">
                            <?php echo esc_html( $tag->name ); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <!-- Post navigation -->
                <nav class="post-nav" aria-label="Navegación entre entradas">
                    <?php
                    $prev = get_previous_post();
                    $next = get_next_post();
                    ?>
                    <?php if ( $prev ) : ?>
                    <a href="<?php echo esc_url( get_permalink( $prev->ID ) ); ?>" class="post-nav__item post-nav__item--prev">
                        <span class="post-nav__direction">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                            Anterior
                        </span>
                        <span class="post-nav__title"><?php echo esc_html( get_the_title( $prev->ID ) ); ?></span>
                    </a>
                    <?php endif; ?>
                    <?php if ( $next ) : ?>
                    <a href="<?php echo esc_url( get_permalink( $next->ID ) ); ?>" class="post-nav__item post-nav__item--next">
                        <span class="post-nav__direction">
                            Siguiente
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                        </span>
                        <span class="post-nav__title"><?php echo esc_html( get_the_title( $next->ID ) ); ?></span>
                    </a>
                    <?php endif; ?>
                </nav>
            </article>

            <!-- Sidebar -->
            <aside class="post-sidebar">

                <!-- Recent posts -->
                <?php
                $recent = new WP_Query( [
                    'post_type'      => 'post',
                    'posts_per_page' => 4,
                    'post_status'    => 'publish',
                    'post__not_in'   => [ get_the_ID() ],
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ] );
                if ( $recent->have_posts() ) :
                ?>
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget__title">Entradas Recientes</h3>
                    <ul class="sidebar-recent">
                        <?php while ( $recent->have_posts() ) : $recent->the_post(); ?>
                        <li class="sidebar-recent__item">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <a href="<?php the_permalink(); ?>" class="sidebar-recent__thumb">
                                    <?php the_post_thumbnail( 'thumbnail', [ 'alt' => get_the_title(), 'loading' => 'lazy' ] ); ?>
                                </a>
                            <?php endif; ?>
                            <div>
                                <a href="<?php the_permalink(); ?>" class="sidebar-recent__title"><?php the_title(); ?></a>
                                <time class="sidebar-recent__date"><?php echo get_the_date( 'd M Y' ); ?></time>
                            </div>
                        </li>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </ul>
                </div>
                <?php endif; ?>

                <!-- Categories -->
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget__title">Categorías</h3>
                    <ul class="sidebar-cats">
                        <?php
                        $all_cats = get_categories( [ 'hide_empty' => true ] );
                        foreach ( $all_cats as $cat ) :
                        ?>
                        <li>
                            <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>">
                                <span><?php echo esc_html( $cat->name ); ?></span>
                                <span class="sidebar-cats__count"><?php echo (int) $cat->count; ?></span>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- CTA widget -->
                <div class="sidebar-widget sidebar-cta">
                    <p class="sidebar-cta__text">¿Quieres saber más sobre nuestros juegos?</p>
                    <a href="<?php echo esc_url( home_url( '/juegos/' ) ); ?>" class="btn btn--primary" style="width:100%;justify-content:center;">
                        Ver Juegos
                    </a>
                </div>

            </aside>
        </div><!-- .post-layout -->
    </div>
</div>

<?php endwhile; ?>

<?php get_footer(); ?>
