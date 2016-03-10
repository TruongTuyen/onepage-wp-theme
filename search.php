<?php get_header(); ?>
   <div id="list-post">
	<?php if (have_posts()) : ?>

		<h2>Search Results</h2>

		
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

		<h2>No posts found.</h2>

	<?php endif; ?>

<?php get_sidebar(); ?>
 </div>
<?php get_footer(); ?>
