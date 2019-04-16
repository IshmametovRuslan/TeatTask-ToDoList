<?php
include 'config.php';

/**
 *
 *Функция подключения к БД
 * @return bool
 *
 */

global $link;

if ( empty( $link ) ) {
	$link = mysqli_connect( HOST, LOGIN, PASSWORD, DATABASE );
	if ( ! $link ) {
		print( 'Ошибка при подключении к серверу MySQL: ' . mysqli_connect_error() );
	}
}



