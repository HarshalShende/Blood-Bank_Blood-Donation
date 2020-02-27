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
					<h3 class="text-primary"><i class="fa fa-home"></i> Camps </h3><hr>

					<?php
					if(isset($_POST["submit"]))
								{
						$target_dir = "camp_image/";
						$img="camp_image/noimage.jpg";
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
						$country="";
						$state="";
						$qry="SELECT COUNTRY_NAME FROM country WHERE COUNTRY_ID={$_POST["COUNTRY"]}";
						$res=$con->query($qry);
						if($res->num_rows>0)
						{
						if($row=$res->fetch_assoc())
						{
						$country=$row["COUNTRY_NAME"];
						}
						}
						$qry="SELECT STATE_NAME FROM state WHERE STATE_ID={$_POST["STATE"]}";
						$res=$con->query($qry);
						if($res->num_rows>0)
						{
						if($row=$res->fetch_assoc())
						{
						$state=$row["STATE_NAME"];
						}
						}
						$cityname=$_POST["CITY"];
						$sql="
						INSERT INTO camps
						(TITLE, ORG_BY, COUNTRY, STATE, CITY, AREA, PINCODE, DETAILS, CAMP_PIC, CAMP_DATE)
						VALUES
						('{$_POST["TITLE"]}', '{$_POST["ORG_BY"]}', '{$country}', '{$state}', '$cityname', '{$_POST["AREA"]}', '{$_POST["PINCODE"]}', '{$_POST["DETAILS"]}', '{$img}', '{$_POST["CAMP_DATE"]}');";
								if($con->query($sql))
									{
										echo '
										<div class="alert alert-success">
																<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
																<strong>Success!</strong> Camp Details Submitted.
										</div>
										';
									}
							}
				?>
					<div class="row centered-form ">
						<div class="col-xs-12 col-lg-8 col-sm-8 col-md-6 col-lg-offset-2 col-sm-offset-2 col-md-offset-3">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h3 class="panel-title text-center" style="padding:5px;font-size:16px;font-weight:bold"><span class="fa fa-user "> </span> Add Blood Donation Camps</h3>
								</div>
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
				</div></div></div>
				
				<?php include("admin_footer.php"); ?>
				<script>
				$(document).ready(
				function(){
						
						
						// $("#CITY").change(function(){
							// 	var city=$("#CITY").val();
							// 	//alert(city);
							// 	$.post('functions.php',{G_CITY_ID:city},function(data){
													// 						//	alert(data);
								// 		$("#STATE").html(data);
							// 	});
							
						// });
						
						
						$("#COUNTRY").change(function(){
							var countr=$("#COUNTRY").val();
							//alert(city);
							$.post('get_state.php',{G_STATE_ID:countr},function(data){
													//	alert(data);
								$("#STATE").html(data);
							});
							
						});
						
							$("#STATE").change(function(){
							var stid=$("#STATE").val();
							//alert(city);
							$.post('get_city.php',{G_STATE_ID:stid},function(data){
													//	alert(data);
								$("#CITY").html(data);
							});
							
						});
					
						
							
				});
				
				
				$(function() {
				var availableTags = [
				<?php
					$sql="SELECT AREA_NAME FROM area";
											$result=$con->query($sql);
											
											if($result->num_rows>0)
											{
												$i=0;
												$n=$result->num_rows;
												while($row=$result->fetch_assoc())
												{
													$i++;
													if($n!=$i)
													{
														echo '"'.$row['AREA_NAME'].'",';
													}
													else
													{
														echo '"'.$row['AREA_NAME'].'"';
													}
												}
												
											}
					
					
				?>
				];
				$( "#AREA" ).autocomplete({
				source: availableTags
				});
				});
				
				</script>
			</body>
		</html>