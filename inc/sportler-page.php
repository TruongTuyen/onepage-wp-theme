  <?php
      $sportler_title = get_option('sportler_title');
      $sportler_section_id = get_option('sportler_section_id');
      $sportler_section_height = get_option('sportler_section_height');

  ?>          

              <div class="section" id="<?php echo esc_attr($sportler_section_id ); ?>" <?php if(!empty($sportler_section_height)){ echo 'style="height:'.$sportler_section_height.'px !important"';} ?> >
                <h1 class="seecion4_title"><?php echo esc_attr($sportler_title); ?></h1>
                <div class="sporter scrollme">
                    <ul class="list_sporter">
                    <?php 
                    $sportler = new WP_Query( 'post_type=sportler&posts_per_page=8&orderby=ID&order=ASC' );
                    
                    $i=1;
                    if($sportler->have_posts()) : while($sportler->have_posts()) : $sportler->the_post();
                        $class = "item item{$i}col";
                        if($i == 4){ $i =0;}
                        $i++;
                    ?>
                        
                        <li class="<?php echo $class; ?>">
                            <?php
                            $default_attr = array(
                                'data-scale'=>0.8,
                                'data-opacity'=>0,
                                'data-crop'=>'false',
                                'data-to'=>0,
                                'data-from'=>0.5,
                                'data-when'=>'enter',
                                'style'=>"opacity: 1; transform: translate3d(0px, 0px, 0px) rotateX(0deg) rotateY(0deg) rotateZ(0deg) scale3d(1, 1, 1);",
                                'class' => "picture_sporter animateme",
                            );
                            the_post_thumbnail('project-thumbnail', $default_attr);
                            
                            ?>
                            
                            <div class="class_content_spo">
                                <a href="" class="title_sporter">
                                    <?php the_title(); ?>
                                </a>
                                <div class="desc_spoert">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        </li>
                    <?php endwhile; endif; wp_reset_postdata(); ?>    
                    </ul>
                </div>
                
            </div>