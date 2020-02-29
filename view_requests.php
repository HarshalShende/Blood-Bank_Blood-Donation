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
                    <i class='fa fa-users'></i> View Blood Requests
                    </h3><hr>
                    <?php  include("blood_bread.php"); ?>
                </div>
            </div>
            <div class="container-fluid justify-content-center">
                <?php
                $sql="SELECT * FROM request_blood";
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
                            <img alt="" height="80%" width="80%" src="<?php echo $row['PIC']; ?>">
                        </div>
                    </div>
                    <div class="card-body info">
                        <div class="title text-primary h2 text-center">Name:<?php echo $row['Name']; ?></div>
                        <div class="title text-primary h6 text-center">Name:<?php echo $row['GENDER']; ?></div>
                        <div class="title text-primary h6 text-center">Name:<?php echo $row['BLOOD']; ?></div>
                        <div class="title text-primary h6 text-center">Name:<?php echo $row['BUNIT']; ?></div>
                        <div class="title text-primary h6 text-center">Name:<?php echo $row['HOSP']; ?></div>
                        <div class="title text-primary h6 text-center">Name:<?php echo $row['Name']; ?></div>
                        <div class="title text-primary h6 text-center">Name:<?php echo $row['CITY']; ?></div>
                        <div class="title text-primary h6 text-center">Name:<?php echo $row['DOC']; ?></div>
                        <div class="title text-primary h6 text-center">Name:<?php echo $row['RDATE']; ?></div>
                        <div class="desc  text-info h6 text-center">Contact<?php echo $row['CON1'],$row['CON2']; ?></div><br>
                        <div class="desc  text-warning h4 text-center">Address:<?php echo "<td>{$row["AREA"]}, {$row["CITY"]},<br>{$row["STATE"]},{$row["PINCODE"]}<br>{$row["COUNTRY"]}</td>"; ?></div><br>
                        <div class="desc  text-dark h4 text-center">Camp Date: <?php echo $row['CAMP_DATE']; ?></div><br>

                    </div>
                </div>
            </div>
                <?php }
                }
                ?>
            </div>

            <div class="container-fluid ">
                <?php
                
                $sql="SELECT * FROM request_blood";
                $result=$con->query($sql);
                if($result->num_rows>0)
                {
                $i=0;
                echo "<div class='table-responsive '><table class='table table-striped table-bordered'>
                    <tr class='text-primary'>
                        <th>Sno</th>
                        <th>Picture</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Blood</th>
                        <th>Blood Unit</th>
                        <th>Hospital</th>
                        <th>Address</th>
                        <th>Doctor</th>
                        <th>Required Date</th>
                        <th>Contact Person</th>
                        <th>Contact Address</th>
                        <!--<th>Email</th>-->
                        <th>Contact No</th>
                        <th>Reason</th>
                        
                    </tr>
                    ";
                    
                    while($row=$result->fetch_assoc())
                    {
                    $i++;
                    echo"<tr>";
                        echo"<td>$i</td>";
                        echo"<td><img src='{$row["PIC"]}' class='don_img' height='50px' width='50px'></td>";
                        echo"<td>{$row["NAME"]}</td>";
                        echo"<td>{$row["GENDER"]}</td>";
                        echo"<td>{$row["BLOOD"]}</td>";
                        echo"<td>{$row["BUNIT"]}</td>";
                        echo"<td>{$row["HOSP"]}</td>";
                        echo"<td>{$row["CITY"]}<br>{$row["PIN"]}</td>";
                        echo"<td>{$row["DOC"]}</td>";
                        echo"<td>{$row["RDATE"]}</td>";
                        echo"<td>{$row["CNAME"]}</td>";
                        echo"<td>{$row["CADDRESS"]}</td>";
                        // echo"<td>{$row["EMAIL"]}</td>";
                        echo"<td>{$row["CON1"]}<br>{$row["CON2"]}</td>";
                        echo"<td>{$row["REASON"]}</td>";
                    echo"</tr>";
                    }
                echo "</table></div>";
                }
                
                
                else if($i==0)
                {
                
                echo "<div class='alert alert-danger'><i class='fa fa-users'></i> Our Donors already donated</div>";
                }
                else
                {
                echo "<div class='alert alert-danger'><i class='fa fa-users'></i> No Donors Found</div>";
                }
                
                
                ?>
            </div>

        </div>



        <div class="container-fluid" style="">
            <?php include("footer.php"); ?>
        </div>
    </body>
</html>