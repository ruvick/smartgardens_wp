<div class="prod-card__body d-flex">
	<a href="<?echo get_the_permalink(get_the_ID());?>" class="prod-card__link">
		<img src="<?php  $imgTm = get_the_post_thumbnail_url( get_the_ID(), "tominiatyre" ); echo empty($imgTm)?get_bloginfo("template_url")."/img/no-photo.jpg":$imgTm; ?>" alt="">
	</a>
	<div class="prod-card__text">
		<a href="<?echo get_the_permalink(get_the_ID());?>">
			<h4><? the_title();?></h4>
		</a>
	</div>
	<div class="prod-card__price-item d-flex">
		<p class="prod-card__price"><?echo carbon_get_post_meta(get_the_ID(),"offer_price"); ?> руб.</p>
		<a href="<?echo get_the_permalink(get_the_ID());?>" class="prod-card__btn btn">ПОДРОБНЕЕ</a> 
	</div>
</div> 
	