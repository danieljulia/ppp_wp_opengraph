<?php
/*
Plugin Name: Pimpampum OpenGraph
Description:  Afegeix opengraph per facebook
Version: 1.0
Author: Pimpampum
Author URI: http://www.pimpampum.net
License: GPL2
*/

function doctype_opengraph($output) {
    return $output . '
    xmlns:og="http://opengraphprotocol.org/schema/"
    xmlns:fb="http://www.facebook.com/2008/fbml"';
}

add_filter('language_attributes', 'doctype_opengraph');

function fb_opengraph() {
  wp_reset_query();
    global $post;

    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
    $logo_img = $image[0];


    if(is_single()) {
        if(has_post_thumbnail($post->ID)) {
            $img_src = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'medium');
            $img_src=$img_src[0];
        } else {
            $img_src = $logo_img;
        }


        $excerpt = get_the_excerpt();


        ?>

    <meta property="og:title" content="<?php echo the_title(); ?>"/>
    <meta property="og:description" content="<?php echo $excerpt; ?>"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="<?php echo the_permalink(); ?>"/>
    <meta property="og:site_name" content="<?php echo get_bloginfo(); ?>"/>
    <meta property="og:image" content="<?php echo $img_src; ?>"/>

<?php
    }

    if(is_home()) {

        $img_src =$logo_img;

        $title= get_bloginfo('name');
        $excerpt = get_bloginfo('description');

        ?>

    <meta property="og:title" content="<?php echo $title ?>"/>
    <meta property="og:description" content="<?php echo $excerpt; ?>"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="<?php echo the_permalink(); ?>"/>
    <meta property="og:site_name" content="<?php echo get_bloginfo(); ?>"/>
    <meta property="og:image" content="<?php echo $img_src; ?>"/>

<?php
    }




}
add_action('wp_head', 'fb_opengraph', 5);
