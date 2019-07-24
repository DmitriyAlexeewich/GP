<?php
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$link = mysqli_connect("localhost", "umz_admin", "password", "umz");
	mysqli_set_charset($link,"utf8");
	$query = "SELECT DISTINCT request.Request_ID, request.Ser, request.Name, request.Pant, request.PSer, request.PNum, speciality.SpecName, socialstatus.SocName, request.ReqDate, request.FAre FROM request, socialstatus, speciality WHERE(speciality.Spec_ID = request.Spec AND socialstatus.Soc_ID = request.SocSt);";
	$query_result = mysqli_query($link,$query);
	$tb = "";
	while($row = mysqli_fetch_assoc($query_result)){
		$dt = str_replace("-","",$row["ReqDate"]);
		if((date("Ymd")-$dt) < 10){
			$tb .= "<tr id='ReqId:".$row["Request_ID"]."_' class='bg-light-green hover-bg-light-blue' onclick='ClickOnReq(this)'>";
		}
		if(((date("Ymd")-$dt) < 20)&&((date("Ymd")-$dt) >= 10)){
			$tb .= "<tr id='ReqId:".$row["Request_ID"]."_' class='bg-light-yellow hover-bg-light-blue' onclick='ClickOnReq(this)'>";
		}
		if((date("Ymd")-$dt) >= 20){
			$tb .= "<tr id='ReqId:".$row["Request_ID"]."_' class='bg-light-red hover-bg-light-blue' onclick='ClickOnReq(this)'>";	
		}
		$tb .= "      <td class='pa1 tc'>".$row["Ser"]."</td>
	                <td class='pa1 tc'>".$row["Name"]."</td>
	                <td class='pa1 tc'>".$row["Pant"]."</td>
	                <td class='pa1 tc'>".$row["PSer"]."</td>
	                <td class='pa1 tc'>".$row["PNum"]."</td>
	                <td class='pa1 tc'>".$row["SpecName"]."</td>
	                <td class='pa1 tc'>".$row["SocName"]."</td>
                  <td class='pa1 tc'>".$row["FAre"]."</td>
	                <td class='pa1 tc'>".$row["ReqDate"]."</td>
              </tr>";
	}
	$tb .= "";
	/*
			<tr class='bg-light-red hover-bg-black-10'>
                  <td class='w-80 tc'>Барабаш Валентин Вареникович</td>
                  <td class='w-10 tc'>
                    <input type='button' value='Открыть' >
                  </td>
                  <td class='w-10'>
                    <input class='w-100' type='button'  value='x'>
                  </td>
            </tr>
			*/
    echo $tb;
?>