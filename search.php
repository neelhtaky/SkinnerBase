<?php get_header(); ?>

    <?php if ( have_posts() ) : ?>

     <h2>Here are the results for '<?php echo get_search_query(); ?>':</h2>
     <?php global $wp_query;
     $searchcount = $wp_query->found_posts;
     ?>
         <?php if ($searchcount > 1 ): ?>
             <p> <?php echo 'By the way, we found ' . $wp_query->found_posts.' results.'; ?></p>
         <?php elseif ($searchcount == 1): ?>
            <p>By the way, we found only 1 result.</p>
         <?php endif ?>

    <?php while ( have_posts() ) : the_post() ?>
    <!-- this is our loop -->

 		<article <?php post_class("entries item grid-x grid-padding-x"); ?> id="post-<?php the_ID(); ?>" role="article">
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






    <?php endwhile; ?>

    <?php else : ?>
    <article <?php post_class("sticky entries item grid-x grid-padding-x"); ?> id="post-<?php the_ID(); ?>" role="article">
    	<div class="small-12 cell">
    		<h2>Sorry... No results were found for '<?php echo get_search_query(); ?>'</h2>
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