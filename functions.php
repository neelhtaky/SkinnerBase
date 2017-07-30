<?php
/****************************************************************
ADD THEME SUPPORT
***************************************************************/
/* set content width support for jetpack */
if ( ! isset( $content_width ) )
    $content_width = 900;
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
add_action( 'widgets_init', 'theme_slug_widgets_init' );
function theme_slug_widgets_init() {
}
/* Register Sidebars */
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Primary Sidebar',
		'id' => 'primary',
    'description' => __('The main sidebar available on all devices. Sits on the right side of the screen.'),
		'before_widget' => '<li id="%1$s" class="widget %2$s cell clearfix">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
  register_sidebar(array(
    'name' => 'Secondary Sidebar',
    'id' => 'secondary',
    'description' => __('The secondary sidebar. Available for large devices and up. Sits on the left side of the screen.'),
    'before_widget' => '<li id="%1$s" class="widget %2$s clearfix">',
    'after_widget' => '</li>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ));
	register_sidebar(array(
		'name' => 'Footer Sidebar',
		'id' => 'footer',
    'description' => __('To add extra widgets to the footer, such as contact information.'),
		'before_widget' => '<li id="%1$s" class="small-4 cell widget %2$s clearfix">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
  /* Register Navigation Menus */
    register_nav_menus( array(
		'nav_header_left' => ( 'Left Navigation in header area'),
    	'nav_header_right' => ( 'Right Navigatoin in Header  area'),
    	'nav_footer' => ('Footer Navigation')
	) );}
add_filter( 'use_default_gallery_style', '__return_false' );
/******************************************************************
Manipulate the Excerpt
******************************************************************/
/**
 * Author: Boutros AbiChedid
 * Remove header tags and their content from the autogenerated
 * excerpt whilst preserving other chosen HTML tags
 * Also modify default excerpt_length and excerpt_more filters.
 */
function bac_wp_strip_header_tags_keep_other_formatting( $text ) {
$raw_excerpt = $text;
if ( '' == $text ) {
    //Retrieve the post content.
    $text = get_the_content('');
    //remove shortcode tags from the given content.
    $text = strip_shortcodes( $text );
    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]&gt;', $text);
    //Regular expression that removes the h1-h6 tags with their content.
    $regex = '#(<h([1-6])[^>]*>)\s?(.*)?\s?(<\/h\2>)#';
    $text = preg_replace($regex,'', $text);
    /***Add the allowed HTML tags separated by a comma.
    h1-h6 header tags are NOT allowed. DO NOT add h1,h2,h3,h4,h5,h6 tags here.***/
    $allowed_tags = '<p>,<em>,<strong>,<img>';  //I added p, em, and strong tags.
    $text = strip_tags($text, $allowed_tags);
    /***Change the excerpt word count.***/
    $excerpt_word_count = 55; //This is WP default.
    $excerpt_length = apply_filters('excerpt_length', $excerpt_word_count);
    /*** Change the excerpt ending.***/
    $excerpt_end = '[... <div class="read_more"><a href="'. get_permalink($post->ID) . '"  rel="bookmark">Read More</a></div>]'; //This is the WP default.
    $excerpt_more = apply_filters('excerpt_more', ' ' . $excerpt_end);
    $words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
        if ( count($words) > $excerpt_length ) {
            array_pop($words);
            $text = implode(' ', $words);
            $text = $text . $excerpt_more;
        } else {
            $text = implode(' ', $words);
        }
    }
    return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);}
add_filter( 'get_the_excerpt', 'bac_wp_strip_header_tags_keep_other_formatting', 5);
/**
 * Add Read More Button
 */
function new_excerpt_more($more) {
  global $post;
  return '... <div class="read_more"><a href="'.get_permalink($post->ID).'" rel="bookmark nofollow">Read More</a></div>';
}
add_filter('excerpt_more', 'new_excerpt_more');
/******************************************************************
Comment Manipulation
******************************************************************/
/**
 * Add Delete and Spam Buttons for Easy Admin Management
 */
function spam_delete_comment_link($id) {
  global $comment, $post;
  if ( $post->post_type == 'page' ) {
    if ( !current_user_can( 'edit_page', $post->ID ) )
      return;
  } else {
    if ( !current_user_can( 'edit_post', $post->ID ) )
      return;
  }
  $id = $comment->comment_ID;
  if ( null === $link )
    $link = __('Edit');
  $link = '<p><a class="comment-edit-link" href="' . get_edit_comment_link( $comment->comment_ID ) . '" title="' . __( 'Edit comment' ) . '">' . $link . '</a>';
  $link = $link . ' | <a href="'.admin_url("comment.php?action=cdc&c=$id").'">Delete</a> ';
  $link = $link . ' | <a href="'.admin_url("comment.php?action=cdc&dt=spam&c=$id").'">Spam</a></p>';
  $link = $before . $link . $after;
  return $link;
}
add_filter('edit_comment_link', 'spam_delete_comment_link');
/******************************************************************
Format Chat Post for Better Markup and Presentation
******************************************************************/
/*
 * Author: David Chandra - Justin Tadlock
 * @global array $_post_format_chat_ids An array of IDs for the chat rows based on the author.
 * @param string $content The content of the post.
 * @return string $chat_output The formatted content of the post.
 * @param string $chat_author Author of the current chat row.
 * @return int The ID for the chat row based on the author.
 */
function my_format_chat_content( $content ) {
  global $_post_format_chat_ids;
  /* If this is not a 'chat' post, return the content. */
  if ( !has_post_format( 'chat' ) )
    return $content;
  /* Set the global variable of speaker IDs to a new, empty array for this chat. */
  $_post_format_chat_ids = array();
  /* Allow the separator (separator for speaker/text) to be filtered. */
  $separator = apply_filters( 'my_post_format_chat_separator', ':' );
  /* Open the chat transcript div and give it a unique ID based on the post ID. */
  $chat_output = "\n\t\t\t" . '<div id="chat-transcript-' . esc_attr( get_the_ID() ) . '" class="chat-transcript">';
  /* Split the content to get individual chat rows. */
  $chat_rows = preg_split( "/(\r?\n)+|(<br\s*\/?>\s*)+/", $content );
  /* Loop through each row and format the output. */
  foreach ( $chat_rows as $chat_row ) {
    /* If a speaker is found, create a new chat row with speaker and text. */
    if ( strpos( $chat_row, $separator ) ) {
      /* Split the chat row into author/text. */
      $chat_row_split = explode( $separator, trim( $chat_row ), 2 );
      /* Get the chat author and strip tags. */
      $chat_author = strip_tags( trim( $chat_row_split[0] ) );
      /* Get the chat text. */
      $chat_text = trim( $chat_row_split[1] );
      /* Get the chat row ID (based on chat author) to give a specific class to each row for styling. */
      $speaker_id = my_format_chat_row_id( $chat_author );
      /* Open the chat row. */
      $chat_output .= "\n\t\t\t\t" . '<div class="chat-row ' . sanitize_html_class( "chat-speaker-{$speaker_id}" ) . '">';
      /* Add the chat row author. */
      $chat_output .= "\n\t\t\t\t\t" . '<div class="chat-author ' . sanitize_html_class( strtolower( "chat-author-{$chat_author}" ) ) . ' vcard"><cite class="fn">' . apply_filters( 'my_post_format_chat_author', $chat_author, $speaker_id ) . '</cite>' . $separator . '</div>';
      /* Add the chat row text. */
      $chat_output .= "\n\t\t\t\t\t" . '<div class="chat-text">' . str_replace( array( "\r", "\n", "\t" ), '', apply_filters( 'my_post_format_chat_text', $chat_text, $chat_author, $speaker_id ) ) . '</div>';
      /* Close the chat row. */
      $chat_output .= "\n\t\t\t\t" . '</div><!-- .chat-row -->';
    }
    /**
     * If no author is found, assume this is a separate paragraph of text that belongs to the
     * previous speaker and label it as such, but let's still create a new row.
     */
    else {
      /* Make sure we have text. */
      if ( !empty( $chat_row ) ) {
        /* Open the chat row. */
        $chat_output .= "\n\t\t\t\t" . '<div class="chat-row ' . sanitize_html_class( "chat-speaker-{$speaker_id}" ) . '">';
        /* Don't add a chat row author.  The label for the previous row should suffice. */
        /* Add the chat row text. */
        $chat_output .= "\n\t\t\t\t\t" . '<div class="chat-text">' . str_replace( array( "\r", "\n", "\t" ), '', apply_filters( 'my_post_format_chat_text', $chat_row, $chat_author, $speaker_id ) ) . '</div>';
        /* Close the chat row. */
        $chat_output .= "\n\t\t\t</div><!-- .chat-row -->";
      }
    }}
  /* Close the chat transcript div. */
  $chat_output .= "\n\t\t\t</div><!-- .chat-transcript -->\n";
  /* Return the chat content and apply filters for developers. */
  return apply_filters( 'my_post_format_chat_content', $chat_output );}
/**
 * This function returns an ID based on the provided chat author name.  It keeps these IDs in a global
 * array and makes sure we have a unique set of IDs.  The purpose of this function is to provide an "ID"
 * that will be used in an HTML class for individual chat rows so they can be styled.  So, speaker "John"
 * will always have the same class each time he speaks.  And, speaker "Mary" will have a different class
 * from "John" but will have the same class each time she speaks.
 */
function my_format_chat_row_id( $chat_author ) {
  global $_post_format_chat_ids;
  /* Sanitize the chat author to avoid craziness and differences like "John" and "john". */
  $chat_author = strtolower( strip_tags( $chat_author ) );
  /* Add the chat author to the array. */
  $_post_format_chat_ids[] = $chat_author;
  /* Make sure the array only holds unique values. */
  $_post_format_chat_ids = array_unique( $_post_format_chat_ids );
  /* Return the array key for the chat author and add "1" to avoid an ID of "0". */
  return absint( array_search( $chat_author, $_post_format_chat_ids ) ) + 1;}
/******************************************************************
Better Pagination Archive Support
******************************************************************/
function kriesi_pagination($pages = '', $range = 2)
{
     $showitems = ($range * 2)+1;
     global $paged;
     if(empty($paged)) $paged = 1;
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }
     if(1 != $pages)
     {
        echo "<ul class='pagination'  aria-label='Pagination' role='menubar'>";
        echo "<div class='panel small-12 medium-12 large-12 xlarge-12 xxlarge-12 columns text-center'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'>&laquo; First</a></li>";
         if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous </a></li>";
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<li class='current'><a href='".get_pagenum_link($i)."'>".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a></li>";
             }
         }
         if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."'>Next &rsaquo;</a></li>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>Last &raquo;</a></li>";
         echo "</div>\n";
         echo "</ul>\n";
     }
}
/******************************************************************
Better Pagination For Pages Support
******************************************************************/
/**
 * The formatted output of a list of pages.
 * Displays page links for paginated posts (i.e. includes the "nextpage"
 * This tag must be within The Loop.
 *
 * The defaults for overwriting are:
 * 'next_or_number' - Default is 'number' (string). Indicates whether page
 *      numbers should be used. Valid values are number and next.
 * 'nextpagelink' - Default is 'Next Page' (string). Text for link to next page.
 * 'previouspagelink' - Default is 'Previous Page' (string). Text for link to
 *      previous page, if available.
 * 'pagelink' - Default is '%' (String).Format string for page numbers. The % in
 *      the parameter string will be replaced with the page number, so Page %
 *      generates "Page 1", "Page 2", etc. Defaults to %, just the page number.
 * 'before' - Default is '<p id="post-pagination"> Pages:' (string). The html
 *      or text to prepend to each bookmarks.
 * 'after' - Default is '</p>' (string). The html or text to append to each
 *      bookmarks.
 * 'text_before' - Default is '' (string). The text to prepend to each Pages link
 *      inside the <a> tag. Also prepended to the current item, which is not linked.
 * 'text_after' - Default is '' (string). The text to append to each Pages link
 *      inside the <a> tag. Also appended to the current item, which is not linked.
 *
 * @param string|array $args Optional. Overwrite the defaults.
 * @return string Formatted output in HTML.
 */
