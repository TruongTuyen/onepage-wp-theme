<?php
/**
 * Template Name: Video Section
 * 
*/
?>
    <?php          
        $query = new WP_Query(array(
                                    'post_type'  => 'page',  /* overrides default 'post' */
                                    'meta_key'   => '_wp_page_template',
                                    'meta_value' => 'inc/video-page.php',
                                    'posts_per_page'=>1
        ) );
        
        $video_url_default = get_stylesheet_directory_uri() . '/video.mp4';
        
        if($query->have_posts()) : while($query->have_posts()) : $query->the_post();
            $video_url  = get_post_meta( get_the_ID(), '_onepage_video_url', true );
            $section_id = get_post_meta(get_the_ID(), '_onepage_video_section_id', true);
            $height = get_post_meta(get_the_ID(),'_onepage_video_section_height', true);
    ?>
<div class="section scrollme" id="<?php echo esc_attr($section_id); ?>" <?php if(!empty($height)){ echo 'style="height:'.$height.'px !important"'; } ?> >
    <div class="video">

    <h1 style="margin-top: 25px; margin-bottom: 5px;" class="title_big"><?php the_excerpt(); ?></h1>
    <div class="video_infomatio">
    <?php 
      if($video_url == ''){ 
          onepage_display_video($video_url_default);
      }else{ 
          onepage_display_video($video_url);
      }  
      
      ?>
    </div>
    
    </div>
    
</div>

<?php  endwhile; endif; wp_reset_postdata();?>