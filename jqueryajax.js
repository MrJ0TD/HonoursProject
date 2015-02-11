$(document).ready(function(){
  var form = $('form');
  var submit = $('#submit');
  

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

        window.location.reload(true).fadeIn(800);

      },
      error: function(e){
        alert(e);
      }
    });
  });

  $('.delete-btn').each( function(){
      var comment_id = $(this).attr('id');
      var username = $(this).data('username');
    var btn = this;
    $(btn).click( function(e) {
    // prevent default action
    e.preventDefault();
    $.ajax({
      url: 'delete.php',
      type: 'POST',
      cache: false,
      data: {comment_id: comment_id, username: username },  //form serizlize data
      beforeSend: function(){
        // change submit button value text and disabled it
      // del.attr('disabled', 'disabled');
      },
      success: function(){
       
        console.log('yass');

      },
      error: function(e){
        alert(e);
      }
    });
  });
  });


});