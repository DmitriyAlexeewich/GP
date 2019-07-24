<?php
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$link = mysqli_connect("localhost", "umz_admin", "password", "umz") or die ('Couldn\'t connect to MySQL');
	mysqli_set_charset($link,"utf8");
	$query="UPDATE groups SET groups.EDate=".date("Ymd")." WHERE groups.Group_ID='".$_POST["TargetContent"]."'";
	$query_result = mysqli_query($link,$query);
	
	include "sGroup.php";
?>