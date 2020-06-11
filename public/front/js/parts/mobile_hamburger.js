export function mobileHamburgerBtn() {
	if (document.querySelector('.hamburger') !== null) {
		let hamburger = document.querySelector('.hamburger'),
			mainMenu = document.querySelector('.main-menu');
	
		hamburger.addEventListener('click', function () {
			this.classList.toggle('hamburger--active');
			mainMenu.classList.toggle('main-menu--active');
		});
	}
}