<?php get_header(); ?>



<?php
if (have_posts()) :
	while (have_posts()) :
		the_post(); ?>


			<article <?php post_class("clear single_content"); ?> id="post-<?php the_ID(); ?>" role="article">
				<?php if ( is_singular() || is_single() || is_404() || is_archive() ) { ?>
					<span itemprop="name">
						<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
						<?php } else { ?>
					<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
					<?php } ?>
					</span>
					<div id="schema_desc"><span itemprop="description"><?php the_excerpt(); ?></span></div>

					<p><?php the_content(); ?></p>

					<?php custom_wp_link_pages(); ?>

			</article>


	<?php endwhile;
	endif; ?>

<div class="post_meta_share">
	<div class="small-2 columns">
		<div id="comment_count">
     		<?php comments_number('0 Comments', '1 Comment', '% Comments' );?>
	    </div>
	</div>
	<div class="small-4 columns">
		<div>
	    	<div id="shortlink">Short URL</div><div id="shortlink_url"><?php echo wp_get_shortlink(); ?></div>
	    </div>
	</div>
	<div class="small-6 columns">
		<?php
			if ( function_exists( 'sharing_display' ) ) {
			    sharing_display( '', true );
			}
			if ( class_exists( 'Jetpack_Likes' ) ) {
			    $custom_likes = new Jetpack_Likes;
			    echo $custom_likes->post_likes( '' );
			}
			 ?>
	</div>
</div>




		<?php if( is_single() || is_page() ){ ?>
			<?php comments_template(); ?>
		<?php } ?>

  <?php get_sidebar('primary'); ?>
<?php get_footer(); ?>