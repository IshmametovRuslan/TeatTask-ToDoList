<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
	      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="/css/style.css">
	<title>ToDoList</title>
</head>
<body>
<div class="container">
	<div class="row justify-content-start">
		<div class="col-md-9">
			<?php include 'taskForm.php'; ?>
		</div>
		<div class="col-md-3">
			<?php include 'adminForm.php'; ?>
		</div>
	</div>
	<div class="row justify-content-center col-md-12">
		<div class="sortForm">
			<form action="" method="post" id="myForm">
				<h4>Отсортировать задачи</h4>
				<select name="sort" id="" onchange="document.getElementById('myForm').submit()">
					<option value="">Выберите поле</option>
					<option value="name">По имени</option>
					<option value="email">По email</option>
					<option value="status">По статусу</option>
				</select>
			</form>
		</div>
	</div>
	<div class="row justify-content-around">
		<?php for ( $i = 0; $i < count( $data ); $i ++ ) {
			echo '<div class="msg-block col-md-auto"><h5>' . $data[ $i ]['name'] . '</h5>';
			echo '<div class="email"><p>' . $data[ $i ]['email'] . '</p></div>';
			echo '<div class="text"><p>' . $data[ $i ]['text'] . '</div></p>';
			echo '<div class="status"><p>' . $data[ $i ]['status'] . '</div></p>';
			if ( isAdminLoggedIn() ) {
				echo '<button type="button" class="edit">Редактировать</button>';
				include 'editForm.php';
			}
			echo '</div>';
		}
		pagination();
		?>

	</div>
	<script
			src="https://code.jquery.com/jquery-3.4.0.js"
			integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo="
			crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
	        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
	        crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
	        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
	        crossorigin="anonymous"></script>
	<script src="../scripts/scripts.js"></script>
</body>
</html>
