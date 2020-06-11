export function showFullContent() {
	let showBtn = document.querySelectorAll('[data-show-full-text]');

	for (let i = 0; i < showBtn.length; i++) {
		showBtn[i].addEventListener('click', function () {
			let showContent = document.querySelector(`[data-full-text="${this.dataset.showFullText}"]`);

			showContent.classList.toggle('cards-section__descr--full-view');
			this.classList.toggle('cards-section__button--active');
		});
	}
}