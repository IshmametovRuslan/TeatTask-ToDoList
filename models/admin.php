<?php
include '../functions.php';

/**
 * Функция авторизации админимтратора
 * @param $login
 * @param $password
 *
 */
function adminAuth ($login, $password) {

	//Проверяем введен ли логин и пароль
	if ( isset( $login ) && isset( $password ) ) {

		//хэшируем пароль
		$password = md5(md5($password));

		//Запрос в БД и сверка логина и пароля из БД
		$sql      = "SELECT COUNT(*) FROM admin WHERE login='{$login}' AND password='{$password}'";
		$result   = doQuery( $sql );
		$rows     = mysqli_fetch_row ($result);

		//Если из БД вернулась строка устанавливаем куки
		if ( $rows[0] == 1 ) {
			setcookie( 'beejeetest', implode( ';', [ $login, $password ] ), time() + 60 * 60 * 24, '/' );
			header( "Location: ../index.php" );
		} else {
			echo "Такого пользователя не существует!";
		}
		exit();
	}
}

adminAuth ($_POST['adminLogin'], $_POST['adminPassword']);