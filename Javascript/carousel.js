//Script to start the carousel
new Glider(document.querySelector('.glider'), {
  slidesToShow: 1,
  slidesToScroll: 1,
  draggable: true,
  dots: '#dots',
  scrollLock: true,
  rewind:true,
  arrows: {
    prev: '.glider-prev',
    next: '.glider-next'
  },
   responsive: [
    {
      // screens greater than >= 775px
      breakpoint: 775,
      settings: {
        slidesToShow: 'auto',
        slidesToScroll: 'auto',
        itemWidth: 150,
        duration: 0.25
      }
    },{
      // screens greater than >= 1024px
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        itemWidth: 500,
      }
    }
  ]
})