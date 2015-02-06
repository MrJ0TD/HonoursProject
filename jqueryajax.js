$(document).ready(function(){
  var form = $('form');
  var submit = $('#submit');
  var comment_id = $('.delete-btn').attr('id');
  

  form.on('submit', function(e) {
    // prevent default action
    e.preventDefault();
    // send ajax request
    $.ajax({
      url: 'comment.php',
      type: 'POST',
      cache: false,
      data: form.serialize(),  //form serizlize data
      beforeSend: function(){
        // change submit button value text and disabled it
        submit.val('Submitting...').attr('disabled', 'disabled');
      },
      success: function(data){
       
        var item = $(data).hide().fadeIn(800);
        $('.comment-block').append(item);

        // reset form and button
        form.trigger('reset');
        submit.val('Submit Comment').removeAttr('disabled');
      },
      error: function(e){
        alert(e);
      }
    });
  });

  $('.delete-btn').each( function(){
    var btn = this;
    $(btn).click( function(e) {
    // prevent default action
    e.preventDefault();
    $.ajax({
      url: 'delete.php',
      type: 'POST',
      cache: false,
      data: {comment_id: comment_id },  //form serizlize data
      beforeSend: function(){
        // change submit button value text and disabled it
      // del.attr('disabled', 'disabled');
      },
      success: function(){
       
       window.location.reload(true);

      },
      error: function(e){
        alert(e);
      }
    });
  });
  });


});