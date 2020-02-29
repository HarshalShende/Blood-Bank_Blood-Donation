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
                    <i class='fa fa-users'></i> View Blood Donation Camps
                    </h3><hr>
                    <?php  include("blood_bread.php"); ?>
                </div>
            </div>
            <div class="container-fluid">
                <?php
                
                $sql="SELECT * FROM camps";
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
                            <img alt="" height="80%" width="80%" src="<?php echo $row['CAMP_PIC']; ?>">
                        </div>
                    </div>
                    <div class="card-body info">
                        <div class="title text-primary h2 text-center">Title:<?php echo $row['TITLE']; ?></div>
                        <div class="desc  text-info h3 text-center">Organized By: <?php echo $row['ORG_BY']; ?></div><br>
                        <div class="desc  text-warning h4 text-center">Address:<?php echo "<td>{$row["AREA"]}, {$row["CITY"]},<br>{$row["STATE"]},{$row["PINCODE"]}<br>{$row["COUNTRY"]}</td>"; ?></div><br>
                        <div class="desc  text-dark h4 text-center">Camp Date: <?php echo $row['CAMP_DATE']; ?></div><br>

                    </div>
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