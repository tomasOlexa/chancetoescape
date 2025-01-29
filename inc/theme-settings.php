<?php
/* -------------------------- Theme setup -------------------------- */
function theme_setup()
{
    add_theme_support('title-tag');

    // menu settings
    register_nav_menus(array(
        'menu' => __('Main menu', 'chancetoescape'),
    ));
    
    // settings Page for theme
    if (function_exists('acf_add_options_page')) {
        $settingsPage = acf_add_options_page(array(
            'page_title' => __('Theme settings', 'chancetoescape'),
            'menu_title' => __('Theme settings', 'chancetoescape'),
            'menu_slug' => 'name-general-settings',
            'capability' => 'edit_posts',
            'autoload' => true,
            'post_id' => 'options',
            'redirect' => false,
            'position' => 4,
        ));
    }


    /* Set custom image size */
    add_image_size('page_header', 1680 );
    add_image_size('big_thumbnail', 500, 500 );
}
add_action('after_setup_theme', 'theme_setup');

/* -------------------------- Add search button to Admin -------------------------- */
if (!function_exists('custom_button')) {
    function custom_button($wp_admin_bar){
        $args = array(
            'id' => 'generate-search',
            'title' => _x('Hľadať', 'chancetoescape'),
            'href' => get_template_directory_uri() . '/export-search.php',
            'meta' => array(
                            'class' => 'generate-search'
                        )
        );
        
        $wp_admin_bar->add_node($args);
    }
        
    add_action('admin_bar_menu', 'custom_button', 50);
}

/* -------------------------- Rewrite rules -------------------------- */
add_action('init', function() {
    add_rewrite_rule(_x('blog', 'chancetoescape') . '/page/([0-9]{1,})/?$', 'index.php?post_type=post&page=$matches[1]', 'top');
    add_rewrite_rule(_x('blog', 'chancetoescape') . '/([^/]+)/page/?([0-9]{1,})/?$', 'index.php?category_name=$matches[1]&page=$matches[2]', 'top');
});

/* -------------------------- Disable XML-RPC -------------------------- */
add_filter('xmlrpc_enabled', '__return_false');

/* -------------------------- Define mime types -------------------------- */
function my_mime_types($mime_types){
    $mime_types['zip-added'] = 'application/octet-stream';
    $mime_types['zip'] = 'application/zip';
    $mime_types['rar'] = 'application/x-rar-compressed';
    $mime_types['tar'] = 'application/x-tar';
    $mime_types['gz'] = 'application/x-gzip';
    $mime_types['gzip'] = 'application/x-gzip';
    $mime_types['svg'] = 'image/svg+xml';
    $mime_types['xml'] = 'application/xml';
    return $mime_types;
}

add_filter('upload_mimes', 'my_mime_types', 1, 1);

function my_acf_json_save_point($path)
{
    return get_stylesheet_directory() . '/acf-json';
}
add_filter('acf/settings/save_json', 'my_acf_json_save_point');

/* -------------------------- Common SVG thumbanils -------------------------- */
add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {

    if (!$data['type']) {
        $wp_filetype = wp_check_filetype($filename, $mimes);
        $ext = $wp_filetype['ext'];
        $type = $wp_filetype['type'];
        $proper_filename = $filename;
        if ($type && str_starts_with($type, 'image/') && $ext !== 'svg') {
            $ext = $type = false;
        }
        $data['ext'] = $ext;
        $data['type'] = $type;
        $data['proper_filename'] = $proper_filename;
    }
    return $data;


}, 10, 4);

add_filter('upload_mimes', function ($mimes) {
    $mimes['svg'] = 'image/svg';
    return $mimes;
});
/* -------------------------- Pagination for post taxonomy -------------------------- */
function taxonomy_page_request($query_string )
{
    if( isset( $query_string['page'] ) ) {
        if( ''!=$query_string['page'] ) {
            if( isset( $query_string['name'] ) ) {
                unset( $query_string['name'] );
            }
        }
    }
    return $query_string;
}
add_filter('request', 'taxonomy_page_request');

add_action('pre_get_posts','taxonomy_pre_get_posts');
function taxonomy_pre_get_posts( $query ) { 
    if( $query->is_main_query() && !$query->is_feed() && !is_admin() ) { 
        $query->set( 'paged', str_replace( '/', '', get_query_var( 'page' ) ) ); 
    } 
}

/* -------------------------- Google maps -------------------------- */
function my_acf_init() {
    $api_key=get_field('google_maps_api', 'options');
    acf_update_setting('google_api_key', $api_key);
}
add_action('acf/init', 'my_acf_init');
function my_custom_scripts() {
    ?>
    <script type="text/javascript">
        document.addEventListener('wpcf7mailsent', function(event) {
            // Skrytie formulára
            var form = event.target;
            form.style.display = 'none';
            
            // Zobrazenie ďakovnej správy a tlačidla
            var messageContainer = document.createElement('div');
            messageContainer.innerHTML = `
                <p>Ďakujeme za vašu správu!</p>
                <button id="showFormBtn" class="btn_basic">Späť na formulár</button>
            `;
            form.parentNode.insertBefore(messageContainer, form.nextSibling);

            // Pridanie udalosti kliknutia na tlačidlo
            document.getElementById('showFormBtn').addEventListener('click', function() {
                form.style.display = 'block';
                messageContainer.style.display = 'none';
            });
        }, false);
    </script>
    <?php
}
add_action('wp_footer', 'my_custom_scripts');
