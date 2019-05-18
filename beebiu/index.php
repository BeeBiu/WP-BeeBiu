<?php get_header(); ?>
	<div class="beebiu-index">
		<div class="beebiu-responsive-box">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	

				<?php get_template_part('content', get_post_format());  ?>
			 
			<?php endwhile; else : ?>
			<h2><?php esc_html__('No posts Found!', 'gripvine'); ?></h2>
			<?php endif; ?>
		</div>
		<div class="post-pagination">
			   <?php //the_posts_pagination(); ?>
			   <?php
				//the_posts_pagination();
				echo paginate_links( array(
										'show_all'           => false,
										'prev_next'          => true,
										'prev_text'          => __( '<' ),
										'next_text'          => __( '>' ),
										'end_size'           => 1,
										'mid_size'           => 3,
										'type'               => 'list', //'plain', 'array', 'list'
										'before_page_number' => '',
										'after_page_number'  => '',
				) );
				?>
				</div>
	</div>
<?php get_footer(); ?>