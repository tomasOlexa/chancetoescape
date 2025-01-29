<?php
/* -------------------------- CPT -------------------------- */
function cpt_register()
{   
    //CPT name
    $labels_services = array(
        'name' => __('Room', 'escaperoomssahul'),
        'singular_name' => __('Room', 'escaperoomssahul'),
        'add_new' => __('Add new', 'escaperoomssahul'),
        'add_new_item' => __('Add new item', 'escaperoomssahul'),
        'edit_item' => __('Edit item', 'escaperoomssahul'),
        'new_item' => __('New item', 'escaperoomssahul'),
        'view_item' => __('View item', 'escaperoomssahul'),
        'search_items' => __('Search item', 'escaperoomssahul'),
        'not_found' => __('Nothing was found', 'escaperoomssahul'),
        'not_found_in_trash' => __('There is nothing in the trash', 'escaperoomssahul'),
        'parent_item_colon' => ''
    );

    $args_services = array(
        'hierarchical' => true,
        'labels' => $labels_services,
        'public' => true,
        'has_archive' => true,
        'show_ui' => true,
        'supports' => array(
            'title',
            'editor',
            'page-attributes',
            'author'
        ),
        'menu_icon' => 'dashicons-admin-network',
        'rewrite' => array( 'slug' => 'rooms', 'with_front' => false ),
    );

    register_post_type('rooms', $args_services);
}
add_action('init', 'cpt_register');