<?php
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$link = mysqli_connect("localhost", "umz_admin", "password", "umz") or die ('Couldn\'t connect to MySQL');
	mysqli_set_charset($link,"utf8");
	$query = "SELECT students.Student_ID, request.Request_ID, students.Group_ID, students.Grades, request.Name, request.Ser, request.Pant, students.Stat, groups.SDate, groups.EDate, groups.Group_ID FROM students, request, groups WHERE request.Request_ID = students.Request_ID AND students.Group_ID = '".$_POST["TargetContent"]."' AND groups.Group_ID = '".$_POST["TargetContent"]."'";
	$query_result = mysqli_query($link,$query);
	$tb = "
	<form onmouseover='this.parentNode.onclick = null;' onmouseout='this.parentNode.setAttribute(`onclick`,`CloseWind(this.id)`)' class='w-70 ph3 pv3 mt1 br2 ba bg-white' action='' method='post'>
	  <div class='pb1 tc'>Журнал группы</div>
	  <p></p>
	  <div class='w-100 div_scroll'>
	    <table class='w-100 bg-white'>
	      <thead>
		      <tr>
	          <td class='w-50 tc pv1' nowrap>Студент</td>
	          <td class='w-10 tc' nowrap>Количество отсутсвий</td>
	          <td class='w-10 tc' nowrap>Статус</td>
	          <td class='w-10 tc' nowrap>Присутствие</td>";
	          if(isset($_GET["Update"])){
	          	$tb .= "<td class='w-10 tc' nowrap>Присутствие</td>";
	          }
	          $tb .="
	        </tr>
	      </thead>
	      <tbody>";
	while($row = mysqli_fetch_assoc($query_result)){
		$status = "Обучается";
		if($row["Stat"]=="1"){
			$status = "Отчислен";
			$tb.="
				<tr class='bg-light-red hover-bg-light-blue'>";
		}else{
			if((int)(str_replace("-","",$row["EDate"])) < (int)(date("Ymd"))){
	            $tb .= "<tr class='bg-light-red hover-bg-light-blue'>";
	        }else if((int)(str_replace("-","",$row["SDate"])) > (int)(date("Ymd"))){
	            $tb .= "<tr class='bg-light-pink hover-bg-light-blue'>";
	        }else{
	            $tb .= "<tr class='bg-light-green hover-bg-light-blue'>";
	        }
		}
		$tb.="
          <td class='w-50 tc pv1' nowrap>".$row["Ser"]." ".$row["Name"]." ".$row["Pant"]."</td>
          <td class='w-10 tc' nowrap>".$row["Grades"]."</td>
          <td class='w-10 tc pv1' nowrap>".$status."</td>";
	          if($row["Stat"]!="1"){
	          	$tb .= "<td class='w-10 tc' nowrap><input name='ButCls' id='_Soc0' class='w-100 ph3 pv2' type='button' value='Отсутствует' action='php/student/uStudent.php?studid=".$row["Student_ID"]."' onclick='onbuttonclick(this,event); this.disabled = true;
	          	this.parentNode.getElementsByTagName(`rd`)[1].innerHTML = parseInt(this.parentNode.getElementsByTagName(`rd`)[1].innerHTML,10)+1'></td>";
	          }else{
	          	$tb .= "<td class='w-10 tc' nowrap><input name='ButCls' class='w-100 ph3 pv2' type='button' value='Отсутствует'disabled></td>";
	          }
	          $tb .="
        </tr>";
	}
	$tb .= "
			</tbody>
	    </table>
	  </div>
	  <p></p>
	  <div class='flex justify-end'>
	    <input class='ph2 pv1' type='button' name='' value='Закрыть' onclick='CloseWind(`Group`)'>
	  </div>
	</form>";
	echo $tb;
    $query = "";    
    mysqli_free_result($query_result);
    mysqli_close($link);
?>