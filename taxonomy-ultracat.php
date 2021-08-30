<?php get_header(); ?>

<?php get_template_part('template-parts/header-section'); ?>

<main class="page">
	<section id="all-products" class="all-products">
		<div class="container">
			<?php if (function_exists('kama_breadcrumbs')) kama_breadcrumbs(); ?>
			<h2><?php single_cat_title('', true); ?></h2>
			<div class="prod-card d-flex">
				<?php
				while (have_posts()) :
					the_post();
					get_template_part('template-parts/product-elem');
				endwhile;
				?>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>