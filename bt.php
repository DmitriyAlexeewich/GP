<?php
	$tb = "
<html style='overflow:hidden;'>
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
		<link rel='stylesheet' href='css/tachyons_min.css'>
		<link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
		<link rel='stylesheet' href='css/custom.css'>
		<title>БТ</title>
	</head>
	<body onload='loadwind(`loadwind`)'>
		    <div id='NotifMess' class='w-3 pv2 ph1 bg-white ba br2 ml1 mt2' style='position:absolute;top:0;left:0;visibility:hidden;'>
		    	<div class='flex justify-end bb items-baseline'>
					<div class='tc mr2'>Создана заявка</div>
		    		<input type='button' value='Закрыть' onclick='document.getElementById(`NotifMess`).style.visibility = `hidden`'>
		    	</div>
				<div class='tc pv1'>Иванов Иван Иванович</div>
			</div>
		<div id='loadwind' class='flex items-center justify-center modal' style='position:flexible; visibility:visible'>
			<div class='flex flex-column ph3 pv3 mt1 br2 ba bg-white items-center' style='width: 500px;'>
				<img src='img/load.gif' alt='Загрузка...' width='50px' height='50px'>
				<div class='flex flex-column items-center'>Пожалуйста, подождите окончания загрузки.</div>
			</div>
		</div>
		<div class='w-100 ph4 pv4 bb b--light-silver'>
		    <div class='flex justify-end'>
			    <div class='flex flex-column justify-center ph3'>
				    <div class='tc pv1'>".$row["Ser"]." ".$row["Name"]." ".$row["Pant"]."</div>
				    <div class='f6 tc'>Оператор БТ, ";
	$query = "SELECT * FROM kladr WHERE kladr.CODE = '".$row["GroundID"]."'";
	$query_result = mysqli_query($link,$query);
	$row = mysqli_fetch_assoc($query_result);
	$tb .=$row["NAME"]."</div>
				</div>
				<input class='ph2 pv1' type='button' name='' value='Выйти'>
			</div>
		</div>
		<div class='flex justify-between' style='height:89%;'>
			<div id='sidenav' class='w-15 flex flex-column br b--light-silver' style='justify-content:start;'>
				<div id='' class='pv4 ph1 tc hover' onclick='ClickOnSideMenuElem(this); BtSideMenu(false);'>
		            <div class=''>
		              <i class='material-icons' style='color:#357EDD;font-size:40px'>person_add</i>
		            </div>
		            Создать заявку
	          	</div>
	          	<div id='_ReqBut' class='pv4 ph1 tc hover' tablename='#content' action='php/request/sReq.php' clearflag='_clearned' onclick='ClickOnSideMenuElem(this); BtSideMenu(true);'>
		            <div class=''>
		              <i class='material-icons' style='color:#357EDD;font-size:40px'>contact_mail</i>
		            </div>
		            Заявки
	          	</div>
			</div>
			<div id='content' class='w-100 ph3 pv2'>
			<div name='modalwind' id='_ReqSearch' class='flex items-center justify-center modal' onclick='CloseWind(this.id)' style='visibility:hidden;'>
          <form onmouseover='this.parentNode.onclick = null;' onmouseout='this.parentNode.setAttribute(`onclick`,`CloseWind(this.id)`)' id='_ReqSearchForm' class='w-60 ph3 pv3 mt1 br2 ba bg-white' action='php/request/sSReq.php' method='post' tablename='#content' clearflag='_clearned'>
            <div class='pb1 tc'>Поиск заявки</div>
            <p></p>
            <div class='flex justify-around'>
			    <div class='w-33 flex justify-between ba b--light-silver'>
              		<input autocomplete='off' name='Ser' class='w-100 ph2 pv1 bn' type='text'  value='' placeholder='Фамилия'>
				    <div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
			    </div>
			    <div class='w-33 flex justify-between ba b--light-silver'>
              		<input autocomplete='off' name='Name' class='w-100 ph2 pv1 bn' type='text'  value='' placeholder='Имя'>
              		<div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
			    </div>
              	<div class='w-33 flex justify-between ba b--light-silver'>
              		<input autocomplete='off' name='Pant' class='w-100 ph2 pv1 bn' type='text'  value='' placeholder='Отчество'>
              		<div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
			    </div>
            </div>
            <p></p>
            <div class='flex justify-around'>
            	<div class='w-33 flex justify-between ba b--light-silver'>
              		<input autocomplete='off'  name='Soc' class='w-100 ph2 pv1 bn' list='social_status' type='text'  value='' placeholder='Соц. статус'>
              		<div class='w-10 pt1 tc' style='transform:rotate(90deg);' noselect=''>></div>
              		<div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
			    </div>
			    <div class='w-33 flex justify-between ba b--light-silver'>
              		<input autocomplete='off' name='Spec' list='speciality' class='w-100 ph2 pv1 bn' type='text'  value='' placeholder='Специальность'>
              		<div class='w-10 pt1 tc' style='transform:rotate(90deg);' noselect=''>></div>
              		<div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
			    </div>
              	<div class='w-33 flex justify-between ba b--light-silver'>
              		<input autocomplete='off' name='Date' class='w-100 ph2 bn' type='date'  value='' placeholder='дд.мм.гггг'>
			    </div>
            </div>
            <p></p>
            <div class='flex justify-start'>
            	<div class='w-25 flex justify-between ba b--light-silver mr2'>
              		<input autocomplete='off' name='PSer' class='w-100 ph2 pv1 bn' type='text'  value='' placeholder='Пасп. серия'onkeyup='return ChekSymb(this)'  maxlength='4'>
              		<div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
			    </div>
			    <div class='w-25 flex justify-between ba b--light-silver'>
              		<input autocomplete='off' name='PNum' class='w-100 ph2 pv1 bn' type='text'  value='' placeholder='Пасп. номер'onkeyup='return ChekSymb(this)'  maxlength='6'>
              		<div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
			    </div>
            </div>
            <p></p>
            <div class='tc'>
              Адрес регистрации
            </div>
            <p></p>
            <div class='flex justify-around'>
              <div class='w-33 flex justify-between ba b--light-silver'>
                <input autocomplete='off' onchange='CheckStreet(this,`adr_1_area`,`adr_1_street`)' class='w-100 ph2 pv1 bw0' list='adr_1_area' type='text' name='RAre' value='' placeholder='Район'>
                <div class='w-10 pv1 tc' noselect onclick='ClearKladr(this,`adr_1_street`)'>x</div>
              </div>
              <div class='w-33 flex justify-between ba b--light-silver'>
                <input autocomplete='off' onchange='CheckStreet(this,`adr_1_street`,`adr_1_house`)' class='w-100 ph2 pv1 bw0' list='adr_1_street' type='text' name='RStr' value='' placeholder='Улица, проспект'>
                <div class='w-10 pv1 tc' noselect onclick='ClearKladr(this,`adr_1_house`)'>x</div>
              </div>
              <div class='w-33 flex justify-between ba b--light-silver'>
                <input autocomplete='off' class='w-100 ph2 pv1 bw0' list='adr_1_house' type='text' name='RHou' value='' placeholder='Дом / корпус'>
                <div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
              </div>
            </div>
            <p></p>
            <div class='tc'>
              <text>Адрес проживания</text>
            </div>
            <div class='flex justify-around'>
              <div class='w-33 flex justify-between ba b--light-silver'>
                <input autocomplete='off' onchange='CheckStreet(this,`adr_1_area`,`adr_1_street`)' class='w-100 ph2 pv1 bw0' list='adr_1_area' type='text' name='FAre' value='' placeholder='Район'>
                <div class='w-10 pv1 tc' noselect onclick='ClearKladr(this,`adr_1_street`)'>x</div>
              </div>
              <div class='w-33 flex justify-between ba b--light-silver'>
                <input autocomplete='off' onchange='CheckStreet(this,`adr_1_street`,`adr_1_house`)' class='w-100 ph2 pv1 bw0' list='adr_1_street' type='text' name='FStr' value='' placeholder='Улица, проспект'>
                <div class='w-10 pv1 tc' noselect onclick='ClearKladr(this,`adr_1_house`)'>x</div>
              </div>
              <div class='w-33 flex justify-between ba b--light-silver'>
                <input autocomplete='off' class='w-100 ph2 pv1 bw0' list='adr_1_house' type='text' name='FHou' value='' placeholder='Дом / корпус'>
                <div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
              </div>
            </div>
            <p></p>
            <div class='tc'>
              Контактные данные
            </div>
            <p></p>
            <div class='flex justify-start'>
            	<div class='w-33 flex justify-between ba b--light-silver mr2'>
              		<input autocomplete='off' name='Mail' class='w-100 ph2 pv1 bn' type='text'  value='' placeholder='Адрес эл. почты'>
              		<div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
              	</div>
              	<div class='w-33 flex justify-between ba b--light-silver'>
              		<input autocomplete='off' class='w-100 ph2 pv1 bn' type='text' name='Phone' defaultValue='+7(___)___-__-__' placeholder='Номер моб. телефона'  oninput='mask(event);'>
              		<div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
              	</div>
            </div>
            <p></p>
            <div class='flex justify-end'>
              <input class='ph2 pv1' type='submit'  value='Поиск' onclick='document.getElementById(`_ReqSearch`).style.visibility = `hidden`'>
              <input class='ph2 pv1 ml1' type='button'  value='Сбросить' onclick='ClearForm(`_ReqSearch`)'>
              <input class='ph2 pv1 ml1' type='button'  value='Закрыть' onclick='CloseWind(`_ReqSearch`)'>
            </div>
          </form>
        </div>
			<div name='modalwind' onclick='CloseWind(this.id)' id='_ReqInfo' class='flex items-center justify-center modal' style='visibility: hidden; z-index: 1'>
	          <form onmouseover='this.parentNode.onclick = null' onmouseout='this.parentNode.setAttribute(`onclick`,`CloseWind(this.id)`)' class='w-60 ph3 pv3 mt1 br2 ba bg-white'>
	            <div class='pb1 tc'>Информация о заявке</div>
	            <p></p>
	            <div class=''>
	              <input class='w-30 ph2 pv1 mr2' disabled='true' type='text'  value=''>
	              <input class='w-30 ph2 pv1' disabled='true' type='text'  value=''>
	              <input class='w-30 ph2 pv1 ml2' disabled='true' type='text'  value=''>
	            </div>
	            <p></p>
	            <div class=''>
	              <input class='w-30 ph2 pv1 mr2' disabled='true' type='text'  value=''>
	              <input class='w-30 ph2 pv1' disabled='true' type='text'  value='' >
	              <input class='w-30 ph2 pv1 ml2' disabled='true' type='text'  value=''>
	            </div>
	            <p></p>
	            <div class='tc'>
	              Паспортные данные
	            </div>
	            <p></p>
	            <div class=''>
	              <input class='w-30 ph2 pv1 mr2' disabled='true' type='text'  value=''>
	              <input class='w-30 ph2 pv1' disabled='true' type='text'  value=''>
	            </div>
	            <p></p>
	            <div class='tc'>
	              Адрес регистрации
	            </div>
	            <p></p>
	            <div class=''>
	              <input class='w-30 ph2 pv1 mr2' disabled='true' type='text' value=''>
	              <input class='w-30 ph2 pv1' disabled='true' type='text'  value=''>
	              <input class='w-30 ph2 pv1 ml2' disabled='true' type='text'  value=''>
	            </div>
	            <p></p>
	            <div class='tc'>
	              Адрес проживания
	            </div>
	            <p></p>
	            <div class=''>
	              <input class='w-30 ph2 pv1 mr2' disabled='true' type='text'  value=''>
	              <input class='w-30 ph2 pv1' disabled='true' type='text'  value=''>
	              <input class='w-30 ph2 pv1 ml2' disabled='true' type='text'  value=''>
	            </div>
	            <p></p>
	            <div class='tc'>
	              Контактные данные
	            </div>
	            <p></p>
	            <div class=''>
	              <input class='w-30 ph2 pv1 mr2' disabled='true' type='text'  value=''>
	              <input class='w-30 ph2 pv1 mr2' disabled='true' type='text'  value=''>
	            </div>
	            <p></p>
	            <div class='flex justify-end'>
	              <input class='ph2 pv1 ml1' type='button'  value='Закрыть' onclick='CloseWind(`_ReqInfo`)'>
	            </div>
	          </form>
	        </div>
	        <input name='requsts_list' id='_Requsts_list' type='text' style='visibility: hidden; position: absolute;' value=''>
		    <form id='_CrRequestForm' class='w-100 ph3 pv3 mt1 br2 ba bg-white' action='php/request/iReq.php' method='post' tablename='0' clearflag='0' onsubmit='SubForm(event)'>
			    <div class='pb1 tc'>Создание  заявки</div>
			    <hr align='center' width='60%' size='1' color='#757575' />
			    <div class='flex justify-around'>
			    	<div class='w-33 flex justify-between ba b--light-silver'>
				    	<input autocomplete='off' class='w-100 ph2 pv1 bn' type='text' name='Ser' value='' placeholder='Фамилия' oninput='ChangeClass(this);'>
				    	<div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
			    	</div>
			    	<div class='w-33 flex justify-between ba b--light-silver'>
					    <input autocomplete='off' class='w-100 ph2 pv1 bn' type='text' name='Name' value='' placeholder='Имя' oninput='ChangeClass(this);'>
					    <div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
					</div>
					<div class='w-33 flex justify-between ba b--light-silver'>
					    <input autocomplete='off' class='w-100 ph2 pv1 bn' type='text' name='Pant' value='' placeholder='Отчество' oninput='ChangeClass(this);'>
					    <div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
				    </div>
				</div>
				<p></p>
				<div class='flex justify-around'>
					<div class='w-33 flex justify-between ba b--light-silver'>
						<input autocomplete='off' class='w-100 ph2 pv1 bn b--light-silver' list='social_status' type='text' name='SocName' value='' placeholder='Соц. статус' oninput='ChangeClass(this);'>
						<div class='w-10 pt1 tc' style='transform:rotate(90deg);' noselect>></div>
				        <div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
				    </div>
				    <div class='w-33 flex justify-between ba b--light-silver'>
						<input autocomplete='off' class='w-100 ph2 pv1 bn b--light-silver' list='speciality' type='text' name='SpecName' value='' placeholder='Специальность' oninput='ChangeClass(this);'>
						<div class='w-10 pt1 tc' style='transform:rotate(90deg);' noselect>></div>
				        <div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
					</div>
					<div class='w-33 flex justify-between ba b--light-silver'>
						<input autocomplete='off' class='w-100 ph2 bn ml3 b--light-silver' type='date' name='ReqDate' value='".date("Y")."-".date("m")."-".date("d")."' readonly dt='false'>
					</div>
				</div>
				<p></p>
				<div class='flex justify-start'>
					<div class='w-25 flex justify-between ba b--light-silver mr2'>
					    <input autocomplete='off' class='w-100 ph2 pv1 bn' type='text' name='PSer' value='' placeholder='Пасп. серия' oninput='ChangeClass(this);' onkeyup='return ChekSymb(this)'  maxlength='4'>
					    <div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
					</div>
					<div class='w-25 flex justify-between ba b--light-silver'>
					    <input autocomplete='off' class='w-100 ph2 pv1 bn' type='text' name='PNum' value='' placeholder='Пасп. номер' oninput='ChangeClass(this); 'onkeyup='return ChekSymb(this)' maxlength='6'>
						<div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
					</div>
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
				<div class='flex justify-start'>
					<div class='w-33 flex justify-between ba b--light-silver mr2'>
					    <input autocomplete='off' class='w-100 ph2 pv1 bn' type='text' name='Mail' value='' placeholder='Адрес эл. почты' oninput='ChangeClass(this);'>
					    <div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
					</div>
					<div class='w-33 flex justify-between ba b--light-silver'>
						<input autocomplete='off' class='w-100 ph2 pv1 bn' type='text' name='Phone' defaultValue='+7(___)___-__-__' placeholder='Номер моб. телефона'  oninput='ChangeClass(this); mask(event);'>
						<div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
					</div>
				</div>
				<p></p>
				<div class='flex justify-end'>
					<input class='ph2 pv1' type='submit' name='' value='Создать'>
					<input class='ph2 pv1 ml1' type='button' name='' value='Сброс' onclick='ClearForm(`_CrRequestForm`)'>
				</div>
			</form>
			<p></p>
		</div>
		<datalist id='social_status'>
		    <option value='Безработный'></option>
		    <option value='Пенсионер'></option>
		    <option value='Инвалид'></option>
		    <option value='Декрет'></option>
		</datalist>
		<datalist id='adr_1_area'>";
	$query = "SELECT kladr.NAME, kladr.SOCR, kladr.CODE FROM kladr";
	$query_result = mysqli_query($link,$query);
	while($row = mysqli_fetch_assoc($query_result)){
   		$tb .= "<option value='".$row["SOCR"]." ".$row["NAME"]."' kladrid='".$row["CODE"]."'></option>";
	}
	$tb .= "
		</datalist>
		<datalist id='adr_1_street'>";
	$query = "SELECT street.NAME, street.SOCR, street.CODE FROM street";
	$query_result = mysqli_query($link,$query);
	while($row = mysqli_fetch_assoc($query_result)){
	   	$tb .= "<option value='".$row["SOCR"]." ".$row["NAME"]."' streetid='".$row["CODE"]."'></option>";
	}
	$tb .= "
	    </datalist>
	    <datalist id='adr_1_house'>";
	$query = "SELECT houses.NAME, houses.SOCR, houses.CODE FROM houses";
	$query_result = mysqli_query($link,$query);
	while($row = mysqli_fetch_assoc($query_result)){
	   	$tb .= "<option value='".$row["SOCR"]." ".$row["NAME"]."' houtid='".$row["CODE"]."'></option>";
	}
	$tb.="
	    </datalist>
	    <datalist id='speciality'>";
	$query = "SELECT * FROM speciality";
	$query_result = mysqli_query($link,$query);
	while($row = mysqli_fetch_assoc($query_result)){
	   	$tb .= "<option value='".$row["SpecName"]."'></option>";
	}
	$tb.="
		</datalist>
		</div>
	</body>
	<script type='text/javascript' src='js/but_actions.js' charset='utf8'></script>
	<script type='text/javascript' src='js/jquery.js' charset='utf8'></script>
	<script type='text/javascript' src='js/form.js' charset='utf8'></script>
</html>";
	echo $tb;
?>