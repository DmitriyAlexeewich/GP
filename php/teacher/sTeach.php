<?php
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$link = mysqli_connect("localhost", "umz_admin", "password", "umz") or die ('Couldn\'t connect to MySQL');
	mysqli_set_charset($link,"utf8");
	$query = "SELECT * FROM speciality";
	$query_result = mysqli_query($link,$query);
	$AllSpecNames = array();
	while($row = mysqli_fetch_assoc($query_result)){
		array_push($AllSpecNames, $row);
	}
	$query = "SELECT * FROM groups WHERE Ground_ID='".$_GET['groundid']."'";
	$query_result = mysqli_query($link,$query);
	$AllGroups = array();
	while($row = mysqli_fetch_assoc($query_result)){
		array_push($AllGroups, $row);
	}
	$query = "SELECT * FROM users WHERE users.OrgType > 0";
	$query_result = mysqli_query($link,$query);
	$td = "<div name='_clearned'  class='w-100 ph3 pv3 mt1 br2 ba b--light-silver' method='post'>
			  <div class='flex flex-column items-center'>
			    <div class='w-90 pb1 tc'>Преподаватели</div>
			    <table class='w-90 bg-white table_scroll'>
			      <thead>
			        <th class='w-10 pa1 tc'>Фамилия</th>
			        <th class='w-10 pa1 tc'>Имя</th>
			        <th class='w-10 pa1 tc'>Отчество</th>
			        <th class='w-10 pa1 tc'>Специальность</th>
			        <th class='w-10 pa1 tc'></th>
			      </thead>
			      <tbody>";
	while($row = mysqli_fetch_assoc($query_result)){
		if(!(strpos($row["OrgType"],"4")===false)){
			if((int)($row["Stat"])==0){
				$td .= "<tr class='bg-washed-green hover-bg-light-blue'>";
			}else if((int)($row["Stat"])==1){
				$td .= "<tr class='bg-light-red hover-bg-light-blue'>";
			}
			$td .= "<td class='pa1 tc'>".$row["Name"]."</td>";
			$td .= "<td class='pa1 tc'>".$row["Ser"]."</td>";
			$td .= "<td class='pa1 tc'>".$row["Pant"]."</td>";
			$specid = substr($row["OrgType"], 1);
			for($i=0; $i<count($AllSpecNames); $i++){
				if($AllSpecNames[$i]["Spec_ID"]==$specid){
					$td .= "<td class='pa1 tc'>".$AllSpecNames[$i]["SpecName"]."</td>";
					break;
				}
			}
			if((int)($row["Stat"])==0){
				$td .= "
				<td class='pa1 tc w-20'>
				    <form name='_AddGroupToTeacher' class='flex justify-between ba b--light-silver'>
				        <input class='w-100 ph2 pv1 bw0' list='All_groups' type='text' name='' value='' placeholder='Группы'>
				        <div class='w-20 pv1 tc bg-white' noselect>x</div>
				      	<input class='ph2 pv1 ml1' type='button' name='' value='Назначить' TargetContent='".$row["User_ID"]."' onclick='onbuttonclick(this,event)' tablename='#content' action='php/teacher/uGroup.php' clearflag='_clearned'>
				    </form>
				</td>
			</tr>";
			}else if((int)($row["Stat"])==1){
				$td .= "
				<td class='pa1 tc w-20'>
				    <div class='flex justify-between ba b--light-silver'>
				        <input disabled class='w-100 ph2 pv1 bw0' type='text' name='' value='Группа №";
				for($i=0; $i<count($AllGroups); $i++){
					if($AllGroups[$i]["TeacherID"]==$row["User_ID"]){
						$td .= $AllGroups[$i]["Group_ID"];
					}
				}
				$td.="
				        ' placeholder=''>
				    </div>
				</td>
			</tr>";
			}
		}
	}
	$td .= "</tbody>
	    </table>
	  </div>
	  <p></p>
	  <div class='flex justify-end'>
	    <input class='ph2 pv1 ml1' type='button' name='' value='Добавить преподавателя' onclick='OpenCreateTeach()'>
	  </div>
	  <datalist id='All_groups'>";
	for($i=0; $i<count($AllGroups); $i++){
		if($AllGroups[$i]["TeacherID"]=="0"){
			$td .= $AllGroups[$i]["Group_ID"];
		}
	}
	$td.="</datalist>
	</div>";
	echo $td;
	mysqli_free_result($query_result);
    mysqli_close($link);
?>