</div><!-- grid-x grid-padding-x -->


<footer id="footer_wrap">
    <div id="footer_widgets" >
        <ul class="no-bullet grid-x grid-padding-x">
          <?php if ( is_active_sidebar( 'footer' ) ) : ?>
            <?php dynamic_sidebar( 'footer' ); ?>
          <?php else : ?>
            <div class="alert alert-box alert-help">
              <p>Please activate some Widgets.</p>
            </div>
          <?php endif; ?>
        </ul>
    </div><!-- footer_widgets -->

    <div id="footer_meta" class="grid-x grid-padding-x" >
        <div id="copyright" class="small-12 large-5 cell">
          <p>Copyright &copy; <?php echo date("Y") ?> <a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>. All Rights Reserved.
          </p>
        </div><!-- copyright -->
        <div class="footer_menu small-12 large-7 cell">
          <ul class="menu">
            <?php $options = array(
              'theme_location' => 'nav_footer',
              'container' => false,
              'depth' => 2,
              'items_wrap' => '<ul id="%1$s" class="left %2$s">%3$s</ul>'
            );
            wp_nav_menu($options); ?>
          </ul>
        </div>







    </div><!-- footer_meta -->
  </footer><!-- footer_wrap -->
  </div><!-- grid-x grid-padding-x -->

  </body>
</html>