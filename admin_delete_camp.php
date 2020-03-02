<?php
session_start();
include("config.php");
 if(!isset($_SESSION['usertype']))
 {
	 header("location:admin.php");
 }



 if(isset($_GET["id"]))
 {
 	
	 $id=$_GET["id"];
	 echo $sql="DELETE FROM camps WHERE CAMP_ID=$id";
	 $con->query($sql);
	 header("location:admin_view_camp.php?mes=Camp Details Deleted");
 }
 else
 {
	 header("location:admin_customer.php");
 }
 
?>