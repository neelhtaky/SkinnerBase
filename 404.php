<?php get_header(); ?>

    <article <?php post_class("sticky entries item grid-x grid-padding-x"); ?> id="post-<?php the_ID(); ?>" role="article">
    	<div class="small-12 cell">
    		<h2>Opps! Somehow you got lost... </h2>
		<p>Well this is embarrassing, isn’t it?</p>
		<p>I cannot seem to find what you were looking for. I'm very sorry. That page or file may have been moved or deleted.</p>
		<p>Would you like to try another search?</p>
    	</div>


	<div class="small-12 cell">
		<?php get_search_form(); ?>
		<h2>Maybe I can still help you...</h2>
	</div>




	<div class="small-12 large-6 cell">
		<h3>Popular Posts</h3>
		<p>Here's a list of our most popular posts; these are what people come to read!</p>
			<ol class="popular_posts">
			<?php $pc = new WP_Query('orderby=comment_count&posts_per_page=9');
			while ($pc->have_posts()) : $pc->the_post(); ?>
				<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
			<?php endwhile; ?>
		</ol>
	</div>
	<div class="small-12 large-6 cell">
		<h3>Recent Posts</h3>
		<p>Maybe you were looking for one of our more recently published posts?</p>
		<ul>
		<?php $recent_posts = wp_get_recent_posts();
			foreach( $recent_posts as $recent ){
				echo '<li><a href="' . get_permalink($recent["ID"]) . '" title="Look '.esc_attr($recent["post_title"]).'" >' .   $recent["post_title"].'</a> </li> ';
			} ?>
		</ul>
	</div>




</article>
    <!-- here's where we'll put a search form if there're no posts -->
    <?php endif; ?>

<?php get_sidebar('primary'); ?>
<?php get_footer(); ?>