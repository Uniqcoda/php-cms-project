$(document).ready(function () {
	// CKEditor
	ClassicEditor.create(document.querySelector('#body')).catch((error) => {
		console.error(error);
	});

	// posts page checkbox
	$('#selectAllBoxes').click(function (event) {
		if (this.checked) {
			$('.checkBoxes').each(function () {
				this.checked = true;
			});
		} else {
			$('.checkBoxes').each(function () {
				this.checked = false;
			});
		}
	});
});
