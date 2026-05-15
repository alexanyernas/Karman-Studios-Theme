<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Karman Studios — Theme Functions
 */

// ─── UPLOADS BASE URL ────────────────────────────────────────────────────────
add_action( 'after_setup_theme', function () {
    if ( ! defined( 'KS_IMG' ) ) {
        define( 'KS_IMG', content_url( '/uploads' ) );
    }
} );


// ═══════════════════════════════════════════════════════════════════════════════
// CUSTOM POST TYPES
// ═══════════════════════════════════════════════════════════════════════════════

// ─── CPT: GALERÍA ────────────────────────────────────────────────────────────
add_action( 'init', function () {
    register_post_type( 'galeria-item', [
        'labels' => [
            'name'               => 'Galería',
            'singular_name'      => 'Item de Galería',
            'add_new'            => 'Agregar nuevo',
            'add_new_item'       => 'Agregar nuevo item',
            'edit_item'          => 'Editar item',
            'new_item'           => 'Nuevo item',
            'view_item'          => 'Ver item',
            'search_items'       => 'Buscar en galería',
            'not_found'          => 'No se encontraron items',
            'not_found_in_trash' => 'No hay items en la papelera',
            'menu_name'          => 'Galería',
        ],
        'public'       => true,
        'show_in_menu' => true,
        'menu_icon'    => 'dashicons-format-gallery',
        'supports'     => [ 'title', 'thumbnail' ],
        'has_archive'  => false,
        'rewrite'      => [ 'slug' => 'galeria' ],
        'show_in_rest' => false,
    ] );
} );

// ─── TAXONOMY: CATEGORIA-GALERIA ─────────────────────────────────────────────
add_action( 'init', function () {
    register_taxonomy( 'categoria-galeria', 'galeria-item', [
        'labels' => [
            'name'          => 'Categorías de Galería',
            'singular_name' => 'Categoría',
            'all_items'     => 'Todas las categorías',
            'add_new_item'  => 'Agregar nueva categoría',
            'edit_item'     => 'Editar categoría',
            'menu_name'     => 'Categorías',
        ],
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'rewrite'           => [ 'slug' => 'categoria-galeria' ],
    ] );
} );

// ─── CPT: EQUIPO ─────────────────────────────────────────────────────────────
add_action( 'init', function () {
    register_post_type( 'miembro-equipo', [
        'labels' => [
            'name'               => 'Equipo',
            'singular_name'      => 'Miembro del Equipo',
            'add_new'            => 'Agregar miembro',
            'add_new_item'       => 'Agregar nuevo miembro',
            'edit_item'          => 'Editar miembro',
            'new_item'           => 'Nuevo miembro',
            'view_item'          => 'Ver miembro',
            'search_items'       => 'Buscar miembros',
            'not_found'          => 'No se encontraron miembros',
            'not_found_in_trash' => 'No hay miembros en la papelera',
            'menu_name'          => 'Equipo',
        ],
        'public'       => true,
        'show_in_menu' => true,
        'menu_icon'    => 'dashicons-groups',
        'supports'     => [ 'title', 'thumbnail', 'page-attributes' ],
        'has_archive'  => false,
        'rewrite'      => [ 'slug' => 'equipo' ],
        'show_in_rest' => false,
    ] );
} );

// ─── CPT: PREGUNTAS FRECUENTES ────────────────────────────────────────────────
add_action( 'init', function () {
    register_post_type( 'pregunta-faq', [
        'labels' => [
            'name'               => 'Preguntas Frecuentes',
            'singular_name'      => 'Pregunta',
            'add_new'            => 'Agregar pregunta',
            'add_new_item'       => 'Agregar nueva pregunta',
            'edit_item'          => 'Editar pregunta',
            'new_item'           => 'Nueva pregunta',
            'search_items'       => 'Buscar preguntas',
            'not_found'          => 'No se encontraron preguntas',
            'not_found_in_trash' => 'No hay preguntas en la papelera',
            'menu_name'          => 'FAQ',
        ],
        'public'       => false,
        'show_ui'      => true,
        'show_in_menu' => true,
        'menu_icon'    => 'dashicons-editor-help',
        'supports'     => [ 'title', 'editor', 'page-attributes' ],
        'has_archive'  => false,
        'show_in_rest' => false,
    ] );
} );

// ─── TAXONOMY: CATEGORIA-FAQ ──────────────────────────────────────────────────
add_action( 'init', function () {
    register_taxonomy( 'categoria-faq', 'pregunta-faq', [
        'labels' => [
            'name'          => 'Categorías de FAQ',
            'singular_name' => 'Categoría',
            'all_items'     => 'Todas las categorías',
            'add_new_item'  => 'Agregar nueva categoría',
            'edit_item'     => 'Editar categoría',
            'menu_name'     => 'Categorías',
        ],
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'rewrite'           => false,
    ] );
} );


// ─── CPT: JUEGOS ──────────────────────────────────────────────────────────────
add_action( 'init', function () {
    register_post_type( 'juego', [
        'labels' => [
            'name'               => 'Juegos',
            'singular_name'      => 'Juego',
            'add_new'            => 'Agregar juego',
            'add_new_item'       => 'Agregar nuevo juego',
            'edit_item'          => 'Editar juego',
            'new_item'           => 'Nuevo juego',
            'search_items'       => 'Buscar juegos',
            'not_found'          => 'No se encontraron juegos',
            'not_found_in_trash' => 'No hay juegos en la papelera',
            'menu_name'          => 'Juegos',
        ],
        'public'       => true,
        'show_ui'      => true,
        'show_in_menu' => true,
        'menu_icon'    => 'dashicons-games',
        'supports'     => [ 'title', 'thumbnail' ],
        'has_archive'  => false,
        'show_in_rest' => false,
        'rewrite'      => [ 'slug' => 'juego' ],
    ] );
} );


