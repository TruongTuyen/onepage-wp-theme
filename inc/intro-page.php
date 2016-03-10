<?php
/**
 * Template Name: Intro Section
*/
?>

<?php
                    
                    $query = new WP_Query(array(
                                                'post_type'  => 'page',  /* overrides default 'post' */
                                                'meta_key'   => '_wp_page_template',
                                                'meta_value' => 'inc/intro-page.php',
                                                'posts_per_page'=>1
                    ) );
                    
                    if($query->have_posts()) : while($query->have_posts()) : $query->the_post();
                        $intro_des  = get_post_meta( get_the_ID(), '_onepage_intro_description', true );
                        $intro_cta_text  = get_post_meta( get_the_ID(), '_onepage_intro_cta_text', true );
                        $intro_cta_link  = get_post_meta( get_the_ID(), '_onepage_intro_cta_link', true );
                        $intro_image = get_post_meta(get_the_ID(),'_onepage_intro_image_id',true);
                        $intro_section_id = get_post_meta(get_the_ID(),'_onepage_intro_section_id', true);
                        $intro_image_url = wp_get_attachment_image_src($intro_image,'','');
                        $height = get_post_meta(get_the_ID(), '_onepage_intro_section_height',true);
?>
<div class="bg-section cd-fixed-background img-0" id="<?php echo esc_attr($intro_section_id); ?>"  <?php if(!empty($height)){ echo 'style="height:'.$height.'px !important"'; } ?>  >
        
            <div class="container">
                
                <h1 class="title_big"><?php the_content(); ?></h1>
                <div class="banner_ss0 ">
                     <h2 class="title_has_bg scrollme animateme" data-scale="1.5" data-opacity="0" data-crop="false" data-to="0" data-from="0.5" data-when="enter" ><?php echo esc_html($intro_des); ?></h2>
                    
                    <img class="responsive-img scrollme animateme" class="animateme"
    data-when="exit"
    data-from="0"
    data-to="0.5"
    data-opacity="0.3"
    data-translatex="-200"
    data-rotatez="45" src="<?php echo esc_url($intro_image_url[0]); ?>" alt="" />
                  
                    <a href="<?php echo esc_url( $intro_cta_link ) ?>" class="button_red scrollme animateme"  data-opacity="0"  data-to="1" data-from="0" data-when="exit"><?php echo esc_html($intro_cta_text); ?></a>
                </div>
                
                
            </div>
        </div>

<?php  endwhile; endif;wp_reset_postdata(); ?>