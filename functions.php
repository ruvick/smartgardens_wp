<?php

define("COMPANY_NAME", "SMARTGARDENS");
define("MAIL_RESEND", "noreply@smartgardens.ru");

//----Подключене carbon fields
//----Инструкции по подключению полей см. в комментариях themes-fields.php
include "carbon-fields/carbon-fields-plugin.php";

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_attach_theme_options');
function crb_attach_theme_options()
{
	require_once __DIR__ . "/themes-fields.php";
}

add_action('after_setup_theme', 'crb_load');
function crb_load()
{
	require_once('carbon-fields/vendor/autoload.php');
	\Carbon_Fields\Carbon_Fields::boot();
}

//-----Блок описания вывода меню
// 1. Осмысленные названия для алиаса и для описания на русском.
// если это меню в подвали пишем - Меню в подвале 
// если в шапке то пишем - Меню в шапке 
// если 2 меню в шапке пишем  - Меню в шапке (верхняя часть)

add_action('after_setup_theme', function () {
	register_nav_menus([
		'menu-1' => 'Меню главное',
		// 'menu_cat' => 'Меню каталога', 
		// 'menu_main' => 'Меню основное',
		// 'menu_corp' => 'Общекорпоративное меню (верхняя шапка)', 
	]);
});

// Добавление стилей к пунктам меню
// add_filter( 'nav_menu_css_class', 'change_menu_item_css_classes', 10, 4 );

// function change_menu_item_css_classes( $classes, $item, $args, $depth ) {
// 	if( 30 === $item->ID  && 'menu_corp' === $args->theme_location ){
// 		$classes[] = 'link__drop-down';
// 	}

// 	if( 34 === $item->ID  && 'menu_main' === $args->theme_location ){
// 		$classes[] = 'menu__catalogy';
// 	}

// 	return $classes;
// }

add_theme_support('post-thumbnails');
set_post_thumbnail_size(185, 185);

add_post_type_support('page', 'excerpt');

// Подключение стилей и nonce для Ajax в админку 
add_action('admin_head', 'my_assets_admin');
function my_assets_admin()
{
	wp_enqueue_style("style-adm", get_template_directory_uri() . "/style-admin.css");

	wp_localize_script('jquery', 'allAjax', array(
		'nonce'   => wp_create_nonce('NEHERTUTLAZIT')
	));
}

// Подключение стилей и nonce для Ajax и скриптов во фронтенд 
add_action('wp_enqueue_scripts', 'my_assets');
function my_assets()
{

	// Подключение стилей 

	$style_version = "1.0.7";
	$scrypt_version = "1.0.7";

	wp_enqueue_style("style-modal", get_template_directory_uri() . "/css/jquery.arcticmodal-0.3.css", array(), $style_version, 'all'); //Модальные окна (стили)
	wp_enqueue_style("style-lightbox", get_template_directory_uri() . "/css/lightbox.min.css", array(), $style_version, 'all'); //Лайтбокс (стили)
	wp_enqueue_style("style-slik", get_template_directory_uri() . "/css/slick.css", array(), $style_version, 'all'); //Слайдер (стили)
	wp_enqueue_style("style-fancybox", get_template_directory_uri() . "/css/fancybox.css", array(), $style_version, 'all'); //fancybox (стили)

	wp_enqueue_style("main-style", get_stylesheet_uri(), array(), $style_version, 'all'); // Подключение основных стилей в самом конце

	// Подключение скриптов

	wp_enqueue_script('jquery');

	wp_enqueue_script('amodal', get_template_directory_uri() . '/js/jquery.arcticmodal-0.3.min.js', array(), $scrypt_version, true); //Модальные окна
	wp_enqueue_script('mask', get_template_directory_uri() . '/js/jquery.inputmask.bundle.js', array(), $scrypt_version, true); //маска для инпутов
	wp_enqueue_script('lightbox', get_template_directory_uri() . '/js/lightbox.min.js', array(), $scrypt_version, true); //Лайтбокс
	wp_enqueue_script('slick', get_template_directory_uri() . '/js/slick.min.js', array(), $scrypt_version, true); //Слайдер
	wp_enqueue_script('fancybox', get_template_directory_uri() . '/js/jquery.fancybox.min.js', array(), $scrypt_version, true); //fancybox

	wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js', array(), $scrypt_version, true); // Подключение основного скрипта в самом конце

	if (is_page(20)) {
		wp_enqueue_script('vue', get_template_directory_uri() . '/js/vue.js', array(), ALL_VERSION, true);
		wp_enqueue_script('axios', get_template_directory_uri() . '/js/axios.min.js', array(), ALL_VERSION, true);
		wp_enqueue_script('bascet', get_template_directory_uri() . '/js/bascet.js', array(), ALL_VERSION, true);
	}

	wp_localize_script('main', 'allAjax', array(
		'ajaxurl' => admin_url('admin-ajax.php'),
		'nonce'   => wp_create_nonce('NEHERTUTLAZIT')
	));
}



