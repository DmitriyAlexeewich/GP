<?php
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$link = mysqli_connect("localhost", "umz_admin", "password", "umz") or die ('Couldn\'t connect to MySQL');
	mysqli_set_charset($link,"utf8");
	$query = "SELECT * FROM speciality";
	$query_result = mysqli_query($link,$query);
	$SpecId="";
	while($row = mysqli_fetch_assoc($query_result)){
		if($row["SpecName"]==$_POST["Spec"]){
			$SpecId = $row["Spec_ID"];
		}
	}
	$query = "INSERT INTO users(Login, Pass, Name, Ser, Pant, OrgType, Stat, GroundID) VALUES ('".$_POST["Login"]."','".$_POST["Pass"]."','".$_POST["Name"]."','".$_POST["Ser"]."','".$_POST["Pant"]."','4".$SpecId."','0','".$_GET["GroundID"]."')";
	$query_result = mysqli_query($link,$query);
	include "sTeach.php";
	mysqli_free_result($query_result);
    mysqli_close($link);
?>