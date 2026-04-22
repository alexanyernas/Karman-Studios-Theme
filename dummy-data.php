<?php
/**
 * Karman Studios — Dummy Data Seeder
 *
 * Accede una vez desde el navegador (logueado como admin):
 *   https://tu-sitio.com/wp-content/themes/Karman-Studios-Theme/dummy-data.php
 *
 * IMPORTANTE: Elimina este archivo del servidor cuando termines.
 */

// Cargar WordPress
$wp_load = dirname( __FILE__ ) . '/../../../wp-load.php';
if ( ! file_exists( $wp_load ) ) {
    exit( 'Error: no se encontró wp-load.php. Verifica la ruta del tema.' );
}
require_once $wp_load;

// Solo admins logueados
if ( ! is_user_logged_in() || ! current_user_can( 'manage_options' ) ) {
    exit( 'No autorizado. Debes estar logueado como administrador.' );
}

set_time_limit( 180 );

$log = [];

// ── Helper: descarga imagen externa y la importa a la Media Library ─────────
function ks_sideload( string $url, string $title, int $post_id = 0 ): int {
    require_once ABSPATH . 'wp-admin/includes/media.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';
    $id = media_sideload_image( $url, $post_id, $title, 'id' );
    return is_wp_error( $id ) ? 0 : (int) $id;
}

// ── Helper: evitar duplicados por título y post_type ────────────────────────
function ks_post_exists( string $type, string $title ): bool {
    $q = get_posts( [
        'post_type'   => $type,
        'title'       => $title,
        'numberposts' => 1,
        'post_status' => 'any',
        'fields'      => 'ids',
    ] );
    return ! empty( $q );
}


/* ============================================================
   1. EQUIPO
   ============================================================ */

$equipo = [
    [
        'nombre'   => 'Alejandro Torres',
        'cargo'    => 'Director Creativo',
        'bio'      => 'Visionario detrás de los mundos de Karman Studios. Con más de 10 años en la industria, Alejandro lidera la visión artística y narrativa del estudio.',
        'orden'    => 1,
        'foto_url' => 'https://i.pravatar.cc/600?img=11',
    ],
    [
        'nombre'   => 'María González',
        'cargo'    => 'Directora de Arte',
        'bio'      => 'Especialista en concept art y diseño de personajes. María transforma ideas abstractas en universos visuales únicos y memorables.',
        'orden'    => 2,
        'foto_url' => 'https://i.pravatar.cc/600?img=5',
    ],
    [
        'nombre'   => 'Carlos Mendoza',
        'cargo'    => 'Programador Principal',
        'bio'      => 'Arquitecto del motor del juego. Carlos domina C++ y Unreal Engine, garantizando que cada mecánica sea sólida y eficiente.',
        'orden'    => 3,
        'foto_url' => 'https://i.pravatar.cc/600?img=12',
    ],
    [
        'nombre'   => 'Sofía Ramírez',
        'cargo'    => 'Diseñadora de Sonido',
        'bio'      => 'La arquitecta sonora del estudio. Sofía crea bandas sonoras y efectos que sumergen al jugador en mundos que van más allá de la pantalla.',
        'orden'    => 4,
        'foto_url' => 'https://i.pravatar.cc/600?img=9',
    ],
    [
        'nombre'   => 'Diego López',
        'cargo'    => 'Game Designer',
        'bio'      => 'El cerebro detrás de las mecánicas y sistemas de juego. Diego equilibra desafío y diversión para crear experiencias que enganchan desde el primer nivel.',
        'orden'    => 5,
        'foto_url' => 'https://i.pravatar.cc/600?img=15',
    ],
    [
        'nombre'   => 'Ana Castillo',
        'cargo'    => 'Community Manager',
        'bio'      => 'El puente entre el estudio y la comunidad. Ana escucha, comunica y asegura que la voz de los jugadores siempre impulse el desarrollo.',
        'orden'    => 6,
        'foto_url' => 'https://i.pravatar.cc/600?img=3',
    ],
];

