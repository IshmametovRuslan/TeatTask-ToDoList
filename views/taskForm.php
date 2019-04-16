<form action="models/sendMsg.php" method="post">
	<div class="form-group col-md-4">
		<label for="inputEmail4">Имя</label>
		<input type="text" name="usrName" class="form-control" placeholder="Имя">
	</div>
	<div class="form-group col-md-4">
		<label for="inputEmail4">Email</label>
		<input type="email" name="usrEmail" class="form-control" id="inputEmail4" placeholder="Email">
	</div>
	<div class="form-group col-md-6">
		<label for="exampleFormControlTextarea1">Текст задачи</label>
		<textarea class="form-control" name="taskText" rows="3" ></textarea>
	</div>
	<div class="form-group col-md-4">
		<button name="sendBtn" type="submit" class="">Отправить</button>
	</div>
</form>