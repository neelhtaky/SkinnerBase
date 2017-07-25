<?php get_header(); ?>



    <?php
    if ( have_posts() ) {
    while ( have_posts() ) {
      the_post();  ?>

      <article <?php post_class("sticky entries item grid-x grid-padding-x"); ?> id="post-<?php the_ID(); ?>" role="article">
        <?php if (has_post_thumbnail( )){ ?>
            <aside class="small-4 cell">
              <a class="" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_post_thumbnail('thumbnail'); ?></a>
            </aside>
            <div class="entry_content small-8 cell">
              <h2 class="post_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
              <footer class="byline meta postmetadata">
                <time class="published" datetime="<?php the_time('l, F jS, Y') ?>"><?php the_time('jS F Y') ?>.</time>
                <a href="<?php comments_link(); ?>" class="comments-link"><?php comments_number( 'No Comments Yet.','1 Comment.', '% Comments.', 'comments-link', 'Sorry, Comments are closed.'); ?></a>
              </footer>
              <?php if( has_excerpt() ){
                //if post has custom manual excerpt
                the_content('... <div class="read_more"><a href="'. get_permalink($post->ID) . '" class="button" rel="bookmark">Read More</a></div>');
              } else if(strpos($post->post_content, '<!--more-->')) {
                //should break at more tag
                the_content('... <div class="read_more"><a href="'. get_permalink($post->ID) . '" class="button" rel="bookmark">Read More</a></div>');
              } else {
                //display auto generated excerpt
                the_excerpt();
              }?>
            </div><!-- entry_content -->

            <?php } else{ ?> <!--  if no post thumbnail-->
            <div class="entry_content small-12 cell">
              <h2 class="post_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
              <footer class="byline meta postmetadata">
                <time class="published" datetime="<?php the_time('l, F jS, Y') ?>"><?php the_time('jS F Y') ?>.</time>
                <div class="author"><?php the_author(); ?>.</div>
                <a href="<?php comments_link(); ?>" class="comments-link"><?php comments_number( 'No Comments Yet.','1 Comment.', '% Comments.', 'comments-link', 'Sorry, Comments are closed.'); ?></a>
                <?php if(has_category()){ ?>
                    <span class="category"><?php the_category(', ') ?>.</span>
                <?php } else {} ?>
                <?php  if(has_tag()){ ?>
                    <span class="tags"><?php the_tags('Tags: ', ', ', '. '); ?></span>
                <?php } else {} ?>
              </footer>
              <?php if( has_excerpt() ){
                //if post has custom manual excerpt
                the_content('... <div class="read_more"><a href="'. get_permalink($post->ID) . '" class="button" rel="bookmark">Read More</a></div>');
                } else if(strpos($post->post_content, '<!--more-->')) {
                 //should break at more tag
                  the_content('... <div class="read_more"><a href="'. get_permalink($post->ID) . '" class="button" rel="bookmark">Read More</a></div>');
                } else {
                  //display auto generated excerpt
                  the_excerpt();
              }?>
            </div><!-- entry_content -->
            <?php } ?> <!-- end check for post thumbnail-->
      </article>

      <?php
      } // end while
    } // end if
    ?>

    <?php kriesi_pagination($pages = '', $range = 4); ?>

    <?php wp_reset_query(); ?>



    <?php get_sidebar('primary'); ?>


<?php get_footer(); ?>