// Заготовка для вызова ajax
add_action('wp_ajax_aj_fnc', 'aj_fnc');
add_action('wp_ajax_nopriv_aj_fnc', 'aj_fnc');

function aj_fnc()
{
	if (empty($_REQUEST['nonce'])) {
		wp_die('0');
	}

	if (check_ajax_referer('NEHERTUTLAZIT', 'nonce', false)) {
	} else {
		wp_die('НО-НО-НО!', '', 403);
	}
}



// Пагинация
// function wp_corenavi() {
//   global $wp_query;
//   $total = isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;
//   $a['total'] = $total;
//   $a['mid_size'] = 3; // сколько ссылок показывать слева и справа от текущей
//   $a['end_size'] = 1; // сколько ссылок показывать в начале и в конце
//   $a['prev_text'] = ''; // текст ссылки "Предыдущая страница"
//   $a['next_text'] = ''; // текст ссылки "Следующая страница"

//   if ( $total > 1 ) echo '<nav class="pagination">';
//   echo paginate_links( $a );
//   if ( $total > 1 ) echo '</nav>';
// }


/* Отправка почты
		
			$headers = array(
				'From: Сайт '.COMPANY_NAME.' <MAIL_RESEND>',
				'content-type: text/html',
			);
		
			add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
			
			$adr_to_send = <Присваиваем поле карбона c адресами для отправки>;
			$mail_content = "<Тело письма>";
			$mail_them = "<Тема письма>";

			if (wp_mail($adr_to_send, $mail_them, $mail_content, $headers)) {
				wp_die(json_encode(array("send" => true )));
			}
			else {
				wp_die( 'Ошибка отправки!', '', 403 );
			}
	*/


/*	Заготовка шорткода
		function true_url_external( $atts ) {
			$params = shortcode_atts( array( // в массиве укажите значения параметров по умолчанию
				'anchor' => 'Миша Рудрастых', // параметр 1
				'url' => 'https://misha.blog', // параметр 2
			), $atts );
			return "<a href='{$params['url']}' target='_blank'>{$params['anchor']}</a>";
		}
		add_shortcode( 'trueurl', 'true_url_external' );
	*/


// // Регистрация кастомного поста

add_action('init', 'create_taxonomies');

function create_taxonomies()
{

	register_taxonomy('ultracat', array('ultra'), array(
		'hierarchical'  => true,
		'labels'        => array(
			'name'              => "Категория товара",
			'singular_name'     => "Категория товара",
			'search_items'      => "Найти категорию товара",
			'all_items'         => __('Все категории'),
			'parent_item'       => __('Дочерние категории'),
			'parent_item_colon' => __('Дочерние категории:'),
			'edit_item'         => __('Редактировать категорию'),
			'update_item'       => __('Обновить категорию'),
			'add_new_item'      => __('Добавить новую категорию товара'),
			'new_item_name'     => __('Имя новой категории товара'),
			'menu_name'         => __('Категории товара'),
		),
		'description' => "Категория товаров для магазина",
		'public' => true,
		'show_ui'       => true,
		'query_var'     => true,
		'show_in_rest'  => true,
		'show_admin_column'     => true,
	));

	register_taxonomy('ultrastyle', array('ultra'), array(
		'hierarchical'  => false,
		'labels'        => array(
			'name'              => "Стиль дизайна",
			'singular_name'     => "Стиль дизайна",
			'search_items'      => "Найти стиль",
			'all_items'         => __('Все стили'),
			'parent_item'       => __('Дочерние стили'),
			'parent_item_colon' => __('Дочерние стили:'),
			'edit_item'         => __('Редактировать стиль'),
			'update_item'       => __('Обновить стиль'),
			'add_new_item'      => __('Добавить новый стиль'),
			'new_item_name'     => __('Имя новго стиля товара'),
			'menu_name'         => __('Стили товара'),
		),
		'description' => "Стиль дизайна товаров",
		'public' => true,
		'show_ui'       => true,
		'query_var'     => true,
		'show_in_rest'  => true,
		'show_admin_column'     => true,
	));
}


add_action('init', 'ultra_custom_init');

