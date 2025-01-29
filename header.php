<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#fafafa">


     	<?php wp_head();?>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">


        <script>
            document.documentElement.className = 'js';
            
            if (!'IntersectionObserver' in window &&
                !'IntersectionObserverEntry' in window &&
                !'intersectionRatio' in window.IntersectionObserverEntry.prototype) {
                    document.documentElement.classList.add("no-observer");
            } else document.documentElement.classList.add("observer");

            var BASE_URL_ASSETS = 'assets/',
                BASE_LANG = 'sk-SK';
        </script> 

    </head>
    
    <body class="">  

        <div class="container">

            <header class="header">

                <button type="button" class="header_cover toggle-menu hide_lg"></button>

                <div class="header_inner">
                    <nav class="nav">
                        <ul id="menu-primary-menu" class="topmenu">
                            <?php 
                                $menu_option = get_field('menu_option','option');
                                foreach($menu_option as $menu):
                                    ?>
                                    <li id="menu-item-48" class="menu-item menu-item-type-post_type menu-item-object-page">
                                        <a href="#<?php echo$menu['slug'];?>"><?php echo$menu['title'];?></a>
                                    </li>
                                    <?php
                                endforeach;
                            ?>
                        </ul>
                    </nav>
                </div>    

                <button type="button" class="header_button toggle-menu hide_lg">
                    <span class="icon_menu">
                        <i></i>
                        <i></i>
                        <i></i>
                    </span>
                </button>

            </header>