<?php

require_once('walker/CommentWalker.php');
require_once('options/cron.php');

function montheme_supports()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    add_theme_support('html5');
    register_nav_menu('header', 'En tête du menu');
    register_nav_menu('footer', 'Pied de page');
    //register_nav_menus(); permet d'enregistrer directement plusieurs menus

    add_image_size('post-thumbnail', 350, 215, true);
}

function montheme_register_assets()
{
    wp_register_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css', []);
    wp_register_script('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', ['popper', 'jquery'], false, true);
    wp_register_script('popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', [], false, true);
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.4.1.slim.min.js', [], false, true);
    wp_enqueue_style('bootstrap');
    wp_enqueue_script('bootstrap');
    wp_register_style('perso', get_template_directory_uri() . '/css/custom.css');
    wp_enqueue_style('perso');
    wp_enqueue_style('photos', get_template_directory_uri() . '/css/photographies.css');
    wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js');
    wp_enqueue_script('icons', 'https://kit.fontawesome.com/1a226b5060.js');
}

add_action('wp_enqueue_scripts', 'montheme_register_assets');

function montheme_title_separator()
{
    return '|';
}
/*
function montheme_document_title_parts($title)
{
    return $title;
}
*/

function montheme_menu_class($classes)
{
    $classes[] = 'nav-item active';
    return $classes;
}
//On return car on est dans un filtre et non une action
//L'action permet d'ajouter une fonctionnalité
//Un filtre est une fonction qui reçoit un paramètre en entrée, le transforme, et renvoie le résultat de la transformation

function montheme_menu_link_class($attrs)
{
    $attrs['class'] = 'nav-link';
    return $attrs;
}
//On return car on est dans un filtre et non une action


function montheme_pagination()
{
    $pages = paginate_links(['type' => 'array']);
    if ($pages === null) {
        return;
    }
    echo '<nav aria-label="Pagination" class="my-4">';
    echo '<ul class="pagination">';
    foreach ($pages as $page) {
        $active = strpos($page, 'current') !== false;
        $class = 'page-item';
        if ($active) {
            $class .= 'active';
        }
        echo '<li class="' . $class . '">';
        echo  str_replace('page-numbers', 'page-link', $page);
        echo '</li>';
    }
    echo '</ul>';
    echo '</nav>';
}

function montheme_add_custom_box()
{
    add_meta_box('montheme_sponso', 'Sponsoring', 'montheme_render_sponso_box', 'post', 'side');
}



function montheme_init()
{
    register_taxonomy('sport', 'post', [
        'labels' => [
            'name' => 'Sport',
            'singular_name'     => 'Sport',
            'plural_name'       => 'Sports',
            'search_items'      => 'Rechercher des sports',
            'all_items'         => 'Tous les sports',
            'edit_item'         => 'Editer le sport',
            'update_item'       => 'Mettre à jour le sport',
            'add_new_item'      => 'Ajouter un nouveau sport',
            'new_item_name'     => 'Ajouter un nouveau sport',
            'menu_name'         => 'Sport',
        ],
        'show_in_rest' => true,
        'hierarchical' => true,
        'show_admin_column' => true,
    ]);
}

add_action('init', 'montheme_init');
add_action('after_setup_theme', 'montheme_supports');
add_action('wp_enqueue_scripts', 'montheme_register_assets');
add_filter('document_title_separator', 'montheme_title_separator');
/*add_filter('document_title_parts', 'montheme_document_title_parts');*/
add_filter('nav_menu_css_class', 'montheme_menu_class');
add_filter('nav_menu_link_attributes', 'montheme_menu_link_class');


require_once('metaboxes/sponso.php');
require_once('options/agence.php');

SponsoMetaBox::register();
AgenceMenuPage::register();


add_filter('manage_bien_posts_columns', function ($columns) {
    return [
        'cb' => $columns['cb'],
        'thumbnail' => 'Miniature',
        'title' => $columns['title'],
        'date' => $columns['date']
    ];
});

add_filter('manage_bien_posts_custom_column', function ($column, $postId) {
    if ($column === 'thumbnail') {
        the_post_thumbnail('thumbnail', $postId);
    }
}, 10, 2);

add_action('admin_enqueue_scripts', function () {
    wp_enqueue_style('admin_montheme', get_template_directory_uri() . '/assets/admin.css');
});

add_filter('manage_post_posts_columns', function ($columns) {
    $newColumns = [];
    foreach ($columns as $k => $v) {
        if ($k === 'date') {
            $newColumns['sponso'] = 'Article sponsorisé ?';
        }
        $newColumns[$k] = $v;
    }
    return $newColumns;
});

add_filter('manage_post_posts_custom_column', function ($column, $postId) {
    if ($column === 'sponso') {
        if (!empty(get_post_meta($postId, 'SponsoMetaBox::META_KEY', true))) {
            $class = 'yes';
        } else {
            $class = 'no';
        }
        echo '<div class="bullet bullet-' . $class . '"></div>';
    }
}, 10, 2);

/**
 * @param WP_Query $query
 */

function montheme_pre_get_posts($query)
{
    if (is_admin() || !is_search() || !$query->is_main_query()) {
        return;
    }
    if (get_query_var('sponso') === '1') {
        $meta_query = $query->get('meta_query', []);
        $meta_query[] = [
            'key' => SponsoMetaBox::META_KEY,
            'compare' => 'EXISTS',
        ];
        $query->set('meta_query', $meta_query);
    }
}

function montheme_query_vars($params)
{
    $params[] = 'sponso';
    return $params;
}

add_action('pre_get_posts', 'montheme_pre_get_posts');
add_filter('query_vars', 'montheme_query_vars');

require_once 'widgets/YoutubeWidget.php';

function montheme_register_widget()
{
    register_widget(YoutubeWidget::class);
    register_sidebar([
        'id' => 'homepage',
        'name' => __('Sidebar Accueil', 'montheme'),
        'before_widget' => '<div class="p-4 %2$s" id= "%1$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="font-italic">',       'after_title' => '</h4>'
    ]);
}
add_action('widgets_init', 'montheme_register_widget');

add_filter('comment_form_default_fields', function ($fields) {
    $fields['email'] = <<<HTML
    <div class="form-group"><label for="email">Email</label><input class="form-control" name="email" id="email" required></div>
    HTML;
    return $fields;
});

add_action('after_setup_theme', function () {
    load_theme_textdomain('montheme', get_template_directory() . '/languages');
});


