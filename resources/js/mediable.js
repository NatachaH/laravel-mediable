/*
|--------------------------------------------------------------------------
| Mediable Script
|--------------------------------------------------------------------------
*/

var btnDelete = document.querySelectorAll('.btn-media-delete');

Array.prototype.forEach.call(btnDelete, function(el, i) {

  var parent = el.closest('.list-group-item');
  var input  = el.querySelector('input');

  // On click on a delete button
  input.addEventListener('change', (event) => {
      if (event.target.checked) {
          parent.classList.add('list-group-item-danger');
      } else {
          parent.classList.remove('list-group-item-danger');
      }
  });

});
