<?php get_header();

/*
Template Name: Шаблон карточки товаров
WP Post Template: Шаблон карточки товаров
Template Post Type: post
*/

?>

<?php get_template_part('template-parts/header-section'); ?>

<main class="page single">
	<section id="first" class="first">
		<div class="container">

			<?php if (function_exists('kama_breadcrumbs')) kama_breadcrumbs(); ?>

			<div class="first__flex-block d-flex">

				<div class="first__slider">
					<?
					$pict = carbon_get_the_post_meta('offer_picture');
					if ($pict) {
						$pictIndex = 0;
						foreach ($pict as $item) {
					?>
							<div class="first__slider-img">
								<img id="pict-<? echo empty($item['gal_img_sku']) ? $pictIndex : $item['gal_img_sku']; ?>" alt="<? echo $item['gal_img_alt']; ?>" title="<? echo $item['gal_img_alt']; ?>" src="<?php echo wp_get_attachment_image_src($item['gal_img'], 'full')[0]; ?>" />
							</div>
					<?
							$pictIndex++;
						}
					}
					?>
				</div>

				<div class="first__descrip">
					<h1><? the_title(); ?></h1>
					<div class="first__price-block d-flex">
						<? $price_old = carbon_get_post_meta(get_the_ID(), "old_price");
						if (!empty($price_old)) { ?>
							<div class="first__price-old"><? echo $price_old; ?> <span>руб.</span></div>
						<? } ?>
						<? $price_new = carbon_get_post_meta(get_the_ID(), "offer_price");
						if (!empty($price_new)) { ?>
							<div class="first__price-new"><? echo $price_new; ?> <span>руб.</span></div>
						<? } ?>
					</div>
					<p><? echo carbon_get_post_meta(get_the_ID(), "offer_smile_descr"); ?></p>
					<button class="first__btn btn" id="btn__to-card" onclick="add_tocart(this, 0); return false;" data-price="<? echo carbon_get_post_meta(get_the_ID(), "offer_price"); ?>" data-sku="<? echo carbon_get_post_meta(get_the_ID(), "offer_sku") ?>" data-size="" data-oldprice="<? echo carbon_get_post_meta(get_the_ID(), "offer_old_price") ?>" data-lnk="<? echo  get_the_permalink(get_the_ID()); ?>" data-name="<? echo  get_the_title(); ?>" data-count="1" data-picture="<?php $imgTm = get_the_post_thumbnail_url(get_the_ID(), "tominiatyre");
																																																																																																																																																																																																																																											echo empty($imgTm) ? get_bloginfo("template_url") . "/img/no-photo.jpg" : $imgTm; ?>">
						В КОРЗИНУ
					</button>
				</div>

			</div>

		</div>
	</section>

	<section id="about" class="about">
		<img src="<?php echo get_template_directory_uri(); ?>/img/sheet-01.png" class="about-bg-1" alt="">
		<img src="<?php echo get_template_directory_uri(); ?>/img/sheet-02.png" class="about-bg-2" alt="">
		<img src="<?php echo get_template_directory_uri(); ?>/img/sheet-03.png" class="about-bg-3" alt="">
		<div class="container">
			<? $descrip = carbon_get_post_meta(get_the_ID(), "prod_descrip");
			if (!empty($descrip)) { ?>
				<h2>Описание</h2>
				<p><? echo $descrip; ?></p>
			<? } ?>
		</div>
	</section>

	<section id="products" class="products">
		<div class="container">
			<h2>Похожие товары</h2>

			<div class="prod-card d-flex">

				<?
				$args = array(
					'posts_per_page' => 6,
					'post_type' => 'ultra',
					'tax_query' => array(
						array(
							'taxonomy' => 'ultracat',
							'field' => 'id',
							'terms' => array(4)
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