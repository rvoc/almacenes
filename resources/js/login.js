
window.Popper = require('popper.js').default;
window.$ = window.jQuery = require('jquery');
require('bootstrap/dist/js/bootstrap.min.js')
require('tilt.js/src/tilt.jquery');
// vendor/tilt/tilt.jquery.min.js
require('./main.js');

window.toastr = require('toastr');

toastr.options = {
    "closeButton": false,
    "progressBar": true,
    "positionClass": "toast-bottom-left",
  }
//  $('.js-tilt').tilt({
//                 scale: 1.1
//             })
