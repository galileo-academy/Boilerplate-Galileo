<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
<section class="wrapper">
	<div class="wrapper__inner">
		<?php the_content(); ?>
	</div>
</section>
<?php endwhile; ?>

<?php get_footer(); ?>