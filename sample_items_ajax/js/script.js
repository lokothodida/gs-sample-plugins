/* global $ */
$(document).ready(function() {
  var $loadmore = $('#load-more');

  // Once the load-more button is clicked, do an ajax request
  $loadmore.click(function() {
    var $this = $(this);
    var page = $this.data('page');

    // Set the main container's class to a loading class
    $('#sample-items').addClass('loading');

    // Hide the button till the request is finished
    $this.hide();

    // Do a request for the next page
    $.getJSON('?sample_items_ajax', { page: page }, function(data) {


      if (data.results.length == 0) {
        // Remove the button so no more results can be loaded
        $this.remove();
      } else {
        // Add each item to the list
        $.each(data.results, function(idx, item) {
          // Clone the contents of the template div
          var $template = $('#sample-item-template').children().clone();

          // Fill in the content
          $template.find('.title').html(item.title);
          $template.find('.content').html(item.content);

          // Add the html to the items list
          $('#sample-items').append($template);
        });

        // Update the pagination page
        $this.data('page', page + 1);
      }

      // Finished loading, so show
      $('#sample-items').removeClass('loading');
      $this.show();
    });

    return false;
  });

  // Initialize the first few items
  $loadmore.click();
});