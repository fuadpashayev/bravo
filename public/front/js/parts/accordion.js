export function accordion() {
	let accordionItems = document.querySelectorAll('.accordion__descr'),
		accordionInnerItems = document.querySelectorAll('.accordion__descr--inner-title'),
		accordionTopTitle = document.querySelectorAll('.accordion__descr--top');

	// for (let i = 0; i < accordionTopTitle.length; i++) {
	// 	accordionTopTitle[i].addEventListener('click', function () {
	// 		removeActiveAccordionClassMain();
	// 	});
	// }
	for (let i = 0; i < accordionItems.length; i++) {
		accordionItems[i].addEventListener('click', function () {
			// removeActiveAccordionClassInner();
			this.nextElementSibling.classList.toggle('accordion-visible');
			this.classList.toggle('accordion__descr--active');
		});
	}

	// function removeActiveAccordionClassInner() {
	// 	for (let i = 0; i < accordionInnerItems.length; i++) {
	// 		accordionInnerItems[i].nextElementSibling.classList.remove('accordion-visible');
	// 		accordionInnerItems[i].classList.remove('accordion__descr--active');
	// 	}
	// }

	// function removeActiveAccordionClassMain() {
	// 	for (let i = 0; i < accordionTopTitle.length; i++) {
	// 		accordionTopTitle[i].nextElementSibling.classList.remove('accordion-visible');
	// 		accordionTopTitle[i].classList.remove('accordion__descr--active');
	// 	}
	// }
}