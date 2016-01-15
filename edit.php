<html>
<body>
<?php
	require 'connect.php'; //Подключаемся к БД
	session_start();

	if( isset($_GET['edit']) )
	{
		$id = $_GET['edit'];
		$res= mysql_query("SELECT * FROM `gb` WHERE id='$id'");
		$row= mysql_fetch_array($res);
	}
 
	if( isset($_POST['content']) )
	{
		$content = $_POST['content'];
		$ids = $_POST['id'];		
		$id  	 = $_POST['id'];
		$sql     = "UPDATE `gb` SET `content`='$content' WHERE `id`='$ids'";
		$res 	 = mysql_query($sql);
		echo "<meta http-equiv='refresh' content='0;url=login.php'>";
	}
?>
	<form action="edit.php" method="POST">
		Изменить отзыв<p>
		 <textarea name="content" cols="40" rows="10" value=""></textarea><br>
		<input type="hidden" name="id" value="<?php echo $row[0]; ?>">
		<input name="submit" type="submit" value="Изменить">
	</form>

</body>
</html>
