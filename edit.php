<html>
<body>
<?php
require 'connect.php'; //Подключаемся к БД

	if( isset($_GET['edit']) )
	{
		$id = $_GET['edit'];
		$res= mysql_query("SELECT * FROM `gb` WHERE id='$id'");
		$row= mysql_fetch_array($res);
	}
 
	if( isset($_POST['newName']) )
	{
		$newName = $_POST['name'];
		$id  	 = $_POST['id'];
		$sql     = "UPDATE `gb` SET name=$newName WHERE id='$id'";
		$res 	 = mysql_query($sql);
		echo $sql;
	}
?>
	<form action="edit.php" method="POST">
		Изменить имя <input name="name" type="text" value=""><br>
		<input type="hidden" name="id" value="">
		<input name="submit" type="submit" value="Изменить">
	</form>

</body>
</html>
