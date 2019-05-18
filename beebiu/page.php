<?php get_header(); ?>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
						<?php if ( has_post_thumbnail()) : ?>
							<?php the_post_thumbnail(); ?>
						<?php endif; ?>
								<p><?php the_content(); ?></p>
		<?php endwhile; else : ?>
		<h2><?php esc_html__('No posts Found!', 'beebiu'); ?></h2>
		<?php endif; ?>
		<?php get_sidebar(); ?>
<?php get_footer(); ?>