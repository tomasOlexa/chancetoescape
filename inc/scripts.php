<?php
/* -------------------------- Load theme scripts -------------------------- */
function theme_scripts()
{

    wp_enqueue_style('main-style', fullTemplateUri('assets/css/main.min.css'), [], filemtime(fullTemplatePath('assets/css/main.min.css')));
    wp_enqueue_style('custom-style', fullTemplateUri('assets/css/custom.css'), [], filemtime(fullTemplatePath('assets/css/custom.css')));
   
    wp_enqueue_script('vendor', fullTemplateUri('assets/js/vendor.js'), [], filemtime(fullTemplatePath('assets/js/vendor.js')), true);
    
    wp_enqueue_script('main', fullTemplateUri('assets/js/main.js'), [], filemtime(fullTemplatePath('assets/js/main.js')), true);
    wp_enqueue_script('book', fullTemplateUri('assets/js/book.js'), [], filemtime(fullTemplatePath('assets/js/book.js')), true);

}

add_action('wp_enqueue_scripts', 'theme_scripts');

/* -------------------------- Remove type tag from script and style -------------------------- */
add_filter('style_loader_tag', 'codeless_remove_type_attr', 10, 2);
add_filter('script_loader_tag', 'codeless_remove_type_attr', 10, 2);
add_filter('autoptimize_html_after_minify', 'codeless_remove_type_attr', 10, 2);

function codeless_remove_type_attr($tag, $handle)
{
    return preg_replace("/type=['\"]text\/(javascript|css)['\"]/", '', $tag);
}

add_action(
    'after_setup_theme',
    function() {
        add_theme_support( 'html5', [ 'script', 'style' ] );
    }
);

