<?php
	session_start();
	$string = "";
	for ($i = 0; $i < 5; $i++) // задаем кол-во символов 
		$string .= chr(rand(97, 122)); // выводим случайные символы
	$_SESSION['rand_code'] = $string; //  Создаем сессию, где будут символы хранится
	$dir = "fonts/"; // Подключаем шрифты
	$image = imagecreatetruecolor(170, 60); //  Размер картинки
	$black = imagecolorallocate($image, 0, 0, 0); //  Выделение цвета
	$color = imagecolorallocate($image, 200, 100, 90); //  Цвет символов
	$white = imagecolorallocate($image, 255, 255, 255); // Фон
	imagefilledrectangle($image,0,0,399,99,$white); // Рисуем прямоугольник
	imagettftext ($image, 30, 0, 10, 40, $color, $dir."verdana.ttf", $_SESSION['rand_code']); //  Добавляем текст на изображение
	header("Content-type: image/png"); // Объявляем тип страницы
	imagepng($image);
?>
