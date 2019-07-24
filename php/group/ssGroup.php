<?php
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$link = mysqli_connect("localhost", "umz_admin", "password", "umz");
	mysqli_set_charset($link,"utf8");
	$query = "SELECT DISTINCT groups.Group_ID, ground.GrName, speciality.SpecName, groups.HouCount, groups.StCount, groups.SDate, groups.EDate, groups.CDate, typepublicservice.TPSerName, formatpublicservice.FPSerName FROM groups, typepublicservice, speciality, ground, formatpublicservice WHERE ((ground.Gr_ID=groups.Ground_ID) AND (speciality.Spec_ID=groups.Spec) AND (typepublicservice.TPSer_ID = groups.TPSer) AND (formatpublicservice.FPSer_ID = groups.TPSer)";
	if(1<strlen($_POST["GrName"])){
		$query .= " AND ground.GrName = '".$_POST["GrName"]."'";
	}
	if(1<strlen($_POST["SpecName"])){
		$query .= " AND speciality.SpecName = '".$_POST["SpecName"]."'";
	}
	if(1<strlen($_POST["TPSerName"])){
		$query .= " AND typepublicservice.TPSerName = '".$_POST["TPSerName"]."'";
	}
	if(1<strlen($_POST["Group_ID"])){
		$query .= " AND groups.Group_ID = '".$_POST["Group_ID"]."'";
	}
	if(1<strlen($_POST["StCount"])){
		$query .= " AND groups.StCount = '".$_POST["StCount"]."'";
	}
	if(1<strlen($_POST["FPSerName"])){
		$query .= " AND formatpublicservice.FPSerName = '".$_POST["FPSerName"]."'";
	}
	if(1<strlen($_POST["HouCount"])){
		$query .= " AND groups.HouCount = '".$_POST["HouCount"]."'";
	}
	if(1<strlen($_POST["CDate"])){
		$query .= " AND groups.CDate = '".$_POST["CDate"]."'";
	}
	if(1<strlen($_POST["SDate"])){
		$query .= " AND groups.SDate = '".$_POST["SDate"]."'";
	}
	if(1<strlen($_POST["EDate"])){
		$query .= " AND groups.EDate = '".$_POST["EDate"]."'";
	}
	if(isset($_GET['groundid'])){
        $query .= "AND (groups.Ground_ID = '".$_GET['groundid']."')";
    }
    if(isset($_GET["TeacherID"])){
        $query .= " AND (groups.TeacherID = '".$_GET['TeacherID']."')";
    }
    if(isset($_GET["Filter"])){
        switch ($_GET["Filter"]) {
            case "0":
                $query .= " AND ((".date("Ymd").") BETWEEN groups.CDate AND groups.SDate)";
                break;
            case "1":
                $query .= " AND ((".date("Ymd").") BETWEEN groups.SDate AND groups.EDate)";
                break;
            case "2":
                $query .= " AND ((".date("Ymd").") > groups.EDate)";
            default:
                break;
        }
    }
    $query.= ");";
	$query_result = mysqli_query($link,$query);
	$tb = "
    <div name='_clearned' class='flex justify-between'>
        <input name='ButCls' id='_Soc0' class='w-25 ph3 pv2' type='button' tablename='#content' value='Все группы' action='php/group/sGroup.php";
        if(isset($_GET['groundid'])){
            $tb .= "?groundid=".$_GET['groundid'];
        }
        if(isset($_GET["TeacherID"])){
            $tb .= "?TeacherID=".$_GET['TeacherID'];
        }
        $tb .= "' clearflag='_clearned'>
        <input name='ButCls' id='_Soc0' class='w-25 ph3 pv2' type='button' tablename='#content' value='Ожидает обучение' action='php/group/sGroup.php?Filter=0";
        if(isset($_GET['groundid'])){
            $tb .= "&groundid=".$_GET['groundid'];
        }
        if(isset($_GET["TeacherID"])){
            $tb .= "&TeacherID=".$_GET['TeacherID'];
        }
        $tb .= "' clearflag='_clearned'>
        <input name='ButCls' id='_Soc0' class='w-25 ph3 pv2' type='button' tablename='#content' value='На обучении' action='php/group/sGroup.php?Filter=1";
        if(isset($_GET['groundid'])){
            $tb .= "&groundid=".$_GET['groundid'];
        }
        if(isset($_GET["TeacherID"])){
            $tb .= "&TeacherID=".$_GET['TeacherID'];
        }
        $tb .= "' clearflag='_clearned'>
        <input name='ButCls' id='_Soc0' class='w-25 ph3 pv2' type='button' tablename='#content' value='Завершившие обучение' action='php/group/sGroup.php?Filter=2";
        if(isset($_GET['groundid'])){
            $tb .= "&groundid=".$_GET['groundid'];
        }
        if(isset($_GET["TeacherID"])){
            $tb .= "&TeacherID=".$_GET['TeacherID'];
        }
        $tb .= 
    "' clearflag='_clearned'>
    </div>
	<form id='_Teach' name='_clearned' class='w-100 ph3 pv3 mt1 br2 ba b--light-silver' method='post'>
        <div>
          <input class='ph2 pv1' type='button'  value='Поиск' onclick='ModalBut(`_GroupSearch`)'>
          <input class='ph2 pv1' type='button'  value='Сбросить'>
        </div>
        <p></p>
        <div class='pb1 tc'>Группы</div>
        <table class='bg-white w-100 table_scroll' id='teachtable'>
        <thead>
                <th class='w-10 pa1 tc'>№</th>
                <th class='w-10 pa1 tc'>Площадка</th>
                <th class='w-10 pa1 tc' nowrap>Специальность</th>
                <th class='w-10 pa1 tc'>Кол-во часов</th>
                <th class='w-10 pa1 tc'>Кол-во студентов</th>
                <th class='w-10 pa1 tc'>Макс. кол-во студентов</th>
                <th class='w-10 pa1 tc'>Вид гос. услуги</th>
                <th class='w-10 pa1 tc'>Форма оказания услуги</th>
                <th class='w-10 pa1 tc'>Дата создания</th>
                <th class='w-10 pa1 tc'>Период обучения</th>
            </thead>
        <tbody>";
    while($row = mysqli_fetch_assoc($query_result)){
        $query1 = "SELECT COUNT(*) FROM students WHERE students.Group_ID='".$row["Group_ID"]."'";
        $query_result1 = mysqli_query($link,$query1);
        $rst = mysqli_fetch_assoc($query_result1);
    	if((int)(str_replace("-","",$row["EDate"])) < (int)(date("Ymd"))){
            $tb .= "<tr class='bg-light-red hover-bg-light-blue' onclick='ClickOnGroup(this)' TargetContent=".$row["Group_ID"]." ondblclick='onbuttonclick(this,event); ModalBut(`Group`);' tablename='#Group' action='php/group/sStudByGroup.php' clearflag='1'>";
        }else if((int)(str_replace("-","",$row["SDate"])) > (int)(date("Ymd"))){
            $tb .= "<tr class='bg-light-pink hover-bg-light-blue' onclick='ClickOnGroup(this)' TargetContent=".$row["Group_ID"]." ondblclick='onbuttonclick(this,event); ModalBut(`Group`);' tablename='#Group' action='php/group/sStudByGroup.php' clearflag='1'>";
        }else{
            $tb .= "<tr class='bg-light-green hover-bg-light-blue' onclick='ClickOnGroup(this)' TargetContent=".$row["Group_ID"]." ondblclick='onbuttonclick(this,event); ModalBut(`Group`);' tablename='#Group' action='php/group/sStudByGroup.php' clearflag='1'>";
        }
        $tb .= "<td class='pa1 tc'>".$row["Group_ID"]."</td>";
        $tb .= "<td class='pa1 tc'>".$row["GrName"]."</td>";
        $tb .= "<td class='pa1 tc'>".$row["SpecName"]."</td>";
        $tb .= "<td class='pa1 tc'>".$row["HouCount"]."</td>";
        $tb .= "<td class='pa1 tc'>".$rst["COUNT(*)"]."</td>";
        $tb .= "<td class='pa1 tc'>".$row["StCount"]."</td>";
        $tb .= "<td class='pa1 tc'>".$row["TPSerName"]."</td>";
        $tb .= "<td class='pa1 tc'>".$row["FPSerName"]."</td>";     
        $tb .= "<td class='pa1 tc'>".$row["CDate"]."</td>";
        $tb .= "<td class='pa1 tc'>".$row["SDate"]."<br>".$row["EDate"]."</td>";
    	$tb .= "</tr>";
    }
    $tb.="</tbody>
        </table>
        <p></p>
        <div class='flex justify-end'>
          <input class='ph2 pv1 ml1' type='button' value='Открыть' name='_GroupButts' TargetContent='' onclick='onbuttonclick(this,event); ModalBut(`Group`);' tablename='#Group' action='php/group/sStudByGroup.php";
        if(isset($_GET['groundid'])){
            $tb .= "?groundid=".$_GET['groundid'];
        }
        if(isset($_GET["TeacherID"])){
            $tb .= "?TeacherID=".$_GET['TeacherID'];
        }
        $tb .= 
    "' clearflag='1' disabled>";/*
          <input class='ph2 pv1 ml1' type='button' name='' value='Просмотреть журнал группы' name='_GroupButts' TargetContent='' onclick='onbuttonclick(this,event)' tablename='#content' action='php/teacher/uGroup.php' clearflag='_clearned'>";*/
    if(isset($_GET["TeacherID"])){
        $tb.="
          <input class='ph2 pv1 ml1' type='button' value='Начать занятие' name='_GroupButts' TargetContent='' onclick='onbuttonclick(this,event); ModalBut(`Group`);' tablename='#Group' action='php/group/sStudByGroup.php?Update=1";
        if(isset($_GET['groundid'])){
            $tb .= "?groundid=".$_GET['groundid'];
        }
        if(isset($_GET["TeacherID"])){
            $tb .= "?TeacherID=".$_GET['TeacherID'];
        }
        $tb .= 
    "' clearflag='1' disabled>";
        $tb.="
              <input class='ph2 pv1 ml1' type='button' value='Закончить обучение' name='_GroupButts' TargetContent='' onclick='onbuttonclick(this,event)' tablename='#content' action='php/group/eGroup.php?TeacherID=".$_GET['TeacherID']."' clearflag='_clearned'";
            if(isset($_GET['groundid'])){
                $tb .= "?groundid=".$_GET['groundid'];
            }
            if(isset($_GET["TeacherID"])){
                $tb .= "?TeacherID=".$_GET['TeacherID'];
            }
            $tb .= 
    "' clearflag='1' disabled>";
    }
    $tb.="
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
    $query = "";    
    mysqli_free_result($query_result);
    mysqli_close($link);
?>