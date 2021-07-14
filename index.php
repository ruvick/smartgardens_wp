<?php get_header(); ?>

<?php get_template_part('template-parts/header-section');?>

	<main class="page"> 

			<!-- Вывод записей конкретной таксономии по id -->
				<?
					$args = array(
						'posts_per_page' => 4,
						'post_type' => 'ultra',
						'tax_query' => array(
							array(
								'taxonomy' => 'ultracat',
								'field' => 'id',
								'terms' => array(7)
							)
						)
					);
					$query = new WP_Query($args);

					foreach( $query->posts as $post ){
						$query->the_post();
						get_template_part('template-parts/product-elem');
					}  
					wp_reset_postdata();
				?>

	</main>

<?php get_footer(); ?> 