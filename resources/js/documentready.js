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

  var $window = $(window);

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
