(function($) {
  'use strict';

  // Jquery Tag Input Starts
  $('#tags').tagsInput({
    'width': '100%',
    // 'height': '75%',
    'interactive': true,
    'defaultText': 'Add More',
    'removeWithBackspace': true,
    'minChars': 0,
    'maxChars': 20, // if not provided there is no limit
    'placeholderColor': '#666666'
  });

  // Jquery Tag Input Ends
})(jQuery);