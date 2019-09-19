<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">  
		<title>Коментарии</title>
		<link rel="stylesheet" href="styles.css">
	</head>
	<header class="zig-zag">
		<div id="header">
			<div id="left">
				<p class="info_of_company">телефон: (499)340-94-71<br>Email:<u>info@future-group.ru</u></p>
				<h1 class="title">Коментарии</h1>
			</div>
			<div id="logo">
				<img id="logo_header" src="logo_1.gif"/>
			</div>
		</div>
	</header>
	<body>
		<?php
		//Соединяемся с базой данных используя фаил connect_db.php:
			include 'connect_db.php';
		// использовано текущую дату и время:
			$datatime = getdate();
		// записать в одну строку год-месяц-день час:минута:секунда:
			$t = "$datatime[hours]:$datatime[minutes]";
			$d = "$datatime[mday]:$datatime[mon]:$datatime[year]";
		// Сохранение нового коментария:
			if (!empty($_POST)) {
				$time = $_POST['time'];
				$date = $_POST['date'];
				$name = $_POST['name'];
				$comment = $_POST['comment'];
				$query = "INSERT INTO comments SET date='$date', time='$time', name='$name', comment='$comment'";
				mysqli_query($link, $query) or die(mysqli_error($link));
			}
		?>
		<div id="body">
			<?php
			//ВЫБРАТЬ все столбцы из таблиы comment, и отсортировать по дате:
				$query = "SELECT * FROM comments ORDER BY id";
			//Делаем запрос к БД, результат запроса пишем в $result:
				$result = mysqli_query($link, $query) or die( mysqli_error($link));
			//Преобразуем то, что отдала нам база в нормальный массив PHP $date:
				for ($date = []; $row = mysqli_fetch_assoc($result); $date[] = $row);
			// Вывод на экран:
				$result = '';
				foreach ($date as $elem) {
					$result .= '<div class="comments">';
						$result .= '<p class="name">' . $elem['name'] . '</p>';
						$result .= '<p class="time">' . $elem['time'] . '</p>';
						$result .= '<p class="date">' . $elem['date'] . '</p>';
						$result .= '<p class="comment">' . $elem['comment'] . '</p>';
					$result .= '</div>';
				}
				echo $result;
			?>
			<hr>
			<div id="form">
				<h2>Оставить коментарий</h2>
				<form action="" method="POST">
					<p><input type="hidden" name="time" value=<?php echo $t; ?>></p>
					<p><input type="hidden" name="date" value=<?php echo $d; ?>></p>
					<p>Ваше имя</p> 
					<p><input name="name" class="form-control" placeholder="Ваше имя"></p>
					<p>Ваш коментарий</p> 
					<p><textarea name="comment" сlass="form-control"></textarea></p>
					<p><input type="submit" class="btn_btn-info_btn-block" value="Отправить"></p>
				</form>
			</div>
		</div>
	</body>
<footer>
	<div id="footer">
		<img id="logo_footer" src="logo_1.gif"/>
		<p class="info_of_company"><b>телефон: (499)340-94-71<br>
			Email:<u>info@future-group.ru</u><br>
			Адрес:<u>115088 Москва, ул.2-я Машиностроения, д. 7 стр.1</u><br></b></p>
		<p class="info_of_company">©2010-2014 Future. Все права защищены</p>
	</div>
</html>
