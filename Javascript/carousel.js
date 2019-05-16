var $carousel = $('.carousel').overlapSlideshow({ //.carousel is a css selector
	imagesLoaded:true;
	percentPosition: false;
})

var $images = $carousel.find('carousel-cell img');

var documentStyle = document.documentElement.style;

var transformImg = typeof documentStyle.transform == 'string' ? 'transform' : 'WebkitTransform';

var overlapSlide = $carousel.data('overlapSlideshow');

$carousel.on ('scroll.overlapSlideshow', function() {

		overlapSlide.slides.foreach (function(slide, i) {
			var img = $img[i];
			var x = (slide.target + overlapSlide.x) * -1/3;
			img.style[transformImg] = 'translateX(' + x + 'px)';

	  });
});
