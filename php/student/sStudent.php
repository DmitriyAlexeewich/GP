<?php
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$link = mysqli_connect("localhost", "umz_admin", "password", "umz");
	mysqli_set_charset($link,"utf8");
	$query = "SELECT DISTINCT students.Group_ID, request.Ser, request.Name, request.Pant, request.PSer, request.PNum, speciality.SpecName, request.ReqDate, request.Phone, groups.SDate, groups.EDate, request.ReqDate, request.RAre, request.RStr, request.RHou, request.FAre, request.FStr, request.FHou, request.Mail, socialstatus.SocName, ground.Gr_ID, ground.GrName, groups.Ground_ID  FROM students, speciality, request, groups, socialstatus, ground  WHERE ((students.Request_ID=request.Request_ID) AND (request.Spec=speciality.Spec_ID) AND (groups.Group_ID = students.Group_ID) AND (request.SocSt = socialstatus.Soc_ID) AND (groups.Ground_ID = ground.Gr_ID)";
  if(isset($_GET['Soc'])){
    $query.=" AND (request.SocSt = ".$_GET['Soc']."))";
  }else{
    $query.=")";
  }
	$query_result = mysqli_query($link,$query);
	$tb = "
	<div name='_clearned' id='_SocTypes' class='flex justify-between'>
	  <input name='ButCls' id='_Soc5' class='w-25 ph3 pv2' type='button' tablename='#content' value='Все студенты' action='php/student/sStudent.php' clearflag='_clearned'>
		<input name='ButCls' id='_Soc6' class='w-25 ph3 pv2' type='button' tablename='#content' value='Безработный' action='php/student/sStudent.php?Soc=1' clearflag='_clearned'>
		<input name='ButCls' id='_Soc7' class='w-25 ph3 pv2' type='button' tablename='#content' value='Декрет' action='php/student/sStudent.php?Soc=2' clearflag='_clearned'>
		<input name='ButCls' id='_Soc8' class='w-25 ph3 pv2' type='button' tablename='#content' value='Инвалид' action='php/student/sStudent.php?Soc=3' clearflag='_clearned'>
		<input name='ButCls' id='_Soc9' class='w-25 ph3 pv2' type='button' tablename='#content' value='Пенсионер' action='php/student/sStudent.php?Soc=4' clearflag='_clearned'>
	</div>
	<form id='_Students' name='_clearned' class='w-100 ph3 pv3 mt1 br2 ba b--light-silver' method='post' style=''>
        <div>
          <input class='ph2 pv1' type='button'  value='Поиск' onclick='ModalBut(`_StudSearch`)'>
          <input class='ph2 pv1' type='button'  value='Сбросить'>
        </div>
        <p></p>
        <div class='pb1 tc'>Студенты</div>
        <p></p>
        <div class='flex justify-center w-100'>
        <table class='bg-white w-90 table_scroll'>
          <thead>
            <th class='w-10 pa1 tc' nowrap>Группа</th>
            <th class='w-10 pa1 tc' nowrap>Фамилия</th>
            <th class='w-10 pa1 tc' nowrap>Имя</th>
            <th class='w-10 pa1 tc' nowrap>Отчество</th>
            <th class='w-10 pa1 tc'>Серия</th>
            <th class='w-10 pa1 tc'>Номер</th>
            <th class='w-10 pa1 tc' nowrap>Специальность</th>
            <th class='w-10 pa1 tc'>Площадка</th>
            <th class='w-10 pa1 tc'>Дата подачи</th>
            <th class='w-10 pa1 tc'>Номер телефона</th>
          </thead>
          <tbody>";
    while($row = mysqli_fetch_assoc($query_result)){
      $dt = str_replace("-","",$row["SDate"]);
      if(((int)(date("Ymd")-$dt)) > 0){
      	$dt = str_replace("-","",$row["EDate"]);
	      if(((int)(date("Ymd")-$dt)) < 0){
	        $tb .= "<tr class='bg-light-green hover-bg-light-blue' onclick='ClickOnStudent(this)' ondblclick='OpenStudInfo(this)'";
	      }else{
	        $tb .= "<tr class='bg-light-red hover-bg-light-blue' onclick='ClickOnStudent(this)' ondblclick='OpenStudInfo(this)'";
	      }
	  }else{
	  	$tb .= "<tr class='bg-light-pink hover-bg-light-blue' onclick='ClickOnStudent(this)' ondblclick='OpenStudInfo(this)'";
	  }
      $tb .= "secattr='RAre:".$row["RAre"].",RStr:".$row["RStr"].",RHou:".$row["RHou"].",FAre:".$row["FAre"].",FStr:".$row["FStr"].",FHou:".$row["FHou"].",Phone:".$row["SocName"].",Mail:".$row["Mail"].",'>";
            $tb.="<td class='pa1 tc'>".$row["Group_ID"]."</td>";
            $tb.="<td class='pa1 tc'>".$row["Ser"]."</td>";
            $tb.="<td class='pa1 tc'>".$row["Name"]."</td>";
            $tb.="<td class='pa1 tc'>".$row["Pant"]."</td>";
            $tb.="<td class='pa1 tc'>".$row["PSer"]."</td>";
            $tb.="<td class='pa1 tc'>".$row["PNum"]."</td>";
            $tb.="<td class='pa1 tc'>".$row["SpecName"]."</td>";          
            $tb.="<td class='pa1 tc'>".$row["GrName"]."</td>";
            $tb.="<td class='pa1 tc'>".$row["ReqDate"]."</td>";
            $tb.="<td class='pa1 tc'>".$row["Phone"]."</td>
            </tr>";
    }
    $tb .="</tbody>
        </table>
        </div>
        <p></p>
        <div class='flex justify-center'>
        	<div class='pa1 bg-light-pink'>&nbsp;</div>
          <div class='pa1'>
            - ожидает обучения
          </div>
          <div class='pa1 bg-green'>&nbsp;</div>
          <div class='pa1'>
            - в процессе обучения
          </div>
          <div class='pa1 bg-red'>&nbsp;</div>
          <div class='pa1'>
            - закончил обучение
          </div>
        </div>
        <div class='flex justify-end'>
          <input id='OpenStud' class='ph2 pv1 ml1' type='button'  value='Открыть' disabled='true' onclick='OpenStudInfo(this)'>
        </div>
      </form>";
    echo $tb;      
    mysqli_free_result($query_result);
    mysqli_close($link);
?>