$( function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: maxslider,
      values: slidervalue,
      slide: function( event, ui ) {
        $( "#amount" ).val( "R$" + ui.values[ 0 ] + " - R$" + ui.values[ 1 ] );
      }
    });
    $( "#amount" ).val( "R$" + $( "#slider-range" ).slider( "values", 0 ) +
      " - R$" + $( "#slider-range" ).slider( "values", 1 ) 
    );

    $('.filterarea').find('input').on('change', function(){
      $('.filterarea form').submit();
    });

    $('.addtocartform button').on('click', function(e){
      e.preventDefault();
    });

  });

const buttonUp = document.querySelector('#buttonClickUp');
const buttonDown = document.querySelector('#buttonClickDown');
const Quant = document.querySelector('.addtocart_qt');
const valueQuantyProduct = document.querySelector('#valueQuantyProduct');

const photo_item0 = document.querySelector('.photo_item0 img');
const photo_item1 = document.querySelector('.photo_item1 img');
const photo_item2 = document.querySelector('.photo_item2 img');
const photo_item3 = document.querySelector('.photo_item3 img');

const Photomain = document.querySelector('.mainphoto img');

buttonUp.addEventListener('click', function(e){
  e.preventDefault();
  Quant.value++;
  valueQuantyProduct.value++;
});
buttonDown.addEventListener('click', function(e){
  e.preventDefault();
  if(Quant.value>1){
  Quant.value--;
  valueQuantyProduct.value--;
  }
});

photo_item0.addEventListener('click', function(){
  let src = photo_item0.getAttribute('src');
  Photomain.setAttribute('src', src);
});
photo_item1.addEventListener('click', function(){
  let src = photo_item1.getAttribute('src');
  Photomain.setAttribute('src', src);
});
photo_item2.addEventListener('click', function(){
  let src = photo_item2.getAttribute('src');
  Photomain.setAttribute('src', src);
});
photo_item3.addEventListener('click', function(){
  let src = photo_item3.getAttribute('src');
  Photomain.src = src;
});