foreach ( $equipo as $m ) {
    if ( ks_post_exists( 'miembro-equipo', $m['nombre'] ) ) {
        $log[] = [ 'skip', "Equipo: ya existe «{$m['nombre']}»" ];
        continue;
    }

    $post_id = wp_insert_post( [
        'post_type'   => 'miembro-equipo',
        'post_title'  => $m['nombre'],
        'post_status' => 'publish',
    ] );

    if ( is_wp_error( $post_id ) ) {
        $log[] = [ 'err', "Equipo: error creando «{$m['nombre']}» — " . $post_id->get_error_message() ];
        continue;
    }

    update_post_meta( $post_id, 'nombre_completo', $m['nombre'] );
    update_post_meta( $post_id, 'cargo',           $m['cargo']  );
    update_post_meta( $post_id, 'bio_corta',       $m['bio']    );
    update_post_meta( $post_id, 'orden',           $m['orden']  );

    $foto_id = ks_sideload( $m['foto_url'], $m['nombre'], $post_id );
    if ( $foto_id ) {
        set_post_thumbnail( $post_id, $foto_id );
        update_post_meta( $post_id, 'foto', $foto_id );
    }

    $log[] = [ 'ok', "Equipo: creado «{$m['nombre']}» (ID $post_id)" ];
}


/* ============================================================
   2. PREGUNTAS FRECUENTES
   ============================================================ */

$faqs = [
    [
        'pregunta'  => '¿En qué plataformas están disponibles sus juegos?',
        'respuesta' => 'Actualmente nuestros títulos están disponibles en PC a través de Steam. Estamos evaluando expandirnos a otras plataformas en el futuro cercano.',
        'orden'     => 1,
    ],
    [
        'pregunta'  => '¿Cuándo será el lanzamiento del próximo juego?',
        'respuesta' => 'Estamos trabajando arduamente en nuestro próximo título. Síguenos en redes sociales para ser el primero en enterarte de la fecha oficial de lanzamiento.',
        'orden'     => 2,
    ],
    [
        'pregunta'  => '¿Sus juegos tienen soporte completo en español?',
        'respuesta' => 'Sí. Todos nuestros títulos están completamente localizados al español, incluyendo textos, subtítulos y voces donde aplica.',
        'orden'     => 3,
    ],
    [
        'pregunta'  => '¿Cómo puedo reportar un bug o error en el juego?',
        'respuesta' => 'Puedes reportar errores desde nuestra página de Contacto o a través de los foros de Steam. Incluye el mayor detalle posible: pasos para reproducirlo, capturas de pantalla y especificaciones de tu equipo.',
        'orden'     => 4,
    ],
    [
        'pregunta'  => '¿Ofrecen reembolsos?',
        'respuesta' => 'Los reembolsos se gestionan directamente a través de Steam, bajo su política estándar: menos de 2 horas jugadas y dentro de los 14 días posteriores a la compra.',
        'orden'     => 5,
    ],
    [
        'pregunta'  => '¿Tienen planes para lanzar en consolas?',
        'respuesta' => 'Es algo que tenemos en el radar a largo plazo. Por ahora nos enfocamos en ofrecer la mejor experiencia posible en PC antes de expandirnos a otras plataformas.',
        'orden'     => 6,
    ],
    [
        'pregunta'  => '¿Tienen un programa de acceso anticipado (Early Access)?',
        'respuesta' => 'Estamos evaluando la posibilidad de ofrecer acceso anticipado para nuestra comunidad más fiel. Mantente pendiente de nuestros canales oficiales para el anuncio.',
        'orden'     => 7,
    ],
    [
        'pregunta'  => '¿Cómo puedo unirme al equipo de Karman Studios?',
        'respuesta' => 'Siempre estamos abiertos a conocer talento apasionado. Visita nuestra sección de Equipo o escríbenos desde la página de Contacto adjuntando tu portafolio y el área en la que te especializas.',
        'orden'     => 8,
    ],
];

