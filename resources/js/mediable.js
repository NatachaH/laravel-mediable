/*
|--------------------------------------------------------------------------
| Media - Script
|--------------------------------------------------------------------------
|
| Require: require('vendor/nh/bs-component/resources/js/dynamic');
| Require: require('vendor/nh/sortable/resources/js/sortable');
|
*/

// Init the Dynamic to each .dynamic-media and init the bsCustomFileInput for file input
var dynamicMedia = document.querySelectorAll('.dynamic-media');
Array.prototype.forEach.call(dynamicMedia, function(el, i) {
    new Dynamic(el, {
      addCallback: function(){
        bsCustomFileInput.init();
      }
    });
});

// Init the sortable for the .dynamic-list in .dynamic-media
var sortableDynamic = document.querySelector('.dynamic-media .dynamic-list');
SortableJs.create(sortableDynamic, {
   animation: 150,
   handle: '.drag',
   onEnd: function (evt) {
     Array.prototype.forEach.call(sortableDynamic.children, function(el, i) {
       var input = el.querySelector('.dynamic-position');
       input.value = i+1;
     });
   }
});
