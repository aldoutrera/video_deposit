(function( $ ){

  "use strict";

  var fetch_url = '';

  $('.iframe').fitVids();

  $('.filter-search').click(function(){
    $(this).button('loading');
    fetchResults();
  });

  var fetchResults = function() {
    var filters;
    if ($('input:text[name=video-query]').length) {
      fetch_url = (fetch_url === '') ? '/videos/get_videos' : fetch_url;
      filters   = fetchVideoFilters();
    } else {
      fetch_url = (fetch_url === '') ? '/users/get_users' : fetch_url;
      filters   = fetchUserFilters();
    }
    $.ajax({
      type: "POST",
      url: fetch_url,
      dataType: 'html',
      data: filters
    }).done(function( data ) {
      $('.results').html(data);
      $('.filter-search').button('reset');
      enable_ajax_pagination();
      enable_lazy_load();
    });
  };

  var fetchVideoFilters = function() {
    var order = $('.video-order .btn.active').text();
    order = (order == 'Newest') ? 'desc' : 'asc';
    var title = $('input:text[name=video-query]').val();
    return {
      'title': title,
      'order': order
    };
  };

  var fetchUserFilters = function() {
    return {
      'name': $('input:text[name=user-query]').val()
    };
  };

  var enable_ajax_pagination = function() {
    $('.pagination a').click(function(event){
      event.preventDefault();
      var new_link = $(this).attr('href');
      if (new_link == '#') {
        return false;
      }
      fetch_url = new_link;
      $('.results').empty();
      fetchResults();
    });
  };

  var search_boxes = {
    'videos': {
      'input': 'video-query',
      'url': '/videos/get_titles'
    },
    'users': {
      'input': 'user-query',
      'url': '/users/get_users_names'
    }
  };

  var enableSearchBoxes = function(search_boxes) {
    $.each(search_boxes, function(index, search){
      if ($('input:text[name='+search.input+']').length) {
        $('input:text[name='+search.input+']').keyup(function(){
          var text = $(this).val();
          $.ajax({
            type: "POST",
            url: search.url,
            dataType: 'json',
            data: {
              'search_input': text
            }
          }).done(function( data ) {
            $('input:text[name='+search.input+']').typeahead({
              source: data
            });
          });
        });
      }
    });
  };

  var enable_lazy_load = function() {
    $('img.lazy').lazyload({
      effect : "fadeIn",
      failure_limit : 99999,
      threshold : 10
    });
    $('img.lazy:last-child').load(function() {
      $(window).scroll();
    });
  };

  if ($('.filter-search').length) {
    fetchResults();
  }

  enable_lazy_load();
  enableSearchBoxes(search_boxes);

})( jQuery );
