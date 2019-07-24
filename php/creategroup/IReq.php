<?php
	$t = "";
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$link = mysqli_connect("localhost", "umz_admin", "password", "umz");
	mysqli_set_charset($link,"utf8");
	$query = "SELECT Gr_ID FROM ground WHERE (GrName='".$_POST["_GroundName"]."');";
	$query_result = mysqli_query($link,$query);
	$row = mysqli_fetch_assoc($query_result);
	$GroundID = $row["Gr_ID"];

	$query = "SELECT Spec_ID FROM speciality WHERE (SpecName='".$_POST["_SpecNameInp"]."');";
	$query_result = mysqli_query($link,$query);
	$row = mysqli_fetch_assoc($query_result);
	$SpecID = $row["Spec_ID"];

	$query = "SELECT Soc_ID FROM socialstatus WHERE (SocName='".$_POST["_SocStInp"]."');";
	$query_result = mysqli_query($link,$query);
	$row = mysqli_fetch_assoc($query_result);
	$SocID = $row["Soc_ID"];
	$query = "SELECT FPSer_ID FROM formatpublicservice WHERE (FPSerName='".$_POST["_FPSer"]."');";
	$query_result = mysqli_query($link,$query);
	$row = mysqli_fetch_assoc($query_result);
	$FPSerID = $row["FPSer_ID"];

	$query = "SELECT TPSer_ID FROM typepublicservice WHERE (TPSerName='".$_POST["_TPSer"]."');";
	$query_result = mysqli_query($link,$query);
	$row = mysqli_fetch_assoc($query_result);
	$TPSerID = $row["TPSer_ID"];
	$query = "INSERT INTO groups(Ground_ID, Spec, SocSt, TPSer, FPSer, StCount, HouCount, CDate, SDate, EDate) VALUES (".$GroundID.",".$SpecID.",".$SocID.",".$TPSerID.",".$FPSerID.",".$_POST["_GroupCount"].",".$_POST["_Hours"].",'".$_POST["_CDate"]."','".$_POST["_SDate"]."','".$_POST["_EDate"]."');";
	$query_result = mysqli_query($link,$query);

	$query = "SELECT * FROM groups WHERE Group_ID=(SELECT MAX(Group_ID) FROM groups);";
	$query_result = mysqli_query($link,$query);
	$row = mysqli_fetch_assoc($query_result);
	$Group_ID = $row["Group_ID"];

	for($i=0; $i<strlen($_POST["requsts_list"]); $i++){
		if($_POST["requsts_list"][$i] == "_"){
			$query = "INSERT INTO students(Request_ID, Group_ID) VALUES (".$t.",".$Group_ID.");";
			$query_result = mysqli_query($link,$query);
			$t="";
		}
		if(ctype_digit($_POST["requsts_list"][$i])){
			$t .= $_POST["requsts_list"][$i];
		}
	}
	//echo $t;
?>