<html>
<head>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
</head>
<body>
	<form action="success.php" method="post" name="form">
		<p><b>Ваше имя:</b><br>
		<input type="text" name="name" size="40">
		<p> <b>Отзыв</b><br>
		<textarea name="content" cols="40" rows="3"></textarea></p>
		<img src = "captcha.php" />
		<input type = "text" name = "kapcha" />
		<input id="submit" type="submit" value="Добавить"><br/>
	</form>
</body>
</html>
