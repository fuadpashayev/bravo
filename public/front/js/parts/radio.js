export function vacancyRadioButton() {
	let label = document.querySelectorAll('.careers-info-vacancies__link--js'),
		labelInner = document.querySelectorAll('.careers-info-vacancies__inner-items');

	// remove checked sub label when click another radio input
	for (let i = 0; i < label.length; i++) {
		label[i].addEventListener('click', function () {
			if (this.nextElementSibling !== null && this.nextElementSibling.classList.contains('careers-info-vacancies__inner-list')) {
				uncheckedRadioInput();
				this.nextElementSibling.querySelectorAll('.careers-info-vacancies__input')[0].checked = true;
			} else {
				uncheckedRadioInput();
			}
		});
	}

	// checked parent radio input when click sub radio input
	for (let j = 0; j < labelInner.length; j++) {
		labelInner[j].addEventListener('click', function () {
			this.parentNode.previousElementSibling.querySelector('input').checked = true;
		})
	}

	function uncheckedRadioInput() {
		let radio = document.querySelectorAll('.careers-info-vacancies__input');

		for (let k = 0; k < radio.length; k++) {
			if (radio[k].checked) {
				radio[k].checked = false;
			}
		}
	}
}