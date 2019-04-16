/**
 * Функция отображения окна редактирования записи
 */
$(document).ready(function() {
	$('.edit').click( function() {
		$(this).siblings('.editBlock').slideToggle(300);
		return false;
	});
});