// ═══════════════════════════════════════════════════════════════════════════════
// ACF: CAMPO LOCALES (compatible con ACF Free)
// ═══════════════════════════════════════════════════════════════════════════════

add_action( 'acf/init', function () {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) return;

    // ── Galería ──────────────────────────────────────────────────────────────
    acf_add_local_field_group( [
        'key'    => 'group_galeria_item',
        'title'  => 'Datos del Item de Galería',
        'fields' => [
            [
                'key'           => 'field_galeria_tipo',
                'label'         => 'Tipo de contenido',
                'name'          => 'tipo',
                'type'          => 'select',
                'choices'       => [
                    'imagen' => 'Imagen',
                    'video'  => 'Video',
                ],
                'default_value' => 'imagen',
                'instructions'  => 'Selecciona si este item es una imagen o un video.',
            ],
            [
                'key'           => 'field_galeria_imagen',
                'label'         => 'Imagen',
                'name'          => 'archivo_imagen',
                'type'          => 'image',
                'return_format' => 'array',
                'preview_size'  => 'medium',
                'instructions'  => 'Sube la imagen a mostrar en la galería. Se usa también como miniatura.',
            ],
            [
                'key'          => 'field_galeria_video',
                'label'        => 'URL del Video',
                'name'         => 'url_video',
                'type'         => 'url',
                'instructions' => 'Pega el enlace de YouTube o Vimeo. Ej: https://www.youtube.com/watch?v=XXXX',
                'placeholder'  => 'https://www.youtube.com/watch?v=',
            ],
            [
                'key'          => 'field_galeria_descripcion',
                'label'        => 'Descripción',
                'name'         => 'descripcion_item',
                'type'         => 'textarea',
                'rows'         => 3,
                'instructions' => 'Descripción breve que aparece al pasar el cursor o en el modal.',
            ],
            [
                'key'           => 'field_galeria_destacado',
                'label'         => 'Mostrar en Inicio',
                'name'          => 'destacado',
                'type'          => 'true_false',
                'ui'            => 1,
                'default_value' => 0,
                'message'       => 'Aparece en la sección de Galería de la página de inicio',
            ],
        ],
        'location' => [
            [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'galeria-item' ] ],
        ],
        'position'              => 'normal',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
    ] );

    // ── Equipo ───────────────────────────────────────────────────────────────
    acf_add_local_field_group( [
        'key'    => 'group_miembro_equipo',
        'title'  => 'Datos del Miembro',
        'fields' => [
            [
                'key'          => 'field_equipo_nombre',
                'label'        => 'Nombre Completo',
                'name'         => 'nombre_completo',
                'type'         => 'text',
                'instructions' => 'Nombre completo del miembro del equipo.',
                'placeholder'  => 'Ej: María González',
            ],
            [
                'key'          => 'field_equipo_cargo',
                'label'        => 'Cargo',
                'name'         => 'cargo',
                'type'         => 'text',
                'instructions' => 'Posición o rol dentro del estudio.',
                'placeholder'  => 'Ej: Lead Developer',
            ],
            [
                'key'           => 'field_equipo_foto',
                'label'         => 'Foto',
                'name'          => 'foto',
                'type'          => 'image',
                'return_format' => 'array',
                'preview_size'  => 'medium',
                'instructions'  => 'Foto del miembro. Recomendado: cuadrada, mínimo 400×400px.',
            ],
            [
                'key'          => 'field_equipo_bio',
                'label'        => 'Bio Corta',
                'name'         => 'bio_corta',
                'type'         => 'textarea',
                'rows'         => 3,
                'instructions' => '(Opcional) Descripción breve. Aparece en el hover de la card.',
            ],
            [
                'key'           => 'field_equipo_posicion',
                'label'         => 'Posición en el Grid',
                'name'          => 'posicion_grid',
                'type'          => 'select',
                'instructions'  => 'Define cómo aparece este miembro en la página del equipo.',
                'choices'       => [
                    'normal'       => 'Normal',
                    'destacado'    => 'Destacado (1ª fila)',
                    'segunda_fila' => 'Segunda fila (máx. 2)',
                ],
                'default_value' => 'normal',
                'return_format' => 'value',
                'allow_null'    => 0,
            ],
        ],
        'location' => [
            [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'miembro-equipo' ] ],
        ],
        'position'              => 'normal',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
    ] );

    // ── Juegos ───────────────────────────────────────────────────────────────
    acf_add_local_field_group( [
        'key'    => 'group_juego',
        'title'  => 'Datos del Juego',
        'fields' => [
            [
                'key'           => 'field_juego_destacado',
                'label'         => 'Juego Destacado',
                'name'          => 'juego_destacado',
                'type'          => 'true_false',
                'ui'            => 1,
                'default_value' => 0,
                'message'       => 'Mostrar este juego en el Hero de la página de Juegos',
                'instructions'  => 'Solo un juego debe estar marcado como destacado.',
            ],
            [
                'key'           => 'field_juego_logo',
                'label'         => 'Logo del Juego',
                'name'          => 'juego_logo',
                'type'          => 'image',
                'return_format' => 'array',
                'preview_size'  => 'medium',
                'instructions'  => 'Logo del juego (PNG con fondo transparente). Aparece en el Hero.',
            ],
            [
                'key'           => 'field_juego_hero_bg',
                'label'         => 'Imagen de Fondo (Hero)',
                'name'          => 'juego_hero_bg',
                'type'          => 'image',
                'return_format' => 'array',
                'preview_size'  => 'medium',
                'instructions'  => 'Imagen panorámica para el fondo del Hero. Recomendado: 1920×1080px. Se usa como fallback si hay video.',
            ],
            [
                'key'          => 'field_juego_hero_video_bg',
                'label'        => 'Video de Fondo (Hero)',
                'name'         => 'juego_hero_video_bg',
                'type'         => 'file',
                'return_format' => 'url',
                'library'      => 'all',
                'mime_types'   => 'mp4,webm',
                'instructions' => '(Opcional) Sube un archivo .mp4 o .webm. Se reproduce automáticamente en loop sin sonido. Tiene prioridad sobre la imagen de fondo.',
            ],
            [
                'key'          => 'field_juego_tagline',
                'label'        => 'Tagline',
                'name'         => 'juego_tagline',
                'type'         => 'text',
                'placeholder'  => 'Ej: Sobrevive. Construye. Domina.',
                'instructions' => 'Frase corta e impactante. Aparece bajo el logo en el Hero.',
            ],
            [
                'key'          => 'field_juego_genero',
                'label'        => 'Género',
                'name'         => 'juego_genero',
                'type'         => 'text',
                'placeholder'  => 'Ej: Supervivencia / Estrategia / Gestión',
                'instructions' => 'Género(s) del juego separados por barra.',
            ],
            [
                'key'           => 'field_juego_estado',
                'label'         => 'Estado de Desarrollo',
                'name'          => 'juego_estado',
                'type'          => 'select',
                'choices'       => [
                    'desarrollo'    => 'En Desarrollo',
                    'demo'          => 'Demo Disponible',
                    'early_access'  => 'Acceso Anticipado',
                    'lanzado'       => 'Lanzado',
                    'proximamente'  => 'Próximamente',
                ],
                'default_value' => 'desarrollo',
            ],
            [
                'key'          => 'field_juego_fecha',
                'label'        => 'Fecha / Año de Lanzamiento',
                'name'         => 'juego_fecha',
                'type'         => 'text',
                'placeholder'  => 'Ej: 2025 · Q4',
                'instructions' => 'Fecha estimada o real de lanzamiento.',
            ],
            [
                'key'          => 'field_juego_resumen',
                'label'        => 'Resumen / Sinopsis',
                'name'         => 'juego_resumen',
                'type'         => 'textarea',
                'rows'         => 5,
                'instructions' => 'Descripción del juego. Aparece en la sección de sinopsis.',
            ],
            // Plataformas
            [
                'key'           => 'field_juego_plataforma_steam',
                'label'         => 'PC — Steam',
                'name'          => 'juego_plataforma_steam',
                'type'          => 'true_false',
                'ui'            => 1,
                'default_value' => 0,
            ],
            [
                'key'           => 'field_juego_plataforma_ps5',
                'label'         => 'PlayStation 5',
                'name'          => 'juego_plataforma_ps5',
                'type'          => 'true_false',
                'ui'            => 1,
                'default_value' => 0,
            ],
            [
                'key'           => 'field_juego_plataforma_xbox',
                'label'         => 'Xbox',
                'name'          => 'juego_plataforma_xbox',
                'type'          => 'true_false',
                'ui'            => 1,
                'default_value' => 0,
            ],
            [
                'key'           => 'field_juego_plataforma_switch',
                'label'         => 'Nintendo Switch',
                'name'          => 'juego_plataforma_switch',
                'type'          => 'true_false',
                'ui'            => 1,
                'default_value' => 0,
            ],
            // URLs de tiendas
            [
                'key'          => 'field_juego_steam_url',
                'label'        => 'URL de Steam',
                'name'         => 'juego_steam_url',
                'type'         => 'url',
                'placeholder'  => 'https://store.steampowered.com/app/...',
                'instructions' => '(Opcional) Al hacer clic en el badge de Steam redirige aquí.',
            ],
            [
                'key'          => 'field_juego_ps5_url',
                'label'        => 'URL de PlayStation Store',
                'name'         => 'juego_ps5_url',
                'type'         => 'url',
                'placeholder'  => 'https://store.playstation.com/...',
                'instructions' => '(Opcional) Al hacer clic en el badge de PS5 redirige aquí.',
            ],
            [
                'key'          => 'field_juego_xbox_url',
                'label'        => 'URL de Xbox Store',
                'name'         => 'juego_xbox_url',
                'type'         => 'url',
                'placeholder'  => 'https://www.xbox.com/games/...',
                'instructions' => '(Opcional) Al hacer clic en el badge de Xbox redirige aquí.',
            ],
            [
                'key'          => 'field_juego_switch_url',
                'label'        => 'URL de Nintendo eShop',
                'name'         => 'juego_switch_url',
                'type'         => 'url',
                'placeholder'  => 'https://www.nintendo.com/store/...',
                'instructions' => '(Opcional) Al hacer clic en el badge de Switch redirige aquí.',
            ],
            [
                'key'          => 'field_juego_trailer_url',
                'label'        => 'URL del Tráiler (YouTube)',
                'name'         => 'juego_trailer_url',
                'type'         => 'url',
                'placeholder'  => 'https://www.youtube.com/watch?v=...',
                'instructions' => '(Opcional) Enlace de YouTube. Aparece como video embed.',
            ],
            // Features (6 fijas)
            [
                'key'          => 'field_juego_feature_1_titulo',
                'label'        => 'Característica 1 — Título',
                'name'         => 'juego_feature_1_titulo',
                'type'         => 'text',
                'placeholder'  => 'Ej: Gestión de Granja',
            ],
            [
                'key'          => 'field_juego_feature_1_desc',
                'label'        => 'Característica 1 — Descripción',
                'name'         => 'juego_feature_1_desc',
                'type'         => 'textarea',
                'rows'         => 2,
            ],
            [
                'key'          => 'field_juego_feature_2_titulo',
                'label'        => 'Característica 2 — Título',
                'name'         => 'juego_feature_2_titulo',
                'type'         => 'text',
            ],
            [
                'key'          => 'field_juego_feature_2_desc',
                'label'        => 'Característica 2 — Descripción',
                'name'         => 'juego_feature_2_desc',
                'type'         => 'textarea',
                'rows'         => 2,
            ],
            [
                'key'          => 'field_juego_feature_3_titulo',
                'label'        => 'Característica 3 — Título',
                'name'         => 'juego_feature_3_titulo',
                'type'         => 'text',
            ],
            [
                'key'          => 'field_juego_feature_3_desc',
                'label'        => 'Característica 3 — Descripción',
                'name'         => 'juego_feature_3_desc',
                'type'         => 'textarea',
                'rows'         => 2,
            ],
            [
                'key'          => 'field_juego_feature_4_titulo',
                'label'        => 'Característica 4 — Título',
                'name'         => 'juego_feature_4_titulo',
                'type'         => 'text',
            ],
            [
                'key'          => 'field_juego_feature_4_desc',
                'label'        => 'Característica 4 — Descripción',
                'name'         => 'juego_feature_4_desc',
                'type'         => 'textarea',
                'rows'         => 2,
            ],
            [
                'key'          => 'field_juego_feature_5_titulo',
                'label'        => 'Característica 5 — Título',
                'name'         => 'juego_feature_5_titulo',
                'type'         => 'text',
            ],
            [
                'key'          => 'field_juego_feature_5_desc',
                'label'        => 'Característica 5 — Descripción',
                'name'         => 'juego_feature_5_desc',
                'type'         => 'textarea',
                'rows'         => 2,
            ],
            [
                'key'          => 'field_juego_feature_6_titulo',
                'label'        => 'Característica 6 — Título',
                'name'         => 'juego_feature_6_titulo',
                'type'         => 'text',
            ],
            [
                'key'          => 'field_juego_feature_6_desc',
                'label'        => 'Característica 6 — Descripción',
                'name'         => 'juego_feature_6_desc',
                'type'         => 'textarea',
                'rows'         => 2,
            ],
            // Galería — imágenes individuales (ACF Free compatible)
            [
                'key'          => 'field_juego_galeria_nota',
                'label'        => 'Galería de Imágenes',
                'name'         => '',
                'type'         => 'message',
                'message'      => 'Sube hasta 10 capturas de pantalla o artwork del juego.',
            ],
            [
                'key'           => 'field_juego_img_1',
                'label'         => 'Imagen 1',
                'name'          => 'juego_img_1',
                'type'          => 'image',
                'return_format' => 'array',
                'preview_size'  => 'medium',
            ],
            [
                'key'           => 'field_juego_img_2',
                'label'         => 'Imagen 2',
                'name'          => 'juego_img_2',
                'type'          => 'image',
                'return_format' => 'array',
                'preview_size'  => 'medium',
            ],
            [
                'key'           => 'field_juego_img_3',
                'label'         => 'Imagen 3',
                'name'          => 'juego_img_3',
                'type'          => 'image',
                'return_format' => 'array',
                'preview_size'  => 'medium',
            ],
            [
                'key'           => 'field_juego_img_4',
                'label'         => 'Imagen 4',
                'name'          => 'juego_img_4',
                'type'          => 'image',
                'return_format' => 'array',
                'preview_size'  => 'medium',
            ],
            [
                'key'           => 'field_juego_img_5',
                'label'         => 'Imagen 5',
                'name'          => 'juego_img_5',
                'type'          => 'image',
                'return_format' => 'array',
                'preview_size'  => 'medium',
            ],
            [
                'key'           => 'field_juego_img_6',
                'label'         => 'Imagen 6',
                'name'          => 'juego_img_6',
                'type'          => 'image',
                'return_format' => 'array',
                'preview_size'  => 'medium',
            ],
            [
                'key'           => 'field_juego_img_7',
                'label'         => 'Imagen 7',
                'name'          => 'juego_img_7',
                'type'          => 'image',
                'return_format' => 'array',
                'preview_size'  => 'medium',
            ],
            [
                'key'           => 'field_juego_img_8',
                'label'         => 'Imagen 8',
                'name'          => 'juego_img_8',
                'type'          => 'image',
                'return_format' => 'array',
                'preview_size'  => 'medium',
            ],
            [
                'key'           => 'field_juego_img_9',
                'label'         => 'Imagen 9',
                'name'          => 'juego_img_9',
                'type'          => 'image',
                'return_format' => 'array',
                'preview_size'  => 'medium',
            ],
            [
                'key'           => 'field_juego_img_10',
                'label'         => 'Imagen 10',
                'name'          => 'juego_img_10',
                'type'          => 'image',
                'return_format' => 'array',
                'preview_size'  => 'medium',
            ],
            // Galería — videos de YouTube
            [
                'key'          => 'field_juego_galeria_video_1',
                'label'        => 'Galería — Video 1 (YouTube)',
                'name'         => 'juego_galeria_video_1',
                'type'         => 'url',
                'placeholder'  => 'https://www.youtube.com/watch?v=...',
                'instructions' => '(Opcional) URL de YouTube. Aparece en la galería junto a las imágenes.',
            ],
            [
                'key'          => 'field_juego_galeria_video_2',
                'label'        => 'Galería — Video 2 (YouTube)',
                'name'         => 'juego_galeria_video_2',
                'type'         => 'url',
                'placeholder'  => 'https://www.youtube.com/watch?v=...',
            ],
            [
                'key'          => 'field_juego_galeria_video_3',
                'label'        => 'Galería — Video 3 (YouTube)',
                'name'         => 'juego_galeria_video_3',
                'type'         => 'url',
                'placeholder'  => 'https://www.youtube.com/watch?v=...',
            ],
            [
                'key'          => 'field_juego_galeria_video_4',
                'label'        => 'Galería — Video 4 (YouTube)',
                'name'         => 'juego_galeria_video_4',
                'type'         => 'url',
                'placeholder'  => 'https://www.youtube.com/watch?v=...',
            ],
        ],
        'location' => [
            [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'juego' ] ],
        ],
        'position'              => 'normal',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
    ] );

    // ── FAQ ──────────────────────────────────────────────────────────────────
    acf_add_local_field_group( [
        'key'    => 'group_pregunta_faq',
        'title'  => 'Datos de la Pregunta',
        'fields' => [
            [
                'key'          => 'field_faq_orden',
                'label'        => 'Orden de aparición',
                'name'         => 'orden',
                'type'         => 'number',
                'default_value' => 10,
                'min'          => 1,
                'instructions' => 'Número para ordenar las preguntas. Menor número = aparece primero.',
            ],
        ],
        'location' => [
            [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'pregunta-faq' ] ],
        ],
        'position'              => 'side',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
    ] );
} );


