<?php
/**
 * AJAX handler that returns all the posts matching given criteria
 */
function loadmore_handler_ajax_name() {
    //Argument for query
    
    $limit = 4;
    $args1 = array(
        'post_type' =>  $_GET['loadmore'],
        'posts_per_page' => $limit+1,
        'offset' => (int) $_GET['offset'],
        'orderby' => 'relevance',
        'order' => 'DESC',
        's' => $_GET['loadmoreTerm']
    );


    $posts = get_posts($args1); 
    $no_more = (count($posts) <= $limit);
    
    $args2 = array(
        'post_type' =>  $_GET['loadmore'],
        'posts_per_page' => $limit,
        'offset' => (int) $_GET['offset'],
        'orderby' => 'relevance',
        'order' => 'DESC',
        's' => $_GET['loadmoreTerm']
    );

    $my_query = new WP_Query( $args2 );

    //Queried article
    if ( $my_query->have_posts() ):
        while ( $my_query->have_posts() ):
            $my_query->the_post();?>
            <!-- Grid item -->
            <?php get_template_part('/template-parts/item'); ?>   
       <?php 
       endwhile;
    endif;
    
    wp_reset_postdata();

    //Check if has product  
    if ($no_more) : ?>
        <div class="no-more">&nbsp;</div>
    <?php endif;
    exit;
}

add_action('wp_ajax_loadmore_ajax_name', 'loadmore_handler_ajax_name');
add_action('wp_ajax_nopriv_loadmore_ajax_name', 'loadmore_handler_ajax_name');