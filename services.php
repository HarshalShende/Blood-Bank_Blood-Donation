<?php 
include("config.php"); 
//include("functions.php"); 

error_reporting(0);?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("head.php");?>
</head>
<body>

<?php
include("top_nav.php");
?>
    <div class="container-fluid" style='margin-top:20px;'>
        <div class="row">
            <div class="col-md-12 text-center">
                <h3 class=" text-primary">
					<i class='fa fa-briefcase'></i> Services
                </h3><hr>
						<?php  include("blood_bread_services.php"); ?>

            </div>
        </div>


     </div>

		<?php include("footer.php"); ?>
     </body>
</html>