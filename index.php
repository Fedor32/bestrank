<?php 

	// получение массива зарегистрированных коротких ссылок из файла
	// При работе с БД - здесь подключение и загрузка массива из базы
	$urllist = parse_ini_file('urls.ini',false);

	// получение текста первого элемента URI
	$url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	$uri_parts = explode('/', trim($url_path, ' /'));
	$link = array_shift($uri_parts);

	if (array_key_exists($link, $urllist)) {
		// если в массиве зарегистрированных ссылок есть элемент с ключем $link 
		// то отправлям пользователя по адресу, содержащемуся в значении этого элемента
		header('Location: '.$urllist[$link]); 
	} else {
		// если соответствие не найдено выводим форму генерации новой ссылки
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<title>Сервис сокращенных ссылок</title>
	<link rel="stylesheet" type="text/css" media="all" href="style.css">
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="script.js"></script>
</head>
<body>
	<h1>Получение короткой ссылки</h1>
	<form method="post" action="" class="urlform">
		<p>
			<label for="longurl">Ваша длинная ссылка:</label>
			<input type="text" id="longurl" value="http://" placeholder="Ваша длинная ссылка">
		</p>

		<p>
			<label for="newurl">Моя короткая:</label>
			<input type="text" id="newurl" value="" placeholder="Нажмите кнопку для получения" disabled="disabled">
		</p>

		<p class="urlform-submit">
		<button type="button" class="urlform-button"></button>
		</p>
		<hr>		

		<p>Для получения короткой ссылки введите свой адрес в верхнее поле и нажмите кнопку СФОРМИРОВАТЬ</p>
		<p>Нажимайте кнопку СФОРМИРОВАТЬ для смены короткой ссылки</p>

		<p class="newurlink" style="display:none"><a href="#" id="newurlink" newurl="">Сохранить ссылку и перейти</a></p>

	</form>
</body>
</html>


<?
	}

 ?>