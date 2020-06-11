// NPM Modules 
import blazyload from '../../node_modules/blazy/blazy.min';
import svg4everybody from '../../node_modules/svg4everybody/dist/svg4everybody.min';
import Swiper from '../../node_modules/swiper/js/swiper.min';
import 'core-js/features/promise'; 
// import simplebar from '../../node_modules/simplebar/dist/simplebar.min';


// JS Modules 
import {preloader} from './parts/preloader';
import {dragFalse} from './parts/dragfalse';
import {mobileHamburgerBtn} from './parts/mobile_hamburger';
import {customSelect} from './parts/custom_select';
import {videoShow} from './parts/video_show';
import {simpleTab} from './parts/simple_tab';
import {pdf} from './parts/pdf';
import {fileLoadInput} from './parts/file_load_input';
import {showFullContent} from './parts/show_full_content';
import {accordion} from './parts/accordion';
import {vacancyRadioButton } from './parts/radio';
// import {modalBox} from './parts/modal_box';


window.addEventListener('DOMContentLoaded', function () {

	'use strict';

	/*
			navigation panel 
			0.   preloader 
			1.   svg for ie function 
			2.   dragable false web elements (images, link) 
			3.   lazyload
			4.   menu mobile hamburger btn click
			5.   custom select
			6.   video player show
			7.   simple tab
			8.   modal box  
			9.   file load input 
			10.  show full content 
			11.  vacancy radio buttons
	*/

	// preloader 
	if (document.querySelectorAll('.preloader') !== null) {
		preloader(); 
	}
	// end preloader 

	// svg for ie 
	svg4everybody();
	// end svg for ie 


	// dragable false web source
	dragFalse(); 
	// end dragable false web source 


	// lazyload
	blazyload({
		selector: '.blazy',
		offset: 1000,
		loadInvisible: true
	});
	// END lazyload

	// menu mobile hamburger btn click
	mobileHamburgerBtn();
	// end menu mobile hamburger btn click
	
	// sliders 
	if (document.querySelector('.banner-top-slider') !== null) {
		let topSliderThumb = new Swiper('.banner-top-slider-thumb', {
			slidesPerView: 6,
			watchSlidesVisibility: true,
			watchSlidesProgress: true,
			spaceBetween: 10,
			breakpoints: {
				320: {
					slidesPerView: 2
				},
				500: {
					slidesPerView: 3,
				},
				800: {
					slidesPerView: 6,
				}
			}
		});
		let topSlider = new Swiper('.banner-top-slider', {
			slidesPerView: 1,
			lazy: true,
			thumbs: {
				swiper: topSliderThumb
			}
		})
	}

	if (document.querySelector('.offers-tab-slider') !== null) {
		let offerPageSlider = new Swiper('.offers-tab-slider', {
			slidesPerView: 5,
			breakpoints: {
				320: {
					slidesPerView: 1
				},
				500: {
					slidesPerView: 2,
				},
				800: {
					slidesPerView: 4,
				},
				1100: {
					slidesPerView: 5,
				}
			}
		});
	}

	if (document.querySelector('.article-slider__main--slider-1') !== null) {
		let tabEls = document.querySelectorAll('.about-aside__items');

		let articleSlider1 = new Swiper('.article-slider__main--slider-1', {
			slidesPerView: 1,
			lazy: true,
			navigation: {
				prevEl: '.article-slider-navigation__btn--prev-js-1',
				nextEl: '.article-slider-navigation__btn--next-js-1',
			},
			pagination: {
				el: '.article-slide-count--1',
				type: 'fraction',
			}
		});

		for (let i = 0; i < tabEls.length; i++) {
			tabEls[i].addEventListener('click', function () {
				setTimeout(() => {
					articleSlider1.update();
				}, 100);
			});
		}
		
	}

	if (document.querySelector('.article-slider__main--slider-2') !== null) {
		let tabEls = document.querySelectorAll('.about-aside__items'),
			  currentSlideCount= document.querySelector('.article-slide-count__current--2'),
				totalSlideCount = document.querySelector('.article-slide-count__total--2');

		let articleSlider1 = new Swiper('.article-slider__main--slider-2', {
			slidesPerView: 1,
			lazy: true,
			navigation: {
				prevEl: '.article-slider-navigation__btn--prev-js-2',
				nextEl: '.article-slider-navigation__btn--next-js-2',
			},
			pagination: {
				el: '.article-slide-count--2',
				type: 'fraction',
			},
		});

		for (let i = 0; i < tabEls.length; i++) {
			tabEls[i].addEventListener('click', function () {
				setTimeout(() => {
					articleSlider1.update();
				}, 100);
			});
		}
		
	}

	if (document.querySelector('.article-slider__main--slider-3') !== null) {
		let tabEls = document.querySelectorAll('.about-aside__items');

		let articleSlider1 = new Swiper('.article-slider__main--slider-3', {
			slidesPerView: 1,
			lazy: true,
			navigation: {
				prevEl: '.article-slider-navigation__btn--prev-js-3',
				nextEl: '.article-slider-navigation__btn--next-js-3',
			},
			pagination: {
				el: '.article-slide-count--3',
				type: 'fraction',
			}
		});

		for (let i = 0; i < tabEls.length; i++) {
			tabEls[i].addEventListener('click', function () {
				setTimeout(() => {
					articleSlider1.update();
				}, 100);
			});
		}
		
	}

	if (document.querySelector('.benefits-slider') !== null) {
		let jobsSlider = new Swiper('.benefits-slider', {
			slidesPerView: 5,
			lazy: true,
			navigation: {
				prevEl: '.benefits-slider-pagination__btn--prev',
				nextEl: '.benefits-slider-pagination__btn--next',
			},
			breakpoints: {
				310: {
					slidesPerView: 2
				},
				400: {
					slidesPerView: 2.4
				},
				550: {
					slidesPerView: 3.6
				},
				620: {
					slidesPerView: 4
				},
				1000: {
					slidesPerView: 5
				},
			}
		});
		
	}
	// end sliders


	// custom select
	customSelect();
	// end custom select


	// video player show
	videoShow();
	// end video player show


	// simple tab
	simpleTab();
	// end simple tab 


	// pdf 
	pdf();
	// end pdf
	

	// when file loaded in contacts page 
	fileLoadInput();
	// end when file loaded in contacts page 

	
	// show full content script 
	showFullContent();
	// end show full content script 

	// accordion
	accordion();
	// end accordion 


	// vacancy radio buttons
	vacancyRadioButton();
	// end vacancy radio buttons



	// END 
});

    
