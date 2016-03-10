<?php 
    if(is_front_page()){
        get_template_part('inc/partner-page'); 
    }else{

?>
<div class="section scrollme" id="footer"> 
        <div class="footer_container">
        
<?php }?>
              <div class="logo_icon_box">
                    <?php
                        $logo_id = get_option('logo_footer_image_id');
                        $logo_image = wp_get_attachment_image_src( $logo_id, '', '' ); 
                        if(!empty($logo_image)){ ?>
                            <img src="<?php echo esc_url($logo_image[0]);  ?>" alt="" />
                    <?php }else{  ?>
                        <img src="<?php bloginfo('stylesheet_directory'); ?>/images/icon_logo.png" alt="" />
                    <?php } ?>  
                    
                    </div>
                    <div class="social">
                        
                        <?php
                            $menu = array(
                                //'menu' => 'Social Footer Menu',
                                'theme_location' => 'social_footer_menu',
                                'container' => '',
                                'container_class' => '',
                                'items_wrap'      => '<ul id="social_menu" class="social_menu">%3$s</ul>'
                            );
                            
                            wp_nav_menu($menu);
                        
                        ?>
                    </div>
                    <div class="copy_right">
                        <?php echo esc_attr(get_option('footer_title')); ?><br /><br />
                        &copy; <?php bloginfo('name'); ?> <?php echo date("Y"); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php wp_footer(); ?>
</body>
</html>
