<html>
	<head>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	</head>
<body>
<?php 
	require 'connect.php';
	error_reporting(E_ALL);
	//создаем кнопки 
	$delete =   '<input type="submit" name="delete" value="Удалить">';
	$edit =   '<input type="submit" name="edit" value="Редактировать">';
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
		echo $delete;
		echo '</td>';
		echo '<td>';
		echo $edit;
		echo '</td>';
		echo '</tr>';
		$id = $_REQUEST['id'];
		echo $id;
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
			echo '<div class="pagination">';
			echo '<li class="active">'.$i.'</li>';
			echo '</div>';
		} else {
			echo '<div class="pagination">';
			echo '<li><a href="'.$_SERVER['PHP_SELF'].'?page='.$i.'">'.$i.'</a></li>';
			echo '</div>';
		}
	}
?>
<a href="admin.php?do=logout">Выход</a>
</body>
</html>
