export function customSelect() {
	let selectWrap = document.querySelectorAll('[data-select-wrap]'),
			selectOption = document.querySelectorAll('[data-select-option-items]'),
			selectChangedInput = document.querySelectorAll('[data-selected-input-change]');

	window.addEventListener('click', function (e) {

		if (!e.target.dataset.selectWrap) {
			totalCloseCustomSelect();
		}

	});

	for (let i = 0; i < selectWrap.length; i++) {
		selectWrap[i].addEventListener('click', openCustomSelect);
	}

	for (let i = 0; i < selectOption.length; i++) {
		selectOption[i].addEventListener('click', closeCustomSelect);
	}

	function openCustomSelect() {
		totalCloseCustomSelect();
		
		let thisEl = this,
			elFocus = thisEl.dataset.selectFocus,
			elWrap = thisEl.dataset.selectWrap,
			elSelectFocus = thisEl.querySelector(`[data-selected-item="${elWrap}"]`),
			elOptionWrapFocus = document.querySelector(`[data-select-option="${elWrap}"]`),
			elSelectInput = thisEl.querySelector(`[data-select-input="${elWrap}"]`);

		if (elFocus == 'false') {
			thisEl.setAttribute('data-select-focus', true);
			elSelectFocus.setAttribute('data-selected-focus', true);
			elOptionWrapFocus.setAttribute('data-select-option-opened', true);
		} else {
			thisEl.setAttribute('data-select-focus', false);
			elSelectFocus.setAttribute('data-selected-focus', false);
			elOptionWrapFocus.setAttribute('data-select-option-opened', false);
		}

	}

	function closeCustomSelect() {
		let thisEl = this,
			selectInputValue = this.dataset.selectOptionInput,
			selectAttrInfo = this.dataset.selectOptionItems,
			selectInputMain = document.querySelector(`[data-select-input="${selectInputValue}"]`),
			selectAttr = document.querySelector(`[data-selected-item="${selectInputValue}"]`),
			selectOpened = document.querySelector(`[data-select-wrap="${selectInputValue}"]`),
			selectFocus = document.querySelector(`[data-select-option="${selectInputValue}"]`);

		selectInputMain.value = selectAttrInfo;
		selectAttr.textContent = selectAttrInfo;

		selectOpened.setAttribute('data-select-focus', false);
		selectFocus.setAttribute('data-select-option-opened', false);
		selectAttr.setAttribute('data-selected-focus', false);


		selectAttr.dataset.selectedChanged = true; 
	}

	function totalCloseCustomSelect() {
		let selectFocus = document.querySelectorAll('[data-select-option-opened]'),
			selectOpened = document.querySelectorAll('[data-select-focus]'),
			selectAttr = document.querySelectorAll('[data-selected-focus]');

		for (let i = 0; i < selectFocus.length; i++) {
			selectFocus[i].setAttribute('data-select-option-opened', false)
		}

		for (let i = 0; i < selectOpened.length; i++) {
			selectOpened[i].setAttribute('data-select-focus', false)
		}

		for (let i = 0; i < selectAttr.length; i++) {
			selectAttr[i].setAttribute('data-selected-focus', false)
		}

	}

}