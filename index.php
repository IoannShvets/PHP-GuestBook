<html>
<head>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
</head>
<body>
<?php 
	// Подключаемся к БД
	require 'connect.php';
	$per_page=5;
	// Получаем номер страницы
	if (isset($_GET['page'])) $page=($_GET['page']-1); else $page=0;
	// вычисляем первый оператор для LIMIT
	$start = $page * $per_page;
	// Составляем запрос и выводим записи
	// Переменную $start используем, как нумератор записей.
	$sql = "SELECT * FROM `gb`";

	if ($_GET['sort'] == 'date') {
    	$sql .= " ORDER BY `date` DESC LIMIT $start, $per_page";
	} elseif ($_GET['sort'] == 'name') {
    	$sql .= " ORDER BY `name` DESC LIMIT $start, $per_page";
	} elseif ($_GET['sort'] == 'content') {
    	$sql .= " ORDER BY content DESC LIMIT $start, $per_page";
	}

	$result=mysql_query($sql);
	// Создаем таблицу для данных
	echo '<table class="table table-bordered">';
	echo '<thead>';
	echo '<tr>';
	echo '<th>Дата</th>';
	echo '<th>IP</th>';
	echo '<th>Браузер</th>';
	echo '<th>Имя</th>';
	echo '<th>Отзыв</th>';
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
		echo '</tr>';
	}
	echo '</table>';

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
			echo '<a href="'.$_SERVER['PHP_SELF'].'?page='.$i.'">'.$i.'</a>';
		}
	}


?>
<p> Сортировка: 
<p><a href="index.php?sort=date">Дата</a> | <a href="index.php?sort=name">Имя</a> | <a href="index.php?sort=content">Отзывы</a>

<p><a href ="add_new.php">Добавить отзыв</a>
</body>
</html>
