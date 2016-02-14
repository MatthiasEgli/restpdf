<?php include("header.php"); 
?>

  <body>

    <div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container">

          <div class="inner cover">
            <h1 class="cover-heading">RESTpdf</h1>
            <p class="lead">Welcome to RESTpdf. Let's get started. Either drag your PDF into your browser window, or click the button to select the file from your computer.</p>
            <!-- <form class="upload_form">
              <input type="file" name="file" class="cloudinary_fileupload" role="button">
            </form> -->
            <div class="upload_form">
              <span class="btn btn-lg btn-success fileinput-button">
                  <i class="glyphicon glyphicon-upload"></i>
                  <span>Upload PDF</span>
                  <!-- The file input field used as target for the file upload widget -->
                  <input id="fileupload" class="cloudinary_fileupload" type="file" name="file" role="button">
              </span>
            </div>

            <div class="upload_field"></div>

            <div class="progress_bar"></div>

            <button class="btn btn-lg btn-primary hidden" id="add-text" onclick="appendText()">
              <i class="glyphicon glyphicon-plus"></i>
              <span>Add Text Field</span>
            </button>
            <button class="btn btn-lg btn-success hidden" id="submit-pdf">
              <i class="glyphicon glyphicon-ok"></i>
              <span>Submit</span>
            </button>

            <div class="image-display">
              <div id="image-overlay">
              </div>
              <!-- REmove before going live -->
              <!-- <img src="http://res.cloudinary.com/restpdf/image/upload/ufwlaqatvv3d6hbsgjl2.jpg"> -->
            </div>

          </div>

          <div class="mastfoot">
            <div class="inner">
              <p>Cover template for <a href="http://getbootstrap.com">Bootstrap</a>, by <a href="https://twitter.com/mdo">@mdo</a>.</p>
            </div>
          </div>

        </div>

      </div>

    </div>

<?php include("footer.php"); ?>
