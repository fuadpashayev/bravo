export function simpleTab() {
	let tabNavItems = document.querySelectorAll('[data-simple-tab-nav]'),
			tabNavInnerItems = document.querySelectorAll('[data-simple-tab-inner-nav]'),
			menuInner = document.querySelectorAll('.about-aside__menu-inner');

	// add click event tab nav 
	for (let i = 0; i < tabNavItems.length; i++) {
		tabNavItems[i].addEventListener('click', showNextTab);
	}

	for (let i = 0; i < tabNavInnerItems.length; i++) {
		tabNavInnerItems[i].addEventListener('click', showNextTabInner);
	}

	// show next tab function 
	function showNextTab() {
		let nextTabAttrName = this.dataset.simpleTabNav,
				nextTab = document.querySelector(`[data-simple-tab-content="${nextTabAttrName}"]`),
				activeTabClass = document.querySelectorAll('.simple-tab__content--active');

		if (!this.classList.contains('simple-tab__content--active')) {

			// remove active class tab nav 
			for (let i = 0; i < tabNavItems.length; i++) {
				tabNavItems[i].classList.remove('simple-tab__link--active');
				tabNavItems[i].classList.remove('simple-tab__link--submenu-active');
			}

			// remove active inner class 
			for (let i = 0; i < tabNavInnerItems.length; i++) {
				tabNavInnerItems[i].classList.remove('simple-tab__link--active-inner');
			}

			for (let i = 0; i < menuInner.length; i++) {
				if (this.nextElementSibling !== null && this.nextElementSibling.classList.contains('about-aside__menu-inner')) {
					menuInner[i].querySelectorAll('.about-aside__link')[0].classList.add('simple-tab__link--active-inner')
				} 
			}
			

			// add active class tab nav 
			this.classList.add('simple-tab__link--active');


			// remove active class 
			for (let i = 0; i < activeTabClass.length; i++) {
				activeTabClass[i].classList.remove('simple-tab__content--active');
			}

			// add active class next tab content 
			nextTab.classList.add('simple-tab__content--active');
		}

	}

	// show next tab inner function 
	function showNextTabInner() {
		let nextTabAttrName = this.dataset.simpleTabInnerNav,
				nextTab = document.querySelector(`[data-simple-tab-content="${nextTabAttrName}"]`),
				activeTabClass = document.querySelectorAll('.simple-tab__content--active');

		for (let i = 0; i < tabNavItems.length; i++) {
			if (tabNavItems[i].dataset.simpleTabSubmenu == 'true' && tabNavItems[i].classList.contains('simple-tab__link--active')) {
				tabNavItems[i].classList.add('simple-tab__link--submenu-active');
			}
			tabNavItems[i].classList.remove('simple-tab__link--active');
		}

		for (let i = 0; i < activeTabClass.length; i++) {
			activeTabClass[i].classList.remove('simple-tab__content--active');
		}

		// remove active class tab nav 
		for (let i = 0; i < tabNavInnerItems.length; i++) {
			tabNavInnerItems[i].classList.remove('simple-tab__link--active-inner');
		}

		// add active class tab nav 
		this.classList.add('simple-tab__link--active-inner');

		// add active class next tab content 
		nextTab.classList.add('simple-tab__content--active');
	}

	
}