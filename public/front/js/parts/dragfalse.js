export function dragFalse() {

	// Dragstart for images 
	let allImg = document.querySelectorAll('img'),
		allLink = document.querySelectorAll('a');

	if (allImg.length > 0) {
		for (let i = 0; i < allImg.length; i++) {
			allImg[i].addEventListener('dragstart', elementDragableFalse);
		}
	}

	if (allLink.length > 0) {
		for (let i = 0; i < allLink.length; i++) {
			allLink[i].addEventListener('dragstart', elementDragableFalse);
		}
	}

	function elementDragableFalse(e) {
		e.preventDefault();
	}

	// END Dragstart for images 

}

