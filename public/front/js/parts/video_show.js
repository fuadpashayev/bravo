export function videoShow() {
	let videoWrap = document.querySelectorAll('.shop-article__video-wrap'),
		videoMain = document.querySelectorAll('.shop-article__video-wrap--active'),
		firstVideoWrap = document.querySelectorAll('.shop-article__video-wrap--first'),
		player = document.querySelectorAll('.yt-player');

	for (let i = 0; i < videoWrap.length; i++) {
		videoWrap[i].addEventListener('click', function () {
			if (!this.classList.contains('shop-article__video-wrap--first')) {
				this.classList.add('shop-article__video-wrap--active');
			} else {
				closeAllActiveVideo();
				this.classList.remove('shop-article__video-wrap--active');
				this.nextElementSibling.classList.add('shop-article__video-wrap--active');
			}
		});
	}

	function closeAllActiveVideo() {

		for (let i = 0; i < videoMain.length; i++) {
			videoMain[i].classList.remove('shop-article__video-wrap--active');
		}
		for (let i = 0; i < firstVideoWrap.length; i++) {
			firstVideoWrap[i].classList.add('shop-article__video-wrap--active');
		}

		for (let i = 0; i < player.length; i++) {
			player[i].contentWindow.postMessage('{"event":"command","func":"stopVideo","args":""}', '*');
		}

	}
}