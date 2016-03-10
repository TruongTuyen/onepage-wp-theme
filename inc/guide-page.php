<?php
/**
 * Template Name: Guide Section 
*/

?>

<?php          
        $query = new WP_Query(array(
                                    'post_type'  => 'page',  /* overrides default 'post' */
                                    'meta_key'   => '_wp_page_template',
                                    'meta_value' => 'inc/guide-page.php',
                                    'posts_per_page'=>1
        ) );
        
        
        if($query->have_posts()) : while($query->have_posts()) : $query->the_post();
            $cta_url  = get_post_meta( get_the_ID(), '_onepage_guide_cta_url', true );
            $cta_text  = get_post_meta( get_the_ID(), '_onepage_guide_cta_text', true );
            $section_id = get_post_meta(get_the_ID(), '_onepage_guide_section_id', true);
            $height = get_post_meta(get_the_ID(), '_onepage_guide_section_height', true);
    ?>
<div class="section scrollme animateme" data-opacity="0"  data-to="1" data-from="0" data-when="exit" id="<?php echo esc_attr($section_id); ?>" <?php if(!empty($height)){ echo 'style="height:'.$height.'px !important"'; } ?>  >
    
    <div class="section_sub">
        <?php the_content(); ?>
        <a href="<?php echo esc_url($cta_url); ?>" class="button_red b_session2_bottom"><?php echo($cta_text); ?></a>
    </div>
    
</div>

<?php  endwhile; endif;wp_reset_postdata(); ?>