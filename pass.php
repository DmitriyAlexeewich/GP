<?php
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$link = mysqli_connect("localhost", "umz_admin", "password", "umz");
	mysqli_set_charset($link,"utf8");
	$query = "SELECT users.Login, users.Pass, users.Name, users.Ser, users.Pant, users.OrgType, users.GroundID FROM users WHERE ((users.Login = '".$_POST["Login"]."') AND (users.Pass = '".$_POST["Pass"]."'))";
	$query_result = mysqli_query($link,$query);
	$row = mysqli_fetch_assoc($query_result);
	if(count($row)==0){
		mysqli_free_result($query_result);
    	mysqli_close($link);
		header ('Location: login.html');
   		exit();
	}else{
		switch ($row["OrgType"]) {
	    //umz
	    case "1":
	        /*$tb = "";
				echo $tb;*/
	        include ('umz.php');
			mysqli_free_result($query_result);
	    	mysqli_close($link);
   			exit();
	        break;	
	        break;
	    //bt    
	    case "2":
	    	include ('bt.php');
			mysqli_free_result($query_result);
	    	mysqli_close($link);
   			exit();
	        break;
	    case "3":
		    mysqli_free_result($query_result);
	    	mysqli_close($link);
	        header ('Location: login.html');
   			exit();
	        break;
		}
	}
?>