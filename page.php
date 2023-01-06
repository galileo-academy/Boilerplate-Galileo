<?php get_header(); ?>

<?php if(have_posts()) : ?>
	<?php while(have_posts()) : the_post(); ?>
		<div class="wrapper">
			<div class="wrapper__inner">
				<?php the_content(); ?>
			</div>
		</div>
	<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>