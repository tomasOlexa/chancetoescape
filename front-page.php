<?php get_header(); ?>
<!-- Main content -->
<div class="main">
    <div class="main_inner">
        
        <div class="box_hero">
            <div class="box_hero_content">
                <?php $home_hp = get_field('home_hp'); ?>
                <h1 class="title_h1 box_hero_title"><?php echo $home_hp['title'];?></h1>
                <div class="box_hero_text">
                    <?php echo $home_hp['text'];?>                    
                </div>
                <a href="#about" data-page-index="2" class="btn_basic mgt-20 text_uc"><?php echo $home_hp['btn'];?></a>
            </div>
        </div>

        <div class="box_book">
            <div class="box_book_sizer"></div>
            <div class="box_book_pages">

                <!-- PAGE -->
                <div class="box_book_page box_book_front" data-page="0" id="domov">
                    <div class="box_book_bg">
                        <?php show_image($home_hp['bg'], 'large', ''); ?>
                        
                    </div>
                    <div class="box_book_content">
                        <div class="box_book_front_top">
                            <span class="image-text-heading">Escape room</span>
                            <a href="<?php home_url();?>" title="" class="box_book_logo">
                                <?php show_image($home_hp['logo'], 'large', ''); ?>
                            </a>
                            <span class="image-text-bottom">Jána Jonáša 6183/13<br>841 08 Devínska Nová Ves</span>
                        </div>
                        <a href="#" data-page-index="2" class="box_book_corner">
                            <img src="<?php theme_url();?>assets/layout/page-corner.png" alt="" />
                        </a>
                    </div>
                </div>
                <?php $one_hp = get_field('one_hp'); ?>
                <!-- PAGE -->
                <div class="box_book_page" data-page="1">
                    <div class="box_book_content">
                        <div class="box_book_image">
                            <?php show_image($one_hp['img_left'], 'large', ''); ?>
                        </div>
                    </div>

                    <a href="#" title="" class="box_book_prev" data-page-index="0"></a>
                    <a href="#" title="" class="box_book_next" data-page-index="2"></a>
                </div>

                <!-- PAGE / ABOUT -->
                <div class="box_book_page" data-page="2" id="o-hre">
                    <div class="box_book_content pd-30 pd-20md">
                        <h2 class="title_h2 title_line">
                            <span><?php echo $one_hp['title'];?></span>
                        </h2> 

                        <div class="page_content reset_margins mgt-30">
                            <?php echo $one_hp['text'];?> 
                        </div>
                    </div>

                    <a href="#" title="" class="box_book_prev" data-page-index="0"></a>
                    <a href="#" title="" class="box_book_next" data-page-index="3"></a>
                </div>
                
                <!-- PAGE / Game E.B. Grófka -->
                <?php $two_hp = get_field('two_hp'); ?>
                <div class="box_book_page" data-page="3">
                    <div class="box_book_content">
                        <div class="box_book_image">
                            <?php show_image($two_hp['img_left'], 'large', ''); ?>
                        </div>
                    </div>

                    <a href="#" title="" class="box_book_prev" data-page-index="2"></a>
                    <a href="#" title="" class="box_book_next" data-page-index="4"></a>
                </div>

                <!-- PAGE / Game E.B. Grófka -->
                <div class="box_book_page" data-page="4" id="nase-hry">
                    <div class="box_book_content pd-30 pd-20md">
                        <h2 class="title_h2 title_line">
                            <span><?php echo $two_hp['title'];?></span>
                        </h2> 

                        <div class="page_content reset_margins mgt-30">
                            <?php echo $two_hp['text'];?> 
                        </div>
                    </div>

                    <a href="#" title="" class="box_book_prev" data-page-index="3"></a>
                    <a href="#" title="" class="box_book_next" data-page-index="5"></a>
                </div>

                <!-- PAGE / Game kým si spal -->
                <?php $two_hp_2 = get_field('two_hp_2'); ?>
                <div class="box_book_page" data-page="5">
                    <div class="box_book_content">
                        <div class="box_book_image">
                            <?php show_image($two_hp_2['img_left'], 'large', ''); ?>
                        </div>
                    </div>

                    <a href="#" title="" class="box_book_prev" data-page-index="4"></a>
                    <a href="#" title="" class="box_book_next" data-page-index="6"></a>
                </div>

                <!-- PAGE / Game kým si spal -->
                <div class="box_book_page" data-page="6" id="nase-hry">
                    <div class="box_book_content pd-30 pd-20md">
                        <h2 class="title_h2 title_line">
                            <span><?php echo $two_hp_2['title'];?></span>
                        </h2> 

                        <div class="page_content reset_margins mgt-30">
                            <?php echo $two_hp_2['text'];?> 
                        </div>
                    </div>

                    <a href="#" title="" class="box_book_prev" data-page-index="5"></a>
                    <a href="#" title="" class="box_book_next" data-page-index="7"></a>
                </div>

                <!-- PAGE / Price -->
                <?php $three_hp = get_field('three_hp');?>
                <div class="box_book_page" data-page="7" id="cennik">
                    <div class="box_book_content pd-30 pd-20md">
                        <h2 class="title_h2 title_line">
                            <span><?php echo $three_hp['left_title'];?></span>
                        </h2> 

                        <div class="page_content reset_margins mgt-30">
                            <?php echo $three_hp['teft_text'];?> 
                        </div>
                    </div>

                    <a href="#" title="" class="box_book_prev" data-page-index="6"></a>
                    <a href="#" title="" class="box_book_next" data-page-index="8"></a>
                </div>
                <!-- PAGE / RESERVATION -->
                <?php $three_hp = get_field('three_hp');?>
                <div class="box_book_page" data-page="8" id="rezervacie">
                    <div class="box_book_content pd-30 pd-20md">
                        <h2 class="title_h2 title_line">
                            <span><?php echo $three_hp['right_title'];?></span>
                        </h2> 
                        <div class="page_content reset_margins mgt-30">
                            <?php echo $three_hp['right_text']; ?>
                            <?php echo do_shortcode( $three_hp['form']);?>
                        </div>
                    </div>

                    <a href="#" title="" class="box_book_prev" data-page-index="7"></a>
                    <a href="#" title="" class="box_book_next" data-page-index="9"></a>
                </div>

                <!-- PAGE / Teambuilding -->
                <?php $four_hp = get_field('four_hp');?>
                <div class="box_book_page" data-page="9">
                    <div class="box_book_content pd-30 pd-20md">
                        <div class="box_book_image">
                            <?php show_image($four_hp['img_left'], 'large', ''); ?>
                        </div>
                    </div>

                    <a href="#" title="" class="box_book_prev" data-page-index="8"></a>
                    <a href="#" title="" class="box_book_next" data-page-index="10"></a>
                </div>
                
                <!-- PAGE / Teambuilding -->
                <div class="box_book_page" data-page="10" id="teambuilding">
                    <div class="box_book_content pd-30 pd-20md">
                        <h2 class="title_h2 title_line">
                            <span><?php echo $four_hp['title'];?></span>
                        </h2> 

                        <div class="page_content reset_margins mgt-30">
                            <?php echo $four_hp['text'];?> 
                        </div>
                    </div>

                    <a href="#" title="" class="box_book_prev" data-page-index="9"></a>
                    <a href="#" title="" class="box_book_next" data-page-index="11"></a>
                </div>

                <!-- PAGE / GIFT CARDS -->
                <?php $five_hp = get_field('five_hp');?>
                <div class="box_book_page" data-page="11" id="darovat-hru">
                    <div class="box_book_content pd-30 pd-20md">
                        <h2 class="title_h2 title_line">
                            <span><?php echo $five_hp['left_title'];?></span>
                        </h2> 

                        <div class="page_content reset_margins mgt-30">
                            <?php echo $five_hp['teft_text'];?> 
                        </div>
                    </div>

                    <a href="#" title="" class="box_book_prev" data-page-index="10"></a>
                    <a href="#" title="" class="box_book_next" data-page-index="12"></a>
                </div>

                <!-- PAGE / GIFT CARDS -->
                <div class="box_book_page" data-page="12">
                    <div class="box_book_content pd-30 pd-20md">
                        <h2 class="title_h2 title_line">
                            <span><?php echo $five_hp['left_title'];?></span>
                        </h2> 
                        <div class="page_content reset_margins mgt-30">
                            <h3>
                                <?php echo $five_hp['title_form'];?>
                            </h3>
                            <?php echo do_shortcode( $five_hp['form']);?>
                        </div>
                    </div>

                    <a href="#" title="" class="box_book_prev" data-page-index="11"></a>
                    <a href="#" title="" class="box_book_next" data-page-index="13"></a>
                </div>

                <!-- PAGE / FAQ -->
                <?php $six_hp = get_field('six_hp');?>
                <div class="box_book_page" data-page="13" id="otazky-a-odpovede">
                    <div class="box_book_content pd-30 pd-20md">
                        <h2 class="title_h2 title_line">
                            <span><?php echo $six_hp['title'];?></span>
                        </h2> 

                        <div class="accord mgt-20">
                            <?php 
                                foreach($six_hp['faqs'] as $faq):
                                    ?>
                                    <!-- ITEM -->
                                    <div class="item_accord accorditem">
                                        <a href="#" title="<?php echo $faq['title_faq'];?>" role="button" class="item_accord_head accordhead">
                                            <span><?php echo $faq['title_faq'];?></span>
                                            <svg class="sico"><use href="<?php theme_url();?>assets/layout/icons.svg#s_plus" /></svg>
                                        </a>  
                                        
                                        <div class="item_accord_expand">
                                            <div>
                                                <div class="item_accord_content page_content reset_margins">
                                                    <?php echo $faq['text'];?>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <?php 
                                endforeach;
                            ?>
                        </div>
                    </div>

                    <a href="#" title="" class="box_book_prev" data-page-index="12"></a>
                    <a href="#" title="" class="box_book_next" data-page-index="14"></a>
                </div>
                <!-- CONTACT -->
                <?php $seven_hp = get_field('seven_hp');?>
                <div class="box_book_page" data-page="14" id="kontakt">
                    <div class="box_book_content pd-30 pd-20md">
                        <h2 class="title_h2 title_line">
                            <span><?php echo $seven_hp['title'];?></span>
                        </h2> 

                        <div class="pdt-50 pdb-50">

                            <ul class="list_icon">
                                <?php 
                                    $tel = $seven_hp['phone'];
                                    if( $tel ): 
                                        ?>
                                        <li>
                                            <svg class="sico"><use href="<?php theme_url();?>assets/layout/icons.svg#s_phone" /></svg>   
                                            <span>
                                                <a href="tel:<?php echo str_replace(' ', '', $tel)?>">
                                                    <?php echo $tel?>
                                                </a>
                                            </span>
                                        </li>
                                        <?php 
                                    endif;
                                ?>
                                <?php 
                                    $email = $seven_hp['email'];
                                    if( $email ): 
                                        ?>
                                        <li>
                                            <svg class="sico"><use href="<?php theme_url();?>assets/layout/icons.svg#s_enve" /></svg>   
                                            <span>
                                                <a href="mailto:<?php echo $email?>"><?php echo $email?></a>
                                            </span> 
                                        </li>
                                        <?php 
                                    endif;
                                ?>
                                 <?php 
                                    $adresa = $seven_hp['adresa'];
                                    if( $adresa ): 
                                        $encoded_address = urlencode($adresa);
                                        $google_maps_url = "https://www.google.com/maps/dir/?api=1&destination=" . $encoded_address;
                                        ?>
                                        <li>
                                            <svg class="sico"><use href="<?php theme_url();?>assets/layout/icons.svg#s_build" /></svg>   
                                            <span>
                                            <a href="<?php echo $google_maps_url ?>" target='_blank'><?php echo $adresa?></a>
                                            </span> 
                                        </li>
                                        <?php 
                                    endif;
                                ?>
                            </ul>

                            <div class="text_center mgt-40">
                                <div class="social">
                                    <?php 
                                        $fb = $seven_hp['fb'];
                                        if( $fb ): 
                                            show_button_socials($fb, "","s_fb");
                                        endif;
                                        $ig = $seven_hp['ig'];
                                        if( $ig ): 
                                            show_button_socials($ig, "","s_insta");
                                        endif;
                                    ?>
                                </div>
                            </div>
                            <div class="page_content reset_margins mgt-30">
                                <?php echo do_shortcode( $seven_hp['form']);?>
                            </div>
                        </div>
                    </div>

                    <a href="#" title="" class="box_book_prev" data-page-index="13"></a>
                    <a href="#" title="" class="box_book_next" data-page-index="15"></a>
                </div>
                <div class="box_book_page" data-page="15" id="">
                    <div class="box_book_content pd-30 pd-20md">
                        <h2 class="title_h2 title_line">
                            <span>Adresa</span>
                        </h2> 

                        <div class="pdt-50 pdb-50">
                            <div class="box_map">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2657.8982330332883!2d16.994729576501047!3d48.227834144873206!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x476cf2e797dbfe7d%3A0x574ac6cdb5f3a318!2zSsOhbmEgSm9uw6HFoWEgNjE4My8xMywgODQxIDA4IERldsOtbnNrYSBOb3bDoSBWZXM!5e0!3m2!1ssk!2ssk!4v1716545265948!5m2!1ssk!2ssk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>

                    <a href="#" title="" class="box_book_prev" data-page-index="14"></a>
                    <a href="#" title="" class="box_book_next" data-page-index="16"></a>
                </div>
                <!-- prevadzkovy_poriadok -->
                <div class="box_book_page" data-page="16" id="">
                    <div class="box_book_content pd-30 pd-20md">
                        <h2 class="title_h2 title_line">
                            <span><?php echo  get_field('nadpis_prev');?></span>
                        </h2> 

                        <div class="page_content no_margins mgt-40">
                            <?php echo get_field('prevadzkovy_poriadok');?>
                        </div>

                    </div>

                    <a href="#" title="" class="box_book_prev" data-page-index="15"></a>
                    <a href="#" title="" class="box_book_next" data-page-index="17"></a>
                </div>
                <!-- gdp -->
                <?php $gdpr_hp = get_field('gdpr_hp');?>
                <div class="box_book_page" data-page="17" id="">
                    <div class="box_book_content pd-30 pd-20md">
                        <h2 class="title_h2 title_line">
                            <span><?php echo $gdpr_hp['title'];?></span>
                        </h2> 

                        <div class="page_content no_margins mgt-40">
                            <?php echo $gdpr_hp['text'];?>
                        </div>

                    </div>

                    <a href="#" title="" class="box_book_prev" data-page-index="16"></a>
                    <a href="#" title="" class="box_book_next" data-page-index="18"></a>
                </div>
                <!-- reklamacny -->
                <?php $rekl_hp = get_field('rekl_hp');?>
                <div class="box_book_page" data-page="18" id="">
                    <div class="box_book_content pd-30 pd-20md">
                        <h2 class="title_h2 title_line">
                            <span><?php echo $rekl_hp['title'];?></span>
                        </h2> 

                        <div class="page_content no_margins mgt-40">
                            <?php echo $rekl_hp['text'];?>
                        </div>

                    </div>

                    <a href="#" title="" class="box_book_prev" data-page-index="15"></a>
                </div>

            </div>
        </div>

    </div>
</div>
<!-- /Main content -->
    
<?php get_footer(); ?>