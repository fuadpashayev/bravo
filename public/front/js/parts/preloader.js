export function preloader() {


		let preloader = document.querySelectorAll('.preloader');

		function removeClass(i) {
			return function () {
				preloader[i].classList.remove('preloader', 'preloader--v', 'preloader--o', 'preloader--h');
			};
		}

		for (let i = 0; i < preloader.length; i++) {
			setTimeout(removeClass(i), i);
		}

}