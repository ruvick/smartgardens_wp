<?php get_header(); ?>

<?php get_template_part('template-parts/header-section'); ?>

<main class="page">
	<section id="first" class="index-first first">
		<div class="container">

			<div class="first__flex-block d-flex">
				<div class="first__descrip">
					<h1><?php echo carbon_get_theme_option('product_home_title'); ?></h1>
					<div class="first__price-block d-flex">
						<? $product_old_price = carbon_get_theme_option("product_old_price");
						if (!empty($product_old_price)) { ?>
							<div class="first__price-old"><? echo $product_old_price; ?> <span>руб.</span></div>
						<? } ?>
						<? $product_new_price = carbon_get_theme_option("product_new_price");
						if (!empty($product_new_price)) { ?>
							<div class="first__price-new"><? echo $product_new_price; ?> <span>руб.</span></div> 
						<? } ?>
					</div>
					<p><?php echo carbon_get_theme_option('product_short_descp'); ?></p>
					<a href="<?php echo get_permalink(45); ?>" class="first__btn btn">ПОДРОБНЕЕ</a>
				</div>
				<div class="first__slider">
					<div class="first__slider-img">
						<img src="<?php echo get_template_directory_uri(); ?>/img/slider-product/sl-prod-01.png" alt="">
						<!-- <img src="<?php echo get_template_directory_uri(); ?>/img/shadow-sl.png" alt=""> -->
					</div>
					<div class="first__slider-img">
						<img src="<?php echo get_template_directory_uri(); ?>/img/slider-product/sl-prod-02.png" alt="">
						<!-- <img src="<?php echo get_template_directory_uri(); ?>/img/shadow-sl.png" alt=""> -->
					</div>
					<div class="first__slider-img">
						<img src="<?php echo get_template_directory_uri(); ?>/img/slider-product/sl-prod-03.png" alt="">
						<!-- <img src="<?php echo get_template_directory_uri(); ?>/img/shadow-sl.png" alt=""> -->
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="about" class="about">
		<img src="<?php echo get_template_directory_uri(); ?>/img/sheet-01.png" class="about-bg-1" alt="">
		<img src="<?php echo get_template_directory_uri(); ?>/img/sheet-02.png" class="about-bg-2" alt="">
		<img src="<?php echo get_template_directory_uri(); ?>/img/sheet-03.png" class="about-bg-3" alt="">
		<div class="container">

			<? $product_descp = apply_filters( 'the_content', carbon_get_theme_option("product_descp"));
			if (!empty($product_descp)) { ?>
				<h2><?php echo carbon_get_theme_option('product_title'); ?></h2>
				<p><? echo $product_descp; ?></p>
			<? } ?>

			<h3>Технические характеристики</h3>

			<div class="about__charact charact__row">
				<div class="charact__line d-flex">
					<?
					$pspecific = carbon_get_theme_option('product_specifications');
					if ($pspecific) {
						$pspecificIndex = 0;
						foreach ($pspecific as $item) {
					?>
							<div class="charact__tab d-flex">
								<div class="charact__value"><? echo $item['parameter_name']; ?></div>
								<div class="charact__property"><? echo $item['parameter_value']; ?></div>
							</div>
					<?
							$pspecificIndex++;
						}
					}
					?>
				</div>
			</div>

			<h3>Видеопрезентация</h3>
			<a href="<?php echo get_template_directory_uri(); ?>/img/video/video.mp4" data-rel="media" class="about__link-video fancybox position">
				<video class="about__video" controls="controls" loop autoplay muted poster="<?php echo get_template_directory_uri(); ?>/img/video/video.png">
					<source src="<?php echo get_template_directory_uri(); ?>/img/video/video.mp4" type='video/ogg; codecs="theora, vorbis"'>
				</video>
			</a>

			<h3>Галерея</h3>
			<div class="about__gallery-row d-flex">

				<a href="<?php echo get_template_directory_uri(); ?>/img/gallery/01.jpg" rel="lightbox" class="about__gallery-img">
					<img src="<?php echo get_template_directory_uri(); ?>/img/gallery/01.jpg" alt="">
				</a>

				<a href="<?php echo get_template_directory_uri(); ?>/img/gallery/02.jpg" rel="lightbox" class="about__gallery-img">
					<img src="<?php echo get_template_directory_uri(); ?>/img/gallery/02.jpg" alt="">
				</a>

				<a href="<?php echo get_template_directory_uri(); ?>/img/gallery/03.jpg" rel="lightbox" class="about__gallery-img">
					<img src="<?php echo get_template_directory_uri(); ?>/img/gallery/03.jpg" alt="">
				</a>

				<a href="<?php echo get_template_directory_uri(); ?>/img/gallery/04.jpg" rel="lightbox" class="about__gallery-img">
					<img src="<?php echo get_template_directory_uri(); ?>/img/gallery/04.jpg" alt="">
				</a>

				<a href="<?php echo get_template_directory_uri(); ?>/img/gallery/05.jpg" rel="lightbox" class="about__gallery-img">
					<img src="<?php echo get_template_directory_uri(); ?>/img/gallery/05.jpg" alt="">
				</a>

				<a href="<?php echo get_template_directory_uri(); ?>/img/gallery/06.jpg" rel="lightbox" class="about__gallery-img">
					<img src="<?php echo get_template_directory_uri(); ?>/img/gallery/06.jpg" alt="">
				</a>

			</div>

			<div id="advant" class="advantages-block">
				<h2>Преимущества</h2>

				<div class="advantages-block__row d-flex">

					<div class="advantages-block__item">
						<div class="advantages-block__item-icon advantages-block__item-1"></div>
						<p>Компактность</p>
					</div>

					<div class="advantages-block__item">
						<div class="advantages-block__item-icon advantages-block__item-2"></div>
						<p>Вместительность</p>
					</div>

					<div class="advantages-block__item">
						<div class="advantages-block__item-icon advantages-block__item-3"></div>
						<p>Малая мощность</p>
					</div>

					<div class="advantages-block__item">
						<div class="advantages-block__item-icon advantages-block__item-4"></div>
						<p>Безопасность</p>
					</div>

				</div>
			</div>

		</div>
	</section>

	<section id="products" class="products">
		<div class="container">
			<h2>Аксессуары</h2>

			<div class="prod-card d-flex">

				<?
				$args = array(
					'posts_per_page' => 6,
					'post_type' => 'ultra',
					'tax_query' => array(
						array(
							'taxonomy' => 'ultracat',
							'field' => 'id',
							'terms' => array(3)
						)
					)
				);
				$query = new WP_Query($args);

				foreach ($query->posts as $post) {
					$query->the_post();
					get_template_part('template-parts/product-elem');
				}
				wp_reset_postdata();
				?>

			</div>

		</div>
	</section>

</main>

<?php get_footer(); ?>