// ═══════════════════════════════════════════════════════════════════════════════
// THEME SETUP
// ═══════════════════════════════════════════════════════════════════════════════

add_action( 'after_setup_theme', function () {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'gallery', 'caption' ] );

    register_nav_menus( [
        'primary' => __( 'Menú Principal', 'karman-studios' ),
        'footer'  => __( 'Menú Footer',    'karman-studios' ),
    ] );
} );


// ═══════════════════════════════════════════════════════════════════════════════
// ENQUEUE ASSETS
// ═══════════════════════════════════════════════════════════════════════════════

add_action( 'wp_enqueue_scripts', function () {

    // Google Fonts: Spectral SC (títulos) + Inter (cuerpo)
    wp_enqueue_style(
        'karman-google-fonts',
        'https://fonts.googleapis.com/css2?family=Spectral+SC:wght@400;700;800&family=Inter:wght@300;400;500;600;700&display=swap',
        [],
        null
    );

    // Main CSS
    wp_enqueue_style(
        'karman-styles',
        get_template_directory_uri() . '/css/styles.css',
        [ 'karman-google-fonts' ],
        '1.0.0'
    );

    // Main JS (footer, deferred)
    wp_enqueue_script(
        'karman-main',
        get_template_directory_uri() . '/js/main.js',
        [],
        '1.0.0',
        true
    );

    wp_script_add_data( 'karman-main', 'defer', true );

    // Pass data to JS
    wp_localize_script( 'karman-main', 'karmanVars', [
        'ajaxUrl'    => admin_url( 'admin-ajax.php' ),
        'siteUrl'    => home_url( '/' ),
        'uploadsUrl' => content_url( '/uploads' ),
    ] );
} );

