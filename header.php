<!doctype html>
<html <?php language_attributes(); ?> >

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<!-- support for pinterest -->
	<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
	<meta itemprop="url" content="<?php echo get_permalink(); ?>" />
	<title>
		<?php if (function_exists('is_tag') && is_tag()) {
			single_tag_title("Tag Archive for &quot;"); echo '&quot; - '; }
		elseif (is_archive()) {
			wp_title(''); echo ' Archive - '; }
		elseif (is_search()) {
			echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; }
		elseif (!(is_404()) && (is_single()) || (is_page())) {
			wp_title(''); echo ' - '; }
		elseif (is_404()) {
			echo 'Not Found - '; }
		if (is_home()) {
			bloginfo('name'); echo ' - '; bloginfo('description'); }
		else {
			bloginfo('name'); }
		if ($paged>1) {
			echo ' - page '. $paged; }
		?>
	</title>

	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />


	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
    <?php wp_head(); ?>
  </head>

  <body <?php body_class(''); ?> >

<div class="grid-container" id="header_title">
  	<div class="grid-x grid-padding-x">

  	<div class="header_menu small-4 cell">
		<ul class="menu">
			<?php $options = array(
				'theme_location' => 'nav_header_left',
				'container' => false,
				'depth' => 2,
				'items_wrap' => '<ul id="%1$s" class="left %2$s">%3$s</ul>'
			);
			wp_nav_menu($options); ?>
		</ul>
	</div>

    <div class="site_title small-4 cell">
      <?php if(is_home()){ ?>
            <h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
          <?php } else { ?>
            <h4><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h4>
          <?php } ?>
    </div><!-- #site_title END -->

	<div class="header_menu small-4 cell">
		<ul class="menu">
			<?php $options = array(
				'theme_location' => 'nav_header_right',
				'container' => false,
				'depth' => 2,
				'items_wrap' => '<ul id="%1$s" class="left %2$s">%3$s</ul>'
			);
			wp_nav_menu($options); ?>
		</ul>
	</div>

   </div>
  </div>

  <div class="grid-x grid-padding-x">
  <div class="cell medium-9 large-9">