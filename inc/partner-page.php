<?php
/**
 * Template Name: Partner Section
 * 
*/
?>
<?php 
                
                $query = new WP_Query(array(
                                            'post_type'  => 'page',  /* overrides default 'post' */
                                            'meta_key'   => '_wp_page_template',
                                            'meta_value' => 'inc/partner-page.php',
                                            'posts_per_page'=>1
                ) );
                $i = 1;
                if($query->have_posts()) : while($query->have_posts()) : $query->the_post() ;
                    $partner_info = get_post_meta( get_the_ID(), '_onepage_partner_section', false );
                    $section_id = get_post_meta(get_the_ID(),'partner_section_id', true);
                    $height = get_post_meta(get_the_ID(), 'partner_section_height', true);
?>
            <div class="section scrollme" id="<?php echo esc_attr($section_id); ?>" <?php if(!empty($height)){ echo 'style="height:'.$height.'px !important"'; } ?>  >
            
                <div class="footer_container">
                    <h1 class="seecion4_title"><?php the_title(); ?></h1>
                    <ul class="flag_list">
                    <?php 
                        foreach($partner_info[0] as $info){
                            $image = wp_get_attachment_image_src( $info['partner_image_id'], '','' ); 
                    ?>
                        <li class="item <?php if($i==1){echo "first_item";}else{echo "";}  ?>">
                            <img src="<?php echo esc_url($image[0]); ?>" alt="" />
                            <p><?php echo esc_html($info['partner_content']); ?></p>
                        </li>
                    <?php $i++; } ?>    
                    </ul>
                    
              <?php endwhile; endif; wp_reset_postdata(); ?>      