// Blog CSS — carga solo en páginas del blog
add_action( 'wp_enqueue_scripts', function () {
    if ( is_home() || is_singular( 'post' ) || is_category() || is_tag() || is_date() || is_archive() ) {
        wp_enqueue_style(
            'karman-blog',
            get_template_directory_uri() . '/css/blog.css',
            [ 'karman-styles' ],
            '1.0.0'
        );
    }
} );


// ═══════════════════════════════════════════════════════════════════════════════
// HELPERS
// ═══════════════════════════════════════════════════════════════════════════════

/**
 * Devuelve class="active" si el link de nav corresponde a la página actual.
 */
function karman_nav_class( string $slug ): string {
    if ( $slug === 'home' && is_front_page() ) return ' class="active"';
    if ( $slug === 'noticias' && ( is_home() || is_singular( 'post' ) || is_category() || is_tag() || is_date() ) ) return ' class="active"';
    if ( $slug !== 'home' && $slug !== 'noticias' && is_page( $slug ) ) return ' class="active"';
    return '';
}

/**
 * Accede a una opción del panel de ajustes del tema.
 */
function karman_opt( string $key, string $default = '' ): string {
    $opts = get_option( 'karman_options', [] );
    return ! empty( $opts[ $key ] ) ? $opts[ $key ] : $default;
}

