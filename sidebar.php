</div> <!-- large-6 -->
<div class="cell medium-3 large-3">
<aside id="sidebar"  class="sidebar_right cell nopin" role="complementary" >
	<ul class="no-bullet">


	<?php if ( is_active_sidebar( 'primary' ) ) : ?>

		<?php if ( is_single() && 'portfolio' != get_post_type() ) { ?>
			<h3 class="widget-title">About This Post</h3>
			<?php if ( has_post_thumbnail() ) { ?>
		        <aside class="thumbnail">
		        	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_post_thumbnail('medium'); ?></a>
		        </aside>
		    <?php } ?>

	        <aside class="byline meta postmetadata">
				<div class="post_details">
					<p>This post was published on <?php the_time('F j, Y'); ?>.
					<br>
					<?php
						if(has_category()){ ?>
						  It was posted under the topic <span class="course-category"><?php the_category(', ') ?></span>.
					 <?php } else {} ?>

					<?php
						if(has_tag()){ ?>
						   It is tagged with <span class="tags"><?php the_tags('', ', ', '. '); ?></span>
					<?php } else {} ?>
					<br>
					<?php if ( comments_open() ) :
						comments_popup_link( 'There are no responses yet. Why not leave a response?','There is 1 response.', 'There are % responses.', 'comments-link', 'Sorry, but comments are closed.');
					endif; ?>
					</p>
				</div>

			</aside>
			<div id="sharing">
				<?php if ( function_exists( 'sharing_display' ) ) {
				    sharing_display( '', true );
				}
				if ( class_exists( 'Jetpack_Likes' ) ) {
				    $custom_likes = new Jetpack_Likes;
				    echo $custom_likes->post_likes( '' );
				} ?>
			</div>
			<?php } elseif (is_singular( 'lesson' )) { ?>
			<h3>About This Lesson</h3>
			<?php if ( has_post_thumbnail() ) { ?>
		        <aside class="thumbnail th">
		        	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_post_thumbnail(); ?></a>
		        </aside>
		    <?php } ?>

	        <aside class="byline meta postmetadata">
				<div class="post_details">

					This post was written by <address class="author"><?php the_author_posts_link(); ?></address>.
					It was published on a <?php the_time('l'); ?>, which is the <?php the_time('jS'); ?> day in <?php the_time('F, Y'); ?>.
					<div class="schema_datePublished">
					<time class="entry-date" datetime="<?php the_date('F jS, Y'); ?>" itemprop="datePublished" pubdate><?php the_date('F jS, Y'); ?></time></div>
					It was posted under the topic <span class="course-category"><?php the_category(', ') ?></span>.
					It is tagged with <span class="tags"><?php the_tags('<span itemprop="keywords">', ', ', '</span>. '); ?></span>
					<?php if ( comments_open() ) :
						echo '<p>';
						comments_popup_link( 'There are no responses yet. Why not leave a response?','There is 1 response.', 'There are % responses.', 'comments-link', 'Sorry, but comments are closed.');
						echo '</p>';
					endif; ?>
				</div>
				<div class="postauthor">
					<h3>About The Author</h3>
					<div class="th"><?php echo get_avatar( get_the_author_id() , 95 ); ?></div>
					<p id="postauthordesc">Hi, I am <?php the_author_meta( 'nickname', $author_id ); ?>. I have written <a href="<?php bloginfo('url'); ?>/?author=<?php the_author_ID(); ?>"><?php the_author_posts(); ?> article<?php
					$postcnt =(int)get_the_author_posts();
					if ($postcnt>=2){
					echo "s";}?>
					</a> for <?php bloginfo('name'); ?>.

					<?php the_author_meta( 'description' ); ?>
					</p>
				</div>
			</aside><!-- byline meta postmetadata -->
			<div id="sharing">
				<?php if ( function_exists( 'sharing_display' ) ) {
				    sharing_display( '', true );
				}
				if ( class_exists( 'Jetpack_Likes' ) ) {
				    $custom_likes = new Jetpack_Likes;
				    echo $custom_likes->post_likes( '' );
				} ?>
			</div>

			<?php } elseif (is_category()) { ?>
				<p>You are currently browsing the archives for the <?php single_cat_title(''); ?> category.</p>
			<?php } elseif (is_tag()) { ?>
				<p>You are currently browsing the archives for the <?php single_tag_title(''); ?> tag.</p>
			<?php } elseif (is_day()) { ?>
			    <p>You are currently browsing the <a href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a> blog archives for the day <?php get_option('date_format'); ?>.</p>
		    <?php } elseif (is_month()) { ?>
			    <p>You are currently browsing the <a href="<?php bloginfo('url'); ?>/"><?php bloginfo('name'); ?></a> blog archives for <?php the_time('F, Y'); ?>.</p>
			<?php } elseif (is_year()) { ?>
		    	<p>You are currently browsing the <a href="<?php bloginfo('url'); ?>/"><?php bloginfo('name'); ?></a> blog archives for the year <?php the_time('Y'); ?>.</p>
			<?php } elseif (is_search()) { ?>
		    	<p>You have searched the <a href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a> blog archives for <strong>'<?php the_search_query(); ?>'</strong>.</p>
			 <?php } ?>

		<?php dynamic_sidebar( 'primary' ); ?>

	<?php else : ?>
	<?php endif; ?>
	</ul>
</aside>
  </div>

</div><!-- cell medium-9 large-9  -->