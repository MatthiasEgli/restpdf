<?php include("header.php"); ?>

  <body>

    <div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container">

          <div class="masthead clearfix">
            <div class="inner">
              <h3 class="masthead-brand">Cover</h3>
              <nav>
                <ul class="nav masthead-nav">
                  <li class="active"><a href="#">Home</a></li>
                  <li><a href="#">Features</a></li>
                  <li><a href="#">Contact</a></li>
                </ul>
              </nav>
            </div>
          </div>

          <div class="inner cover">
            <h1 class="cover-heading">Step 1: Upload Your PDF</h1>
            <?php
                if ($uploadOk = 1) {
                    $image_file = '/' . $target_dir . $_FILES["fileToUpload"]["name"];
                    echo '<img src="' . $image_file . '" />';
                }
            ?>
            <a href="/mark.php?img=<?php echo urlencode($image_file) ?>">Begin Marking Up</a>
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