function ultra_custom_init()
{
	register_post_type('ultra', array(
		'labels'             => array(
			'name'               => 'Продукты', // Основное название типа записи
			'singular_name'      => 'Продукты', // отдельное название записи типа Book
			'add_new'            => 'Добавить новый',
			'add_new_item'       => 'Добавить новый товар',
			'edit_item'          => 'Редактировать товар',
			'new_item'           => 'Новый товар',
			'view_item'          => 'Посмотреть товар',
			'search_items'       => 'Найти товар',
			'not_found'          =>  'Товаров не найдено',
			'not_found_in_trash' => 'В корзине товаров не найдено',
			'parent_item_colon'  => '',
			'menu_name'          => 'Товары'

		),
		'taxonomies' => array('ultracat'),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'show_admin_column'        => true,
		'show_in_quick_edit'        => true,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', 'post-formats')
	));
}

// // Колонки в таблицу админки

add_filter('manage_posts_columns', 'posts_columns', 5);
add_action('manage_posts_custom_column', 'posts_custom_columns', 5, 2);

function posts_columns($defaults)
{
	$defaults['riv_post_sku'] = __('Артикул');
	$defaults['riv_post_thumbs'] = __('Миниатюра');
	$defaults['riv_post_price'] = __('Цена');
	return $defaults;
}

function posts_custom_columns($column_name, $id)
{


	if ($column_name === 'riv_post_sku') {
		$SKU_t = get_post_meta(get_the_ID(), "_offer_sku", true);
		echo empty($SKU_t) ? "-" : $SKU_t;
	}

	if ($column_name === 'riv_post_thumbs') {
		$img1 = get_the_post_thumbnail_url(get_the_ID(), "thumbnail");

		if (empty($img1))
			$img1 = get_bloginfo("template_url") . "/img/no-photo.jpg";

		echo '<img width = "60" src = "' . $img1 . '" />';
	}

	if ($column_name === 'riv_post_price') {
		$PRICE = get_post_meta(get_the_ID(), "_offer_price", true);
		echo empty($PRICE) ? "0 руб." : $PRICE . " руб.";
	}
}


// Отправка формы из модального окна
add_action('wp_ajax_sendphone', 'sendphone');
add_action('wp_ajax_nopriv_sendphone', 'sendphone');

function sendphone()
{
	if (empty($_REQUEST['nonce'])) {
		wp_die('0');
	}

	if (check_ajax_referer('NEHERTUTLAZIT', 'nonce', false)) {

		$headers = array(
			'From: Сайт ' . COMPANY_NAME . ' <' . MAIL_RESEND . '>',
			'content-type: text/html',
		);

		add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
		if (wp_mail(carbon_get_theme_option('as_email_send'), 'Заказ звонка', '<strong>Имя:</strong> ' . $_REQUEST["name"] . ' <br/> <strong>Телефон:</strong> ' . $_REQUEST["tel"] . ' <br/> <strong>Email:</strong> ' . $_REQUEST["email"], $headers))
			wp_die("<span style = 'color:green;'>Мы свяжемся с Вами в ближайшее время.</span>");
		else wp_die("<span style = 'color:red;'>Сервис недоступен попробуйте позднее.</span>");
	} else {
		wp_die('НО-НО-НО!', '', 403);
	}
}


// Отправка корзины
function tovarTo1c($bascetElem)
{
	return
		"<Товар>\n\r" .
		"<Ид>" . $bascetElem->sku1c . "</Ид>\n\r" .
		'<Наименование>' . $bascetElem->name . '</Наименование>\n\r' .
		'<БазоваяЕдиница Код="796" НаименованиеПолное="Штука" МеждународноеСокращение="PCE">шт</БазоваяЕдиница>\n\r' .
		"<ЦенаЗаЕдиницу>" . $bascetElem->price . "</ЦенаЗаЕдиницу>\n\r" .
		"<Количество>" . $bascetElem->count . "</Количество>\n\r" .
		"<Сумма>" . $bascetElem->subtotal . "</Сумма>\n\r" .
		"<ЗначенияРеквизитов>\n\r" .
		"<ЗначениеРеквизита>\n\r" .
		"<Наименование>ВидНоменклатуры</Наименование>\n\r" .
		"<Значение>Товар</Значение>\n\r" .
		"</ЗначениеРеквизита>\n\r" .

		"<ЗначениеРеквизита>\n\r" .
		"<Наименование>ТипНоменклатуры</Наименование>\n\r" .
		"<Значение>Товар</Значение>\n\r" .
		"</ЗначениеРеквизита>\n\r" .
		"</ЗначенияРеквизитов>\n\r" .
		"</Товар>\n\r";
}

