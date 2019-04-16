<?php
include 'sql.php';


/**
 * Функция выполнения запроса к БД
 *
 */
function doQuery( $query ) {

	global $link;

	//Задаем $link если она пуста
	if ( $link ) {
		mysqli_set_charset( $link, 'utf8' );

		$result = mysqli_query( $link, $query );

		//Выводим ошибку, если не соединились с БД
		if ( ! $result ) {
			return mysqli_error( $link );
		}

		return $result;
	}

	return false;
}

/**
 * Функция проверяет залогинен ли администратор
 *
 * @return bool
 *
 */
function isAdminLoggedIn() {

	global $link;

	if ( $link ) {

		//проверяем наличие куки
		if ( ! empty( $_COOKIE['beejeetest'] ) ) {

			list( $login, $password ) = explode( ';', escSql( $_COOKIE['beejeetest'] ) );

			//СВеряем данные из БД с данными из куки
			if ( ! empty( $login ) && ! empty( $password ) ) {
				$sql    = "SELECT COUNT(*) FROM admin WHERE login='{$login}' AND password='{$password}'";
				$result = doQuery( $sql );
				$rows   = mysqli_fetch_row( $result );

				if ( $rows[0] == 1 ) {
					return true;
				}
			}
		}

		return false;
	}
}

/**
 * Функция разлогинивания администратора
 *
 * @param string $args
 *
 */
function adminLogout() {
	if ( isset( $_GET['exit'] ) ) {

		//Обнуляем куки
		setcookie( 'beejeetest', '', time() - 60 * 60 * 24 );
		header( "Location: ../index.php" );
		die();
	}
}

adminLogout();

/**
 * Функция экранирует специальные символы
 *
 * @param $string
 *
 * @return string
 *
 */
function escSql( $string ) {
	global $link;
	if ( $link ) {
		return mysqli_real_escape_string( $link, $string );
	}
}

/**
 * Функция вывода задач на страницу
 *
 * @return array
 *
 */
function displayTasks() {

	global $data;

	//Лимит выводимых сообщений
	$limit = 3;

	//Устанавливаем номер страницы по умолчанию
	if ( empty( $_GET['page'] ) ) {
		$page = 1;
	} else {
		$page = $_GET['page'];
	}

	//С какой записи выводить
	$startPost = ( $page * $limit ) - $limit;

	//Лимитированый вывод из БД
	$sql    = "SELECT * FROM `task_table` LIMIT $startPost, $limit";
	$result = doQuery( $sql );
	$count  = mysqli_num_rows( $result );

	//Если записей нет
	if ( $count > 0 ) {
		for ( $data = []; $row = mysqli_fetch_assoc( $result ); $data[] = $row ) {
		}
	} else {
		echo 'Вы превый кто тут оставит запись!';
	}

	return $data;

}

displayTasks();

/**
 * Функция сортировки
 *
 */
function sortArr() {
	global $data;
	usort( $data, 'compareRow' );
}

sortArr();

/**
 * Функция сравнения строк
 *
 * @param $x
 * @param $y
 *
 * @return int
 *
 */
function compareRow( $x, $y ) {

	$flag = $_POST['sort'];

	$comparedRow = strcasecmp( $x[ $flag ], $y[ $flag ] );

	return $comparedRow;
}

/**
 * Функция вывода постраничной пагинации
 *
 */
function pagination() {

	global $active;

	//Узнаем общее количество записей в БД
	$sql    = "SELECT COUNT(*)FROM `task_table`";
	$result = doQuery( $sql );
	$row    = mysqli_fetch_row( $result );
	$count  = $row[0];

	//Входные данные
	$start      = '';
	$limit      = 3;                                                         //количество записей на странице
	$countPages = ceil( $count / $limit );                              //Количество страниц
	$active     = ( empty( $_GET['page'] ) ? 0 : intval( $_GET['page'] ) );   //Активная страница по умолчанию
	$countShow  = 3;                                                          //Количество навигационных ссылок
	$url_first  = '?page=1';
	$url_page   = '?&page=';

	//Устанавливаем наличие навигации, если страниц больше 1
	if ( $countPages > 1 ) {
		$left  = $active - 1;
		$right = $countPages - $active;

		//Границы навигационых ссылок
		if ( $left < floor( $countShow / 2 ) ) {
			$start = 1;
		} else {
			$start = $active - floor( $countShow / 2 );
		}

	}
	$end = $start + $countShow - 1;
	if ( $end > $countPages ) {
		$start -= ( $end - $countPages );
		$end   = $countPages;
		if ( $start < 1 ) {
			$start = 1;
		}
	} ?>
	<div class="row justify-content-around col-md-12">
		<div class="pagination justify-content-center">
			<span>Страницы:</span>
			<?php if ( $active != 0 ) { ?>
				<a href="<?= $url_first ?>" title="Первая страница">&lt;&lt;&lt;</a>
				<a href="<?php if ( $active == 2 ) { ?><?= $url_first ?><?php } else { ?><?= $url_page . ( $active - 1 ) ?><?php } ?>"
				   title="Предыдущая страница">&lt;</a>
			<?php } ?>
			<?php for ( $i = $start; $i <= $end; $i ++ ) { ?>
				<?php if ( $i == $active ) { ?><span><?= $i ?></span><?php } else { ?><a
					href="<?php if ( $i == 1 ) { ?><?= $url_first ?><?php } else { ?><?= $url_page . $i ?><?php } ?>"><?= $i ?></a><?php } ?>
			<?php } ?>
			<?php if ( $active != $countPages ) { ?>
				<a href="<?= $url_page . ( $active + 1 ) ?>" title="Следующая страница">&gt;</a>
				<a href="<?= $url_page . $countPages ?>" title="Последняя страница">&gt;&gt;&gt;</a>
			<?php } ?>
		</div>
	</div>
	<?php
}


