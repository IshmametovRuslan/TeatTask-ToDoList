<?php

include '../functions.php';

/**
 *
 * Функция отправки отправки сообщения в БД
 *
 * @param     $name
 * @param     $email
 * @param     $textMsg
 * @param int $statusVal
 *
 *
 */
function sendTaskMsg( $name, $email, $textMsg, $statusVal = 1 ) {

	if ( $statusVal == 2 ) {
		$statusVal = 'Выполненно';
	} else {
		$statusVal = 'В работе';
	}
	//Проверяем переменную POST
	if ( ! empty( $name ) && ! empty( $email ) && ! empty( $textMsg ) && isset( $_POST['sendBtn'] ) ) {

		//Отправляем данные в БД
		$sql = "INSERT INTO `task_table` (`name`,`email`,`text`,`status`) VALUES ('{$name}','{$email}','{$textMsg}','{$statusVal}')";
		doQuery( $sql );
	}
	header( "location: ../index.php" );
}

sendTaskMsg( $_POST['usrName'], $_POST['usrEmail'], $_POST['taskText'] );



