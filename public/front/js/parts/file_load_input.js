export function fileLoadInput() {
	let loadedInput = document.querySelectorAll('.contact-form-loaded__input'),
		loadedFileClean = document.querySelectorAll('.contact-form-loaded__close');

	for (let i = 0; i < loadedInput.length; i++) {
		loadedInput[i].addEventListener('change', function () {
			if (this.value.length > 0) {
				console.log(this)
				this.parentNode.classList.add('contact-form-loaded--active');
				this.parentNode.querySelector('.contact-form-loaded__close').classList.add('contact-form-loaded__close--active');
			} else {
				this.parentNode.querySelector('.contact-form-loaded__close').classList.remove('contact-form-loaded__close--active');
				this.parentNode.classList.remove('contact-form-loaded--active');
			}
		});
	}

	for (let i = 0; i < loadedFileClean.length; i++) {
		loadedFileClean[i].addEventListener('click', function (e) {
			e.preventDefault();
			this.classList.remove('contact-form-loaded__close--active');
			this.parentNode.classList.remove('contact-form-loaded--active');
		});
	}
}