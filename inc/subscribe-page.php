<?php 
/**
 * Template Name: Subscribe Section
 * 
*/
?>
<?php
        $query = new WP_Query(array(
                                    'post_type'  => 'page',  /* overrides default 'post' */
                                    'meta_key'   => '_wp_page_template',
                                    'meta_value' => 'inc/subscribe-page.php',
                                    'posts_per_page'=>1
        ) );
        
        $prefix = "_onepage_subscribe";
        if($query->have_posts()) : while($query->have_posts()) : $query->the_post();
            $form_url  = get_post_meta( get_the_ID(), $prefix.'url_handling', true );
            $name_field_placeholder  = get_post_meta( get_the_ID(), $prefix.'placeholder_name', true );
            $email_field_placeholder  = get_post_meta( get_the_ID(), $prefix.'placeholder_email', true );
            $submit_text  = get_post_meta( get_the_ID(), $prefix.'submit_text', true );
            $section_id = get_post_meta(get_the_ID(), 'subscribe_section_id', true);
            $height = get_post_meta(get_the_ID(),'subscribe_section_height', true);
    ?>
<div class="bg-section cd-fixed-background img-2" id="<?php echo esc_attr($section_id); ?>" <?php if(!empty($height)){ echo 'style="height:'.esc_attr($height).'px !important"'; } ?>  >
    
    <?php the_content(); ?>
    <form class="form_contact" action="<?php echo esc_attr($form_url);  ?>" method="post">
        <div class="picture_form scrollme animateme" data-rotatez="-90" data-rotatey="90" data-rotatex="-90" data-to="0.1" data-from="0.5" data-when="view"></div>
        <div class="button_function">
            <input type="text" class="input_text" placeholder="<?php echo esc_attr($name_field_placeholder); ?>" name="NAME" value="" />
            <input type="text" class="input_text email" placeholder="<?php echo esc_attr($email_field_placeholder); ?>" name="EMAIL" value="" />
            <input type="submit" value="<?php echo esc_attr($submit_text); ?>" name="submit_form" class="button_contact_form" />
        </div>
    </form>
    
</div>
<?php endwhile; endif; wp_reset_postdata(); ?>