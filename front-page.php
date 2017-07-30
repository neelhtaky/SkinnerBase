<?php get_header(); ?>
</div></div></div> <!-- close default container, gridx and main cell-->

<div class="front_parallax"></div>

<div class="grid-container">
	<div class="artist_quote">
		<p>A professional artist who loves beauty.</p>
	</div>


	<div class="grid-x grid-margin-x" data-equalizer>
		<article class="front_call small-12 large-4 cell" data-equalizer-watch onclick="location.href='journal/';">
			<h2> Read The Journal</h2>
			<p>A collection of tutorials, my practice pieces and artwork in-progress.</p>
		</article>
		<article class="front_call small-12 large-4 cell" data-equalizer-watch onclick="location.href='portfolio/';">
			<h2>Browse The Portfolio</h2>
		    	<p>The best of the best. A great way to see my talent. </p>
		</article>
		<article class="front_call small-12 large-4 cell" data-equalizer-watch onclick="location.href='http://www.fineartamerica.com/profiles/1-kathleen-skinner.html';">
			<h2> Buy My Art</h2>
		    	<p>All the artwork that I have for sale, available as prints, phone cases, bed sheets and so much more.</p>
		</article>

	</div><!-- grid-x -->
</div> <!-- container -->



<div class="grid-container single_content front_body">
<div class="grid-x grid-padding-x" id="front_portfolio">
	<h3 class="small-12 cell">The Latest Artworks</h3>
	<?php
        $args = array(
            'post_type'      => 'jetpack-portfolio',
            'posts_per_page' => 3,
        );
        $project_query = new WP_Query ( $args );
        if ( post_type_exists( 'jetpack-portfolio' ) && $project_query -> have_posts() ) :
            while ( $project_query -> have_posts() ) : $project_query -> the_post();
        ?>
		<article <?php post_class("small-12 large-4 cell"); ?> id="post-<?php the_ID(); ?>" role="article">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
						<figure class="wp-caption">
							<?php the_post_thumbnail('thumbnail'); ?>
							<figcaption class="wp-caption-text"><?php the_title_attribute(); ?></figcaption>
						</figure>
					</a>
		</article>
	    <?php
            endwhile;
            wp_reset_postdata();
        else :
    ?>
    <?php endif; ?>
</div>






<div class="grid-x grid-padding-x single_content front_body front_entries">
	<h3 class="small-12 cell">The Latest Journal Entries</h3>
		<?php
		$temp = $wp_query; $wp_query= null;
		$wp_query = new WP_Query(); $wp_query->query('posts_per_page=3' );
		while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

			<article class="small-12 large-4 cell">
				<a class="" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_post_thumbnail('thumbnail'); ?></a>
				<h4><a href="<?php the_permalink(); ?>" title="Read more"><?php the_title(); ?></a></h4>
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
			</article>




		<?php endwhile; ?>


		<?php wp_reset_postdata(); ?>
</div>




<?php wp_reset_query(); // reset the query ?>









<?php get_footer(); ?>
