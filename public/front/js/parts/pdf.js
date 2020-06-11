export function pdf() {
	if (document.querySelector('.pdf-booklet-view') !== null) {
		let pdfFile = document.querySelector('.pdf-booklet-view'),
			// pdfSection = document.querySelector('.pdf-booklet'),
			pdfFileSrc = pdfFile.dataset.pdfSrc,
			pdfNextBtn = document.querySelector('.pdf-booklet-controls__btn--next'),
			pdfPrevBtn = document.querySelector('.pdf-booklet-controls__btn--prev'),
			pdfCurrentPage = document.querySelector('.pdf-booklet-controls__current'),
			headerCurrentPage = document.querySelector('.pdf-total-list__active'),
			headerCurrentPageMobile = document.querySelector('.pdf-total-list__active-mobile'),
			headerTotalPage = document.querySelector('.pdf-total-list__total'),
			headerTotalPageMobile = document.querySelector('.pdf-total-list__total-mobile'),
			progressBar = document.querySelector('.pdf-progress--leaflet'),
			pdfZoomOut = document.querySelector('.pdf-total-list__btn--zoom-out'),
			pdfZoomIn = document.querySelector('.pdf-total-list__btn--zoom-in'),
			pdfPrint = document.querySelector('.pdf-controls__btn--print'),
			pdfEmded = document.querySelector(".printed-emded"),
			pdfPrintContent = document.querySelector(".printed-content"),

			myState = {
				pdf: null,
				currentPage: 1,
				zoom: 0.7
			};

		pdfjsLib.getDocument(pdfFileSrc).then(function (pdf) {
			// Using promise to fetch the page
			myState.pdf = pdf;
			render();
		});

		function render() {
			myState.pdf.getPage(myState.currentPage).then((page) => {

				// Prepare canvas using PDF page dimensions
				let canvas = document.querySelector('.pdf-booklet-view');
				let context = canvas.getContext('2d');
				let viewport = page.getViewport(myState.zoom);
				let preloaderPdf = document.querySelector('.prealoder-pdf');

				canvas.width = viewport.width;
				canvas.height = viewport.height;

				// Render PDF page into canvas context
				page.render({
					canvasContext: context,
					viewport: viewport,
				});

				headerCurrentPage.textContent = myState.currentPage + ' ';
				headerTotalPage.textContent = myState.pdf._pdfInfo.numPages + ' ';

				headerCurrentPageMobile.textContent = myState.currentPage + ' ';
				headerTotalPageMobile.textContent = myState.pdf._pdfInfo.numPages + ' ';

				progressBar.setAttribute('value', myState.currentPage)
				progressBar.setAttribute('max', myState.pdf._pdfInfo.numPages);

				

				if (preloaderPdf !== null) {
					preloaderPdf.classList.remove('prealoder-pdf');
				} 
			});

		}

		pdfPrevBtn.addEventListener('click', function () {
			if (myState.pdf == null || myState.currentPage == 1) {
				this.setAttribute('disabled', 'disabled');
				return;
			} else {
				pdfNextBtn.removeAttribute('disabled');
			}
			myState.currentPage -= 1;
			pdfCurrentPage.value = myState.currentPage;
			render();
		});

		pdfNextBtn.addEventListener('click', function () {
			if (myState.pdf == null || myState.currentPage > myState.pdf._pdfInfo.numPages) {
				this.setAttribute('disabled', 'disabled');
				return;
			} else {
				pdfPrevBtn.removeAttribute('disabled');
				this.removeAttribute('disabled', 'disabled');
			}
			myState.currentPage += 1;
			pdfCurrentPage.value = myState.currentPage;
			render();
		});

		pdfZoomOut.addEventListener('click', function () {
			if (myState.pdf == null) return;
			if (myState.zoom >= .5) {
				myState.zoom -= 0.2;
			}
			render();
		});

		pdfZoomIn.addEventListener('click', function () {
			if (myState.pdf == null) return;
			if (myState.zoom <= 1.6) {
				myState.zoom += 0.2;
			}
			render();
		});

		// pdfPrint.addEventListener('click', function () {
		// 	pdfPrintContent.contentWindow.focus();
		// 	pdfPrintContent.contentWindow.print();
		// });

		
	}
}