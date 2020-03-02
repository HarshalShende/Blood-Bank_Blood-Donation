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
										<th>Camp Date</th>
										<th>Edit</th>
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
										echo"<td>{$row["CAMP_DATE"]}</td>";
										echo"<td class='text-center'>
													<a  href='' class='btn btn-danger btn-xs hidden' data-toggle='modal' data-target='#modalContactForm'><i class='fa fa-trash'></i> Edit</a>
													<a href='admin_camp_detail.php?id=".$row['CAMP_ID']."' class='btn btn-primary btn-xs'><i class='fa fa-edit'></i> View</a>
													<a  href='admin_delete_camp.php?id=".$row['CAMP_ID']."' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i> Delete</a>
											</td>";
								echo"</tr>";
								}
						echo "</table></div>";
						}
						
						
						else if($i==0)
						{
						
						echo "<div class='alert alert-danger'><i class='fa fa-users'></i> No Camps Found</div>";
						}
						else
						{
						echo "<div class='alert alert-danger'><i class='fa fa-users'></i> No Camps Found</div>";
						}
						
						
						?>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="modalContactForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
			aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header text-center">
						<h4 class="modal-title w-100 font-weight-bold">Update Camp Details</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body mx-3">
											<div class="row centered-form ">
						<div class="col-xs-12 col-lg-12 col-sm-12 col-md-12 ">
							<div class="panel panel-primary">
						
								<div class="panel-body">
									<form method="post" action="admin_add_camps.php" autocomplete="off" role="form" enctype="multipart/form-data">
										<div class="form-group">
											<label class="control-label text-primary" for="TITLE" >Camp Title</label>
											<input type="text" placeholder="Camp Title" id="TITLE" name="TITLE"  required class="form-control input-sm" >
										</div>
										<div class="form-group">
											<label class="control-label text-primary" for="ORG_BY">Organized By</label>
											<input type="text" placeholder="Organized By" id="ORG_BY" name="ORG_BY" required class="form-control input-sm">
										</div>
										<div class="form-group">
											<label class="control-label text-primary" for="COUNTRY">Country</label>
											<select name="COUNTRY" id="COUNTRY" required class="form-control">
												<option value="">Select Country</option>
												<?php
													$sql="SELECT COUNTRY_ID,COUNTRY_NAME FROM country ORDER BY COUNTRY_NAME ASC";
													$result=$con->query($sql);
													if($result->num_rows>0)
													{
														while($row=$result->fetch_assoc())
														{
																						echo "<option value='{$row['COUNTRY_ID']}'>{$row['COUNTRY_NAME']}	</option>";
														}
													}
												?>
											</select>
										</div>
										<div class="form-group">
											<label class="control-label text-primary" for="STATE">State</label>
											<select name="STATE" id="STATE" required class="form-control">
												<option value="" ">Select State</option>
												<?php
													$sql="SELECT STATE_ID,STATE_NAME FROM state ORDER BY STATE_NAME ASC";
													$result=$con->query($sql);
													if($result->num_rows>0)
													{
														while($row=$result->fetch_assoc())
														{
																						echo "<option value='{$row['STATE_ID']}'>{$row['STATE_NAME']}	</option>";
														}
													}
													
												?>
											</select>
										</div>
										<div class="form-group">
											<label class="control-label text-primary" for="CITY" >City</label>
											<select name="CITY" id="CITY" required class="form-control">
												<option value="">Select City</option>
												<?php
												
													$sql="SELECT CITY_NAME,CITY_ID FROM city ORDER BY CITY_NAME";
													$result=$con->query($sql);
													if($result->num_rows>0)
													{
														while($row=$result->fetch_assoc())
														{
																					echo "<option value='{$row['CITY_ID']}'>{$row['CITY_NAME']}	</option>";
														}
													}
													
												?>
											</select>
										</div>
										<div class="form-group">
											<label class="control-label text-primary" for="AREA" >Area</label>
											<input type="text" required name="AREA" id="AREA" class="form-control" placeholder="Insert Area">
										</div>
										<div class="form-group">
											<label class="control-label text-primary" for="PINCODE">Pincode</label>
											<input type="text" required name="PINCODE" id="PINCODE" class="form-control" placeholder="Insert Pincode">
										</div>
										<div class="form-group">
											<label class="control-label text-primary" for="DETAILS">DETAILS</label>
											<textarea required name="DETAILS" id="DETAILS" rows="5" style="resize:none;"class="form-control" placeholder="Full Description"></textarea>
										</div>
										<div class="form-group">
											<label class="control-label text-primary" for="CAMP_DATE">Camp Date</label>
											<input type="text"  name="CAMP_DATE" value="0000/00/00" id="CAMP_DATE" placeholder="YYYY/MM/DD" class="form-control input-sm DATES">
										</div>
										<div class="form-group">
											<label class="control-label text-success" for="fileToUpload" >Upload Photo</label>
											<input type="file" class="form-control"  name="fileToUpload">
										</div>
										<div class="form-group">
											<button class="btn btn-primary" type="submit" name="submit" >Submit</button>
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

		<div class="container-fluid" style="">
			<?php include("admin_footer.php"); ?>
		</div>
	</body>
</html>