function sendToFtp($fileAdr, $zak_number)
{
	$ftp_server = "81.177.141.133";
	$ftp_user_name = "asmi046_1s";
	$ftp_user_pass = "!#(yTY)uz9d8";

	$conn_id = ftp_connect($ftp_server);
	$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
	ftp_pasv($conn_id, true);
	if ((!$conn_id) || (!$login_result)) {
		return false;
	} else {
		$upload = ftp_put($conn_id, "orders/" . $zak_number . ".xml", $fileAdr, FTP_ASCII);
		return true;
	}
	ftp_close($conn_id);
}

add_action('wp_ajax_send_cart', 'send_cart');
add_action('wp_ajax_nopriv_send_cart', 'send_cart');

function send_cart()
{
	if (empty($_REQUEST['nonce'])) {
		wp_die('0');
	}

	if (check_ajax_referer('NEHERTUTLAZIT', 'nonce', false)) {

		$headers = array(
			'From: Сайт ' . COMPANY_NAME . ' <' . MAIL_RESEND . '>',
			'content-type: text/html',
		);

		add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));

		$adr_to_send = carbon_get_theme_option("as_email_send");
		// $adr_to_send = (empty($adr_to_send))?"asmi046@gmail.com,rudikov-web@ya.ru":$adr_to_send;

		$zak_number = "A" . date("H") . date("i") . date("s") . rand(100, 999);

		$mail_content = "<h1>Заказ на сайте №" . $zak_number . "</h1>";

		$bscet_dec = json_decode(stripcslashes($_REQUEST["bascet"]));

		// Отправка в базу основного заказа

		global $wpdb;
		$wpdb->insert("shop_zakhistory", array(
			"agent" => empty($_COOKIE["agriautorise"]) ? "" : $_COOKIE["agriautorise"],
			"zak_number" => $zak_number,
			"zak_summ" => $_REQUEST["bascetsumm"],
			"zak_count" => count($bscet_dec),
			"client_name" => $_REQUEST["name"],
			"client_phone" => $_REQUEST["phone"],
			"client_mail" => $_REQUEST["mail"],
			"client_adr" => $_REQUEST["adres"],
			"client_comment" => $_REQUEST["comment"],
		));


		$mail_content .= "<table style = 'text-align: left;' width = '100%'>";
		$mail_content .= "<tr>";
		$mail_content .= "<th></th>";
		$mail_content .= "<th>ТОВАР</th>";
		$mail_content .= "<th>КОЛИЧЕСТВО</th>";
		$mail_content .= "<th>СУММА</th>";
		$mail_content .= "</tr>";

		$toXMLstr = "";

		for ($i = 0; $i < count($bscet_dec); $i++) {
			$toXMLstr .= tovarTo1c($bscet_dec[$i]);
			$mail_content .= "<tr>";
			$mail_content .= "<td><img src = '" . $bscet_dec[$i]->picture . "' width = '70' height = '70'></td>";
			$mail_content .= "<td><a href = '" . $bscet_dec[$i]->lnk . "'>" . $bscet_dec[$i]->name . " / " . $bscet_dec[$i]->sku . "</a></td>";
			$mail_content .= "<td>" . $bscet_dec[$i]->count . "</td>";
			$mail_content .= "<td>" . $bscet_dec[$i]->subtotal . " р.</td>";
			$mail_content .= "</tr>";

			// Отправка в базу содержимого корзины

			$wpdb->insert("shop_zaktovar", array(
				"zak_number" => $zak_number,
				"price" => $bscet_dec[$i]->price,
				"price_old" => empty($bscet_dec[$i]->oldprice) ? "" : $bscet_dec[$i]->oldprice,
				"subtotal" => $bscet_dec[$i]->subtotal,
				"sku" => $bscet_dec[$i]->sku,
				"lnk" => $bscet_dec[$i]->lnk,
				"name" => $bscet_dec[$i]->name,
				"count" => $bscet_dec[$i]->count,
				"picture" => $bscet_dec[$i]->picture,
			));
		}

		$mail_content .= "</table>";
		$mail_content .= "<h2>Сумма: " . $_REQUEST["bascetsumm"] . " р.</h2>";


		$zaktpl = file_get_contents(__DIR__ . '/zaktempl.xml', true);
		// ---- Формирование файла для 1С

		$clname = 	explode(" ", $_REQUEST["name"])[0];
		$clnames = 	explode(" ", $_REQUEST["name"])[1];

		$zaktpl = str_replace("{zaknum}", $zak_number, $zaktpl);
		$zaktpl = str_replace("{zakdata}", date("Y-m-d"), $zaktpl);
		$zaktpl = str_replace("{zaksumm}", $_REQUEST["bascetsumm"], $zaktpl);
		$zaktpl = str_replace("{zaktime}", date("H:i:s"), $zaktpl);
		$zaktpl = str_replace("{name}", $clname, $zaktpl);
		$zaktpl = str_replace("{inn}", ($_REQUEST["inn"] == "null") ? "" : $_REQUEST["inn"], $zaktpl);
		$zaktpl = str_replace("{sname}", $clnames, $zaktpl);
		$zaktpl = str_replace("{adr}", $_REQUEST["adres"], $zaktpl);
		$zaktpl = str_replace("{clientname}", $clname . " " . $clnames, $zaktpl);
		$zaktpl = str_replace("{clientnamefull}", $clname . " " . $clnames, $zaktpl);
		$zaktpl = str_replace("{clienphone}",  $_REQUEST["phone"], $zaktpl);
		$zaktpl = str_replace("{clientmail}", $_REQUEST["mail"], $zaktpl);
		$zaktpl = str_replace("{zakcomment}", $_REQUEST["comment"], $zaktpl);
		$zaktpl = str_replace("{tovars}", $toXMLstr, $zaktpl);

		$fileAdr = __DIR__ . "/1s/orders/" . $zak_number . ".xml";
		file_put_contents($fileAdr, $zaktpl);

		$ftprez = sendToFtp($fileAdr, $zak_number);

		$mail_content .= "<strong>Имя:</strong> " . $_REQUEST["name"] . "<br/>";
		$mail_content .= "<strong>Телефон:</strong> " . $_REQUEST["phone"] . "<br/>";
		$mail_content .= "<strong>e-mail:</strong> " . $_REQUEST["mail"] . "<br/>";
		$mail_content .= "<strong>Адрес:</strong> " . $_REQUEST["adres"] . "<br/>";
		$mail_content .= "<strong>Комментарий:</strong> " . $_REQUEST["comment"] . "<br/>";
		// $mail_content .= "<strong>FTP:</strong> ".($ftprez)?"Загружен":"Не загружен"."<br/>";

		$mail_them = "Заказ с сайта";



		if (wp_mail($adr_to_send, $mail_them, $mail_content, $headers)) {

			wp_die(json_encode(array("send" => true)));
		} else {
			wp_die('Ошибка отправки!', '', 403);
		}
	} else {
		wp_die('НО-НО-НО!', '', 403);
	}
}


