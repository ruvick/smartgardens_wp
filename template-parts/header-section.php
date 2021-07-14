<header id="header" class="header">
	<div class="header__container container">

		<div class="header__row d-flex">

			<a href="http://smartgardens.ru" class="header__logo logo-icon"><span></span></a>

			<div class="header__menu menu">
				<nav class="menu__body">
					<?php wp_nav_menu( array('theme_location' => 'menu-1','menu_class' => 'menu__list ',
						'container_class' => 'menu__list ','container' => false )); ?> 
				</nav>
				<nav class="mob-menu">
					<?php wp_nav_menu( array('theme_location' => 'menu-1','menu_class' => 'mob-menu__list ',
						'container_class' => 'mob-menu__list ','container' => false )); ?> 
				</nav>

			</div>

			<div class="header__contacts">

				<div class="header__callback d-flex">
					<a href="tel:<? echo preg_replace('/[^0-9]/', '', $tel); ?>"><? echo $tel = carbon_get_theme_option("as_phones_1"); ?></a>
					<a href="#callback" class="header__popup-link _popup-link">ЗАКАЗАТЬ ЗВОНОК</a>
				</div>
				<a href="tel:88004882222" class="mob-callback__phone"></a>

				<a href="#" class="bascket-icon"><span class="bascket-icon__number bascet_counter">0</span></a>

			</div>

			<div class="menu__icon icon-menu">
				<span></span>
				<span></span>
				<span></span>
			</div>

		</div>

	</div>
</header>