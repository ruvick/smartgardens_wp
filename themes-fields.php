<?

// Описание полей для Carbon_Fields производим только в этом файле
// 1. В начале идет описание полей - Настройки темы  далее категорий (если необходимо) в конце аблонов страниц и записей
// 2. Префиксы проставляем каждый раз новые осмысленно по имени проекта 
// 3. Для Полей которые входят в состав составново схема именования следующая <Общий префикс>_<название составного поля>_<имя поля>
// 4. Название секций Так же придумываем осмысленные на русском языке чтобы небыло сплошных Доп. полей
// 5. Каждый блок комментируем


use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('theme_options', __('Настройки темы', 'crb'))
  ->add_tab('Товар на главной', array(
    Field::make('text', 'product_home_title', 'Название товара')->set_width(100),
    Field::make('text', 'product_old_price', 'Старая цена')->set_width(50),
    Field::make('text', 'product_new_price', 'Новая цена')->set_width(50),
    Field::make('text', 'product_short_descp', 'Краткое описание товара')->set_width(50),
    Field::make('text', 'product_title', 'Заголовок Описания товара')->set_width(50),
    Field::make('text', 'product_descp', 'Описание товара')->set_width(50),
  ))
  ->add_tab('Технические характеристики товара', array(
    Field::make('text', 'product_home_power', 'Мощность')->set_width(25),
    Field::make('text', 'product_color_rendering_index', 'Индекс цветопередачи')->set_width(25),
    Field::make('text', 'product_dimer_support', 'Поддержка димера')->set_width(25),
    Field::make('text', 'product_voltage', 'Напряжение')->set_width(25),
    Field::make('text', 'product_light_flow', 'Световой поток')->set_width(25),
    Field::make('text', 'product_body_material', 'Материал корпуса')->set_width(25),
    Field::make('text', 'product_certification', 'Сертификация')->set_width(25),
    Field::make('text', 'product_number_leds', 'Количество светодиодов')->set_width(25),
    Field::make('text', 'product_led_colors', 'Цвета светодиодов')->set_width(25),
  ))
  ->add_tab('Контакты', array(
    Field::make('text', 'as_company', __('Название'))
      ->set_width(50),
    Field::make('text', 'as_schedule', __('Режим работы'))
      ->set_width(50),
    Field::make('text', 'as_phones_1', __('Телефон'))
      ->set_width(50),
    Field::make('text', 'as_phone_2', __('Телефон дополнительный'))
      ->set_width(50),
    Field::make('text', 'as_email', __('Email'))
      ->set_width(50),
    Field::make('text', 'as_email_send', __('Email для отправки'))
      ->set_width(50),
    Field::make('text', 'as_inn', __('ИНН'))
      ->set_width(50),
    Field::make('text', 'as_orgn', __('ОРГН'))
      ->set_width(50),
    Field::make('text', 'as_kpp', __('КПП'))
      ->set_width(50),
    Field::make('text', 'as_address', __('Адрес'))
      ->set_width(50),
    Field::make('text', 'as_bik', __('БИК'))
      ->set_width(50),
    Field::make('text', 'as_rs', __('Р/С'))
      ->set_width(50),
    Field::make('text', 'as_ks', __('К/С'))
      ->set_width(50),
    Field::make('text', 'as_insta', __('instagram'))
      ->set_width(50),
    Field::make('text', 'as_face', __('facebook'))
      ->set_width(50),
    Field::make('text', 'as_vk', __('Вконтакте'))
      ->set_width(50),
    Field::make('text', 'as_telegr', __('telegram'))
      ->set_width(50),
    Field::make('text', 'as_whatsapp', __('whatsapp'))
      ->set_width(50),
    Field::make('text', 'map_point', 'Координаты карты')
      ->set_width(50),
    Field::make('text', 'text_map', 'Текст метки карты')
      ->set_width(50),
  ));
Container::make('post_meta', 'ultra_product_cr', 'Характеристики товара')
  ->show_on_post_type(array('ultra'))
  ->add_fields(array(
    Field::make('complex', 'offer_picture', "Галерея товара")
      ->add_fields(array(
        Field::make('image', 'gal_img', 'Изображение')->set_width(30),
        Field::make('text', 'gal_img_sku', 'ID для модификации')->set_width(30),
        Field::make('text', 'gal_img_alt', 'alt и title')->set_width(30)
      )),
    Field::make('textarea', 'offer_smile_descr', 'Краткое описание')->set_width(100),
    Field::make('rich_text', 'prod_descrip', 'Описание товара')->set_width(100),
    Field::make('text', 'offer_price', 'Цена')->set_width(50),
    Field::make('text', 'old_price', 'Старая цена')->set_width(50),
    Field::make('text', 'offer_sku', 'Артикул (Базовый)')->set_width(50),
  ));
