<div class="editBlock" style="display: none;">
	<form action="../models/editMsg.php" method="post">
		<textarea name="updText" class="form-control" cols="50" rows="5"></textarea>
		<p><input type="checkbox" name="checkStatus" value = 2>Выполненно</p>
		<input type="text" name="idMsg" value="<?php echo $data[$i]['id']; ?>" hidden>
		<button name="sendBtn" type="submit" class="">Отправить</button>
	</form>
</div>
