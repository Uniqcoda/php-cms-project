$(document).ready(function () {
	// CKEditor
	ClassicEditor.create(document.querySelector('#body')).catch((error) => {
		console.error(error);
	});

	// disable email and username fields in the edit-profile page
	$('#user_email').prop('disabled', true);
	$('#username').prop('disabled', true);
});
