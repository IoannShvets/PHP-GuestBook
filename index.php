<html>
<head>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <style>
        .sort {
        	float:left ;
        	margin-left: 20px;
    		margin-top: 10px;
    		padding-bottom: 10px;
        }
        .add_new{
        	float: right;
        	margin-right: 20px;
   			margin-top: 10px;
    		padding-bottom: 10px;
        }
        </style>
</head>
<body>
<div class=sort>
<p> Сортировка по убыванию: <a href="index.php?sort=date-desc">Дата</a> | <a href="index.php?sort=name-desc">Имя</a> | <a href="index.php?sort=content-desc">Отзывы</a>
<p> Сортировка по возростанию: <a href="index.php?sort=date-asc">Дата</a> | <a href="index.php?sort=name-asc">Имя</a> | <a href="index.php?sort=content-asc">Отзывы</a>
</div>
<div class=add_new>
<p><a href ="add_new.php">Добавить отзыв</a>
</div>
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
	$sql = "SELECT * FROM `date` DESC LIMIT $start, $per_page";

	if ($_GET['sort'] == 'date-desc') {
    	$sql = "SELECT * FROM `gb` ORDER BY `date` DESC LIMIT $start, $per_page";
	} elseif ($_GET['sort'] == 'name-desc') {
    	$sql = "SELECT * FROM `gb` ORDER BY `name` DESC LIMIT $start, $per_page";
	} elseif ($_GET['sort'] == 'content-desc') {
    	$sql = "SELECT * FROM `gb` ORDER BY `content` DESC LIMIT $start, $per_page";
	} elseif ($_GET['sort'] == 'date-asc') {
    	$sql = "SELECT * FROM `gb` ORDER BY `date` ASC LIMIT $start, $per_page";
	} elseif ($_GET['sort'] == 'name-asc') {
    	$sql = "SELECT * FROM `gb` ORDER BY `name` ASC LIMIT $start, $per_page";
	} elseif ($_GET['sort'] == 'content-asc') {
    	$sql = "SELECT * FROM `gb` ORDER BY `content` ASC LIMIT $start, $per_page";
	} 
	else  {
    	$sql = "SELECT * FROM `gb` ORDER BY `date` DESC LIMIT $start, $per_page";
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
	echo '<th>Сайт</th>';
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
<br />

</body>
</html>
