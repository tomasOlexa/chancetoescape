<?php
/* -------------------------- Show button -------------------------- */
function show_button($button, $classes){
    if (!empty($button)) { ?>
    <a 
    href="<?php echo ($button['url']); ?>"
    class="<?php echo $classes; ?>"
    target="<?php echo(!empty($button['target']))? $button['target']: '_self' ?>"
    ><?php echo ($button['title']); ?></a>
    <?php }
}

/* -------------------------- Show button with icon left -------------------------- */
function show_button_with_icon_left($button, $classes, $icon){
    if (!empty($button)) { ?>
    <a 
    href="<?php echo ($button['url']); ?>"
    class="<?php echo $classes; ?>"
    target="<?php echo(!empty($button['target']))? $button['target']: '_self' ?>"
    >
    <span class="<?php echo $icon; ?>"></span>
    <?php echo ($button['title']); ?>
    </a>
    <?php }
}
function show_button_socials($button, $classes, $icon){
    if (!empty($button)) { ?>
    <a 
    href="<?php echo ($button['url']); ?>"
    class="<?php echo $classes; ?>"
    target="<?php echo(!empty($button['target']))? $button['target']: '_self' ?>"
    title="<?php echo ($button['title']); ?>"
    >
    <svg class="sico"><use href="<?php theme_url();?>assets/layout/icons.svg#<?php echo $icon; ?>" /></svg>
    </a>
    <?php }
}
/* -------------------------- Show button with icon right -------------------------- */
function show_button_with_icon($button, $classes, $icon){
    if (!empty($button)) { ?>
    <a 
    href="<?php echo ($button['url']); ?>"
    class="<?php echo $classes; ?>"
    target="<?php echo(!empty($button['target']))? $button['target']: '_self' ?>"
    >
    <?php echo ($button['title']); ?>
    <span class="<?php echo $icon; ?>"></span>
    </a>
    <?php }
}

/* -------------------------- Show image element -------------------------- */
function show_image($image, $sizes, $classes_link){
    if (!empty($image)) { ?>
        <img src="<?php echo esc_url($image['sizes'][$sizes]); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="<?php echo $classes_link;?>" />
    <?php }
}

/* -------------------------- Get theme URL -------------------------- */
if (!function_exists('theme_url')) {
    function theme_url($echo=true)
    {
        if($echo) {
            echo esc_url(get_template_directory_uri()) . '/';
        } else {
            return esc_url(get_template_directory_uri()) . '/';
        }
    }
}

/* -------------------------- Get File info strings -------------------------- */
function getFileInfoInString($filePath) {
    $extension = pathinfo($filePath)['extension'];
    $fileName = pathinfo($filePath)['filename'];

    $retString = '';
    $tmpInfo = '';

    if(isset($extension) && !empty($extension))  {
        $tmpInfo .= strtoupper($extension) . ', ';
    }
    
    if(isset($tmpInfo) && !empty($tmpInfo))  {
        return '(' . rtrim($tmpInfo, ', ') . ') ';
    }

    return '';
}

function fullTemplateUri($relativeUri)
{
    return sprintf("%s/%s", get_template_directory_uri(), $relativeUri);
}

function fullTemplatePath($relativePath)
{
    return sprintf("%s/%s", get_template_directory(), $relativePath);
}

function printFullTemplateUri($relativePath)
{
    echo fullTemplateUri($relativePath);
}


/* -------------------------- Get language list -------------------------- */
function getLanguages() {
    $languages = icl_get_languages('skip_missing=0');
 
    return $languages;
}

/* -------------------------- Get active language -------------------------- */
function getSelectedLanguage() {
    $languages = icl_get_languages('skip_missing=0');
 
    if( !empty( $languages ) ) {
        foreach( $languages as $language ){
            if( $language['active'] ) return $language;
        }
    }
}

/* -------------------------- Get primary Name -------------------------- */
function getPrimaryCategoryName($post_id,$taxonomy){
    $primary_cat_id=get_post_meta($post_id,'_yoast_wpseo_primary_' . $taxonomy, true);
    if($primary_cat_id){
        $primary_cat = get_term($primary_cat_id, $taxonomy);
        if(isset($primary_cat->name)) 
            echo $primary_cat->name;

    }
}

/* -------------------------- Get primary Link -------------------------- */
function getPrimaryCategoryLink($post_id,$taxonomy){
    $primary_cat_id=get_post_meta($post_id,'_yoast_wpseo_primary_' . $taxonomy, true);
    if($primary_cat_id){
        $primary_cat = get_term($primary_cat_id, $taxonomy);
        if(isset($primary_cat->term_id)) {
            echo get_category_link($primary_cat->term_id);
        }
          
    }
}
