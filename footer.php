<footer id="footer" class="footer">
	<div class='footer__container container'>
		<div class="footer__row d-flex">
			<a href="tel:<? echo preg_replace('/[^0-9]/', '', $tel); ?>" class="footer__callback"><? echo $tel = carbon_get_theme_option("as_phones_1"); ?></a>
			<?php wp_nav_menu( array('theme_location' => 'menu-1','menu_class' => 'footer__menu',
				'container_class' => 'footer__menu','container' => false )); ?> 
		</div>
	</div>
</footer>
</div>

<?php wp_footer(); ?>
</body>
</html>