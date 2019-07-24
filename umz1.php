<?php
	$tb = "
<!DOCTYPE html>
	<html style='overflow:hidden;'>
    	<head>
    		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
    		<link rel='stylesheet' href='css/tachyons_min.css'>
    		<link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
    		<link rel='stylesheet' href='css/custom.css'>
    		<title>УМЦ</title>
    	</head>
    	<body>
    		<div class='w-100 ph4 pv4 bb b--light-silver'>
        		<div class='flex justify-end'>
          			<div class='flex flex-column justify-center ph3'>
            			<div class='tc pv1'>";

    $tb .= "</div>
            			<div class='f6 tc'>Оператор УМЦ</div>
          			</div>
          			<input class='ph2 pv1' type='button' name='' value='Выйти'>
        		</div>
    		</div>
    		<div class='flex justify-between' style='height:89%;'>
        		<div id='sidenav' class='w-15 flex flex-column br b--light-silver' style='justify-content:start;'>
          			<div id='_ReqBut' class='pv4 ph1 tc hover' tablename='#content' action='php/request/sReq.php' clearflag='_clearned' onclick='ClickOnSideMenuElem(this)'>
            			<div class=''>
              				<i class='material-icons' style='color:#357EDD;font-size:40px'>person_add</i>
            			</div>
            			Заявки
          			</div>
          			<div id='_TeachBut' class='pv4 ph1 tc hover' tablename='#content' action='php/group/sGroup.php' clearflag='_clearned' onclick='ClickOnSideMenuElem(this)'>
            		<div class=''>
              			<i class='material-icons' style='color:#357EDD;font-size:40px'>group</i>
            		</div>
            		Группы
        		</div>
        		<div id='_StudBut' class='pv4 ph1 tc hover' tablename='#content' action='php/student/sStudent.php' clearflag='_clearned' onclick='ClickOnSideMenuElem(this)'>
            		<div class=''>
            			<i class='material-icons' style='color:#357EDD;font-size:40px'>school</i>
            		</div>
            		Студенты
        		</div>
        		<div id='_NotifBut' class='pb4 tc hover' tablename='#content' action='php/notification/sNotif.php' clearflag='_clearned' onclick='ClickOnSideMenuElem(this)'>
            		<div class="" style='position:relative;'>
              			<div class='pa1 mb1 br2 bg-light-blue'>Новых:111</div>
              			<i class='material-icons w-100' style='color:#357EDD;font-size:40px'>notification_important</i>
            		</div>
            		Уведомления
        		</div>
        	</div>
      		<div id='content' class='w-100 ph3 pv2'>                  
        		<div name='modalwind' id='_ReqSearch' class='flex items-center justify-center modal' style='visibility:hidden;'>
          			<form id='_ReqSearchForm' class='w-60 ph3 pv3 mt1 br2 ba bg-white' action='php/request/sSReq.php' method='post' tablename='#content' clearflag='_clearned'>
            			<div class='pb1 tc'>Поиск заявки</div>
            			<hr align='center' width='60%' size='1' color='#757575' />
			    <div class=''>
				    <input autocomplete='off' class='w-30 ph2 pv1 mr2' type='text' name='Ser' value='' placeholder='Фамилия' oninput='ChangeClass(this);'>
				    <input autocomplete='off' class='w-30 ph2 pv1' type='text' name='Name' value='' placeholder='Имя' oninput='ChangeClass(this);'>
				    <input autocomplete='off' class='w-30 ph2 pv1 ml2' type='text' name='Pant' value='' placeholder='Отчество' oninput='ChangeClass(this);'>
				</div>
				<p></p>
				<div class=''>
				    <input autocomplete='off' class='w-30 ph2 pv1 mr2' list='social_status' type='text' name='SocName' value='' placeholder='Соц. статус' oninput='ChangeClass(this);'>
					<input autocomplete='off' class='w-30 ph2 pv1 mr2' list='speciality' type='text' name='SpecName' value='' placeholder='Специальность' oninput='ChangeClass(this);'>
					<input autocomplete='off' class='w-25 ph2 pv1 ml3' type='date' name='ReqDate' value='".date("Y")."-".date("m")."-".date("d")."' readonly>	        
				</div>
				<p></p>
				<div class=''>
				    <input autocomplete='off' class='w-30 ph2 pv1 mr2' type='text' name='PSer' value='' placeholder='Пасп. серия' oninput='ChangeClass(this);' onkeyup='return ChekSymb(this)'  maxlength='4'>
				    <input autocomplete='off' class='w-30 ph2 pv1 mr2' type='text' name='PNum' value='' placeholder='Пасп. номер' oninput='ChangeClass(this); 'onkeyup='return ChekSymb(this)' maxlength='6'>
				</div>
				<p></p>
				<div class='tc'>Адрес регистрации</div>
				<hr align='center' width='60%' size='1' color='#757575' />
				<div class='flex justify-around'>
				    <div class='w-33 flex justify-between ba b--light-silver'>
				        <input autocomplete='off' onchange='CheckStreet(this,`adr_1_area`,`adr_1_street`)' class='w-90 ph2 pv1 bw0' list='adr_1_area' type='text' name='RAre' value='' placeholder='Район' oninput='ChangeClass(this);'>
				        <div class='w-10 pt1 tc' style='transform:rotate(90deg);' noselect>></div>
				        <div class='w-10 pv1 tc' noselect onclick='ClearKladr(this,`adr_1_street`)'>x</div>
					</div>
					<div class='w-33 flex justify-between ba b--light-silver'>
					    <input autocomplete='off' onchange='CheckStreet(this,`adr_1_street`,`adr_1_house`)' class='w-90 ph2 pv1 bw0' list='adr_1_street' type='text' name='RStr' value='' placeholder='Улица, проспект' oninput='ChangeClass(this);'>
					    <div class='w-10 pt1 tc' style='transform:rotate(90deg);' noselect>></div>
					    <div class='w-10 pv1 tc' noselect onclick='ClearKladr(this,`adr_1_house`)'>x</div>
					</div>
					<div class='w-33 flex justify-between ba b--light-silver'>
					    <input autocomplete='off' class='w-90 ph2 pv1 bw0' list='adr_1_house' type='text' name='RHou' value='' placeholder='Дом / корпус' oninput='ChangeClass(this);'>
					    <div class='w-10 pt1 tc' style='transform:rotate(90deg);' noselect>></div>
					    <div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
					</div>
				</div>
				<p></p>
				<div class='tc'>
					<text>Адрес проживания</text>
					<hr align='center' width='60%' size='1' color='#757575' />
					<input class='ph2 pv1 ml1' type='button' name='' value='Совпадает с адресом регистрации' onclick='CopareAddr()'>
				</div>
				<p></p>
				<div class='flex justify-around'>
				    <div class='w-33 flex justify-between ba b--light-silver'>
				    	<input autocomplete='off' onchange='CheckStreet(this,`adr_1_area`,`adr_1_street`)' class='w-90 ph2 pv1 bw0' list='adr_1_area' type='text' name='FAre' value='' placeholder='Район' oninput='ChangeClass(this);'>
				    	<div class='w-10 pt1 tc' style='transform:rotate(90deg);' noselect>></div>
				    	<div class='w-10 pv1 tc' noselect onclick='ClearKladr(this,`adr_1_street`)'>x</div>
					</div>
					<div class='w-33 flex justify-between ba b--light-silver'>
					    <input autocomplete='off' onchange='CheckStreet(this,`adr_1_street`,`adr_1_house`)' class='w-90 ph2 pv1 bw0' list='adr_1_street' type='text' name='FStr' value='' placeholder='Улица, проспект' oninput='ChangeClass(this);'>
					    <div class='w-10 pt1 tc' style='transform:rotate(90deg);' noselect>></div>
					    <div class='w-10 pv1 tc' noselect onclick='ClearKladr(this,`adr_1_house`)'>x</div>
					</div>
					<div class='w-33 flex justify-between ba b--light-silver'>
					    <input autocomplete='off' class='w-90 ph2 pv1 bw0' list='adr_1_house' type='text' name='FHou' value='' placeholder='Дом / корпус' oninput='ChangeClass(this);'>
					    <div class='w-10 pt1 tc' style='transform:rotate(90deg);' noselect>></div>
					    <div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
					</div>
				</div>
				<p></p>
				<div class='tc'>Контактные данные</div>
				<hr align='center' width='60%' size='1' color='#757575' />
				<div class=''>
				    <input autocomplete='off' class='w-30 ph2 pv1 mr2' type='text' name='Mail' value='' placeholder='Адрес эл. почты' oninput='ChangeClass(this);'>
					<input autocomplete='off' class='w-30 ph2 pv1 mr2' type='text' name='Phone' value='+7(___)___-____' placeholder='Номер моб. телефона'  oninput='ChangeClass(this); mask(event);'>
				</div><hr align='center' width='60%' size='1' color='#757575' />
			    <div class=''>
				    <input autocomplete='off' class='w-30 ph2 pv1 mr2' type='text' name='Ser' value='' placeholder='Фамилия' oninput='ChangeClass(this);'>
				    <input autocomplete='off' class='w-30 ph2 pv1' type='text' name='Name' value='' placeholder='Имя' oninput='ChangeClass(this);'>
				    <input autocomplete='off' class='w-30 ph2 pv1 ml2' type='text' name='Pant' value='' placeholder='Отчество' oninput='ChangeClass(this);'>
				</div>
				<p></p>
				<div class=''>
				    <input autocomplete='off' class='w-30 ph2 pv1 mr2' list='social_status' type='text' name='SocName' value='' placeholder='Соц. статус' oninput='ChangeClass(this);'>
					<input autocomplete='off' class='w-30 ph2 pv1 mr2' list='speciality' type='text' name='SpecName' value='' placeholder='Специальность' oninput='ChangeClass(this);'>
					<input autocomplete='off' class='w-25 ph2 pv1 ml3' type='date' name='ReqDate' value=''>	        
				</div>
				<p></p>
				<div class=''>
				    <input autocomplete='off' class='w-30 ph2 pv1 mr2' type='text' name='PSer' value='' placeholder='Пасп. серия' oninput='ChangeClass(this);' onkeyup='return ChekSymb(this)'  maxlength='4'>
				    <input autocomplete='off' class='w-30 ph2 pv1 mr2' type='text' name='PNum' value='' placeholder='Пасп. номер' oninput='ChangeClass(this); 'onkeyup='return ChekSymb(this)' maxlength='6'>
				</div>
				<p></p>
				<div class='tc'>Адрес регистрации</div>
				<hr align='center' width='60%' size='1' color='#757575' />
				<div class='flex justify-around'>
				    <div class='w-33 flex justify-between ba b--light-silver'>
				        <input autocomplete='off' onchange='CheckStreet(this,`adr_1_area`,`adr_1_street`)' class='w-90 ph2 pv1 bw0' list='adr_1_area' type='text' name='RAre' value='' placeholder='Район' oninput='ChangeClass(this);'>
				        <div class='w-10 pt1 tc' style='transform:rotate(90deg);' noselect>></div>
				        <div class='w-10 pv1 tc' noselect onclick='ClearKladr(this,`adr_1_street`)'>x</div>
					</div>
					<div class='w-33 flex justify-between ba b--light-silver'>
					    <input autocomplete='off' onchange='CheckStreet(this,`adr_1_street`,`adr_1_house`)' class='w-90 ph2 pv1 bw0' list='adr_1_street' type='text' name='RStr' value='' placeholder='Улица, проспект' oninput='ChangeClass(this);'>
					    <div class='w-10 pt1 tc' style='transform:rotate(90deg);' noselect>></div>
					    <div class='w-10 pv1 tc' noselect onclick='ClearKladr(this,`adr_1_house`)'>x</div>
					</div>
					<div class='w-33 flex justify-between ba b--light-silver'>
					    <input autocomplete='off' class='w-90 ph2 pv1 bw0' list='adr_1_house' type='text' name='RHou' value='' placeholder='Дом / корпус' oninput='ChangeClass(this);'>
					    <div class='w-10 pt1 tc' style='transform:rotate(90deg);' noselect>></div>
					    <div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
					</div>
				</div>
				<p></p>
				<div class='tc'>
					<text>Адрес проживания</text>
					<hr align='center' width='60%' size='1' color='#757575' />
					<input class='ph2 pv1 ml1' type='button' name='' value='Совпадает с адресом регистрации' onclick='CopareAddr()'>
				</div>
				<p></p>
				<div class='flex justify-around'>
				    <div class='w-33 flex justify-between ba b--light-silver'>
				    	<input autocomplete='off' onchange='CheckStreet(this,`adr_1_area`,`adr_1_street`)' class='w-90 ph2 pv1 bw0' list='adr_1_area' type='text' name='FAre' value='' placeholder='Район' oninput='ChangeClass(this);'>
				    	<div class='w-10 pt1 tc' style='transform:rotate(90deg);' noselect>></div>
				    	<div class='w-10 pv1 tc' noselect onclick='ClearKladr(this,`adr_1_street`)'>x</div>
					</div>
					<div class='w-33 flex justify-between ba b--light-silver'>
					    <input autocomplete='off' onchange='CheckStreet(this,`adr_1_street`,`adr_1_house`)' class='w-90 ph2 pv1 bw0' list='adr_1_street' type='text' name='FStr' value='' placeholder='Улица, проспект' oninput='ChangeClass(this);'>
					    <div class='w-10 pt1 tc' style='transform:rotate(90deg);' noselect>></div>
					    <div class='w-10 pv1 tc' noselect onclick='ClearKladr(this,`adr_1_house`)'>x</div>
					</div>
					<div class='w-33 flex justify-between ba b--light-silver'>
					    <input autocomplete='off' class='w-90 ph2 pv1 bw0' list='adr_1_house' type='text' name='FHou' value='' placeholder='Дом / корпус' oninput='ChangeClass(this);'>
					    <div class='w-10 pt1 tc' style='transform:rotate(90deg);' noselect>></div>
					    <div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
					</div>
				</div>
				<p></p>
				<div class='tc'>Контактные данные</div>
				<hr align='center' width='60%' size='1' color='#757575' />
				<div class=''>
				    <input autocomplete='off' class='w-30 ph2 pv1 mr2' type='text' name='Mail' value='' placeholder='Адрес эл. почты' oninput='ChangeClass(this);'>
					<input autocomplete='off' class='w-30 ph2 pv1 mr2' type='text' name='Phone' value='+7(___)___-____' placeholder='Номер моб. телефона'  oninput='ChangeClass(this); mask(event);'>
				</div>";
?>