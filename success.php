<html>
<head>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
</head>
<body>
<?php 
	session_start();
	if($_POST['kapcha'] != $_SESSION['rand_code']) { 
		echo "Капча введена неверно, отзыв не был добавлен!";
	} else {
		require 'connect.php'; //Подключаемся к БД
		$date =  date("Y-m-d H:i:s"); // Узнаем дату и время
		$ip_adress = $_SERVER['REMOTE_ADDR']; // узнаем IP
		$browser = $_SERVER['HTTP_USER_AGENT'];  // Узнаем браузер
		$name = trim($_REQUEST['name']); // считываем данные с поля
		$content = trim($_REQUEST['content']); // считываем данные с поля
		$insert_sql = "INSERT INTO gb (date, ip_adress, browser, name, content)" . "VALUES('{$date}' , '{$ip_adress}', '{$browser}' , '{$name}' , '{$content}');";
		mysql_query($insert_sql); // Записываем в базу
		echo "Капча введена верно, ваш отзыв успешно добавлен!";
	} 
?>
</body>
</html>
