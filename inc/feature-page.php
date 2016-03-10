<?php
/**
 * Template Name: Feature Section
 * 
*/


?>
<?php
      $feature_section_id= get_option('feature_section_id');
      $feature_section_height= get_option('feature_section_height');

?> 
<div class="section" id="<?php echo esc_attr($feature_section_id); ?>" <?php if(!empty($feature_section_height)){ echo 'style="height:'.esc_attr($feature_section_height).'px !important"'; } ?> >
    <?php 
        $id = get_option('feature_id');
        $query = new WP_Query("post_type=page&post_parent={$id}&posts_per_page=3&orderby=ID&order=ASC");
        $i = 1;
        if($query->have_posts()) : while($query->have_posts()) : $query->the_post() ;
            $right_banner_image_id  = get_post_meta( get_the_ID(), 'right_banner_image_id', true );
            $right_banner_image = wp_get_attachment_image_src( $right_banner_image_id, '','' ); 
            $cta_text  = get_post_meta( get_the_ID(), 'CTA_Text', true );
            $cta_link  = get_post_meta( get_the_ID(), 'CTA_Link', true );
            $footer_title  = get_post_meta( get_the_ID(), 'footer_title', true );
            $footer_content  = get_post_meta( get_the_ID(), 'footer_content', true );
            $footer_banner_image_id = get_post_meta( get_the_ID(), 'footer_banner_image_id', true );
            $footer_banner_image = wp_get_attachment_image_src( $footer_banner_image_id, '','' ); 
            $image_and_title = get_post_meta( get_the_ID(), '_onepage_feature_image_and_title', false );
            
    ?>
    <div class="<?php if($i==1){echo 'container_1';}else{echo'container_1 container_'.$i;} ?>">
                <h1 class="dosis_semibold"><?php the_title(); ?></h1>
                <div class="row_feature scrollme animateme" data-scale="1.5" data-opacity="0" data-crop="false" data-to="0" data-from="0.5" data-when="enter">
                  <div class="feature_content">
                    <div class="petrol_blue">
                        <?php the_post_thumbnail(); ?>
                        <div class="text_yellow"> <?php the_content(); ?> </div>
                    </div>
                    <div class="feature">
                        
                        <ul class="list_feature">
                            <?php 
                                foreach($image_and_title[0] as $detail){  
                                    $image = wp_get_attachment_image_src( $detail['image_id'], '','' ); 
                           ?>
                                    
                                    <li class="item"><img src="<?php echo esc_url($image[0]); ?>" /><?php echo($detail['title']); ?></li>
                            <?php    }  ?>
                            
                            
                        </ul>
                    </div>
                    <img class="banner_boy_swimming" src="<?php echo esc_url($right_banner_image[0]); ?>" alt="feature" /><!-- banner image right -->
                </div>
                <a href="<?php echo esc_url($cta_link); ?>" class="button"><?php echo($cta_text); ?></a><!-- call to action -->
                </div>
                <div class="footer_secssion scrollme animateme" data-rotatex="90" data-to="0" data-from="1" data-when="enter"  >
                    <div class="left_box">
                        <h2 class="title_dosislight"><?php echo apply_filters('onepage_title_dosislight',$footer_title) ; ?></h2> <!-- title -->
                        <div class="arrow_box">
                            <?php echo $footer_content; ?>
                        </div><!-- content -->
                    </div>
                    <img class="banner_footer" style="" src="<?php echo esc_url($footer_banner_image[0]); ?>" alt="" /><!-- banner footer image -->
                </div>
                </div> 
                
        <?php  $i++;endwhile; endif; wp_reset_postdata(); ?>        
</div>