/**
 * Convierte una URL de YouTube o Vimeo en una URL de embed.
 */
function karman_get_video_embed( string $url ): string {
    if ( empty( $url ) ) return '';

    // YouTube: watch?v=ID  o  youtu.be/ID  o  /shorts/ID
    if ( preg_match( '/(?:youtube\.com\/(?:watch\?v=|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $m ) ) {
        return 'https://www.youtube.com/embed/' . $m[1] . '?autoplay=1&rel=0';
    }

    // Vimeo: vimeo.com/ID
    if ( preg_match( '/vimeo\.com\/(\d+)/', $url, $m ) ) {
        return 'https://player.vimeo.com/video/' . $m[1] . '?autoplay=1';
    }

    return $url;
}

/**
 * Extrae la miniatura de un video de YouTube o Vimeo.
 */
function karman_get_video_thumbnail( string $url ): string {
    if ( preg_match( '/(?:youtube\.com\/(?:watch\?v=|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $m ) ) {
        return 'https://img.youtube.com/vi/' . $m[1] . '/maxresdefault.jpg';
    }
    return '';
}

/**
 * Calcula el tiempo estimado de lectura de un post.
 */
function karman_reading_time( int $post_id = 0 ): int {
    $post_id  = $post_id ?: get_the_ID();
    $content  = get_post_field( 'post_content', $post_id );
    $word_count = str_word_count( wp_strip_all_tags( $content ) );
    return max( 1, (int) ceil( $word_count / 200 ) );
}

/**
 * Devuelve un array con las redes sociales configuradas [ 'red' => 'url' ].
 */
function karman_social_links(): array {
    $networks = [ 'youtube', 'twitter', 'twitch', 'discord', 'instagram', 'tiktok', 'facebook' ];
    $links    = [];
    foreach ( $networks as $net ) {
        $url = karman_opt( $net );
        if ( $url ) $links[ $net ] = $url;
    }
    return $links;
}

/**
 * Renderiza los iconos SVG inline de redes sociales.
 * Evita dependencias de Font Awesome manteniendo la restricción de CSS puro.
 */
function karman_social_icon_svg( string $network ): string {
    $icons = [
        'youtube'   => '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M23.5 6.2a3 3 0 0 0-2.1-2.1C19.5 3.6 12 3.6 12 3.6s-7.5 0-9.4.5A3 3 0 0 0 .5 6.2 31.4 31.4 0 0 0 0 12a31.4 31.4 0 0 0 .5 5.8 3 3 0 0 0 2.1 2.1c1.9.5 9.4.5 9.4.5s7.5 0 9.4-.5a3 3 0 0 0 2.1-2.1A31.4 31.4 0 0 0 24 12a31.4 31.4 0 0 0-.5-5.8zM9.7 15.5V8.5l6.3 3.5-6.3 3.5z"/></svg>',
        'twitter'   => '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18.3 2h3.4L14.3 9.9 23 22h-6.9l-5-6.7L5 22H1.6l8-9.3L1 2h7.1l4.5 6.1L18.3 2zM17.1 20h1.9L7 3.9H5L17.1 20z"/></svg>',
        'twitch'    => '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M11.6 5.5H13v4.5h-1.4V5.5zm3.9 0H17v4.5h-1.5V5.5zM2.4 0L1 3.4V21h5.9v3h3.3l3-3h4.5L24 14.5V0H2.4zm19.1 13.6-3.5 3.5h-5.4l-3 3v-3H4.4V1.5h17.1v12.1z"/></svg>',
        'discord'   => '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20.3 4.4A19.7 19.7 0 0 0 15.5 3c-.2.4-.5.9-.6 1.3a18.3 18.3 0 0 0-5.8 0C9 3.9 8.6 3.4 8.4 3A19.6 19.6 0 0 0 3.7 4.4 20.8 20.8 0 0 0 .1 18a19.8 19.8 0 0 0 6 3.1c.5-.7.9-1.4 1.3-2.2-.7-.3-1.4-.6-2-1l.5-.4a14.1 14.1 0 0 0 12.2 0l.5.4c-.7.4-1.4.7-2.1 1 .4.8.8 1.5 1.3 2.2a19.7 19.7 0 0 0 6-3.1A20.7 20.7 0 0 0 20.3 4.4zM8 15.1c-1.2 0-2.3-1.1-2.3-2.6S6.7 9.9 8 9.9s2.3 1.1 2.3 2.6S9.3 15.1 8 15.1zm8 0c-1.3 0-2.3-1.1-2.3-2.6s1-2.6 2.3-2.6 2.3 1.1 2.3 2.6-1 2.6-2.3 2.6z"/></svg>',
        'instagram' => '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 0C8.74 0 8.33.015 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.88 1.44 1.44 0 000-2.88z"/></svg>',
        'tiktok'    => '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M19.6 3.3A4.7 4.7 0 0 1 15 0h-3.6v16.4a2.8 2.8 0 1 1-1.9-2.6V10a6.4 6.4 0 1 0 5.5 6.4V8.2a8.2 8.2 0 0 0 4.8 1.5V6.2a4.7 4.7 0 0 1-0.2-.9z"/></svg>',
        'facebook'  => '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987H7.898V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>',
    ];
    return $icons[ $network ] ?? '';
}


// ═══════════════════════════════════════════════════════════════════════════════
// BLOG SETTINGS
// ═══════════════════════════════════════════════════════════════════════════════

add_filter( 'excerpt_length', function () { return 22; }, 999 );
add_filter( 'excerpt_more',   function () { return '...'; } );


// ═══════════════════════════════════════════════════════════════════════════════
// ADMIN OPTIONS PANEL
// ═══════════════════════════════════════════════════════════════════════════════

add_action( 'admin_menu', function () {
    add_menu_page(
        'Ajustes Karman Studios',
        'Karman Studios',
        'manage_options',
        'karman-settings',
        'karman_settings_page',
        'dashicons-admin-generic',
        3
    );
} );

add_action( 'admin_init', function () {
    register_setting( 'karman_options_group', 'karman_options', [
        'sanitize_callback' => 'karman_sanitize_options',
    ] );
} );

add_action( 'admin_enqueue_scripts', function ( $hook ) {
    if ( $hook === 'toplevel_page_karman-settings' ) {
        wp_enqueue_media();
    }
} );

function karman_sanitize_options( array $input ): array {
    $clean = [];
    $urls        = [ 'youtube', 'twitter', 'twitch', 'discord', 'instagram', 'tiktok', 'facebook' ];
    $texts       = [ 'email_1', 'email_2', 'hero_cta_text', 'hero_cta_url', 'telefono' ];
    $checkboxes  = [ 'plat_steam', 'plat_xbox', 'plat_playstation', 'plat_nintendo' ];
    $logo_urls   = [ 'plat_steam_logo', 'plat_xbox_logo', 'plat_playstation_logo', 'plat_nintendo_logo' ];

    foreach ( $urls       as $k ) $clean[ $k ] = isset( $input[ $k ] ) ? esc_url_raw( $input[ $k ] )        : '';
    foreach ( $texts      as $k ) $clean[ $k ] = isset( $input[ $k ] ) ? sanitize_text_field( $input[ $k ] ) : '';
    foreach ( $checkboxes as $k ) $clean[ $k ] = ! empty( $input[ $k ] ) ? '1' : '';
    foreach ( $logo_urls  as $k ) $clean[ $k ] = isset( $input[ $k ] ) ? esc_url_raw( $input[ $k ] )        : '';

    if ( ! empty( $input['email_1'] ) ) $clean['email_1'] = sanitize_email( $input['email_1'] );
    if ( ! empty( $input['email_2'] ) ) $clean['email_2'] = sanitize_email( $input['email_2'] );

    return $clean;
}

function karman_settings_page(): void { ?>
<div class="wrap">
    <h1 style="display:flex;align-items:center;gap:10px;">
        <span style="font-size:1.8rem;">&#9670;</span> Ajustes Karman Studios
    </h1>
    <form method="post" action="options.php">
        <?php settings_fields( 'karman_options_group' ); ?>
        <?php $o = get_option( 'karman_options', [] ); ?>

        <h2 class="title">Redes Sociales</h2>
        <table class="form-table" role="presentation">
            <tr>
                <th><label for="ks_youtube">YouTube</label></th>
                <td><input type="url" id="ks_youtube" name="karman_options[youtube]" value="<?php echo esc_attr( $o['youtube'] ?? '' ); ?>" class="regular-text" placeholder="https://youtube.com/@..."></td>
            </tr>
            <tr>
                <th><label for="ks_twitter">Twitter / X</label></th>
                <td><input type="url" id="ks_twitter" name="karman_options[twitter]" value="<?php echo esc_attr( $o['twitter'] ?? '' ); ?>" class="regular-text" placeholder="https://x.com/..."></td>
            </tr>
            <tr>
                <th><label for="ks_instagram">Instagram</label></th>
                <td><input type="url" id="ks_instagram" name="karman_options[instagram]" value="<?php echo esc_attr( $o['instagram'] ?? '' ); ?>" class="regular-text" placeholder="https://instagram.com/..."></td>
            </tr>
            <tr>
                <th><label for="ks_tiktok">TikTok</label></th>
                <td><input type="url" id="ks_tiktok" name="karman_options[tiktok]" value="<?php echo esc_attr( $o['tiktok'] ?? '' ); ?>" class="regular-text" placeholder="https://tiktok.com/@..."></td>
            </tr>
            <tr>
                <th><label for="ks_twitch">Twitch</label></th>
                <td><input type="url" id="ks_twitch" name="karman_options[twitch]" value="<?php echo esc_attr( $o['twitch'] ?? '' ); ?>" class="regular-text" placeholder="https://twitch.tv/..."></td>
            </tr>
            <tr>
                <th><label for="ks_discord">Discord</label></th>
                <td><input type="url" id="ks_discord" name="karman_options[discord]" value="<?php echo esc_attr( $o['discord'] ?? '' ); ?>" class="regular-text" placeholder="https://discord.gg/..."></td>
            </tr>
            <tr>
                <th><label for="ks_facebook">Facebook</label></th>
                <td><input type="url" id="ks_facebook" name="karman_options[facebook]" value="<?php echo esc_attr( $o['facebook'] ?? '' ); ?>" class="regular-text" placeholder="https://facebook.com/..."></td>
            </tr>
        </table>

        <h2 class="title">Contacto</h2>
        <table class="form-table" role="presentation">
            <tr>
                <th><label for="ks_telefono">Teléfono <small>(con código de país)</small></label></th>
                <td><input type="text" id="ks_telefono" name="karman_options[telefono]" value="<?php echo esc_attr( $o['telefono'] ?? '' ); ?>" class="regular-text" placeholder="+505 8888-8888"></td>
            </tr>
            <tr>
                <th><label for="ks_email1">Correo principal</label></th>
                <td><input type="email" id="ks_email1" name="karman_options[email_1]" value="<?php echo esc_attr( $o['email_1'] ?? '' ); ?>" class="regular-text" placeholder="info@karmanstudios.com"></td>
            </tr>
            <tr>
                <th><label for="ks_email2">Correo secundario <small>(opcional)</small></label></th>
                <td><input type="email" id="ks_email2" name="karman_options[email_2]" value="<?php echo esc_attr( $o['email_2'] ?? '' ); ?>" class="regular-text" placeholder="prensa@karmanstudios.com"></td>
            </tr>
        </table>

        <h2 class="title">Hero — Botón Principal</h2>
        <table class="form-table" role="presentation">
            <tr>
                <th><label for="ks_cta_text">Texto del botón</label></th>
                <td><input type="text" id="ks_cta_text" name="karman_options[hero_cta_text]" value="<?php echo esc_attr( $o['hero_cta_text'] ?? 'Explorar Juegos' ); ?>" class="regular-text"></td>
            </tr>
            <tr>
                <th><label for="ks_cta_url">URL del botón</label></th>
                <td><input type="url" id="ks_cta_url" name="karman_options[hero_cta_url]" value="<?php echo esc_attr( $o['hero_cta_url'] ?? '' ); ?>" class="regular-text" placeholder="https://..."></td>
            </tr>
        </table>

        <h2 class="title">Plataformas</h2>
        <p class="description" style="margin-bottom:12px;">Activa las plataformas en las que Karman Studios publica sus juegos. Aparecen en el Hero y en la sección de Plataformas de la página de inicio. Sube el logo que se mostrará en la tarjeta de cada plataforma.</p>
        <?php
        $plat_defs = [
            'plat_steam'       => 'PC — Steam',
            'plat_xbox'        => 'Xbox',
            'plat_playstation' => 'PlayStation',
            'plat_nintendo'    => 'Nintendo Switch',
        ];
        ?>
        <table class="form-table" role="presentation">
            <?php foreach ( $plat_defs as $key => $label ) :
                $logo_key  = $key . '_logo';
                $logo_val  = $o[ $logo_key ] ?? '';
                $input_id  = 'ks_' . $logo_key;
                $preview_id = 'ks_prev_' . $key;
            ?>
            <tr>
                <th><?php echo esc_html( $label ); ?></th>
                <td>
                    <label style="display:block;margin-bottom:10px;">
                        <input type="checkbox" name="karman_options[<?php echo esc_attr( $key ); ?>]" value="1" <?php checked( '1', $o[ $key ] ?? '' ); ?>>
                        Habilitado
                    </label>
                    <img id="<?php echo esc_attr( $preview_id ); ?>"
                         src="<?php echo esc_url( $logo_val ); ?>"
                         style="max-height:56px;display:<?php echo $logo_val ? 'block' : 'none'; ?>;margin-bottom:8px;border-radius:4px;background:#1a1a2e;padding:6px;">
                    <input type="hidden"
                           id="<?php echo esc_attr( $input_id ); ?>"
                           name="karman_options[<?php echo esc_attr( $logo_key ); ?>]"
                           value="<?php echo esc_attr( $logo_val ); ?>">
                    <button type="button" class="button ks-media-btn"
                            data-input="<?php echo esc_attr( $input_id ); ?>"
                            data-preview="<?php echo esc_attr( $preview_id ); ?>">
                        <?php echo $logo_val ? 'Cambiar logo' : 'Seleccionar logo'; ?>
                    </button>
                    <?php if ( $logo_val ) : ?>
                    <button type="button" class="button ks-media-remove"
                            data-input="<?php echo esc_attr( $input_id ); ?>"
                            data-preview="<?php echo esc_attr( $preview_id ); ?>">
                        Quitar
                    </button>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <script>
        jQuery(function($){
            $(document).on('click', '.ks-media-btn', function(e){
                e.preventDefault();
                var btn      = $(this);
                var inputId  = btn.data('input');
                var prevId   = btn.data('preview');
                var frame    = wp.media({ title: 'Seleccionar logo', button: { text: 'Usar este logo' }, multiple: false, library: { type: 'image' } });
                frame.on('select', function(){
                    var att = frame.state().get('selection').first().toJSON();
                    $('#' + inputId).val(att.url);
                    $('#' + prevId).attr('src', att.url).show();
                    btn.text('Cambiar logo');
                });
                frame.open();
            });
            $(document).on('click', '.ks-media-remove', function(e){
                e.preventDefault();
                var btn = $(this);
                $('#' + btn.data('input')).val('');
                $('#' + btn.data('preview')).attr('src','').hide();
            });
        });
        </script>

        <?php submit_button( 'Guardar Cambios' ); ?>
    </form>
</div>
<?php }
