<?php
/**
 * Template Name: Benefit Section
 * 
*/

?>
<?php 
                
                $query = new WP_Query(array(
                                            'post_type'  => 'page',  /* overrides default 'post' */
                                            'meta_key'   => '_wp_page_template',
                                            'meta_value' => 'inc/benefit-page.php',
                                            'posts_per_page'=>1
                ) );
                $i = 1;
                if($query->have_posts()) : while($query->have_posts()) : $query->the_post() ;
                    $cta_link = get_post_meta( get_the_ID(), 'manufacture_CTA_Link', true );
                    $cta_text = get_post_meta( get_the_ID(), 'manufacture_CTA_Text', true );
                    $manufacture_list_title = get_post_meta( get_the_ID(), 'manufacture_list_title', true );
                    
                    $benefit_info = get_post_meta( get_the_ID(), '_onepage_benefit_feature', false );
                    $manufacture_image = get_post_meta( get_the_ID(), '_onepage_manufacture_feature', false );
                    $section_id = get_post_meta(get_the_ID(),'benefit_section_id',true);
                    $height = get_post_meta(get_the_ID(), '_onepage_benefit_section_height',true);
?>
            
            <div class="bg-section cd-fixed-background img-1 scrollme scrollme" id="<?php echo esc_attr($section_id); ?>" <?php if(!empty($height)){ echo 'style="height:'.$height.'px !important"'; } ?>  >
            
            
                <h1 class="seecion4_title" style="color: #fff; margin-bottom: 23px;"><?php the_title(); ?></h1>
                <div class="voteile_box">
                    <div class="madein_germany animateme" data-rotatez="-90" data-rotatey="90" data-rotatex="-90" data-to="0.1" data-from="0.5" data-when="view">
                    </div>
                    <div class="tage_30 animateme" data-translatey="400" data-translatex="400" data-to="0.15" data-from="0.5" data-when="view" ></div>
                    <div class="trsut_shop ">
                        <ul class="list_trust animateme" data-opacity="0" data-to="0" data-from="0.5" data-when="view">
                            <?php
                                foreach($benefit_info[0] as $info){
                                     $image = wp_get_attachment_image_src( $info['benefit_image_id'], '', '' ); 
                            ?>
                            
                            <li class="item">
                                <i class="icon"><img src="<?php echo $image[0]; ?>" alt="" /></i>
                                <span class="title_vor"><?php echo $info['benefit_title']; ?></span>
                                <span class="subtiel_vore"><?php echo $info['CTA_Text']; ?> </span>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="button_box2">
                        <a class="button button_vore" href="<?php echo esc_url($cta_link); ?>"><i class="cart_icon"></i><?php echo esc_html($cta_text); ?></a>
                    </div>
                </div>
                <div class="footer_secssion_5">
                    <div class="container">
                        <h1 class="seecion4_title" style="color: #fff;margin-bottom: 5px;margin-top: 6px;padding-bottom: 5px;"><?php echo esc_html($manufacture_list_title); ?></h1>
                        <ul class="list_manuafacture"><!-- nha may san xuat -->
                            <?php
                                foreach($manufacture_image[0] as $manu){
                                    $image = wp_get_attachment_image_src( $manu['manufacture_image_id'], '', '' ); 
                                    $class = "item manu{$i}";
                                    $i++;
                                    
                            ?>
                            <li class="<?php echo $class; ?>">
                                <a href="<?php echo esc_url($manu['manufacture_url_link']); ?>"><img class="animateme" data-rotatez="-90" data-rotatey="90" data-rotatex="-90" data-translatey="400" data-translatex="400" data-to="0.15" data-from="0.5" data-when="view"  src="<?php echo esc_attr( $image[0]); ?>" alt="" /></a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <?php endwhile; endif; wp_reset_postdata(); ?>
            </div>