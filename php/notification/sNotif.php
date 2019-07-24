<?php
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$link = mysqli_connect("localhost", "umz_admin", "password", "umz") or die ('Couldn\'t connect to MySQL');
	mysqli_set_charset($link,"utf8");
	$query = "SELECT Notif_ID, NotifType, Child_ID FROM notifications";
	$query_result = mysqli_query($link,$query);
	$tb="<div name='_clearned' class='w-100 ph3 pv3 mt1 br2 ba b--light-silver' method='post' style='height:85%;'>
        <div class='flex flex-column items-center'>
          <div class='w-90 pb1 tc'>Уведомления</div>
        </div>
        <div class='div_scroll h-100'>";
	while($row = mysqli_fetch_assoc($query_result)){
		$query1 = "SELECT students.Student_ID, students.Request_ID, students.Group_ID, request.Request_ID, request.Ser, request.Name, request.Pant, groups.Group_ID, groups.Ground_ID, ground.GrName, ground.Gr_ID FROM students,request, groups, ground WHERE ((students.Request_ID=request.Request_ID) AND (students.Group_ID=groups.Group_ID) AND (groups.Ground_ID = ground.Gr_ID) AND (students.Student_ID=".$row["Child_ID"]."))";
		$query_result1 = mysqli_query($link,$query1);
		$query_result1 = mysqli_fetch_assoc($query_result1);
		$tb .= "<div class='pa1 ba b--light-silver'>
            <div class='flex'>
              <div class='w-100 bg-white' style='text-align:center'>
	              Зачислен студент
	            </div>
              <input class='ph2 pv1 ph1 ml1 w-20' type='button' value='Удалить'>
            </div>
            <div name='MainWorkspase'>
	            <p></p>
	            <div class='flex items-center'>
	              <input class='ph2 pv1 ml1 w-100' type='button' name='' groupname='".$query_result1["GrName"]."' studname='".$query_result1["Ser"]." ".$query_result1["Name"]." ".$query_result1["Pant"]."' value='Посмотреть' onclick='onnotifclick(this)'>
	            </div>
	            <p></p>
	        </div>
          </div>";
	}
	$tb .="
        </div>
      </div>";
      echo $tb;
      /*
      <div class='flex justify-end mt1'>
        <input class='w-100 ph2 pv1' type='button' name='' value='Наверх'>
      </div>
      */
?>