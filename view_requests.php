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