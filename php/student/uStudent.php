<?php
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$link = mysqli_connect("localhost", "umz_admin", "password", "umz") or die ('Couldn\'t connect to MySQL');
	mysqli_set_charset($link,"utf8");
	$query = "UPDATE students SET students.Grades=students.Grades+1 WHERE students.Student_ID='".$_GET["studid"]."'";
	echo $query;
	$query_result = mysqli_query($link,$query);
	$query = "";    
    mysqli_free_result($query_result);
    mysqli_close($link);
?>