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
        <div class="container" style='margin-top:70px;'>
            <div class="row">
                <div class="col-md-12">
                    <h3 class=" text-primary">
                    <i class='fa fa-users'></i> New Donor Registration
                    </h3><hr>
                    <?php  include("blood_bread.php"); ?>
                </div>
            </div>
            <div class="container">
                <?php
                
                $sql="SELECT * FROM camps";
                $result=$con->query($sql);
                if($result->num_rows>0)
                {
                $i=1;
                while($row=$result->fetch_assoc())
                {
                ?>
                <div class="card hovercard col-lg-3 col-xs-3 col-sm-6 col-md-6 col-12 m-5 ">
                    <div class="cardheader">
                        <div class="avatar text-center">
                            <img alt="" height="80%" width="80%" src="<?php echo $row['CAMP_PIC']; ?>">
                        </div>
                    </div>
                    <div class="card-body info">
                        <div class="title text-success text-center h1"><?php echo $row['TITLE']; ?></div>
                        <div class="desc"><?php echo $row['ORG_BY']; ?></div>
                        <div class="desc text-secondary">Address:<?php echo '{$row["AREA"]}, {$row["CITY"]},<br>{$row["STATE"]},{$row["PINCODE"]}<br>{$row["COUNTRY"]}'; ?></div>
                    </div>
                </div>
                <?php }
                }
                ?>
            </div>
        </div>
        <?php include("footer.php"); ?>
    </body>
</html>