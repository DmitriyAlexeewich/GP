<?php
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$link = mysqli_connect("localhost", "umz_admin", "password", "umz") or die ('Couldn\'t connect to MySQL');
	mysqli_set_charset($link,"utf8");
	$query = "UPDATE groups SET groups.TeacherID='".$_POST["TargetContent"]."' WHERE groups.Group_ID='".$_POST["Target"]."'";
	$query_result = mysqli_query($link,$query);
	$query = "UPDATE users SET Stat=1 WHERE User_ID='".$_POST["TargetContent"]."'";
	$query_result = mysqli_query($link,$query);
	$query = "SELECT Student_ID, Group_ID FROM students WHERE students.Group_ID = '".$_POST["Target"]."'";
	$query_result = mysqli_query($link,$query);
	while($row = mysqli_fetch_assoc($query_result)){
		$query1 = "INSERT INTO notifications(NotifType, Child_ID) VALUES (1,".$row["Student_ID"].")";
		$query_result1 = mysqli_query($link,$query1);
	}
    mysqli_close($link);
?>