<?php
session_start();
include("config.php");
if(!isset($_SESSION['usertype']))
{
	header("location:admin.php");
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include("admin_head.php");?>
	</head>
	<body>
		<?php include("admin_topnav.php"); ?>
		<div class="container"  style='margin-top:70px;'>
			<div class="row">
				<div class="col-sm-3">
					<?php include("admin_side_nav.php");?>
				</div>
				
				<div class="col-sm-9" >
					<h3 class="text-primary"><i class="fa fa-home"></i> View Camp </h3><hr>
					<div class="container-fluid ">
						<?php
						
						$sql="SELECT * FROM camps";
						$result=$con->query($sql);
						if($result->num_rows>0)
						{
						$i=0;
						echo "<div class='table-responsive '><table class='table table-striped table-bordered'>
							<tr class='text-primary'>
								<th>Sno</th>
								<th>Picture</th>
								<th>Title</th>
								<th>Organized By</th>
								<th>Address</th>
								<th>Details</th>
							</tr>
							";
							
							while($row=$result->fetch_assoc())
							{
							$i++;
							echo"<tr>";
								echo"<td>$i</td>";
								echo"<td><img src='{$row["CAMP_PIC"]}' class='don_img' height='100px' width='100px'></td>";
								echo"<td>{$row["TITLE"]}</td>";
								echo"<td>{$row["ORG_BY"]}</td>";
								echo"<td>{$row["AREA"]}, {$row["CITY"]},<br>{$row["STATE"]},{$row["PINCODE"]}<br>{$row["COUNTRY"]}</td>";
								echo"<td>{$row["DETAILS"]}</td>";
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
			</div>
		</div>
		<div class="container-fluid" style="">
			<?php include("admin_footer.php"); ?>
		</div>
	</body>
</html>