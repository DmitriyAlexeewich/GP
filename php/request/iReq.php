<?php
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$link = mysqli_connect("localhost", "umz_admin", "password", "umz");
	mysqli_set_charset($link,"utf8");
	$query = "SELECT DISTINCT speciality.Spec_ID FROM speciality WHERE speciality.SpecName='".$_POST["SpecName"]."'";
	$query_result = mysqli_query($link,$query);
	$row = mysqli_fetch_assoc($query_result);
	$Spec_ID = $row["Spec_ID"];
	$query_result = mysqli_query($link,$query);
    mysqli_free_result($query_result);

    $query = "SELECT DISTINCT socialstatus.Soc_ID FROM socialstatus WHERE socialstatus.SocName='".$_POST["SocName"]."'";
	$query_result = mysqli_query($link,$query);
	$row = mysqli_fetch_assoc($query_result);
	$Soc_ID = $row["Soc_ID"];
	$query_result = mysqli_query($link,$query);
    mysqli_free_result($query_result);
	$query = "INSERT INTO request(Ser, Name, Pant, PSer, PNum, SocSt, Spec, ReqDate, RAre, RStr, RHou, FAre, FStr, FHou, Mail, Phone) VALUES ('".$_POST["Ser"]."','".$_POST["Name"]."','".$_POST["Pant"]."','".$_POST["PSer"]."','".$_POST["PNum"]."','".$Soc_ID."','".$Spec_ID."','".$_POST["ReqDate"]."','".$_POST["RAre"]."','".$_POST["RStr"]."','".$_POST["RHou"]."','".$_POST["FAre"]."','".$_POST["FStr"]."','".$_POST["FHou"]."','".$_POST["Mail"]."','".$_POST["Phone"]."')";
    $query_result = mysqli_query($link,$query);
    mysqli_free_result($query_result);
    $query = "SELECT DISTINCT groups.Group_ID, groups.Spec, groups.SocSt, groups.StCount, groups.SDate FROM groups";
    $query_result = mysqli_query($link,$query);
    $flag = false;
    while ($row = mysqli_fetch_assoc($query_result)) {
    	if(($row["Spec"] == $Spec_ID)&&($row["SocSt"] == $Soc_ID)&&(date("Ymd") < str_replace("-","",$row["SDate"]))){
    		$query1 = "SELECT COUNT(*) FROM students WHERE students.Group_ID='".$row["Group_ID"]."'";
	        $query_result1 = mysqli_query($link,$query1);
	        $rst = mysqli_fetch_assoc($query_result1);
	        if((int)$row["StCount"]>(int)($rst["COUNT(*)"])){
				$query1 = "SELECT MAX(Request_ID) FROM request";
				$query_result1 = mysqli_query($link,$query1);
				$rst = mysqli_fetch_assoc($query_result1);
	        	$query = "INSERT INTO students(Request_ID, Group_ID) VALUES (".$rst["MAX(Request_ID)"].",".$row["Group_ID"].");";
				$query_result = mysqli_query($link,$query);
				$flag = true;
	        	break;
	        }
    	}
    }
    if($flag == true){

    }else{
    	
    }
    mysqli_close($link);
    //1-добавлена заявка
    //2-добавлена заявка и добавлен в группу
    //3-созданна группа
    //4-добавленн студент
    //5-группа закончила обучение
    //6-студент закончил обучение
   	exit();

?>