foreach ( $faqs as $faq ) {
    if ( ks_post_exists( 'pregunta-faq', $faq['pregunta'] ) ) {
        $log[] = [ 'skip', "FAQ: ya existe «{$faq['pregunta']}»" ];
        continue;
    }

    $post_id = wp_insert_post( [
        'post_type'    => 'pregunta-faq',
        'post_title'   => $faq['pregunta'],
        'post_content' => $faq['respuesta'],
        'post_status'  => 'publish',
    ] );

    if ( is_wp_error( $post_id ) ) {
        $log[] = [ 'err', "FAQ: error creando «{$faq['pregunta']}» — " . $post_id->get_error_message() ];
        continue;
    }

    update_post_meta( $post_id, 'orden', $faq['orden'] );
    $log[] = [ 'ok', "FAQ: creada «{$faq['pregunta']}» (ID $post_id)" ];
}


/* ============================================================
   3. GALERÍA
   ============================================================ */

$galeria = [
    [
        'titulo'      => 'Paisaje del Bosque Ancestral',
        'tipo'        => 'imagen',
        'descripcion' => 'Vista panorámica del bioma boscoso del primer acto.',
        'destacado'   => '1',
        'img_url'     => 'https://picsum.photos/seed/ks-forest/1280/720',
    ],
    [
        'titulo'      => 'Ciudad de Ash\'Mora — Nocturna',
        'tipo'        => 'imagen',
        'descripcion' => 'La metrópoli central del mundo del juego iluminada de noche.',
        'destacado'   => '1',
        'img_url'     => 'https://picsum.photos/seed/ks-city/1280/720',
    ],
    [
        'titulo'      => 'Concept Art — Protagonista',
        'tipo'        => 'imagen',
        'descripcion' => 'Arte conceptual del personaje principal en su armadura completa.',
        'destacado'   => '1',
        'img_url'     => 'https://picsum.photos/seed/ks-hero/1280/720',
    ],
    [
        'titulo'      => 'Desierto de Cristal',
        'tipo'        => 'imagen',
        'descripcion' => 'Las formaciones de cuarzo del segundo acto al atardecer.',
        'destacado'   => '1',
        'img_url'     => 'https://picsum.photos/seed/ks-desert/1280/720',
    ],
    [
        'titulo'      => 'Captura de Combate',
        'tipo'        => 'imagen',
        'descripcion' => 'Secuencia de batalla con el HUD activo.',
        'destacado'   => '0',
        'img_url'     => 'https://picsum.photos/seed/ks-combat/1280/720',
    ],
    [
        'titulo'      => 'Mapa del Mundo',
        'tipo'        => 'imagen',
        'descripcion' => 'Vista general del mapa de exploración del juego.',
        'destacado'   => '0',
        'img_url'     => 'https://picsum.photos/seed/ks-map/1280/720',
    ],
    [
        'titulo'      => 'Ruinas del Templo Olvidado',
        'tipo'        => 'imagen',
        'descripcion' => 'Zona de exploración del tercer acto, llena de secretos.',
        'destacado'   => '0',
        'img_url'     => 'https://picsum.photos/seed/ks-ruins/1280/720',
    ],
    [
        'titulo'      => 'Tráiler Oficial — Karman Studios',
        'tipo'        => 'video',
        'descripcion' => 'Primer avance oficial del estudio independiente.',
        'destacado'   => '1',
        'video_url'   => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
    ],
];