// Хлебные крошки ================================================================================================================
function kama_breadcrumbs($sep = ' / ', $l10n = array(), $args = array())
{
	$kb = new Kama_Breadcrumbs;
	echo $kb->get_crumbs($sep, $l10n, $args);
}

class Kama_Breadcrumbs
{

	public $arg;

	// Локализация
	static $l10n = array(
		'home'       => 'Главная',
		'paged'      => 'Страница %d',
		'_404'       => 'Ошибка 404',
		'search'     => '<li class="breadcrumb-list-item">Результаты поиска по запросу</li><li class="breadcrumb-list-item"><b>%s</b></li>',
		'author'     => 'Архив автора: <b>%s</b>',
		'year'       => 'Архив за <b>%d</b> год',
		'month'      => 'Архив за: <b>%s</b>',
		'day'        => '',
		'attachment' => 'Медиа: %s',
		'tag'        => 'Записи по метке: <b>%s</b>',
		'tax_tag'    => '%1$s из "%2$s" по тегу: <b>%3$s</b>',
		// tax_tag выведет: 'тип_записи из "название_таксы" по тегу: имя_термина'.
		// Если нужны отдельные холдеры, например только имя термина, пишем так: 'записи по тегу: %3$s'
	);

	// Параметры по умолчанию
	static $args = array(
		'on_front_page'   => true,  // выводить крошки на главной странице
		'show_post_title' => true,  // показывать ли название записи в конце (последний элемент). Для записей, страниц, вложений
		'show_term_title' => true,  // показывать ли название элемента таксономии в конце (последний элемент). Для меток, рубрик и других такс
		'title_patt'      => '<span class="breadcrumb_last">%s</span>', // шаблон для последнего заголовка. Если включено: show_post_title или show_term_title
		'last_sep'        => true,  // показывать последний разделитель, когда заголовок в конце не отображается
		'markup'          => 'schema.org', // 'markup' - микроразметка. Может быть: 'rdf.data-vocabulary.org', 'schema.org', '' - без микроразметки
		// или можно указать свой массив разметки:
		// array( 'wrappatt'=>'<div class="kama_breadcrumbs">%s</div>', 'linkpatt'=>'<a href="%s">%s</a>', 'sep_after'=>'', )
		'priority_tax'    => array('category'), // приоритетные таксономии, нужно когда запись в нескольких таксах
		'priority_terms'  => array(), // 'priority_terms' - приоритетные элементы таксономий, когда запись находится в нескольких элементах одной таксы одновременно.
		// Например: array( 'category'=>array(45,'term_name'), 'tax_name'=>array(1,2,'name') )
		// 'category' - такса для которой указываются приор. элементы: 45 - ID термина и 'term_name' - ярлык.
		// порядок 45 и 'term_name' имеет значение: чем раньше тем важнее. Все указанные термины важнее неуказанных...
		'nofollow' => false, // добавлять rel=nofollow к ссылкам?

		// служебные
		'sep'             => '',
		'linkpatt'        => '',
		'pg_end'          => '',
	);

