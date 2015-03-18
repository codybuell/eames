////////////////////////////////////////////////////////////////////////////////
//                                                                            //
//                              FUNCTIONS LIBRARY                             //
//                                                                            //
////////////////////////////////////////////////////////////////////////////////

//////////////////////
// EMAIL VALIDATION //
//////////////////////

// simple email address checker
//       isEmail($('#id').val);
function isEmail(email) {
  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

///////////////////////////////////
// DYNAMIC FORM PLACEHOLDER TEXT //
///////////////////////////////////

// dynamically places text in input fields
//       placeholder($('#id'), 'Name');
function placeholder(element, text) {
  element.each(function() {
    var input = $(this);
    currtext = input.val();
    if (currtext.length == 0) {
      input.val(text).css({'color':'#ebeded'});
    }
    input.focus(function() { 
      if (this.value == text) {
        this.value = '';
        this.style.color = '';
      }
    });
    input.blur(function() { 
      if (this.value == '') {
        this.value = text;
        this.style.color = '#ebeded';
      }
    });
  });
}

///////////////////////////
// RENDERING CANVAS TEXT //
///////////////////////////

// draws text into an html5 canvas
//       draw($('#elem'),'text');
function draw(id,text) {
  var canvas    = document.getElementById(id);  // define the canvas element
  var context   = canvas.getContext('2d');      // define the canvas context
  canvas.width  = window.innerWidth;            // set canvas width to window
  canvas.height = window.innerHeight;           // set canvas height to window

  context.font      = "lighter 20px Helvetica"; // set the font face and size
  context.fillStyle = '#fff';                   // set the font color

  var metrics   = context.measureText(text);    // test measure with def size
  var textWidth = metrics.width;                // get the test width

  var scalex = (canvas.width / textWidth);      // determine x scale
  var scaley = (canvas.height / 23);            // determine y scale

  var ypos = (canvas.height / (scaley * 1.25)); // determin y position

  context.scale(scalex, scalex);                // normal ratio, fill width
  //context.scale(scaley, scaley);              // normal ratio, fill height
  //context.scale(scalex, scaley);              // scale ratio, fill canvas
  context.fillText(text, 0, ypos);              // render the text

  // drawing vertical text
  //context.save();
  //context.translate(30, 10);
  //context.rotate(-Math.PI/2);
  //context.textAlign = "center";
  //context.fillText("Your Label Here", 20, 0);
  //context.restore();
}

//////////////////////////
// AJAX FORM PROCESSING //
//////////////////////////

// ajax processing of html forms
//       ajaxForm($('id'), $('eid'), function(){}, function(){}, function(){});
function ajaxForm($formid, $email, successFN, errorFN, invalidFN) {
  $formid.submit(function(event) {
    // setup some variables
    var $form   = $(this);
    var $inputs = $form.find('input, select, button, textarea');
    var theData = $form.serialize();
    var action  = $form.attr('action');
    var email   = $email.val();
    // disable inputs for duration of request
    $inputs.attr('disabled', 'disabled');
    // prevent default posting of the form
    event.preventDefault();
    // ajax processing for the form
    if (isEmail(email)) {
      $.ajax({
        url:      action,
        type:     'post',
        data:     theData,
        success:  function(response, textStatus, xhr) {
                    console.log(response + textStatus + xhr);
                    successFN
                  },
        error:    function(xhr, textStatus, errorThrown) {
                    console.log('error ' + xhr + textStatus + errorThrown);
                    errorFN
                  },
        complete: function() {
                    $inputs.removeAttr('disabled');
                    $form[0].reset();
                  }
      });
    } else {
      invalidFN
      $inputs.removeAttr('disabled');
    }
  });
}

////////////////////////////////////
// HIDE ALT & TITLE TOOLTIPS TEXT //
////////////////////////////////////

// hides alt and title elements on hover
// $('img').hideTips();
(function($){
  $.fn.hideTips = function(){
    return this.each(function(){
             var $elem = $(this)
             var savealt = $elem.attr('alt');
             var savetitle = $elem.attr('title');
             $elem.hover(function(){
               $elem.removeAttr('title').removeAttr('alt');
             },function(){
               $elem.attr({title:savetitle,alt:savealt});
             });
    });
  };
})(jQuery);

/////////////////////////////
// AJAX GET SESSION STATUS //
/////////////////////////////

// reloads page if session has expired to show login screen
function checkSessionStatus() {
  var sessionAPI = baseURL+'/api/session';
  $.get(sessionAPI, function(response) {
    if (response) {
      return false;
    } else {
      window.location.replace(currentURL);
    }
  });
}
