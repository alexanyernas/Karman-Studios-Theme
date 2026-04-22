<?php
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
?>

<main class="container" style="padding: 80px 20px; text-align: center;">
    <h1><?php esc_html_e( 'Bienvenido', 'karman-studios' ); ?></h1>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <article>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php the_excerpt(); ?>
        </article>
    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>
