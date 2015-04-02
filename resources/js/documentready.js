$(document).ready(function(){

  /////////////////////////////
  // GET BROWSER INFORMATION //
  /////////////////////////////

  browser = (function(){
    var N= navigator.appName, ua= navigator.userAgent, tem;
    var M= ua.match(/(opera|chrome|safari|firefox|msie)\/?\s*(\.?\d+(\.\d+)*)/i);
    if(M && (tem= ua.match(/version\/([\.\d]+)/i))!= null) M[2]= tem[1];
    M= M? [M[1], M[2]]: [N, navigator.appVersion,'-?'];
    return M;
  })();

  //////////////////////////////
  // ASSIGN ELEMENT VARIABLES //
  //////////////////////////////

  var $window      = $(window);
  var $menu        = $('#menu');
  var $messages    = $('#alert_bar, #error_bar');
  var $quickcreate = $('#quickcreate');
  var $content     = $('#content, #content_fullscreen');

  ////////////////////////////////////
  // ASSIGN ENVIRONMENTAL VARIABLES //
  ////////////////////////////////////

  var baseURL        = window.location.protocol + "//" + window.location.hostname
  var windowWidth    = $window.width();
  var windowHeight   = $window.height();
  var verticalPos    = $window.scrollTop();
  var isMobile       = (/iphone|ipad|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));
  var isApple        = (/iphone|ipad|ipod/i.test(navigator.userAgent.toLowerCase()));

  $(window).focus(function() {
    var window_focus = true;
  }).blur(function() {
    var window_focus = false;
  });

  //////////////////////////////////
  // ASSIGN APPLICATION VARIABLES //
  //////////////////////////////////

  // define browser adjustments
  if (browser[0] === 'Firefox') {
    adj = 1;
  } else {
    adj = 0;
  }

  ///////////
  // CALLS //
  ///////////

  // check session status every 10 minutes
//var sessionCheck = setInterval(checkSessionStatus, 600000);

  // hide alt and title tooltips
  $('img').hideTips();

  // hover elements
  $(document).on({
    mouseenter: function () {
      if ($(this).hasClass('faded')) {
        $(this).stop(true,false).fadeTo(500,1.0);
      } else {
        $(this).stop(true,false).fadeTo(500,0.5);
      }
    },
    mouseleave: function () {
      if ($(this).hasClass('faded')) {
        $(this).fadeTo(500,0.45);
      } else {
        $(this).fadeTo(500,1.0);
      }
    }
  }, ".hover");

  // menu functionality
  $(document).on({
    mouseenter: function () {
      $menu.stop(true,true).fadeIn(500);
      $content.stop(true,true).animate({'opacity':'0.2'}, 500);
    },
    mouseleave: function () {
      $menu.stop(true,true).delay(2000).fadeOut(500);
      $content.stop(true,true).animate({'opacity':'1.0'}, 500);
    }
  }, ".menu");

  // retract alert and error bars
  $messages.delay(4000).animate({
    'margin-top' : '-60px',
  },500);

  // dismissal of messages
  $(document).on('click', '.dismiss', function() {
    $(this).parent().hide();
  });

  // datetime pickers
  $('#datetimepicker').datetimepicker({
    format: 'YYYY-MM-DD HH:mm:ss',
    showTodayButton: true,
    //format: 'YYYY-MM-DD HH:mm:ss Z',  // timezone, table and log model must support
    icons: {
      today: "fa fa-angle-double-down",
      time: "fa fa-clock-o",
      date: "fa fa-calendar",
      up: "fa fa-arrow-up",
      down: "fa fa-arrow-down",
      previous: "fa fa-arrow-left",
      next: "fa fa-arrow-right",
    }
  });

  // chosen select forms
  $('.chosen-select').chosen({
    width: '100%'
  });

  // logs select dependency inputs
  $("#log_selector").chosen().change(function () {
    var field = $(this).val();
    $('.dependent').addClass('hidden');
    $('#'+field).removeClass('hidden');
  }).trigger('change');

  // allow only one per group multiselect
  $('.limited-select group-result group-option').click(function() {
    $(this).siblings().prop('selected', false);
  });

  //////////////////////////
  // WINDOW SCROLL EVENTS //
  //////////////////////////

//// throttling
//var s = true;
//var r = 33;
//setInterval(function(){s=true;}, r);

//// scroll event
//$window.scroll(function() {
//  if (s) {
//    s = false;

//  }
//});

  //////////////////////////
  // WINDOW RESIZE EVENTS //
  //////////////////////////

//$window.resize(function() {
//  if (s) {
//    s = false;

//  }
//});

  ///////////////////////////
  // MOBILE SPECIFIC CALLS //
  ///////////////////////////

  if (isMobile) {

  }

});
