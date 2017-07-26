<?php get_header(); ?>


<h1>Portfolio</h1>




 <!-- Start the Loop. -->
<div class="grid-x">
 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<article <?php post_class("sticky entries item portfolio_item small-6 large-4 cell"); ?> id="post-<?php the_ID(); ?>" role="article">

				<?php if (has_post_thumbnail( )): ?>

					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
						<figure class="wp-caption">
							<?php the_post_thumbnail('medium'); ?>
							<figcaption class="wp-caption-text"><?php the_title_attribute(); ?></figcaption>
						</figure>
					</a>

				<?php endif ?>

	</article>

 <?php endwhile; else : ?>
 	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
 <?php endif; ?>
</div>








 <?php kriesi_pagination($pages = '', $range = 4); ?>
    <?php wp_reset_query(); ?>
    <?php get_sidebar('primary'); ?>
<?php get_footer(); ?>