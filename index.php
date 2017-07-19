<?php get_header(); ?>
<body <?php body_class(''); ?> >

<div class="grid-container" id="header_title">
  <div class="grid-x grid-padding-x">
    <div class="site_title large-12 cell">
      <?php if(is_home()){ ?>
            <h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
          <?php } else { ?>
            <h4><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h4>
          <?php } ?>
      </div><!-- #site_title END -->
   </div>
  </div>

<?php
if ( have_posts() ) {
  while ( have_posts() ) {
    the_post();  ?>
    <article <?php post_class("sticky entries item"); ?> id="post-<?php the_ID(); ?>" role="article">
      <?php if (has_post_thumbnail( )): ?>
        <?php $post_thumbnail_id = get_post_thumbnail_id( $post_id );
        $imgmeta = wp_get_attachment_metadata( $post_thumbnail_id );
        if ($imgmeta['width'] > $imgmeta['height']) {
        ?>
          <aside class="feature_th_hor small-12 columns">
            <a class="" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_post_thumbnail('thumbnail'); ?></a>
          </aside>
         <?php } else { ?>
          <aside class="feature_th_vert small-6 columns">
            <a class="" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_post_thumbnail('thumbnail');  ?></a>
          </aside>
        <?php } ?>

      <?php endif ?>
      <div class="entry_content">
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

    </article>
  <?php
  } // end while
} // end if
?>





    <div class="grid-container">
      <div class="grid-x grid-padding-x">
        <div class="large-12 cell">
          <h1>Welcome to Foundation</h1>
        </div>
      </div>

      <div class="grid-x grid-padding-x">
        <div class="large-12 cell">
          <div class="callout">
            <h3>We&rsquo;re stoked you want to try Foundation! </h3>
            <p>To get going, this file (index.html) includes some basic styles you can modify, play around with, or totally destroy to get going.</p>
            <p>Once you've exhausted the fun in this document, you should check out:</p>
            <div class="grid-x grid-padding-x">
              <div class="large-4 medium-4 cell">
                <p><a href="http://foundation.zurb.com/docs">Foundation Documentation</a><br />Everything you need to know about using the framework.</p>
              </div>
              <div class="large-4 medium-4 cell">
                <p><a href="http://zurb.com/university/code-skills">Foundation Code Skills</a><br />These online courses offer you a chance to better understand how Foundation works and how you can master it to create awesome projects.</p>
              </div>
              <div class="large-4 medium-4 cell">
                <p><a href="http://foundation.zurb.com/forum">Foundation Forum</a><br />Join the Foundation community to ask a question or show off your knowlege.</p>
              </div>
            </div>
            <div class="grid-x grid-padding-x">
              <div class="large-4 medium-4 medium-push-2 cell">
                <p><a href="http://github.com/zurb/foundation">Foundation on Github</a><br />Latest code, issue reports, feature requests and more.</p>
              </div>
              <div class="large-4 medium-4 medium-pull-2 cell">
                <p><a href="https://twitter.com/ZURBfoundation">@zurbfoundation</a><br />Ping us on Twitter if you have questions. When you build something with this we'd love to see it (and send you a totally boss sticker).</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="grid-x grid-padding-x">
        <div class="large-8 medium-8 cell">
          <h5>Here&rsquo;s your basic grid:</h5>
          <!-- Grid Example -->

          <div class="grid-x grid-padding-x">
            <div class="large-12 cell">
              <div class="primary callout">
                <p><strong>This is a twelve cell section in a grid-x.</strong> Each of these includes a div.callout element so you can see where the cell are - it's not required at all for the grid.</p>
              </div>
            </div>
          </div>
          <div class="grid-x grid-padding-x">
            <div class="large-6 medium-6 cell">
              <div class="primary callout">
                <p>Six cell</p>
              </div>
            </div>
            <div class="large-6 medium-6 cell">
              <div class="primary callout">
                <p>Six cell</p>
              </div>
            </div>
          </div>
          <div class="grid-x grid-padding-x">
            <div class="large-4 medium-4 small-4 cell">
              <div class="primary callout">
                <p>Four cell</p>
              </div>
            </div>
            <div class="large-4 medium-4 small-4 cell">
              <div class="primary callout">
                <p>Four cell</p>
              </div>
            </div>
            <div class="large-4 medium-4 small-4 cell">
              <div class="primary callout">
                <p>Four cell</p>
              </div>
            </div>
          </div>

          <hr />

          <h5>We bet you&rsquo;ll need a form somewhere:</h5>
          <form>
            <div class="grid-x grid-padding-x">
              <div class="large-12 cell">
                <label>Input Label</label>
                <input type="text" placeholder="large-12.cell" />
              </div>
            </div>
            <div class="grid-x grid-padding-x">
              <div class="large-4 medium-4 cell">
                <label>Input Label</label>
                <input type="text" placeholder="large-4.cell" />
              </div>
              <div class="large-4 medium-4 cell">
                <label>Input Label</label>
                <input type="text" placeholder="large-4.cell" />
              </div>
              <div class="large-4 medium-4 cell">
                <div class="grid-x">
                  <label>Input Label</label>
                  <div class="input-group">
                    <input type="text" placeholder="small-9.cell" class="input-group-field" />
                    <span class="input-group-label">.com</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="grid-x grid-padding-x">
              <div class="large-12 cell">
                <label>Select Box</label>
                <select>
                  <option value="husker">Husker</option>
                  <option value="starbuck">Starbuck</option>
                  <option value="hotdog">Hot Dog</option>
                  <option value="apollo">Apollo</option>
                </select>
              </div>
            </div>
            <div class="grid-x grid-padding-x">
              <div class="large-6 medium-6 cell">
                <label>Choose Your Favorite</label>
                <input type="radio" name="pokemon" value="Red" id="pokemonRed"><label for="pokemonRed">Radio 1</label>
                <input type="radio" name="pokemon" value="Blue" id="pokemonBlue"><label for="pokemonBlue">Radio 2</label>
              </div>
              <div class="large-6 medium-6 cell">
                <label>Check these out</label>
                <input id="checkbox1" type="checkbox"><label for="checkbox1">Checkbox 1</label>
                <input id="checkbox2" type="checkbox"><label for="checkbox2">Checkbox 2</label>
              </div>
            </div>
            <div class="grid-x grid-padding-x">
              <div class="large-12 cell">
                <label>Textarea Label</label>
                <textarea placeholder="small-12.cell"></textarea>
              </div>
            </div>
          </form>
        </div>

        <div class="large-4 medium-4 cell">
          <h5>Try one of these buttons:</h5>
          <p><a href="#" class="button">Simple Button</a><br/>
          <a href="#" class="success button">Success Btn</a><br/>
          <a href="#" class="alert button">Alert Btn</a><br/>
          <a href="#" class="secondary button">Secondary Btn</a></p>
          <div class="callout">
            <h5>So many components, girl!</h5>
            <p>A whole kitchen sink of goodies comes with Foundation. Check out the docs to see them all, along with details on making them your own.</p>
            <a href="http://foundation.zurb.com/sites/docs/" class="small button">Go to Foundation Docs</a>
          </div>
        </div>
      </div>
    </div>

    <script src="bower_components/jquery/dist/jquery.js"></script>
    <script src="bower_components/what-input/dist/what-input.js"></script>
    <script src="bower_components/foundation-sites/dist/js/foundation.js"></script>
    <script src="js/min/app-min.js"></script>
  </body>
</html>