	function get_crumbs($sep, $l10n, $args)
	{
		global $post, $wp_query, $wp_post_types;

		self::$args['sep'] = $sep;

		// Фильтрует дефолты и сливает
		$loc = (object) array_merge(apply_filters('kama_breadcrumbs_default_loc', self::$l10n), $l10n);
		$arg = (object) array_merge(apply_filters('kama_breadcrumbs_default_args', self::$args), $args);

		// $arg->sep = '<span class="kb_sep">' . $arg->sep . '</span>'; // дополним

		// упростим
		$sep = &$arg->sep;
		$this->arg = &$arg;

		// микроразметка ---
		if (1) {
			$mark = &$arg->markup;

			// Разметка по умолчанию
			if (!$mark) $mark = array(
				'wrappatt'  => '<p id="breadcrumbs">%s</p>',
				'linkpatt'  => '<span><a href="%s">%s</a></span>',
				'sep_after' => '',
			);
			// rdf
			elseif ($mark === 'rdf.data-vocabulary.org') $mark = array(
				'wrappatt'   => '<p id="breadcrumbs" prefix="v: http://rdf.data-vocabulary.org/#">%s</p>',
				'linkpatt'   => '<span><a href="%s" rel="v:url" property="v:title">%s</a></span>',
				'sep_after'  => '', // закрываем span после разделителя!
			);
			// schema.org
			elseif ($mark === 'schema.org') $mark = array(
				'wrappatt'   => '<p id="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">%s</p>',
				'linkpatt'   => '<span><a href="%s" itemprop="item">%s</a></span>',
				'sep_after'  => '',
			);

			elseif (!is_array($mark))
				die(__CLASS__ . ': "markup" parameter must be array...');

			$wrappatt  = $mark['wrappatt'];
			$arg->linkpatt  = $arg->nofollow ? str_replace('<a ', '<a rel="nofollow"', $mark['linkpatt']) : $mark['linkpatt'];
			$arg->sep      .= $mark['sep_after'] . "\n";
		}

		$linkpatt = $arg->linkpatt; // упростим

		$q_obj = get_queried_object();

		// может это архив пустой таксы?
		$ptype = null;
		if (empty($post)) {
			if (isset($q_obj->taxonomy))
				$ptype = &$wp_post_types[get_taxonomy($q_obj->taxonomy)->object_type[0]];
		} else $ptype = &$wp_post_types[$post->post_type];

		// paged
		$arg->pg_end = '';
		if (($paged_num = get_query_var('paged')) || ($paged_num = get_query_var('page')))
			$arg->pg_end = $sep . sprintf($loc->paged, (int) $paged_num);

		$pg_end = $arg->pg_end; // упростим

		$out = '';

		if (is_front_page()) {
			return $arg->on_front_page ? sprintf($wrappatt, ($paged_num ? sprintf($linkpatt, get_home_url(), $loc->home) . $pg_end : $loc->home)) : '';
		}
		// страница записей, когда для главной установлена отдельная страница.
		elseif (is_home()) {
			$out = $paged_num ? (sprintf($linkpatt, get_permalink($q_obj), esc_html($q_obj->post_title)) . $pg_end) : esc_html($q_obj->post_title);
		} elseif (is_404()) {
			$out = $loc->_404;
		} elseif (is_search()) {
			$out = sprintf($loc->search, esc_html($GLOBALS['s']));
		} elseif (is_author()) {
			$tit = sprintf($loc->author, esc_html($q_obj->display_name));
			$out = ($paged_num ? sprintf($linkpatt, get_author_posts_url($q_obj->ID, $q_obj->user_nicename) . $pg_end, $tit) : $tit);
		} elseif (is_year() || is_month() || is_day()) {
			$y_url  = get_year_link($year = get_the_time('Y'));

			if (is_year()) {
				$tit = sprintf($loc->year, $year);
				$out = ($paged_num ? sprintf($linkpatt, $y_url, $tit) . $pg_end : $tit);
			}
			// month day
			else {
				$y_link = sprintf($linkpatt, $y_url, $year);
				$m_url  = get_month_link($year, get_the_time('m'));

				if (is_month()) {
					$tit = sprintf($loc->month, get_the_time('F'));
					$out = $y_link . $sep . ($paged_num ? sprintf($linkpatt, $m_url, $tit) . $pg_end : $tit);
				} elseif (is_day()) {
					$m_link = sprintf($linkpatt, $m_url, get_the_time('F'));
					$out = $y_link . $sep . $m_link . $sep . get_the_time('l');
				}
			}
		}
		// Древовидные записи
		elseif (is_singular() && $ptype->hierarchical) {
			$out = $this->_add_title($this->_page_crumbs($post), $post);
		}
		// Таксы, плоские записи и вложения
		else {
			$term = $q_obj; // таксономии

			// определяем термин для записей (включая вложения attachments)
			if (is_singular()) {
				// изменим $post, чтобы определить термин родителя вложения
				if (is_attachment() && $post->post_parent) {
					$save_post = $post; // сохраним
					$post = get_post($post->post_parent);
				}

				// учитывает если вложения прикрепляются к таксам древовидным - все бывает :)
				$taxonomies = get_object_taxonomies($post->post_type);
				// оставим только древовидные и публичные, мало ли...
				$taxonomies = array_intersect($taxonomies, get_taxonomies(array('hierarchical' => true, 'public' => true)));

				if ($taxonomies) {
					// сортируем по приоритету
					if (!empty($arg->priority_tax)) {
						usort($taxonomies, function ($a, $b) use ($arg) {
							$a_index = array_search($a, $arg->priority_tax);
							if ($a_index === false) $a_index = 9999999;

							$b_index = array_search($b, $arg->priority_tax);
							if ($b_index === false) $b_index = 9999999;

							return ($b_index === $a_index) ? 0 : ($b_index < $a_index ? 1 : -1); // меньше индекс - выше
						});
					}

					// пробуем получить термины, в порядке приоритета такс
					foreach ($taxonomies as $taxname) {
						if ($terms = get_the_terms($post->ID, $taxname)) {
							// проверим приоритетные термины для таксы
							$prior_terms = &$arg->priority_terms[$taxname];
							if ($prior_terms && count($terms) > 2) {
								foreach ((array) $prior_terms as $term_id) {
									$filter_field = is_numeric($term_id) ? 'term_id' : 'slug';
									$_terms = wp_list_filter($terms, array($filter_field => $term_id));

									if ($_terms) {
										$term = array_shift($_terms);
										break;
									}
								}
							} else
								$term = array_shift($terms);

							break;
						}
					}
				}

				if (isset($save_post)) $post = $save_post; // вернем обратно (для вложений)
			}

			// вывод

			// все виды записей с терминами или термины
			if ($term && isset($term->term_id)) {
				$term = apply_filters('kama_breadcrumbs_term', $term);

				// attachment
				if (is_attachment()) {
					if (!$post->post_parent)
						$out = sprintf($loc->attachment, esc_html($post->post_title));
					else {
						if (!$out = apply_filters('attachment_tax_crumbs', '', $term, $this)) {
							$_crumbs    = $this->_tax_crumbs($term, 'self');
							$parent_tit = sprintf($linkpatt, get_permalink($post->post_parent), get_the_title($post->post_parent));
							$_out = implode($sep, array($_crumbs, $parent_tit));
							$out = $this->_add_title($_out, $post);
						}
					}
				}
				// single
				elseif (is_single()) {
					if (!$out = apply_filters('post_tax_crumbs', '', $term, $this)) {
						$_crumbs = $this->_tax_crumbs($term, 'self');
						$out = $this->_add_title($_crumbs, $post);
					}
				}
				// не древовидная такса (метки)
				elseif (!is_taxonomy_hierarchical($term->taxonomy)) {
					// метка
					if (is_tag())
						$out = $this->_add_title('', $term, sprintf($loc->tag, esc_html($term->name)));
					// такса
					elseif (is_tax()) {
						$post_label = $ptype->labels->name;
						$tax_label = $GLOBALS['wp_taxonomies'][$term->taxonomy]->labels->name;
						$out = $this->_add_title('', $term, sprintf($loc->tax_tag, $post_label, $tax_label, esc_html($term->name)));
					}
				}
				// древовидная такса (рибрики)
				else {
					if (!$out = apply_filters('term_tax_crumbs', '', $term, $this)) {
						$_crumbs = $this->_tax_crumbs($term, 'parent');
						$out = $this->_add_title($_crumbs, $term, esc_html($term->name));
					}
				}
			}
			// влоежния от записи без терминов
			elseif (is_attachment()) {
				$parent = get_post($post->post_parent);
				$parent_link = sprintf($linkpatt, get_permalink($parent), esc_html($parent->post_title));
				$_out = $parent_link;

				// вложение от записи древовидного типа записи
				if (is_post_type_hierarchical($parent->post_type)) {
					$parent_crumbs = $this->_page_crumbs($parent);
					$_out = implode($sep, array($parent_crumbs, $parent_link));
				}

				$out = $this->_add_title($_out, $post);
			}
			// записи без терминов
			elseif (is_singular()) {
				$out = $this->_add_title('', $post);
			}
		}

		// Убрали вывод основноый таксономии Продукты
		// замена ссылки на архивную страницу для типа записи
		// $home_after = apply_filters('kama_breadcrumbs_home_after', '', $linkpatt, $sep, $ptype);

		// if ('' === $home_after) {
		// 	// Ссылка на архивную страницу типа записи для: отдельных страниц этого типа; архивов этого типа; таксономий связанных с этим типом.
		// 	if (
		// 		$ptype && $ptype->has_archive && !in_array($ptype->name, array('post', 'page', 'attachment'))
		// 		&& (is_post_type_archive() || is_singular() || (is_tax() && in_array($term->taxonomy, $ptype->taxonomies)))
		// 	) {
		// 		$pt_title = $ptype->labels->name;

		// 		// первая страница архива типа записи
		// 		if (is_post_type_archive() && !$paged_num)
		// 			$home_after = sprintf($this->arg->title_patt, $pt_title);
		// 		// singular, paged post_type_archive, tax
		// 		else {
		// 			$home_after = sprintf($linkpatt, get_post_type_archive_link($ptype->name), $pt_title);

		// 			$home_after .= (($paged_num && !is_tax()) ? $pg_end : $sep); // пагинация
		// 		}
		// 	}
		// }

		$before_out = sprintf($linkpatt, home_url(), $loc->home) . ($home_after ? $sep . $home_after : ($out ? $sep : ''));

		$out = apply_filters('kama_breadcrumbs_pre_out', $out, $sep, $loc, $arg);

		$out = sprintf($wrappatt, $before_out . $out);

		return apply_filters('kama_breadcrumbs', $out, $sep, $loc, $arg);
	}