function custom_wp_link_pages( $args = '' ) {
  $defaults = array(
    'before' => '<h3>Pages In This Article:</h3><ul id="post-pagination" class="pagination">' . '',
    'after' => '</ul>',
    'text_before' => '',
    'text_after' => '',
    'next_or_number' => 'number',
    'nextpagelink' => __( 'Next page' ),
    'previouspagelink' => __( 'Previous page' ),
    'pagelink' => '%',
    'echo' => 1
  );
  $r = wp_parse_args( $args, $defaults );
  $r = apply_filters( 'wp_link_pages_args', $r );
  extract( $r, EXTR_SKIP );
  global $page, $numpages, $multipage, $more, $pagenow;
  $output = '';
  if ( $multipage ) {
    if ( 'number' == $next_or_number ) {
      $output .= $before;
      for ( $i = 1; $i < ( $numpages + 1 ); $i = $i + 1 ) {
        $j = str_replace( '%', $i, $pagelink );
        $output .= ' ';
        if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
          $output .= '<li>' . _wp_link_page( $i );
        else
          $output .= '<li class="current-post-page current"><a>';
        $output .= $text_before . $j . $text_after;
        if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
          $output .= '</a></li>';
        else
          $output .= '</a></li>';
      }
      $output .= $after;
    } else {
      if ( $more ) {
        $output .= $before;
        $i = $page - 1;
        if ( $i && $more ) {
          $output .= _wp_link_page( $i );
          $output .= '<li>' . $text_before . $previouspagelink . $text_after . '</a></li>';
        }
        $i = $page + 1;
        if ( $i <= $numpages && $more ) {
          $output .= _wp_link_page( $i );
          $output .= '<li>' . $text_before . $nextpagelink . $text_after . '</a></li>';
        }
        $output .= $after;
      }
    }
  }
  if ( $echo )
    echo $output;
  return $output;
}
/******************************************************************
Custom Comments Display
******************************************************************/
function mytheme_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);
    if ( 'div' == $args['style'] ) {
      $tag = 'div';
      $add_below = 'comment';
    } else {
      $tag = 'li';
      $add_below = 'div-comment';
    } ?>
        <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
        <?php if ( 'div' != $args['style'] ) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body row">
        <?php endif; ?>
        <div id="author_wrap">
          <div class="comment-author vcard small-12 medium-6 large-6 columns">
            <?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?>
            <?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
          </div>
          <div class="comment-meta commentmetadata small-12 medium-6 large-6 columns"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
            <?php
              /* translators: 1: date, 2: time */
              printf( __('%1$s'), get_comment_date()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
            ?>
          </div>
      </div><!-- author_wrap -->
    <?php if ($comment->comment_approved == '0') : ?>
        <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation, please be patient.') ?></em>
    <?php endif; ?>
        <div class="comment-content small-12 columns"><?php comment_text(); ?></div>

        <div class="reply small-12 columns">
          <?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </div>
        <?php if ( 'div' != $args['style'] ) : ?>
        </div>
        <?php endif; ?>
    <?php
            }
/******************************************************************
Relocate Jetpack Likes to Sidebar. Default is under content.
******************************************************************/
function jptweak_remove_share() {
    remove_filter( 'the_content', 'sharing_display',19 );
    remove_filter( 'the_excerpt', 'sharing_display',19 );
    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }
}
add_action( 'loop_start', 'jptweak_remove_share' );
/******************************************************************
make embeds responsive
******************************************************************/
function div_wrapper($content) {
    // match any iframes
    $pattern = '~<iframe.*</iframe>|<embed.*</embed>~';
    preg_match_all($pattern, $content, $matches);
    foreach ($matches[0] as $match) {
        // wrap matched iframe with div
        $wrappedframe = '<div class="embed_responsive flex-video">' . $match . '</div>';
        //replace original iframe with new in content
        $content = str_replace($match, $wrappedframe, $content);
    }
    return $content;
}
add_filter('the_content', 'div_wrapper');
/******************************************************************
Disable Self Trackbacks and Pingbacks
******************************************************************/
function disable_self_trackback( &$links ) {
    foreach ( $links as $l => $link )
        if ( 0 === strpos( $link, get_option( 'home' ) ) )
            unset($links[$l]);
}
add_action( 'pre_ping', 'disable_self_trackback' );
?>