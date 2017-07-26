<?php
// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!'); ?>
<div id="comments">
<?php if ( post_password_required() ) { ?>
    <p class="nocomments">This post is password protected. Enter the password to view comments.</p>
<?php return; } ?>

<!-- You can start editing here. -->
<?php if ( have_comments() ) : ?>
    <h3 id="comment_title">I welcome your feedback. Why not leave yours?</h3>

    <?php
if ($prev_link || $next_link) {
  echo '<ul class="navigation">';
  if ($prev_link){
    echo '<li>'.$prev_link .'</li>';
  }
  if ($next_link){
    echo '<li>'.$next_link .'</li>';
  }
}
     ?>

 <?php $comments_by_type = &separate_comments($comments); ?>
        <?php if (!empty($comments_by_type['comment'])) { ?>
            <h4 id="comments">Comments</h4>
            <ol class="commentlist">
                <?php wp_list_comments('type=comment&avatar_size=65&callback=mytheme_comment'); ?>
            </ol>
        <?php } if (!empty($comments_by_type['pings'])) { ?>
            <h4 id="pingbacks">Honorable Mentions</h4>
            <ol class="pingbacklist">
                <?php wp_list_comments('type=pings'); ?>
            </ol>

    <?php } ?>

<?php else : // this is displayed if there are no comments so far ?>

    <?php if ('open' == $post->comment_status) : ?>
        <!-- If comments are open, but there are no comments. -->

    <?php else : // comments are closed ?>
        <!-- If comments are closed. -->
        <p class="nocomments">Comments are closed.</p>

    <?php endif; ?>
<?php endif; ?>

<?php if ('open' == $post->comment_status) : ?>

<?php comment_form() ?>


<?php endif; // if you delete this the sky will fall on your head ?>
</div><!-- #comments -->