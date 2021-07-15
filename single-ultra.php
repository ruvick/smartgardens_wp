<?php get_header(); ?>

<?php get_template_part('template-parts/header-section');?>

<main class="page">
			<section id="first" class="first">
				<div class="container">

        <?php
			    if ( function_exists('yoast_breadcrumb') ) {
			    	yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
			    }
			  ?> 

					<div class="first__flex-block d-flex">
						<div class="first__descrip">
							<h1><?the_title();?></h1>
							<div class="first__price-block d-flex">
								<div class="first__price-old">5500 <span>руб.</span></div>
								<div class="first__price-new"><?echo carbon_get_post_meta(get_the_ID(),"offer_price"); ?> <span>руб.</span></div>
							</div>
							<p>
								Выращивайте свежую зелень прямо у себя дома <br>
								вне зависимости от времени года и погоды на улице
							</p>
							<button class="first__btn btn" id = "btn__to-card" onclick = "add_tocart(this, 0); return false;"
                data-price = "<?echo carbon_get_post_meta(get_the_ID(),"offer_price"); ?>"
	              data-sku = "<? echo carbon_get_post_meta(get_the_ID(),"offer_sku")?>"
	              data-size = ""
                data-oldprice = "<? echo carbon_get_post_meta(get_the_ID(),"offer_old_price")?>"
                data-lnk = "<? echo  get_the_permalink(get_the_ID());?>"
                data-name = "<? echo  get_the_title();?>"
                data-count = "1"
                data-picture = "<?php echo wp_get_attachment_image_src($item['gal_img'], 'large')[0];?>">
                В КОРЗИНУ
              </button>
						</div>
						<div class="first__slider">
							<div class="first__slider-img">
								<img src="<?php echo get_template_directory_uri();?>/img/slider-product/sl-prod-01.png" alt="">
								<img src="<?php echo get_template_directory_uri();?>/img/shadow-sl.png" alt="">
							</div>
							<div class="first__slider-img">
								<img src="<?php echo get_template_directory_uri();?>/img/slider-product/sl-prod-01.png" alt="">
								<img src="<?php echo get_template_directory_uri();?>/img/shadow-sl.png" alt="">
							</div>
							<div class="first__slider-img">
								<img src="<?php echo get_template_directory_uri();?>/img/slider-product/sl-prod-01.png" alt="">
								<img src="<?php echo get_template_directory_uri();?>/img/shadow-sl.png" alt="">
							</div>
						</div>
					</div>
				</div>
			</section>

			<section id="about" class="about">
				<img src="<?php echo get_template_directory_uri();?>/img/sheet-01.png" class="about-bg-1" alt="">
				<img src="<?php echo get_template_directory_uri();?>/img/sheet-02.png" class="about-bg-2" alt="">
				<img src="<?php echo get_template_directory_uri();?>/img/sheet-03.png" class="about-bg-3" alt="">
				<div class="container">
					<h2>Описание</h2>
					<p>
						Мы предлагаем Вашему вниманию стационарную гидропонную установку для выращивания зелени в домашних условиях.
						Установка проста в эксплуатации и не требует специфических навыков при использовании. В установке
						предусмотрено 12 ячеек для выращивания растений, имеются все необходимые режимы освещения с автоматической
						регулировкой. Блок светодиодных ламп вынесены на штангу с регулировкой уровня 50 см. Установка снабжена
						насосом для обеспечения циркуляции жидкости внутри бака, который в свою очередь снабжен буйком для индикации
						уровня.
					</p>
					<h3>Технические характеристики</h3>

					<div class="about__charact charact__row">

						<div class="charact__line d-flex">
							<div class="charact__tab d-flex">
								<div class="charact__value">Мощность</div>
								<div class="charact__property">60 Вт</div>
							</div>
							<div class="charact__tab d-flex">
								<div class="charact__value">Индекс цветопередачи</div>
								<div class="charact__property">80 Ra</div>
							</div>
							<div class="charact__tab d-flex">
								<div class="charact__value">Поддержка димера</div>
								<div class="charact__property">Да</div>
							</div>
						</div>

						<div class="charact__line d-flex">
							<div class="charact__tab d-flex">
								<div class="charact__value">Напряжение</div>
								<div class="charact__property">110 В - 240 В</div>
							</div>
							<div class="charact__tab d-flex">
								<div class="charact__value">Световой поток</div>
								<div class="charact__property">23029 Лм</div>
							</div>
							<div class="charact__tab d-flex">
								<div class="charact__value">Материал корпуса</div>
								<div class="charact__property">Алюминий</div>
							</div>
						</div>

						<div class="charact__line d-flex">
							<div class="charact__tab d-flex">
								<div class="charact__value">Сертификация</div>
								<div class="charact__property">Ce, ETL, FCC, RoHS</div>
							</div>
							<div class="charact__tab d-flex">
								<div class="charact__value">Количество светодиодов</div>
								<div class="charact__property">120</div>
							</div>
							<div class="charact__tab d-flex">
								<div class="charact__value">Цвета светодиодов</div>
								<div class="charact__property">2835 белый + красный + синий</div>
							</div>
						</div>

					</div>

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
									'terms' => array(3)
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

					</div>

				</div>
			</section>

		</main>

<?php get_footer(); ?>  