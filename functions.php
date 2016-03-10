<?php
	define('THEME_URL',get_stylesheet_directory()); // This const set the absolute directory to theme folder
	
    //Bootstrap cmb2
//    if ( file_exists(  __DIR__ . '/cmb2/init.php' ) ) {
//      require_once  __DIR__ . '/cmb2/init.php';
//    } elseif ( file_exists(  __DIR__ . '/CMB2/init.php' ) ) {
//      require_once  __DIR__ . '/CMB2/init.php';
//    }
    //require_once(THEME_URL . '/CMB2/example-functions.php');
    // Enqueue script need to one page
    if(!function_exists('onepage_enqueue_script')){
        function onepage_enqueue_script(){
            if ( !is_admin() ) {
               // Load main Jquery from googleapis 
               wp_deregister_script('jquery');
        	   wp_register_script('jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"), false);
        	   wp_enqueue_script('jquery'); 
               // Load Jquery-UI and another files
        	   wp_deregister_script('jquery_ui');
        	   wp_register_script('jquery_ui', ("http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"), false);
        	   wp_enqueue_script('jquery_ui');
               
               wp_register_script('isInViewport', get_template_directory_uri(). '/js/isInViewport.js');
               wp_enqueue_script('isInViewport');
               
               wp_register_script('scrollmejs', get_template_directory_uri(). '/js/jquery.scrollme.js');
               wp_enqueue_script('scrollmejs');
               
               wp_register_script('jsjs', get_template_directory_uri(). '/js/js.js');
               wp_enqueue_script('jsjs');
               
               // Load main stylesheet and another
               wp_register_style('fullPageCss', get_template_directory_uri() . '/css/jquery.fullPage.css');
               wp_enqueue_style('fullPageCss');
               
               wp_register_style('main-style', get_template_directory_uri() . '/css/style.css','all');
               wp_enqueue_style('main-style');
               
               // Load wp library
               
        	}
        }
        
        add_action('wp_enqueue_scripts','onepage_enqueue_script');
    }
    
	// Clean up the <head>
    if(!function_exists('removeHeadLinks')){
        function removeHeadLinks() {
        	remove_action('wp_head', 'rsd_link');
        	remove_action('wp_head', 'wlwmanifest_link');
        }
        add_action('init', 'removeHeadLinks');
        remove_action('wp_head', 'wp_generator');
    }
    
    // Register sidebar
    if (function_exists('register_sidebar')) {
    	register_sidebar(array(
    		'name' => 'Sidebar Widgets',
    		'id'   => 'sidebar-widgets',
    		'description'   => 'These are widgets for the sidebar.',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h2>',
    		'after_title'   => '</h2>'
    	));
    }
    
    // One Page theme setup
    if( !function_exists('onepage_theme_setup')){
        function onepage_theme_setup(){
            // Set textdomain
            $language_folder = THEME_URL . '/languages';
            load_theme_textdomain('onepage',$language_folder);
            
            // Automatic add RSS Link to <head>
            add_theme_support('automatic-feed-links');
            
            // Theme post thumbanail
            add_theme_support('post-thumbnails');
            
            // Them post-format
            add_theme_support('post-formats',array('image','video','gallery','quote','link'));
            
            // Them title-tag : Automatic add <title> in <head>
            //add_theme_support('title-tag');
            
            // Add custom background
            $default_backgroud_color = array('default-color'=> '#e8e8e8');
            add_theme_support('custom-background',$default_backgroud_color);
            
            // Set place to display menu
            register_nav_menus( array(
            	'primary_menu' => __('One Page Menu','onepage'),
                'main_menu' => __('Main Menu','onepage'),
            	'social_footer_menu' => __('Social Footer Menu','onepage'),
            ) );
            
        }
        
        add_action('init','onepage_theme_setup'); // hook 'init' run when reload page
    }
    
    // Display menu
    if(!function_exists('onepage_menu')){
        function onepage_menu($menu){
            $args = array(
                'theme_location' => $menu,
                'container' => 'nav',
                'container_class' => $menu,
            );
            
            wp_nav_menu($args);
        }
    }
    
    
    
    // Create meta boxes
    if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
    	require_once dirname( __FILE__ ) . '/cmb2/init.php';
    } elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
    	require_once dirname( __FILE__ ) . '/CMB2/init.php';
        
    }
    
    add_action('cmb2_init','intro_meta_boxes');
    function intro_meta_boxes(){
        $prefix = '_onepage_';
        
        $intro_meta = new_cmb2_box(array(
            'id' => 'intro_meta_box',
            'title' => __('Intro Meta Box','onepage'),
            'object_types' => array('page'),
            'context' =>'nomal',
            'priority' => 'high',
            'show_on'      => array( 'key' => 'page-template', 'value' => 'inc/intro-page.php' ),
            'show_names' => true
        ));
        
        $intro_meta->add_field( array(
            'name'       => __( 'Section ID', 'onepage' ),
            'id'         => $prefix . 'intro_section_id',
            'type'       => 'text',
           
        ) );

        $intro_meta->add_field( array(
            'name'       => __( 'Height', 'onepage' ),
            'desc'       => __( 'Enter value in pixel if you need to set height for this section', 'onepage' ), 
            'id'         => $prefix . 'intro_section_height',
            'type'       => 'text',
           
        ) );
        
        $intro_meta->add_field( array(
            'name'       => __( 'Short Description', 'onepage' ),
            'desc'       => __( 'Add a short description for intro section', 'onepage' ),
            'id'         => $prefix . 'intro_description',
            'type'       => 'text',
            'show_on_cb' => 'cmb2_hide_if_no_cats', 
        ) );
        
        $intro_meta->add_field( array(
            'name'       => __( 'CTA Text', 'onepage' ),
            'desc'       => __( 'Add text for Call to action button', 'onepage' ),
            'id'         => $prefix . 'intro_cta_text',
            'type'       => 'text',
            'show_on_cb' => 'cmb2_hide_if_no_cats', 
        ) );
        
        $intro_meta->add_field( array(
            'name'       => __( 'CTA Link', 'onepage' ),
            'desc'       => __( 'Add link for Call to action button', 'onepage' ),
            'id'         => $prefix . 'intro_cta_link',
            'type'       => 'text',
            'show_on_cb' => 'cmb2_hide_if_no_cats', 
        ) );
        
        $intro_meta->add_field( array(
    		'name' => __( 'Intro Image', 'onepage' ),
    		'desc' => __( 'Upload an image or enter a URL.', 'onepage' ),
    		'id'   => $prefix . 'intro_image',
    		'type' => 'file',
    	) );
        
        
    }// Intro meta box
    
    
    /// Video Meta Box
    add_action( 'cmb2_init', 'video_metabox' );
    /**
     * Hook in and add a demo metabox. Can only happen on the 'cmb2_init' hook.
     */
    function video_metabox() {
    
    	// Start with an underscore to hide fields from custom fields list
    	$prefix = '_onepage_';
    
    	/**
    	 * Sample metabox to demonstrate each field type included
    	 */
    	$cmb_demo = new_cmb2_box( array(
    		'id'            => 'video_metabox',
    		'title'         => __( 'Video Metabox', 'onepage' ),
    		'object_types'  => array( 'page', ), // Post type
            'show_on'      => array( 'key' => 'page-template', 'value' => 'inc/video-page.php' ),
            //'context' =>'nomal',
            'priority' => 'high',
            'show_names' => true
    	) );
        
        $cmb_demo->add_field( array(
            'name'       => __( 'Section ID', 'onepage' ),
            'id'         => $prefix . 'video_section_id',
            'type'       => 'text',
        ) );

        $cmb_demo->add_field( array(
            'name'       => __( 'Height', 'onepage' ),
            'desc'       => __( 'Enter value in pixel if you need to set height for this section', 'onepage' ), 
            'id'         => $prefix . 'video_section_height',
            'type'       => 'text',
        ) );
        
        $cmb_demo->add_field( array(
            'name'       => __( 'Video URL', 'onepage' ),
            'desc'       => __( 'Add video URL Like: <br/> https://www.youtube.com/watch?v=abcdefgh <br/>Or https://vimeo.com/1234567890<br/>Or http://domain/whitecaps/wp-content/themes/onepage/video.mp4 ( only support: .mp4, .webm, .ogg)', 'onepage' ),
            'id'         => $prefix . 'video_url',
            'type'       => 'text',
            'show_on_cb' => 'cmb2_hide_if_no_cats', 
        ) );
    
    }// Video meta box
    
    
    //Guide Meta Box
    add_action( 'cmb2_init', 'guide_metabox' );
    /**
     * Hook in and add a demo metabox. Can only happen on the 'cmb2_init' hook.
     */
    function guide_metabox() {
    
    	// Start with an underscore to hide fields from custom fields list
    	$prefix = '_onepage_';
    
    	/**
    	 * Sample metabox to demonstrate each field type included
    	 */
    	$cmb_demo = new_cmb2_box( array(
    		'id'            => 'guide_metabox',
    		'title'         => __( 'Guide Metabox', 'onepage' ),
    		'object_types'  => array( 'page', ), // Post type
            'show_on'      => array( 'key' => 'page-template', 'value' => 'inc/guide-page.php' ),
            //'context' =>'nomal',
            'priority' => 'high',
            'show_names' => true
    	) );
        
        $cmb_demo->add_field(array(
            'name' => __('Section ID','onepage'),
            'id'         => $prefix . 'guide_section_id',
            'type'       => 'text',
        ));
        
       $cmb_demo->add_field( array(
            'name'       => __( 'Height', 'onepage' ),
            'desc'       => __( 'Enter value in pixel if you need to set height for this section', 'onepage' ), 
            'id'         => $prefix . 'guide_section_height',
            'type'       => 'text',
        ) ); 


        $cmb_demo->add_field( array(
            'name'       => __( 'CTA link URL', 'onepage' ),
            'desc'       => __( 'Add link to Call to action button', 'onepage' ),
            'id'         => $prefix . 'guide_cta_url',
            'type'       => 'text',
            'show_on_cb' => 'cmb2_hide_if_no_cats', 
        ) );
        
        $cmb_demo->add_field( array(
            'name'       => __( 'CTA Text', 'onepage' ),
            'desc'       => __( 'Add text to Call to action button', 'onepage' ),
            'id'         => $prefix . 'guide_cta_text',
            'type'       => 'text',
            'show_on_cb' => 'cmb2_hide_if_no_cats', 
        ) );
    
    }// Guide meta box


        // Feature Meta Box
        add_action( 'cmb2_init', 'feature_metabox' );
        /**
         * Hook in and add a metabox to demonstrate repeatable grouped fields
         */
        function feature_metabox() {
        
        	// Start with an underscore to hide fields from custom fields list
        	$prefix = '_onepage_';
        
        	/**
        	 * Repeatable Field Groups
        	 */
            
        	$cmb_group = new_cmb2_box( array(
        		'id'           => $prefix . 'metabox',
        		'title'        => __( 'Feature Meta Box', 'onepage' ),
        		'object_types' => array( 'page', ),
                'show_on'      => array( 'key' => 'page-template', 'value' => 'inc/feature-page.php' ),
        	) );
        
        	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
        	$group_field_id = $cmb_group->add_field( array(
        		'id'          => $prefix . 'feature_image_and_title',
        		'type'        => 'group',
        		'description' => __( 'Add features for your items', 'onepage' ),
        		'options'     => array(
        			'group_title'   => __( 'Feature Item {#}', 'onepage' ), // {#} gets replaced by row number
        			'add_button'    => __( 'Add New Entry', 'onepage' ),
        			'remove_button' => __( 'Remove Entry', 'onepage' ),
        			'sortable'      => true, 
        		),
        	) );
        
        	$cmb_group->add_group_field( $group_field_id, array(
        		'name'       => __( 'Title', 'onepage' ),
        		'id'         => 'title',
        		'type'       => 'text',
        		// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
        	) );
        
        	$cmb_group->add_group_field( $group_field_id, array(
        		'name' => __( 'Entry Image', 'onepage' ),
        		'id'   => 'image',
        		'type' => 'file',
        	) );
            
            $cmb_group->add_field(array(
        		'name' => __( 'Entry Right Banner Image', 'onepage' ),
        		'id'   => 'right_banner_image',
        		'type' => 'file',
        	) );
            
            $cmb_group->add_field(array(
        		'name' => __( 'CTA Text', 'onepage' ),
        		'id'   => 'CTA_Text',
        		'type' => 'text',
        	) );
            
            $cmb_group->add_field(array(
        		'name' => __( 'CTA Link', 'onepage' ),
        		'id'   => 'CTA_Link',
        		'type' => 'text',
        	) );
            
            $cmb_group->add_field(array(
        		'name' => __( 'Footer Title', 'onepage' ),
        		'id'   => 'footer_title',
        		'type' => 'text',
        	) );
            
            $cmb_group->add_field(array(
        		'name' => __( 'Footer Content', 'onepage' ),
        		'id'   => 'footer_content',
        		'type' => 'wysiwyg',
        	) );
            
            $cmb_group->add_field(array(
        		'name' => __( 'Entry Footer Banner Image', 'onepage' ),
        		'id'   => 'footer_banner_image',
        		'type' => 'file',
        	) );
        
        }
        
        
        
            // create simple theme option
            add_action('admin_menu', 'onepage_theme_option');
            
            function onepage_theme_option() {
            
            	//create new top-level menu
            	add_menu_page('OnePage Theme Option', 'Theme Option', 'administrator', __FILE__, 'theme_option_setting'  );
            
            	//call register settings function
            	add_action( 'admin_init', 'register_theme_settings' );
            }
            
            ///////////////////////////////////////////////////////////////////////////////////
            function my_admin_scripts() {
                wp_enqueue_script('jquery');
                wp_enqueue_script('media-upload');
                wp_enqueue_script('thickbox');
                wp_register_script('my-upload',  get_template_directory_uri() . '/js/my-script.js', array('jquery','media-upload','thickbox'));
                wp_enqueue_script('my-upload');
                
                
               
            }
                 
            function my_admin_styles() {
                wp_enqueue_style('thickbox');
            }
             // This will enqueue the Media Uploader script
            
            add_action('admin_print_scripts', 'my_admin_scripts');
            add_action('admin_print_styles', 'my_admin_styles');
            add_action('admin_print_styles', 'wp_enqueue_media');
            ///////////////////////////////////////////////////////////////////////////////////
            function register_theme_settings() {
            	//register our settings
            	register_setting( 'option-group', 'feature_id' );
                register_setting( 'option-group', 'logo_header_image' );
                register_setting( 'option-group', 'logo_header_image_id' );
                register_setting( 'option-group', 'logo_footer_image' );
                register_setting( 'option-group', 'logo_footer_image_id' );
                register_setting( 'option-group', 'footer_title' );
                register_setting( 'option-group', 'sportler_title' );
                register_setting( 'option-group', 'sportler_section_id' ); 
                register_setting( 'option-group', 'sportler_section_height' );
                register_setting( 'option-group', 'feature_section_id' ); 
                register_setting( 'option-group', 'feature_section_height' );


            }
            
            function theme_option_setting() {
            ?>
            <div class="wrap">
            
            
            <h2>One Page Theme Option</h2>
            
            <form method="post" action="options.php">
                <?php settings_fields( 'option-group' ); ?>
                <?php do_settings_sections( 'option-group' ); ?>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">Enter Feature Page ID</th>
                        <td><input type="text" name="feature_id" placeholder="Ex: 6" value="<?php echo esc_attr( get_option('feature_id') ); ?>" /></td>
                    </tr>

                    <tr valign="top">
                       <th scope="row">Feature Section ID</th>
                       <td><input type="text" name="feature_section_id"  value="<?php echo esc_attr( get_option('feature_section_id') ); ?>" /></td>
                    </tr>

                    <tr valign="top">
                       <th scope="row">Feature Section Height</th>
                       <td><input type="text" name="feature_section_height"  value="<?php echo esc_attr( get_option('feature_section_height') ); ?>" /></td>
                    </tr> 

                    <tr valign="top">
                        <th scope="row">Upload Header Logo Image</th>
                        <td>
                            <input type="text" name="logo_header_image" id="header_logo" class="regular-text" value="<?php echo esc_attr( get_option('logo_header_image') ); ?>"/>
                            <input type="hidden" name="logo_header_image_id" id="header_logo_id" value="<?php echo esc_attr( get_option('logo_header_image_id') ); ?>"/>
                            <input type="submit" name="upload-btn" id="upload-btn-1" class="button-secondary" value="Upload Image"/>
                        </td>
                        
                    </tr>
                    <tr valign="top">
                        <th scope="row">Upload Footer Logo Image</th>
                        <td>
                            <input type="text" name="logo_footer_image" id="footer_logo" class="regular-text" value="<?php echo esc_attr( get_option('logo_footer_image') ); ?>"/>  
                            <input type="hidden" name="logo_footer_image_id" id="footer_logo_id" value="<?php echo esc_attr( get_option('logo_footer_image_id') ); ?>"/>  
                            <input type="submit" name="upload-btn" id="upload-btn-2" class="button-secondary" value="Upload Image"/>
                        </td>
                        
                    </tr>

                    <tr valign="top">
                       <th scope="row">Sportler Section Title</th>
                       <td><input type="text" name="sportler_title"  value="<?php echo esc_attr( get_option('sportler_title') ); ?>" style="width:25em;" /></td>
                    </tr> 

                    <tr valign="top">
                       <th scope="row">Sportler Section ID</th>
                       <td><input type="text" name="sportler_section_id"  value="<?php echo esc_attr( get_option('sportler_section_id') ); ?>" /></td>
                    </tr>

                    <tr valign="top">
                       <th scope="row">Sportler Section Height</th>
                       <td><input type="text" name="sportler_section_height"  value="<?php echo esc_attr( get_option('sportler_section_height') ); ?>" /></td>
                    </tr> 

                    <tr valign="top">
                       <th scope="row">Footer Title</th>
                       <td><input type="text" name="footer_title" placeholder="Ex: IMPRESSUM" value="<?php echo esc_attr( get_option('footer_title') ); ?>" /></td>
                    </tr>
                </table>
                
                <?php submit_button(); ?>
            
            </form>
            </div>
<?php } 
    
            //Create post type Sportler
            add_action( 'init', 'sportler_register' );
            function sportler_register() {
              $labels = array(
                'name' => _x('Sportlers', 'post type general name'),
                'singular_name' => _x('Sportler', 'post type singular name'),
                'add_new' => _x('Add New', 'Product'),
                'add_new_item' => __('Add New Sportler'),
                'edit_item' => __('Edit Sportler'),
                'new_item' => __('New Sportler'),
                'all_items' => __('All Sportlers'),
                'view_item' => __('View Sportlers'),
                'search_items' => __('Search Sportler'),
                'not_found' =>  __('No Sportler found'),
                'not_found_in_trash' => __('No Sportlers found in Trash'),
                'parent_item_colon' => '',
                'menu_name' => 'Sportlers'
              );
              $args = array(
                'label'  => __('sportler','onepage'),
                'labels' => $labels,
                'public' => false,
                'has_archive' => true,////
                'publicly_queryable' => true,
                'show_ui' => true,
                'menu_position' => 5,
                'show_in_menu' => true,
                'query_var' => true,
                'rewrite' => true,
                'capability_type' => 'post',
                'hierarchical' => false,
                'supports' => array( 'title','editor','excerpt','author','thumbnail', ),
                'taxonomies' => array( 'category', 'post_tag' ),
              );
              register_post_type('sportler',$args);
              flush_rewrite_rules();
            }
            
            
            // Benefit Section Meta Box
            add_action( 'cmb2_init', 'benefit_metabox' );
            /**
             * Hook in and add a metabox to demonstrate repeatable grouped fields
             */
            function benefit_metabox() {
            
            	// Start with an underscore to hide fields from custom fields list
            	$prefix = '_onepage_';
            
            	/**
            	 * Repeatable Field Groups
            	 */
                
            	$cmb_group = new_cmb2_box( array(
            		'id'           => $prefix . 'benefit_metabox',
            		'title'        => __( 'Feature Meta Box', 'onepage' ),
            		'object_types' => array( 'page', ),
                    'show_on'      => array( 'key' => 'page-template', 'value' => 'inc/benefit-page.php' ),
            	) );
                

                 $cmb_group->add_field(array(
            		'name' => __( 'Section ID', 'onepage' ),
            		'id'   => 'benefit_section_id',
            		'type' => 'text',
            	) );

               $cmb_group->add_field( array(
                       'name'       => __( 'Height', 'onepage' ),
                       'desc'       => __( 'Enter value in pixel if you need to set height for this section', 'onepage' ), 
                       'id'         => $prefix . 'benefit_section_height',
                       'type'       => 'text',
                ) ); 

            	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
            	$group_field_id = $cmb_group->add_field( array(
            		'id'          => $prefix . 'benefit_feature',
            		'type'        => 'group',
            		'description' => __( 'Add benefit for your items', 'onepage' ),
            		'options'     => array(
            			'group_title'   => __( 'Benefit Item {#}', 'onepage' ), // {#} gets replaced by row number
            			'add_button'    => __( 'Add New Entry', 'onepage' ),
            			'remove_button' => __( 'Remove Entry', 'onepage' ),
            			'sortable'      => true, 
            		),
            	) );
                
                
                
                $cmb_group->add_group_field( $group_field_id, array(
            		'name' => __( 'Benefit Image', 'onepage' ),
            		'id'   => 'benefit_image',
            		'type' => 'file',
            	) );
                
                
            	$cmb_group->add_group_field( $group_field_id, array(
            		'name'       => __( 'Benefit Title', 'onepage' ),
            		'id'         => 'benefit_title',
            		'type'       => 'text',
            		// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
            	) );
            
            	
                
                $cmb_group->add_group_field( $group_field_id,array(
            		'name' => __( 'Benefit Description', 'onepage' ),
            		'id'   => 'CTA_Text',
            		'type' => 'text',
            	) );
                
                $cmb_group->add_field(array(
            		'name' => __( 'Call To Action Button Text', 'onepage' ),
            		'id'   => 'manufacture_CTA_Text',
            		'type' => 'text',
            	) );
                
                $cmb_group->add_field(array(
            		'name' => __( 'Call To Action Button Link', 'onepage' ),
            		'id'   => 'manufacture_CTA_Link',
            		'type' => 'text',
            	) );
                
                $cmb_group->add_field(array(
            		'name' => __( 'List Manufacture Title', 'onepage' ),
            		'id'   => 'manufacture_list_title',
            		'type' => 'text',
            	) );
                
                $manufacture_field_id = $cmb_group->add_field( array(
            		'id'          => $prefix . 'manufacture_feature',
            		'type'        => 'group',
            		'description' => __( 'Add Manufacture', 'onepage' ),
            		'options'     => array(
            			'group_title'   => __( 'Manufacture {#}', 'onepage' ), // {#} gets replaced by row number
            			'add_button'    => __( 'Add New Entry', 'onepage' ),
            			'remove_button' => __( 'Remove Entry', 'onepage' ),
            			'sortable'      => true, 
            		),
            	) );
                
                $cmb_group->add_group_field( $manufacture_field_id, array(
            		'name' => __( 'Manufacture URL Link', 'onepage' ),
            		'id'   => 'manufacture_url_link',
            		'type' => 'file',
            	) );
                
                $cmb_group->add_group_field( $manufacture_field_id, array(
            		'name' => __( 'Manufacture Image', 'onepage' ),
            		'id'   => 'manufacture_image',
            		'type' => 'file',
            	) );
            
            }
            
            // Partner section meta box
            add_action( 'cmb2_init', 'partner_metabox' );
            /**
             * Hook in and add a metabox to demonstrate repeatable grouped fields
             */
            function partner_metabox() {
            
            	// Start with an underscore to hide fields from custom fields list
            	$prefix = '_onepage_';
            
            	/**
            	 * Repeatable Field Groups
            	 */
                
            	$cmb_group = new_cmb2_box( array(
            		'id'           => $prefix . 'partner_metabox',
            		'title'        => __( 'Partner Meta Box', 'onepage' ),
            		'object_types' => array( 'page', ),
                    'show_on'      => array( 'key' => 'page-template', 'value' => 'inc/partner-page.php' ),
            	) );
                
                $cmb_group->add_field(array(
            		'name' => __( 'Section ID', 'onepage' ),
            		'id'   => 'partner_section_id',
            		'type' => 'text',
            	) );
 
                $cmb_group->add_field( array(
                       'name'       => __( 'Height', 'onepage' ),
                       'desc'       => __( 'Enter value in pixel if you need to set height for this section', 'onepage' ), 
                       'id'         => 'partner_section_height',
                       'type'       => 'text',
                ) ); 

            	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
            	$group_field_id = $cmb_group->add_field( array(
            		'id'          => $prefix . 'partner_section',
            		'type'        => 'group',
            		'description' => __( 'Add your partner', 'onepage' ),
            		'options'     => array(
            			'group_title'   => __( 'Partner {#}', 'onepage' ), // {#} gets replaced by row number
            			'add_button'    => __( 'Add New Entry', 'onepage' ),
            			'remove_button' => __( 'Remove Entry', 'onepage' ),
            			'sortable'      => true, 
            		),
            	) );
                
                
                
                $cmb_group->add_group_field( $group_field_id, array(
            		'name' => __( 'Partner Image', 'onepage' ),
            		'id'   => 'partner_image',
            		'type' => 'file',
            	) );
                
                
            	$cmb_group->add_group_field( $group_field_id, array(
            		'name'       => __( 'Content', 'onepage' ),
            		'id'         => 'partner_content',
            		'type'       => 'wysiwyg',
            		// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
            	) );
            
            }// Partner meta box
            
            //Subscribe meta box
            add_action('cmb2_init','subscribe_meta_boxes');
            function subscribe_meta_boxes(){
                $prefix = '_onepage_subscribe';
                
                $intro_meta = new_cmb2_box(array(
                    'id' => $prefix. 'meta_box',
                    'title' => __('Subscribe Meta Box','onepage'),
                    'object_types' => array('page'),
                    'priority' => 'high',
                    'show_on'      => array( 'key' => 'page-template', 'value' => 'inc/subscribe-page.php' ),
                    'show_names' => true
                ));
                
                $intro_meta->add_field( array(
                    'name'       => __( 'Section ID', 'onepage' ),
                    'id'         => 'subscribe_section_id',
                    'type'       => 'text',
                ) );

                $intro_meta->add_field( array(
                       'name'       => __( 'Height', 'onepage' ),
                       'desc'       => __( 'Enter value in pixel if you need to set height for this section', 'onepage' ), 
                       'id'         => 'subscribe_section_height',
                       'type'       => 'text',
                ) );   

                $intro_meta->add_field( array(
                    'name'       => __( 'URL Form', 'onepage' ),
                    'desc'       => __( 'Add URL for handling your form', 'onepage' ),
                    'id'         => $prefix . 'url_handling',
                    'type'       => 'text',
                    'show_on_cb' => 'cmb2_hide_if_no_cats', 
                ) );
                
                $intro_meta->add_field( array(
                    'name'       => __( 'Placeholder Name Field', 'onepage' ),
                    'desc'       => __( 'Add placeholder for name field', 'onepage' ),
                    'id'         => $prefix . 'placeholder_name',
                    'type'       => 'text',
                    'show_on_cb' => 'cmb2_hide_if_no_cats', 
                ) );
                
                $intro_meta->add_field( array(
                    'name'       => __( 'Placeholder Email Field', 'onepage' ),
                    'desc'       => __( 'Add placeholder for email field', 'onepage' ),
                    'id'         => $prefix . 'placeholder_email',
                    'type'       => 'text',
                    'show_on_cb' => 'cmb2_hide_if_no_cats', 
                ) );
                
                $intro_meta->add_field( array(
            		'name' => __( 'Submit Button Text', 'onepage' ),
            		'desc' => __( 'Add text for submit button', 'onepage' ),
            		'id'   => $prefix . 'submit_text',
            		'type' => 'text',
            	) );
                
                
            }// Subscribe meta box

            
            function new_excerpt_more($more) {
                   global $post;
            	return '<p class="more"><a class="moretag" href="'. get_permalink($post->ID) . '"> '.__('Read More','onepage').'</a></p>';
            }
            add_filter('excerpt_more', 'new_excerpt_more');


            // Pagination
            function onepage_pagination(){  ?>
                <nav id="navigation">
                    <div class="wp-pagenavi">
                        <?php
                        global $wp_query;
                         
                        $big = 999999999; 
                         
                        echo paginate_links( array(
                            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                            'format' => '?paged=%#%',
                                'prev_text'    => __('Previous','onepage'),
                            'next_text'    => __('Next','onepage'),
                            'current' => max( 1, get_query_var('paged') ),
                            'total' => $wp_query->max_num_pages
                        ) );
                        ?>
                        <div class="clear"></div>
                    </div>
                </nav>
                
<?php       }

            add_filter('onepage_title_dosislight','new_onepage_title_dosislight');
			
	    function new_onepage_title_dosislight($text){
		if (preg_match("/:/", $text)) {
	            return str_replace(':',': <br />',$text); 
		} else {
		    return $text;
		}
	   }

           function onepage_display_video($url){
                $support_type = array(
                    'video/mp4' =>'.mp4',
                    'video/webm' => '.webm',
                    'video/ogg' => '.ogg'
                );
    
               preg_match("/^.*(\.ogg$)|(\.webm$)|(\.mp4$)/",$url,$match);
               if(!empty($match)){
                    $find = $match[0];
                    if(in_array($find, $support_type)){
                        $type = array_keys($support_type, $find);
                        printf( '<video id="video" width="345" height="212" controls><source src="%1$s" type="%2$s" /></video>', $url, $type[0] );
                    }
               }else{
                    $width = '345';
                    $height = '212';
                    preg_match(
                    		'/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/',
                    		$url,
                    		$matches
                    	);
                    if(!empty($matches)){
                        $id = $matches[2];
                        echo '<div class="vimeo-article" id="video"><iframe src="http://player.vimeo.com/video/'.$id.'?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ffffff" width="'.$width.'" height="'.$height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
                    }else{
                        preg_match(
                    		'/[\\?\\&]v=([^\\?\\&]+)/',
                    		$url,
                    		$matches
                    	);
                        $id = $matches[1];
                        echo '<div class="youtube-article" id="video"><iframe class="dt-youtube" width="' .$width. '" height="'.$height.'" src="//www.youtube.com/embed/'.$id.'" frameborder="0" allowfullscreen></iframe></div>';
                    }	
               } 
            }//End function

?>