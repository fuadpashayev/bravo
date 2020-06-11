export function modalBox() {
	let modalOverlay = document.querySelectorAll('.modal-main__overlay'),
			modalMain = document.querySelector('.modal-main'),
			body = document.querySelector('body'),
			modalContentBody = document.querySelector('.modal-main__body'),
			closedBtn = document.querySelectorAll('[data-modal-close]'),
			openedModalClass,
			modalOpenedBtn = document.querySelectorAll('[data-modal-main]');

	// modal opened 
	for (let i = 0; i < modalOpenedBtn.length; i++) {
		modalOpenedBtn[i].addEventListener('click', modalOpenFuction);
	}

	function modalOpenFuction(e) {
		e.preventDefault();
		openedModalClass = this.dataset.modalBox;
		let mainModal = document.querySelector(openedModalClass),
				openedBodyAnimationInClass = mainModal.querySelector('.modal-main__body').dataset.animationEffectIn,
				selectedModal = mainModal.querySelector('.modal-main__body'), 
				openedModalBox = document.querySelector(openedModalClass);


		if (this.getAttribute('data-modal-main') == 'true') {
			openedModalBox.classList.add('modal-main--opened');
			body.classList.add('body-modal-active');
			selectedModal.classList.add(`modal-main__body--${openedBodyAnimationInClass}`);
		} else {
			selectedModal.classList.remove(`.modal-main__body--${openedBodyAnimationInClass}`);
			openedModalBox.classList.remove('modal-main--opened');
			body.classList.remove('body-modal-active');
		}
	}

	// modal close 
	for (let i = 0; i < modalOverlay.length; i++) {
		modalOverlay[i].addEventListener('click', closeModal);
	}

	for (let i = 0; i < closedBtn.length; i++) {
		if (closedBtn[i].dataset.modalClose == 'true') {
			closedBtn[i].addEventListener('click', closeModal);
		}
	}

	function closeModal(e) {
		e.preventDefault();
		
		let openedBodyAnimationOutClass = this.dataset.animationEffectOut,
				openedBodyAnimationInClass = this.dataset.animationEffectIn,
				mainModalClass = document.querySelector(openedModalClass),
				modalContentBody = document.querySelector(this.dataset.modalBox).querySelector('.modal-main__body');

		mainModalClass.classList.add('modal-main--closed');
		body.classList.remove('body-modal-active');
		modalContentBody.classList.add(`modal-main__body--${openedBodyAnimationOutClass}`);
		
		setTimeout(function () {
			mainModalClass.classList.remove('modal-main--opened');
			mainModalClass.classList.remove('modal-main--closed');
			modalContentBody.classList.remove(`modal-main__body--${openedBodyAnimationOutClass}`);
			modalContentBody.classList.remove(`modal-main__body--${openedBodyAnimationInClass}`);
		}, 450);
	}
}