<?php
/**
 * Front Page Template For One Page
 * 
*/
?>
<?php get_header(); ?>
    <div id="fullpage" >
    
            <?php get_template_part( 'inc/intro', 'page' ); ?>
            <?php get_template_part('inc/video-page'); ?>
            <?php get_template_part('inc/guide-page'); ?>
            <?php get_template_part('inc/feature-page'); ?>
            <?php get_template_part('inc/sportler-page'); ?>
            <?php get_template_part('inc/benefit-page'); ?>
            <?php get_template_part('inc/subscribe-page'); ?>
<?php get_footer(); ?>