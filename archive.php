<?php get_header(); ?>
    <div id="list-post">
		<?php if (have_posts()) : ?>

 			<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

			<?php /* If this is a category archive */ if (is_category()) { ?>
				<h2>Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h2>

			<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
				<h2>Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h2>

			<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
				<h2>Archive for <?php the_time('F jS, Y'); ?></h2>

			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
				<h2>Archive for <?php the_time('F, Y'); ?></h2>

			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
				<h2 class="pagetitle">Archive for <?php the_time('Y'); ?></h2>

			<?php /* If this is an author archive */ } elseif (is_author()) { ?>
				<h2 class="pagetitle">Author Archive</h2>

			<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				<h2 class="pagetitle">Blog Archives</h2>
			
			<?php } ?>

			
            <div class="post-wrap">
			<?php while (have_posts()) : the_post(); ?>
			
				<div <?php post_class() ?>>
				
						<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
					
						<?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>
                        <div class="feature_image">
                        <?php
                            if ( has_post_thumbnail() ) {
                                the_post_thumbnail();
                            } 
                        ?>    
                        </div>    
						<div class="entry">
							<?php the_excerpt('Read More'); ?>
						</div>
                        <div class="clear_fix"></div>
				</div>

			<?php endwhile; ?>
                        <?php onepage_pagination(); ?> 
			</div>
			
	<?php else : ?>

		<h2>Nothing found</h2>

	<?php endif; ?>
    <?php get_sidebar(); ?>
    </div>


<?php get_footer(); ?>