	function _page_crumbs($post)
	{
		$parent = $post->post_parent;

		$crumbs = array();
		while ($parent) {
			$page = get_post($parent);
			$crumbs[] = sprintf($this->arg->linkpatt, get_permalink($page), esc_html($page->post_title));
			$parent = $page->post_parent;
		}

		return implode($this->arg->sep, array_reverse($crumbs));
	}

	function _tax_crumbs($term, $start_from = 'self')
	{
		$termlinks = array();
		$term_id = ($start_from === 'parent') ? $term->parent : $term->term_id;
		while ($term_id) {
			$term       = get_term($term_id, $term->taxonomy);
			$termlinks[] = sprintf($this->arg->linkpatt, get_term_link($term), esc_html($term->name));
			$term_id    = $term->parent;
		}

		if ($termlinks)
			return implode($this->arg->sep, array_reverse($termlinks)) /*. $this->arg->sep*/;
		return '';
	}

	// добалвяет заголовок к переданному тексту, с учетом всех опций. Добавляет разделитель в начало, если надо.
	function _add_title($add_to, $obj, $term_title = '')
	{
		$arg = &$this->arg; // упростим...
		$title = $term_title ? $term_title : esc_html($obj->post_title); // $term_title чиститься отдельно, теги моугт быть...
		$show_title = $term_title ? $arg->show_term_title : $arg->show_post_title;

		// пагинация
		if ($arg->pg_end) {
			$link = $term_title ? get_term_link($obj) : get_permalink($obj);
			$add_to .= ($add_to ? $arg->sep : '') . sprintf($arg->linkpatt, $link, $title) . $arg->pg_end;
		}
		// дополняем - ставим sep
		elseif ($add_to) {
			if ($show_title)
				$add_to .= $arg->sep . sprintf($arg->title_patt, $title);
			elseif ($arg->last_sep)
				$add_to .= $arg->sep;
		}
		// sep будет потом...
		elseif ($show_title)
			$add_to = sprintf($arg->title_patt, $title);

		return $add_to;
	}
}
// Хлебные крошки End ================================================================================================================
