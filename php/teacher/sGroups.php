<?php
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$link = mysqli_connect("localhost", "umz_admin", "password", "umz") or die ('Couldn\'t connect to MySQL');
	mysqli_set_charset($link,"utf8");
	$query = "SELECT DISTINCT groups.Group_ID, ground.GrName, speciality.SpecName, groups.HouCount, groups.StCount, groups.SDate, groups.EDate, groups.CDate, typepublicservice.TPSerName, formatpublicservice.FPSerName, groups.TeacherID FROM groups, typepublicservice, speciality, ground, formatpublicservice WHERE ((ground.Gr_ID=groups.Ground_ID) AND (speciality.Spec_ID=groups.Spec) AND (typepublicservice.TPSer_ID = groups.TPSer) AND (formatpublicservice.FPSer_ID = groups.TPSer) AND (groups.TeacherID = '".$_GET['TeacherID']."')";
	if(isset($_GET["Filter"])){
		switch ($_GET["Filter"]) {
		    case "0":
		        $query .= " AND ((".date("Ymd").") BETWEEN groups.SDate AND groups.EDate)";
		        break;
		    case "1":
		        echo "i равно 1";
		        break;
		    case "2":
		        echo "i равно 2";
		    default:
		        echo "i равно 2";
		        break;
		}
	}
	$query .= ")";
	$query_result = mysqli_query($link,$query);
	$tb = "<div name='_clearned' class='flex justify-between'>
			  <input class='w-33 ph3 pv2' type='button' name='' value='Все группы'>
			  <input class='w-33 ph3 pv2' type='button' name='' value='Ожидает обучение'>
			  <input class='w-33 ph3 pv2' type='button' name='' value='На обучении'>
			  <input class='w-33 ph3 pv2' type='button' name='' value='Завершившие обучение'>
			</div>
			<form name='_clearned' class='w-100 ph3 mh1 pv3 mt1 br2 ba b--light-silver' method='post' style=''>
			  <div class='flex flex-column justify-center'>
			    <div class='pb1 tc'>Группы</div>
			    <table class='bg-white w-100 table_scroll'>
			      <thead>
			        <th class='w-10 pa1 tc'>№</th>
			      </thead>
			      <tbody>";
	while ($row = mysqli_fetch_assoc($query_result)) {
		if((int)($row["EDate"]) < date("Ymd")){
			$tb .= "<tr class='bg-light-red hover-bg-light-blue'>";
		}else if($row["SDate"] > date("Ymd")){
			$tb .= "<tr class='bg-light-pink hover-bg-light-blue'>";
		}else{
			$tb .= "<tr class='bg-light-green hover-bg-light-blue'>";
		}
		$tb .= "<td class='pa1 tc'>".$row["Group_ID"]."</td>";
		$tb .= "</tr>";
	}
	$tb.="</tbody>
	    </table>
	    <p></p>
	    <div class='flex justify-end'>
	      <input class='ph2 pv1' type='button' name='' value='Открыть'>
	      <input class='ph2 pv1 ml1' type='button' name='' value='Завершить обучение'>
	      <input class='ph2 pv1 ml1' type='button' name='' value='Просмотреть журнал группы'>
	    </div>
	  </div>
	  <p></p>
	  <div class='flex justify-center'>
	    <div class='pa1 bg-red'>&nbsp;</div>
	    <div class='pa1'>- завершил обучение</div>
	    <div class='pa1 bg-green'>&nbsp;</div>
	    <div class='pa1'>- обучается</div>
	    <div class='pa1 bg-light-pink'>&nbsp;</div>
	    <div class='pa1'>- ожидает обучения</div>
	  </div>
	</form>";
	echo $tb;
	mysqli_free_result($query_result);
    mysqli_close($link);
?>