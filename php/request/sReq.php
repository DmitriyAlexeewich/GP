<?php
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$link = mysqli_connect("localhost", "umz_admin", "password", "umz") or die ('Couldn\'t connect to MySQL');
	mysqli_set_charset($link,"utf8");
	$query = "SELECT DISTINCT request.Request_ID, request.Ser, request.Name, request.Pant, request.PSer, request.PNum, speciality.SpecName, socialstatus.SocName, request.ReqDate, request.FAre, request.FHou, request.FStr, request.RAre, request.RHou, request.RStr, request.Phone, request.Mail FROM request, socialstatus, speciality WHERE(speciality.Spec_ID = request.Spec AND socialstatus.Soc_ID = request.SocSt";
	if(isset($_GET['Soc'])){
	    $query.=" AND (request.SocSt = ".$_GET['Soc']."))";
	  }else{
	    $query.=")";
	  }
	$query_result = mysqli_query($link,$query);
	$query = "SELECT students.Request_ID FROM students";
	$query_result1 = mysqli_query($link,$query);
	$arr = array();
	while($row = mysqli_fetch_assoc($query_result1)){
		array_push($arr, $row["Request_ID"]);
	}
	$tb = " <div name='_clearned' id='_SocTypes' class='flex justify-between'>
		        <input name='ButCls' id='_Soc0' class='w-25 ph3 pv2' type='button' tablename='#content' value='Все заявки' action='php/request/sReq.php"; if(isset($_GET["Pass"])){$tb.="?Pass=1";} $tb .="' clearflag='_clearned'>
			    <input name='ButCls' id='_Soc1' class='w-25 ph3 pv2' type='button' tablename='#content' value='Безработный' action='php/request/sReq.php?Soc=1"; if(isset($_GET["Pass"])){$tb.="&Pass=1";} $tb .="' clearflag='_clearned'>
			    <input name='ButCls' id='_Soc2' class='w-25 ph3 pv2' type='button' tablename='#content' value='Декрет' action='php/request/sReq.php?Soc=2"; if(isset($_GET["Pass"])){$tb.="&Pass=1";} $tb .="' clearflag='_clearned'>
			    <input name='ButCls' id='_Soc3' class='w-25 ph3 pv2' type='button' tablename='#content' value='Инвалид' action='php/request/sReq.php?Soc=3"; if(isset($_GET["Pass"])){$tb.="&Pass=1";} $tb .="' clearflag='_clearned'>
			    <input name='ButCls' id='_Soc4' class='w-25 ph3 pv2' type='button' tablename='#content' value='Пенсионер' action='php/request/sReq.php?Soc=4"; if(isset($_GET["Pass"])){$tb.="&Pass=1";} $tb .="' clearflag='_clearned'>
			</div>

		    <form name='_clearned' id='_Request' class='w-100 ph3 pv3 mt1 br2 ba b--light-silver' method='post'>
		        <div>
		          <input class='ph2 pv1' type='button' value='Поиск' onclick='ModalBut(`_ReqSearch`)'>
		          <input name='ButCls' id='_NotifBut' class='ph2 pv1' type='button' tablename='#content' value='Сбросить' action='php/request/sReq.php' clearflag='_clearned'>
		          <input class='ph2 pv1' type='button' value='Показать обработанные заявки' onclick='ShowHideReq(false)'>
		          <input class='ph2 pv1' type='button' value='Скрыть обработанные заявки' onclick='ShowHideReq(true)'>
		        </div>
		        <p></p>
		        <div class='flex flex-column items-center'>
		          <div class='w-90 pb1 tc'>Заявки</div>
		          <table class='w-90 bg-white table_scroll'>
		            <thead>
		              <th class='w-10 pa1 tc hover-bg-light-blue'  data-type='string' onclick='onthclick(event)'>Фамилия</th>
		              <th class='w-10 pa1 tc hover-bg-light-blue'  data-type='string' onclick='onthclick(event)'>Имя</th>
		              <th class='w-10 pa1 tc hover-bg-light-blue'  data-type='string' onclick='onthclick(event)'>Отчество</th>
		              <th class='w-10 pa1 tc hover-bg-light-blue'  data-type='number' onclick='onthclick(event)'>Серия</th>
		              <th class='w-10 pa1 tc hover-bg-light-blue'  data-type='number' onclick='onthclick(event)'>Номер</th>
		              <th class='w-10 pa1 tc hover-bg-light-blue'  data-type='string' onclick='onthclick(event)' nowrap>Специальность</th>
		              <th class='w-10 pa1 tc hover-bg-light-blue'  data-type='string' onclick='onthclick(event)'>Социальный статус</th>
                  	  <th class='w-10 pa1 tc hover-bg-light-blue hover-bg-light-blue' data-type='string' onclick='onthclick(event)'>Нас. пункт</th>
		              <th class='w-10 pa1 tc hover-bg-light-blue' data-type='number' onclick='onthclick(event)'>Дата подачи</th>
		            </thead>
		            <tbody id='_MainRequestList'>";
	while($row = mysqli_fetch_assoc($query_result)){
		$dt = str_replace("-","",$row["ReqDate"]);
		if (!(in_array($row["Request_ID"], $arr))) {
			if((date("Ymd")-$dt) < "10"){
				$tb .= "<tr id='ReqId:".$row["Request_ID"]."_' class='bg-light-green hover-bg-light-blue' onclick='ClickOnReq(this)' ondblclick='OpenReqInfo(this.id)'";
			}
			if(((date("Ymd")-$dt) < "20")&&((date("Ymd")-$dt) >= 10)){
				$tb .= "<tr id='ReqId:".$row["Request_ID"]."_' class='bg-light-yellow hover-bg-light-blue' onclick='ClickOnReq(this)' ondblclick='OpenReqInfo(this.id)'";
			}
			if((date("Ymd")-$dt) >= 20){
				$tb .= "<tr id='ReqId:".$row["Request_ID"]."_' class='bg-light-red hover-bg-light-blue' onclick='ClickOnReq(this)' ondblclick='OpenReqInfo(this.id)'";	
			}
		}else{
			$tb .= "<tr id='ReqId:".$row["Request_ID"]."_' class='bg-light-pink hover-bg-light-blue' style='display:none' onclick='ClickOnReq(this)' ondblclick='OpenReqInfo(this.id)'";	
		}
		$tb .= "secattr='RAre:".$row["RAre"].",RStr:".$row["RStr"].",RHou:".$row["RHou"].",FStr:".$row["FStr"].",FHou:".$row["FHou"].",Phone:".$row["Phone"].",Mail:".$row["Mail"].",'>
				    <td class='pa1 tc'>".$row["Ser"]."</td>
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
	$tb .= "</tbody>
          </table>
        </div>
        <p></p>
        <div class='flex justify-center'>
		  <div class='pa1 bg-red'>&nbsp;</div>
		  <div class='pa1'>- срок истекает</div>
		  <div class='pa1 bg-yellow'>&nbsp;</div>
		  <div class='pa1'>- крайний срок</div>
		  <div class='pa1 bg-green'>&nbsp;</div>
		  <div class='pa1'>- доспустимый срок</div>
		  <div class='pa1 bg-pink'>&nbsp;</div>
		  <div class='pa1'>- обработанные заявки</div>
		</div>
        <p></p>
        <div class='flex justify-end'>
          <input id='_ReqOpen' class='ph2 pv1 ml1' type='button' value='Открыть' disabled='true' onclick='OpenReqInfo(null)'>";
          if(isset($_GET["Pass"])){
	          $tb .= "<input id='_ReqCreateGroupButt' class='ph2 pv1 ml1' type='button' value='Создать группу' disabled='true' onclick='CreateReqGroup(event)'>";
	      }
          $tb .= "<input type='text' name='_Filters' id='_Filters' style='visibility: hidden; position: absolute;'>
        </div>
        </form>";
      echo $tb;      
      mysqli_free_result($query_result);
      mysqli_close($link);
?>