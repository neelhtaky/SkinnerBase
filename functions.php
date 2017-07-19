<?php
/****************************************************************
ADD THEME SUPPORT
***************************************************************/
/* set content width support for jetpack */
if ( ! isset( $content_width ) )
    $content_width = 1121;
if(function_exists('add_theme_support')) {
    add_theme_support( 'post-thumbnails' );
    add_theme_support('automatic-feed-links');
    add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
    $formats = array( 'status', 'quote', 'gallery', 'image', 'video', 'audio', 'link', 'aside', 'chat', );
    add_theme_support( 'post-formats', $formats );}
    add_theme_support( 'jetpack-portfolio' );
    add_action( 'after_setup_theme', 'declare_sensei_support' );
function declare_sensei_support() {
    add_theme_support( 'sensei' );
}
/* Add schema support to images */
the_post_thumbnail('thumbnail',array('itemprop'=>'image' ));
the_post_thumbnail('medium',array('itemprop'=>'image' ));
the_post_thumbnail('large',array('itemprop'=>'image' ));
the_post_thumbnail('full',array('itemprop'=>'image' ));
?>