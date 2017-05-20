<?php;
	//
	//	Обработка ajax запросов
	//	

	//	генерация короткой ссылки при нажатии кнопки СФОРМИРОВАТЬ
	//	
	if((isset($_POST['action'])) && ($_POST['action'] == 'newurl')) {


		// получение массива зарегистрированных коротких ссылок из файла
		// При работе с БД - здесь подключение и загрузка массива из базы
		$urllist = parse_ini_file('urls.ini',false);
		$url = $_POST['url'];

		if (! preg_match("~^(?:(?:https?|ftp|telnet)://(?:[a-z0-9_-]{1,32}".
			"(?::[a-z0-9_-]{1,32})?@)?)?(?:(?:[a-z0-9-]{1,128}\.)+(?:com|net|".
			"org|mil|edu|arpa|gov|biz|info|aero|inc|name|[a-z]{2})|(?!0)(?:(?".
			"!0[^.]|255)[0-9]{1,3}\.){3}(?!0|255)[0-9]{1,3})(:[0-9]{1,5})?(?:/[а-яa-z0-9.,_@%\(\)\*&".
			"?+=\~/-]*)?(?:#[^ '\"&<>]*)?$~i", $url)) {

			// Введен некорректный URL
			echo ":Введите валидный адрес сайта";
			// двоеточие в начале - признак ошибки
			exit();

		} else {

			if (in_array($url, $urllist)) {
				// если этот адрес уже есть в списке
				echo ":Такая ссылка уже зарегистрирована!";
		        // двоеточие в начале - признак ошибки
		        exit();
			} else {
				echo newlink($url);
			}

		}
	}


	//	Запись в файл нового роутера
	//	
	if((isset($_POST['action'])) && ($_POST['action'] == 'saveurl')) {

		$f = fopen('urls.ini', 'a');
		fwrite($f, "\r\n".$_POST['nurl'] . ' = ' . $_POST['surl']);
		fclose($f);
		echo 'Урааа';

	}


	// Генерация нового уникального числа
	function newlink($url) 
	{
		$urllist = parse_ini_file('urls.ini',false);

		$err = true;

		do {
			$res = rand(10000000, 99999999);
			$err = array_key_exists($res, $urllist);
		}
		while ($err) ;

		return $res;rand(10000000, 99999999);
	}


 ?>