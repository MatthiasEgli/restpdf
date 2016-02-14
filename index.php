<?php include("header.php"); 
?>

  <body>

    <div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container">

          <div class="inner cover">
            <h1 class="cover-heading">RESTpdf</h1>
            <p class="lead" id="stepone">Welcome to RESTpdf. Let's get started. Either drag your PDF into your browser window, or click the button to select the file from your computer.</p>
            <p class="lead hidden" id="steptwo">Your PDF is now ready for you to mark up. Click "Create A New Text Field", give it a name, add it to your PDF, and then position it. When done adding all fields, click submit.</p>
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

            <!-- <div id="progressbar" class="progress_bar"><div class="progress-label">Loading...</div></div> -->
            <div class="progress_bar"></div>
            <div class="load-successful"></div>

            <div class="markup-buttons hidden">
              <button class="btn btn-lg btn-primary" id="add-text" onclick="showForm()">
                <i class="glyphicon glyphicon-plus"></i>
                <span>Create New Text Field</span>
              </button>
              <button class="btn btn-lg btn-success" id="submit-pdf">
                <i class="glyphicon glyphicon-ok"></i>
                <span>Submit</span>
              </button>
            </div>

            <div class="create-text-field input-group input-group-lg hidden">
              <input class="form-control" id="field-name" type="text" name="fieldname" placeholder="Input Field Name">
              <span class="input-group-btn">
                <button onclick="appendText()" class="btn btn-default" type="button">Add Field to PDF</button>
              </span>
            </div>

            <div class="image-display">
              <div id="image-overlay">
              </div>
              <!-- REmove before going live -->
              <!-- <img src="http://res.cloudinary.com/restpdf/image/upload/ufwlaqatvv3d6hbsgjl2.jpg"> -->
            </div>

            <div id="results">
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
