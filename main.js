$(function() {
  $('body').on("click", '#enterButton', function (e){
    e.preventDefault();
    $("#enterButton2").css("background-color", "#5abf5d");
    $("#login").show();
    $("#signup").hide();
  });

  $('body').on("click", '#enterButton-2', function (e){
    e.preventDefault();
    $("#signup").show();
    $("#login").hide();
  });



  $('body').on('submit', 'form#login', function(e){
    e.preventDefault();
    //var send = $('form#login').serialize();
    $.post('test.php', $(this).serialize(), function(response){
     if (response == 'ok') {
      //$("#server_answer").html(response);
      alert(response);
     } else {
      alert(response);
     }
    });
  });




  $('body').on('submit', 'form#signup', function(e){
    e.preventDefault();
    //var send = $('form#login').serialize();
    $.post('ok.php', $(this).serialize(), function(response){
     if (response === true) {
      $('#server-answer').html("responce");
     } else {
      $('#server-answer').html(response);
     }
    });
  });


//Клонирует верхнюю панель и привязывает ее вставку и удаление к скролу
  pos = $('.sketch-rule').position();
  // var newTop = $('#top').clone(true).attr('id', 'new-top').css({'position':'fixed', 'background-color':'rgba(255,255,255,0.6)'});


  $(window).scroll(function(){
    if($(window).scrollTop() >= pos.top) {
      // $('#top').after(newTop);
      $('#top').css({'position':'fixed', 'background-color':'rgba(255,255,255,0.6)'});
  }
    if(($(window).scrollTop() < pos.top)) {
      // $('#new-top').remove();
      $('#top').css({'position':'absolute'});
    }
});



});

/*function getDocumentScroll() {
  var scrollInfo = {};

  scrollInfo.top = pageYOffset;
  scrollInfo.bottom = pageYOffset + document.documentElement.clientHeight;
  scrollInfo.height = Math.max(
    document.body.scrollHeight, document.documentElement.scrollHeight
    );

  return scrollInfo;
}*/