<footer id="footer" class="footer">
	<div class='footer__container container'>
		<div class="footer__row d-flex">
			<a href="tel:88004882222" class="footer__callback">8 800 488 22 22</a>
			<?php wp_nav_menu( array('theme_location' => 'menu-1','menu_class' => 'footer__menu',
				'container_class' => 'footer__menu','container' => false )); ?> 
		</div>
	</div>
</footer>
</div>

<?php wp_footer(); ?>
</body>
</html>