foreach ( $galeria as $item ) {
    if ( ks_post_exists( 'galeria-item', $item['titulo'] ) ) {
        $log[] = [ 'skip', "Galería: ya existe «{$item['titulo']}»" ];
        continue;
    }

    $post_id = wp_insert_post( [
        'post_type'   => 'galeria-item',
        'post_title'  => $item['titulo'],
        'post_status' => 'publish',
    ] );

    if ( is_wp_error( $post_id ) ) {
        $log[] = [ 'err', "Galería: error creando «{$item['titulo']}» — " . $post_id->get_error_message() ];
        continue;
    }

    update_post_meta( $post_id, 'tipo',             $item['tipo']        );
    update_post_meta( $post_id, 'descripcion_item', $item['descripcion'] );
    update_post_meta( $post_id, 'destacado',        $item['destacado']   );

    if ( $item['tipo'] === 'imagen' && ! empty( $item['img_url'] ) ) {
        $img_id = ks_sideload( $item['img_url'], $item['titulo'], $post_id );
        if ( $img_id ) {
            set_post_thumbnail( $post_id, $img_id );
            update_post_meta( $post_id, 'archivo_imagen', $img_id );
        }
    }

    if ( $item['tipo'] === 'video' && ! empty( $item['video_url'] ) ) {
        update_post_meta( $post_id, 'url_video', $item['video_url'] );
    }

    $log[] = [ 'ok', "Galería: creado «{$item['titulo']}» (ID $post_id)" ];
}


/* ============================================================
   OUTPUT
   ============================================================ */
$totals = array_count_values( array_column( $log, 0 ) );
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Karman Studios — Seeder</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', system-ui, sans-serif; background: #0d0d0d; color: #fbd570; padding: 2.5rem; line-height: 1.6; }
        h1 { font-size: 1.5rem; margin-bottom: 0.25rem; }
        .subtitle { color: #888; font-size: 0.9rem; margin-bottom: 2rem; }
        .summary { display: flex; gap: 1.5rem; margin-bottom: 2rem; flex-wrap: wrap; }
        .pill { padding: 0.4rem 1rem; border-radius: 999px; font-size: 0.85rem; font-weight: 700; }
        .pill-ok   { background: rgba(74,222,128,0.12); color: #4ade80; border: 1px solid rgba(74,222,128,0.3); }
        .pill-skip { background: rgba(136,136,136,0.1); color: #888;    border: 1px solid #333; }
        .pill-err  { background: rgba(248,113,113,0.1); color: #f87171; border: 1px solid rgba(248,113,113,0.3); }
        ul { list-style: none; display: flex; flex-direction: column; gap: 0.4rem; }
        li { font-size: 0.9rem; padding: 0.3rem 0.6rem; border-radius: 4px; }
        li.ok   { color: #4ade80; }
        li.skip { color: #666; }
        li.err  { color: #f87171; background: rgba(248,113,113,0.07); }
        .warn { margin-top: 2.5rem; padding: 1.25rem 1.5rem; background: rgba(251,213,112,0.06); border: 1px solid rgba(251,213,112,0.4); border-radius: 10px; }
        .warn strong { display: block; margin-bottom: 0.4rem; font-size: 1rem; }
        .warn code { background: rgba(255,255,255,0.08); padding: 0.15rem 0.4rem; border-radius: 4px; font-size: 0.85rem; }
    </style>
</head>
<body>

<h1>🎮 Karman Studios — Dummy Data Seeder</h1>
<p class="subtitle">Resultado de la importación</p>

<div class="summary">
    <span class="pill pill-ok">✅ <?php echo $totals['ok']   ?? 0; ?> creados</span>
    <span class="pill pill-skip">⏭ <?php echo $totals['skip'] ?? 0; ?> ya existían</span>
    <span class="pill pill-err">❌ <?php echo $totals['err']  ?? 0; ?> errores</span>
</div>

<ul>
    <?php foreach ( $log as [ $type, $msg ] ) : ?>
        <li class="<?php echo esc_attr( $type ); ?>"><?php echo esc_html( $msg ); ?></li>
    <?php endforeach; ?>
</ul>

<div class="warn">
    <strong>⚠️ Elimina este archivo del servidor cuando hayas terminado.</strong>
    Ruta: <code>wp-content/themes/Karman-Studios-Theme/dummy-data.php</code>
</div>

</body>
</html>
