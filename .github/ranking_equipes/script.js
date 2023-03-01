window.addEventListener('load', function() {
	var logos = document.getElementsByClassName('logo');
	for (var i = 0; i < logos.length; i++) {
		logos[i].addEventListener('load', function() {
			var maxWidth = 50;
			var maxHeight = 50;
			var width = this.width;
			var height = this.height;
			if (width > maxWidth) {
				height *= maxWidth / width;
				width = maxWidth;
			}
			if (height > maxHeight) {
				width *= maxHeight / height;
				height = maxHeight;
			}
			this.width = width;
			this.height = height;
		});
	}
});
