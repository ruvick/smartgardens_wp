<?php get_header(); ?>

<?php get_template_part('template-parts/header-section');?>

<main class="page">
			<section id="first" class="first">
				<div class="container">

					<div class="first__flex-block d-flex">
						<div class="first__descrip">
							<h1>
								Гидропонная установка <br>  
								у вас дома
							</h1>
							<div class="first__price-block d-flex">
								<div class="first__price-old">5500 <span>руб.</span></div>
								<div class="first__price-new">2500 <span>руб.</span></div>
							</div>
							<p>
								Выращивайте свежую зелень прямо у себя дома <br>
								вне зависимости от времени года и погоды на улице
							</p>
							<a href="<?php echo get_permalink(22);?>" class="first__btn btn">ПОДРОБНЕЕ</a>
						</div>
						<div class="first__slider">
							<div class="first__slider-img">
								<img src="<?php echo get_template_directory_uri();?>/img/slider-product/sl-prod-01.png" alt="">
								<!-- <img src="<?php echo get_template_directory_uri();?>/img/shadow-sl.png" alt=""> -->
							</div>
							<div class="first__slider-img">
								<img src="<?php echo get_template_directory_uri();?>/img/slider-product/sl-prod-02.png" alt="">
								<!-- <img src="<?php echo get_template_directory_uri();?>/img/shadow-sl.png" alt=""> -->
							</div>
							<div class="first__slider-img">
								<img src="<?php echo get_template_directory_uri();?>/img/slider-product/sl-prod-03.png" alt="">
								<!-- <img src="<?php echo get_template_directory_uri();?>/img/shadow-sl.png" alt=""> -->
							</div>
						</div>
					</div>
				</div>
			</section>

			<section id="about" class="about-taxonomy about">
				<img src="<?php echo get_template_directory_uri();?>/img/sheet-01.png" class="about-bg-1" alt="">
				<img src="<?php echo get_template_directory_uri();?>/img/sheet-02.png" class="about-bg-2" alt="">
				<img src="<?php echo get_template_directory_uri();?>/img/sheet-03.png" class="about-bg-3" alt="">
				<div class="container">
					<h2>О нашем устройстве</h2>
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