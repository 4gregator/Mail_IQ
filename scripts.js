$(function(r) {
	$('form[name=poll]').on('submit', function(e) {
		let self = this;
		e.preventDefault();
		$('#sbmtPoll').hide();
		$('#preloader').show();
		$.post('poll.php', {
			answers : $(this).serialize(),
			name : $('#uname').val(),
			email : $('#email').val()
		}).done(function(data) {
			if (data) {
				$(self).slideUp(400);
				$('#answer').html(data).slideDown(400);
			} else showError();
		}).fail(showError);
	});
});

function showError() {
	$('#error').text('Что-то пошло не так...');
	$('#preloader').hide();
	$('#sbmtPoll').show();
};