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
<div class="container"  style='margin-top:70px'>
	<div class="row">
		<div class="col-sm-3">
			<?php include("admin_side_nav.php");?>
		</div>
		<div class="col-sm-9" >
			<h3 class='text-primary'><i class="fa fa-users"></i> Donor Details </h3><hr>    
		<div class="row">
		<?php 
		if(isset($_GET["id"]))
		{
			$sql="SELECT * FROM camps WHERE CAMP_ID=".$_GET["id"];
			$result=$con->query($sql);
			if($result->num_rows>0)
			{
				$row=$result->fetch_assoc();
				
		?>
		<div class="col-md-4">
					<div class="panel">
					<div class="panel-body">
					<img src="<?php echo $row["CAMP_PIC"];?>" class="image-rounded" height="300px" width="100%">
			</div>
			</div>
			
		</div>
		<div class="col-md-8">
		<table class="table table-striped">
			<tr>
				<th>TITLE</th>
				<td><?php echo $row["TITLE"];?></td>
			</tr>
			<tr>
				<th>ORGANIZED BY</th>
				<td><?php echo $row["ORG_BY"];?></td>
			</tr>
			<tr>
				<th>COUNTRY</th>
				<td><?php echo $row["COUNTRY"];?></td>
			</tr>
			<tr>
				<th>STATE</th>
				<td><?php echo $row["STATE"];?></td>
			</tr>
			<tr>
				<th>Blood Group</th>
				<td><?php echo $row["CITY"];?></td>
			</tr>
			<tr>
				<th>AREA</th>
				<td><?php echo $row["AREA"];?></td>
			</tr>
			<tr>
				<th>PINCODE</th>
				<td><?php echo $row["PINCODE"];?></td>
			</tr>
			<tr>
				<th>DETAILS</th>
				<td><?php echo $row["DETAILS"];?></td>
			</tr>
			
			<tr>
				<th>CAMP DATE</th>
				<td><?php echo $row["CAMP_DATE"];?></td>
			</tr>

			<tr>
				<?php echo "<td><a  href='admin_delete_camp.php?id=".$row['CAMP_ID']."' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i> Delete</a> </td>"; ?>
			</tr>
			
		</table>
		</div>
	
		
		<?php
			}
		}	
		else
		{
		echo "<script>window.open('admin_donor.php','_self');</script>";
		}

		?>	


		<form class="col-md-6" method="post" action="update_last.php">
			<div class="form-group">
				<label class="control-label text-primary" for="ldata">Last Donate Date</label>
				<input type="text"  placeholder="YYYY/MM/DD" required id="ldata" name="ldata"  class="form-control input-sm DATES">
			</div>
			<input type="hidden" name="id" value="<?php echo $_GET["id"];?>">
			<button class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>
						
		</form>
			
		</div>
		</div>
	</div>
</div>
  
  
	 <?php include("admin_footer.php"); ?>
  <script>
  </script>

	</body>
</html>