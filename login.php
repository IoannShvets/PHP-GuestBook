<html>
	<head>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	</head>
<body>
<?php
	require 'connect.php';
	session_start();//не забываем во всех файлах писать session_start
if (isset($_POST['login']) && isset($_POST['password'])){
    //немного профильтруем логин
	$login = mysql_real_escape_string(htmlspecialchars($_POST['login']));
    //хешируем пароль т.к. в базе именно хеш
	$password = md5(trim($_POST['password']));
     // проверяем введенные данные
    $query = "SELECT user_id, user_login
            FROM users
            WHERE user_login= '$login' AND user_password = '$password'
            LIMIT 1";
    $sql = mysql_query($query) or die(mysql_error());
    // если такой пользователь есть
    if (mysql_num_rows($sql) == 1) {
        $row = mysql_fetch_assoc($sql);
		//ставим метку в сессии 
		$_SESSION['user_id'] = $row['user_id'];
		$_SESSION['user_login'] = $row['user_login'];
		//ставим куки и время их хранения 10 дней
		setcookie("CookieMy", $row['user_login'], time()+60*60*24*10);
		
   }
    else {
        //если пользователя нет, то пусть пробует еще
		header("Location: login.php"); 
    }
}
//проверяем сессию, если она есть, то значит уже авторизовались
if (isset($_SESSION['user_id'])){
	$per_page=5;
	// Получаем номер страницы
	if (isset($_GET['page'])) $page=($_GET['page']-1); else $page=0;
	// вычисляем первый оператор для LIMIT
	$start = $page * $per_page;
	// Составляем запрос и выводим записи
	// Переменную $start используем, как нумератор записей.
	$query = "SELECT * FROM `gb` order by `date` DESC LIMIT $start, $per_page";
	$result=mysql_query($query);
	// Создаем таблицу для данных
	echo '<table class="table table-bordered">';
	echo '<thead>';
	echo '<tr>';
	echo '<th>Дата</th>';
	echo '<th>IP</th>';
	echo ' <th>Браузер</th>';
	echo ' <th>Имя</th>';
	echo ' <th>Отзыв</th>';
	echo ' <th>Сайт</th>';
	echo ' <th>Удалить</th>';
	echo ' <th>Редактировать</th>';
	echo '</tr>';
	echo '</thead>';
	// Выводим данные с базы в таблицу
	while($row=mysql_fetch_array($result)) {
		echo '<tr>';
		echo '<td>';
		echo htmlspecialchars($row['date'], ENT_QUOTES, 'UTF-8'); // выводим данные
		echo '</td>';
		echo '<td>';
		echo htmlspecialchars($row['ip_adress'], ENT_QUOTES, 'UTF-8'); // выводим данные
		echo '</td>';
		echo '<td>';
		echo htmlspecialchars($row['browser'], ENT_QUOTES, 'UTF-8'); // выводим данные
		echo '</td>';
		echo '<td>';
		echo htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); // выводим данные
		echo '</td>';
		echo '<td>';
		echo htmlspecialchars($row['content'], ENT_QUOTES, 'UTF-8'); // выводим данные
		echo '</td>';
		echo '<td>';
		echo htmlspecialchars($row['site'], ENT_QUOTES, 'UTF-8'); // выводим данные
		echo '</td>';
		echo '<td>';
		echo "<a href='login.php?del=".$row["id"]."' class='deleteContact' name='remove' value='remove'>Удалить</a></article></article>";       
		echo '</td>';
		echo '<td>';
		echo "<a href='edit.php?edit=$row[id]'>Изменить<br />";
		echo '</td>';
		echo '</tr>';
		$id = $_REQUEST['id'];
		echo $id;
	}
	echo '</table>';

		if(isset($_GET["del"])){ 
		$id = $_GET["del"];
		if(mysql_query("DELETE FROM `gb` WHERE id = $id")){
		echo "deleted <br />";
        } else { 

        echo "<br/>ERROR DELETE";
        }    
    }  


	// Выводим ссылки на страницы
	$q="SELECT count(*) FROM `gb`";
	$res=mysql_query($q);
	$row=mysql_fetch_row($res);
	$total_rows=$row[0];
	$num_pages=ceil($total_rows/$per_page);
	for($i=1;$i<=$num_pages;$i++) {
		if ($i-1 == $page) {
			echo $i;
		} else {
			echo '<li><a href="'.$_SERVER['PHP_SELF'].'?page='.$i.'">'.$i.'</a></li>';
		}
	}
	
} else {
	$login = '';
	//проверяем куку, может он уже заходил сюда
	if (isset($_COOKIE['CookieMy'])){
		$login = htmlspecialchars($_COOKIE['CookieMy']);
	}
	//простая формочка
	print <<< 	html
	<form action="login.php" method="POST">
		Логин <input name="login" type="text" value = $login><br>
		Пароль <input name="password" type="password"><br>
		<input name="submit" type="submit" value="Войти">
	</form>
html;
}
?>
</body>
</html>
