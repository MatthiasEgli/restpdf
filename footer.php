 
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="bower_components/bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>

    <script>
    function showForm() {
      $( ".create-text-field" ).removeClass( "hidden" );
    }
    function hideForm() {
      $( ".create-text-field" ).addClass( "hidden" );
    }
    function appendText() {
        var fieldName = document.getElementById("field-name").value;
        if (fieldName.length > 0) {
          var txtfield = '<div class="text-field">' + fieldName + '</div>';              // Create text with HTML
          $("#image-overlay").append(txtfield);     // Append new elements
          $(function() {
            $( ".text-field" ).draggable({ containment: "parent" });
            $( ".text-field" ).resizable();
          });
        }
        hideForm();
        $('#field-name').val('');
    }
    </script>

<script src='bower_components/cloudinary/jquery.iframe-transport.js' type='text/javascript'></script>
<script src='bower_components/cloudinary/jquery.fileupload.js' type='text/javascript'></script>
<script src='bower_components/cloudinary/jquery.cloudinary.js' type='text/javascript'></script>

  <script>

  // $('.upload_form').append($.cloudinary.unsigned_upload_tag("hevbb0vi", 
  // { cloud_name: 'restpdf' }));
 // //remove for live
 //          var imgHeight = $( '.image-display img' ).height();
 //          var imgWidth = $( '.image-display img' ).width();
 //          console.log(imgWidth);
 //          console.log(imgHeight);
 //          $( "#image-overlay").height(imgHeight).width(imgWidth);

  $('.cloudinary_fileupload').unsigned_cloudinary_upload("hevbb0vi", 
  { cloud_name: 'restpdf' }
  ).bind('cloudinaryprogress', function(e, data) { 

  // var progressbar = $( "#progressbar" ),
  //     progressLabel = $( ".progress-label" );
 
  //   progressbar.progressbar({
  //     value: false,
  //     change: function() {
  //       progressLabel.text( progressbar.progressbar( "value" ) + "%" );
  //     },
  //     complete: function() {
  //       progressLabel.text( "Complete!" );
  //     }
  //   });
 
  //   function progress() {
  //     var val = progressbar.progressbar( "value" ) || 0;
 
  //     progressbar.progressbar( "value", val + 2 );
 
  //     if ( val < 99 ) {
  //       setTimeout( progress, 80 );
  //     }
  //   }
 
  //   setTimeout( progress, 2000 );

   $('.progress_bar').css('width', 
    Math.round((data.loaded * 100.0) / data.total) + '%');

   setTimeout( function() {
          $('.progress_bar').css('width', 
          Math.round((data.loaded * 100.0) / data.total) + '%');
    }, 500 );

  }).bind('cloudinarydone', function(e, data) {
    setTimeout(function() {$('.load-successful').append('<p class="loading">Upload Completed.</p>');}, 200);
    $('.progress_bar').addClass('hidden')
    setTimeout(function() {$('.load-successful').append('<p class="loading">Creating Preview.</p>');}, 1000);

    pdfURL = $.cloudinary.image(data.result.public_id, 
      { format: 'jpg', cloud_name: 'restpdf' } );

    $('.image-display').append($.cloudinary.image(data.result.public_id, 
      { format: 'jpg', cloud_name: 'restpdf' } ));

    var checkExist = setInterval(function() {
       if ($('.image-display img').height() > 0) {
          console.log("Exists!");
          imgHeight = $( '.image-display img' ).height();
          imgWidth = $( '.image-display img' ).width();
          console.log(imgWidth);
          console.log(imgHeight);
          $('.loading').remove();
          $('.upload_form').addClass('hidden');
          $('.markup-buttons').removeClass('hidden');
          $('#stepone').addClass('hidden');
          $('#steptwo').removeClass('hidden');

          $( "#image-overlay").height(imgHeight).width(imgWidth);
          clearInterval(checkExist);
       } else {
        console.log("Doesn't Exist");
       }
    }, 100); // check every 100ms

  });

  $('#submit-pdf').click(function() {
    markedPDF = {
      pdf: {
        url: pdfURL[0].currentSrc,
        height: imgHeight,
        width: imgWidth
      },
      fields: new Array()
      }

    var textBoxes = $('.text-field');
    for (i = 0; i < textBoxes.length; i++) {
        var fieldName = $(textBoxes[i]).text();
        if ($(textBoxes[i]).css("left") == 'auto') {
          var textBoxLeft = 0;
        } else {
          var textBoxLeft = $(textBoxes[i]).css("left").substring(0, $(textBoxes[i]).css("left").length - 2);
        }
        if ($(textBoxes[i]).css("top") == 'auto') {
          var textBoxTop = 0;
        } else {
          var textBoxTop = $(textBoxes[i]).css("top").substring(0, $(textBoxes[i]).css("top").length - 2);
        }
        markedPDF['fields'][i] = {
          name: fieldName,
          x: Number(textBoxLeft)/imgWidth,
          y: Number(textBoxTop)/imgHeight,
          font: "Helvetica",
          size: 20
        }
    }
    console.log(markedPDF);
    $.ajax('http://api.restpdf.io/templates', {
        data: JSON.stringify(markedPDF),
        contentType: "application/json",
        type: "POST"
      }).then(
      function(result){
        console.log(result);
        $('#steptwo').addClass('hidden');
        $('.markup-buttons').addClass('hidden');
        $('.image-display').addClass('hidden');
        var resultText = '<p class="lead">Your API Endpoint:</p><p>' + result.api_endpoint + '</p><p class="lead">Your Available Fields</p><ul>';
        for (i = 0; i < markedPDF['fields'].length; i++) {
          resultText += "<li>" + markedPDF['fields'][i]['name'] + "</li>";
        }
        resultText += '</ul>';
        $('#results').append(resultText);
      }
    );
  });

</script>
  </body>
</html>