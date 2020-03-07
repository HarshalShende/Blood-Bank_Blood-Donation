<?php include"config.php";?>
<!DOCTYPE html>
<html lang="en">
    <?php include"head.php";?>
    <body>
        <?php
        include"top_nav.php";
        ?>
        
        <!-- Page Content -->
        <div class="container" style="margin-top:20px;">
            <!-- Page Heading/Breadcrumbs -->
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="page-header  text-primary">Gallery
                    </h1>
                    <ol class="breadcrumb">
                        <li> <a  href='' class='btn btn-danger' data-toggle='modal' data-target='#modalContactForm'><i class='fa fa-image'></i> Upload Image</a></li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            <!-- Intro Content -->
            <div class="modal fade" id="modalContactForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h4 class="modal-title w-100 font-weight-bold">Add Image TO Gallery</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body mx-3">
                            <div class="row centered-form ">
                                <div class="col-xs-12 col-lg-12 col-sm-12 col-md-12 ">
                                    <div class="panel panel-primary">
                                        
                                        <div class="panel-body">
                                            <form method="post" action="gallery.php" autocomplete="off" role="form" enctype="multipart/form-data">
                                              <div class="form-group">
                                                    <label class="control-label text-primary" for="TITLE" >Camp Title</label>
                                                    <input type="text" placeholder="Camp Title" id="TITLE" name="TITLE"  required class="form-control input-sm" >
                                                </div>
                                                 <!--
                                                <div class="form-group">
                                                    <label class="control-label text-primary" for="DETAILS">DETAILS</label>
                                                    <textarea required name="DETAILS" id="DETAILS" rows="5" style="resize:none;"class="form-control" placeholder="Full Description"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label text-primary" for="CAMP_DATE">Camp Date</label>
                                                    <input type="text"  name="CAMP_DATE" value="0000/00/00" id="CAMP_DATE" placeholder="YYYY/MM/DD" class="form-control input-sm DATES">
                                                </div> -->
                                                <div class="form-group">
                                                    <label class="control-label text-success" for="fileToUpload" >Upload Photo</label>
                                                    <input type="file" class="form-control"  name="fileToUpload">
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-primary" type="submit" name="submit" >Upload</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <?php
                
                $sql="SELECT * FROM gallery";
                $result=$con->query($sql);
                if($result->num_rows>0)
                {
                $i=1;
                while($row=$result->fetch_assoc())
                {
                ?>
                <div class="col-lg-4 col-sm-6 col-md-6 col-6 py-2">
                <div class="card hovercard h-100 " style="margin-top: 5rem; ">
                    <div class="cardheader border-warning">
                        <div class="avatar text-center">
                            <img alt="" height="200px" width="200px" src="<?php echo $row['image_name']; ?>">
                        </div>
                    </div>
                    <div class="card-body info">
                        <div class="title text-primary h2 text-center">Title:<?php echo $row['TITLE']; ?></div>
                    </div>
                </div>
            </div>
                <?php }
                }
                ?>
            </div>
            <?php
            if(isset($_POST["submit"]))
                                {
                        $target_dir = "test_upload/";
                        $img="test_upload/noimage.jpg";
                        $target_file = $target_dir.rand(100,999). basename($_FILES["fileToUpload"]["name"]);
                        $uploadOk = 1;
                        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                        // Check if image file is a actual image or fake image
                        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                        if($check !== false) {
                        echo "";
                        $uploadOk = 1;
                        } else {
                        //  echo "File is not an image.";
                        $uploadOk = 0;
                        }
                        // Check if file already exists
                        if (file_exists($target_file)) {
                        // echo "Sorry, file already exists.";
                        $uploadOk = 0;
                        }
                        // Check file size
                        if ($_FILES["fileToUpload"]["size"] > 5000000000) {
                        // echo "Sorry, your file is too large.";
                        $uploadOk = 0;
                        }
                        // Allow certain file formats
                        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                        && $imageFileType != "gif" ) {
                        // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        $uploadOk = 0;
                        }
                        // Check if $uploadOk is set to 0 by an error
                        if ($uploadOk == 0) {
                        // echo "Sorry, your file was not uploaded.";
                        // if everything is ok, try to upload file
                        } else {
                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        $img=$target_file;
                        } else {
                        //   echo "Sorry, there was an error uploading your file.";
                        }
                        }

                        $sql="insert into gallery(title,image_name) values('{$_POST["TITLE"]}','$img')";
                                if($con->query($sql))
                                    {
                                        echo '
                                        <div class="alert alert-success">
                                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                                <strong>Success!</strong> Image Added To Gallery
                                        </div>
                                        ';
                                    }
                    }
            ?>
            <!-- /.row -->
            <hr>
            <?php include"footer.php"; ?>
        </div>
        <!-- /.container -->
        <!-- jQuery -->
        <script src="js/jquery.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>
        
    </body>
</html>