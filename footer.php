 
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="bower_components/bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>

    <script>
    function appendText() {
        var txtfield = '<div class="text-field">Sample Text</div>';              // Create text with HTML
        $("#image-overlay").append(txtfield);     // Append new elements
        $(function() {
          $( ".text-field" ).draggable({ containment: "parent" });
          $( ".text-field" ).resizable();
        });
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
  ).bind('cloudinarydone', function(e, data) {

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
          $('.upload_form').addClass('hidden');
          $('#add-text').removeClass('hidden');
          $('#submit-pdf').removeClass('hidden');

          $( "#image-overlay").height(imgHeight).width(imgWidth);
          clearInterval(checkExist);
       } else {
        console.log("Doesn't Exist");
       }
    }, 100); // check every 100ms

  }).bind('cloudinaryprogress', function(e, data) { 

    $('.progress_bar').css('width', 
      Math.round((data.loaded * 100.0) / data.total) + '%'); 

  });

  $('#submit-pdf').click(function() {
    markedPDF = {
      url: pdfURL[0].currentSrc,
      size: {
        width: imgWidth,
        height: imgHeight
      },
      fields: new Object()
      }

    var textBoxes = $('.text-field');
    for (i = 0; i < textBoxes.length; i++) {
        markedPDF['fields']['field' + i] = new Object();
        markedPDF['fields']['field' + i]['position'] = new Object();
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
        console.log($(textBoxes[i]).css("left"));
        markedPDF['fields']['field' + i]['position']['left'] = Number(textBoxLeft)/imgWidth;
        markedPDF['fields']['field' + i]['position']['top'] = Number(textBoxTop)/imgHeight;
    }
    console.log(markedPDF);
  });

</script>
  </body>
</html>