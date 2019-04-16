<?php
include '../functions.php';


/**
 * Функция редактирования записи
 * @param $idMsg
 * @param $updMsg
 */
function updateTask( $idMsg, $updMsg ) {

	//Проверяем наличие переменную POST
	if ( ! empty( $_POST['updText'] ) && isset( $_POST['sendBtn'] ) && isset( $_POST['idMsg'] ) ) {

		//Статус задачи (выполнена, в работе)
		$checkStatus = (int) ( $_POST['checkStatus'] );

		//Устанавливаем статус
		if ( $checkStatus == 2 ) {
			$checkStatus = 'Выполненно';
		} else {
			$checkStatus = 'В работе';
		}

		//Обновляем данные в БД
		$sql = "UPDATE `task_table` SET `text`= '{$updMsg}', `status` = '{$checkStatus}' WHERE id = '{$idMsg}'";
		doQuery( $sql );
		header( "location: ../index.php" );

	} elseif ( empty( $_POST['updText'] ) ) {

		echo 'Введите тест задания';
	}

}

updateTask( $_POST['idMsg'], $_POST['updText'] );