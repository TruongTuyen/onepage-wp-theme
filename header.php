<!DOCTYPE HTML>
<html  <?php language_attributes(); ?> >

<head>
	
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="author" content="designer" />
	<?php if (is_search()) { ?>
	   <meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>

	<title>
		   <?php
		      if (function_exists('is_tag') && is_tag()) {
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
	
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
	
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

	<?php wp_head(); ?>
	
</head>

<body <?php body_class(); ?>>

    <header class="header">
        <div class="wrapper">
            <div id="logo">
            <?php
                $logo_id = get_option('logo_header_image_id');
                $logo_image = wp_get_attachment_image_src( $logo_id, '','' ); 
                if(!empty($logo_image)){ ?>
                    <a class="logo" href="<?php bloginfo('url'); ?>"><img src="<?php echo esc_url($logo_image[0]);  ?>" alt="<?php bloginfo('description'); ?>" /> </a>
            <?php }else{  ?>
                <a class="logo" href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.png" alt="<?php bloginfo('description'); ?>" /> </a>
            <?php } ?>    
            </div><!-- logo -->
            
            
            
            
            <?php
            
            if(is_front_page()){
                $args = array(
                    //'menu' => 'One Page Menu',
                    'theme_location' => 'primary_menu',
                    'container' => 'nav',
                    'container_class' => 'nav nav_onpage',
                    'items_wrap'      => '<ul id="menu" class="plain clearfix">%3$s</ul>',
                    
                );
                
                wp_nav_menu($args);
            }else{
                $args = array(
                    //'menu' => 'One Page Menu',
                    'theme_location' => 'main_menu',
                    'container' => 'nav',
                    'container_class' => 'nav nav_onpage',
                    //'items_wrap'      => '<ul id="menu" class="plain clearfix">%3$s</ul>',
                    
                );
                
                wp_nav_menu($args);
            }
                
            
            ?>
        </div>
    </header>
