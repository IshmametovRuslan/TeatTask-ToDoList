<?php
if ( isAdminLoggedIn() === false ) { ?>
	<form action="../models/admin.php" method="post">
		<div class="form-group">
			<label for="formGroupExampleInput">Логин</label>
			<input type="text" name="adminLogin" class="form-control" id="formGroupExampleInput"
			       placeholder="Введите логин">
		</div>
		<div class="form-group">
			<label for="inputPassword1">Пароль</label>
			<input type="password" name="adminPassword" class="form-control" id="inputPassword2"
			       placeholder="Введите пароль">
		</div>
		<button type="submit" class="">Вход</button>
	</form>
<?php } else { ?>
	<form action="" method="get">
		<button type="submit" name="exit" class="">Выйти</button>
	</form>
<?php }