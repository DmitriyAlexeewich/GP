<?php
$tb = "
  <html style='overflow:hidden;'>
    <head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
      <link rel='stylesheet' href='css/tachyons_min.css'>
      <link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
      <link rel='stylesheet' href='css/custom.css'>
      <title>УМЦ</title>
    </head>
    <body onload='loadwind(`loadwind`)'>
    	<div id='NotifMess' class='w-3 pv2 ph1 bg-white ba br2 ml1 mt2' style='position:absolute;top:0;left:0;visibility:hidden'>
		   	<div class='flex justify-end bb items-baseline'>
				<div class='tc mr2'>Создана группа</div>
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
            <div class='f6 tc'>Оператор УМЦ</div>
          </div>
          <input class='ph2 pv1' type='button' name='' value='Выйти'>
        </div>
      </div>
      <div class='flex justify-between' style='height:89%;'>
        <div id='sidenav' class='w-15 flex flex-column br b--light-silver' style='justify-content:start;'>
          <div id='_ReqBut' class='pv4 ph1 tc hover' tablename='#content' action='php/request/sReq.php?Pass=1' clearflag='_clearned' onclick='ClickOnSideMenuElem(this)'>
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
            <div class='' style='position:relative;'>
              <div class='pa1 mb1 br2'></div>
              <i class='material-icons w-100' style='color:#357EDD;font-size:40px'>notification_important</i>
            </div>
            Уведомления
          </div>
        </div>
      <div id='content' class='w-100 ph3 pv2'>
        <div onclick='CloseWind(this.id)' class='flex items-center justify-center modal' style='visibility:hidden;' name='modalwind' id='Group'></div>                 
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
        <div onclick='CloseWind(this.id)' name='modalwind' id='_GroupSearch' class='flex items-center justify-center modal' style='visibility:hidden;'>
          <form onmouseover='this.parentNode.onclick = null' onmouseout='this.parentNode.setAttribute(`onclick`,`CloseWind(this.id)`)' class='w-60 ph3 pv3 mt1 br2 ba bg-white' id='_GroupSearchForm' action='php/group/ssGroup.php' method='post' tablename='#content' clearflag='_clearned'>
            <div class='pb1 tc'>Поиск группы</div>
            <p></p>
            <div class='flex justify-start'>
            	<div class='w-33 flex justify-between ba b--light-silver mr2'>
              		<input autocomplete='off' class='w-100 ph2 pv1 bn' list='grp_src_area' type='text'  value='' placeholder='Площадка' name='GrName'>
              		<div class='w-10 pt1 tc' style='transform:rotate(90deg);' noselect=''>></div>
              		<div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
              	</div>
              	<div class='w-33 flex justify-between ba b--light-silver mr2'>
              		<input autocomplete='off' class='w-100 ph2 pv1 bn' list='grp_src_speciality' type='text'  value='' placeholder='Специальность' name='SpecName'>
              		<div class='w-10 pt1 tc' style='transform:rotate(90deg);' noselect=''>></div>
              		<div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
              	</div>
              	<div class='w-33 flex justify-between ba b--light-silver'>
              		<input autocomplete='off' class='w-100 ph2 pv1 bn' list='grp_src_service_type_1' type='text'  value='' placeholder='Вид гос. услуги' name='TPSerName'>
              		<div class='w-10 pt1 tc' style='transform:rotate(90deg);' noselect=''>></div>
              		<div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
              	</div>
              <datalist id='grp_src_area'>";
                  $query="SELECT * FROM ground";
                  $query_result = mysqli_query($link,$query);
                    while($row = mysqli_fetch_assoc($query_result)){
                      $tb .= "<option value='".$row["GrName"]."'></option>";
                    }
            $tb.="</datalist>
              <datalist id='grp_src_speciality'>";
                  $query="SELECT * FROM `speciality`";
                  $query_result = mysqli_query($link,$query);
                    while($row = mysqli_fetch_assoc($query_result)){
                      $tb .= "<option value='".$row["SpecName"]."'></option>";
                    }
            $tb.="
              </datalist>
              <datalist id='grp_src_service_type_1'>";
                  $query="SELECT * FROM `typepublicservice`";
                  $query_result = mysqli_query($link,$query);
                    while($row = mysqli_fetch_assoc($query_result)){
                      $tb .= "<option value='".$row["TPSerName"]."'></option>";
                    }
            $tb .= "
              </datalist>
            </div>
            <p></p>
            <div class='flex justify-start'>
            	<div class='w-33 flex justify-between ba b--light-silver mr2'>
              		<input autocomplete='off' class='w-100 ph2 pv1 bn' list='grp_src_number' type='text'  value='' placeholder='Номер группы' name='Group_ID'>
              		<div class='w-10 pt1 tc' style='transform:rotate(90deg);' noselect=''>></div>
              		<div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
              	</div>
              	<div class='w-33 flex justify-between ba b--light-silver mr2'>
              		<input autocomplete='off' class='w-100 ph2 pv1 bn' type='text'  value='' placeholder='Человек в группе' name='StCount'>
              		<div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
              	</div>
              	<div class='w-33 flex justify-between ba b--light-silver'>
              		<input autocomplete='off' class='w-100 ph2 pv1 bn' list='grp_src_service_type_2' type='text'  value='' placeholder='Формат гос. услуги' name='FPSerName'>
              		<div class='w-10 pt1 tc' style='transform:rotate(90deg);' noselect=''>></div>
              		<div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
              	</div>
              <datalist id='grp_src_number'>";
                  $query="SELECT * FROM groups";
                  $query_result = mysqli_query($link,$query);
                    while($row = mysqli_fetch_assoc($query_result)){
                      $tb .= "<option value='".$row["Group_ID"]."'></option>";
                    }
              $tb.="      
              </datalist>
              <datalist id='grp_src_service_type_2'>";
                  $query="SELECT * FROM `formatpublicservice`";
                  $query_result = mysqli_query($link,$query);
                    while($row = mysqli_fetch_assoc($query_result)){
                      $tb .= "<option value='".$row["FPSerName"]."'></option>";
                    }
              $tb.="      
              </datalist>
              <datalist id='grp_src_service_type_1'>";
                  $query="SELECT * FROM `typepublicservice`";
                  $query_result = mysqli_query($link,$query);
                    while($row = mysqli_fetch_assoc($query_result)){
                      $tb .= "<option value='".$row["TPSerName"]."'></option>";
                    }
              $tb.="      
              </datalist>
            </div>
            <p></p>
            <div class=''>
            	<div class='w-33 flex justify-between ba b--light-silver'>
              		<input autocomplete='off' class='w-100 ph2 pv1 bn' type='text'  value='' placeholder='Кол-во часов обучения' name='HouCount'>
              		<div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
              	</div>
            </div>
            <p></p>
            <div class=''>
              Дата создания
            </div>
            <p></p>
            <div class=''>
              <input autocomplete='off' class='w-30 ph2 pv1 mr2' type='date'  value='' name='CDate'>
            </div>
            <p></p>
            <div class=''>
              Дата начала обучения
            </div>
            <p></p>
            <div class=''>
              <input autocomplete='off' class='w-30 ph2 pv1 mr2' type='date'  value='' name='SDate'>
            </div>
            <p></p>
            <div class=''>
              Дата окончания обучения
            </div>
            <p></p>
            <div class=''>
              <input autocomplete='off' class='w-30 ph2 pv1 mr2' type='date'  value='' name='EDate'>
            </div>
            <p></p>
            <div class='flex justify-end'>
              <input class='ph2 pv1' type='submit'  value='Поиск'   onclick='document.getElementById(`_GroupSearch`).style.visibility = `hidden`'>
              <input class='ph2 pv1 ml1' type='button'  value='Сбросить' onclick='ClearForm(`_GroupSearchForm`)'>
              <input class='ph2 pv1 ml1' type='button'  value='Закрыть' onclick='CloseWind(`_GroupSearch`)'>
            </div>
                    </form>
                  </div>
                 
                  
                  <div id='_CreateGroupForm' onclick='CloseCreateGroup()' class='flex items-center justify-center modal' style='visibility: hidden; z-index: 0'>
                    <form onmouseover='this.parentNode.onclick = null' onmouseout='this.parentNode.setAttribute(`onclick`,`CloseCreateGroup()`)' id='_CreateGroupFormSub' class='w-90 ph3 pv3 mt1 br2 ba bg-white' action='php/creategroup/IReq.php' tablename='#_CreateGroupFormSub' onsubmit='SubForm(event);ClearForm(this.parentNode.id);'> 
            <div class='pb1 tc'>Создание группы</div>
            <p></p>
            <div class='flex justify-start'>
            	<div class='w-33 flex justify-between ba b--light-silver mr2'>
              		<input autocomplete='off' name='_GroundName' class='w-100 ph2 pv1 bn' list='grp_src_area' type='text'  value='' placeholder='Площадка'>
              		<div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
              	</div>
              	<div class='w-33 flex justify-between ba b--light-silver mr2'>
              		<input autocomplete='off' name='_SpecNameInp' id='_SpecInputCrtGr' class='w-100 ph2 pv1 bn' list='grp_src_speciality' type='text'  value='' placeholder='Специальность'>
              	</div>
              	<div class='w-33 flex justify-between ba b--light-silver'>
              		<input autocomplete='off' name='_TPSer' class='w-100 ph2 pv1 bn' list='grp_src_service_type_1' type='text'  value='' placeholder='Вид гос. услуги'>
              		<div class='w-10 pt1 tc' style='transform:rotate(90deg);' noselect=''>></div>
              		<div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
              	</div>
            </div>
            <p></p>
            <div class='flex justify-start'>
            	<div class='w-33 flex justify-between ba b--light-silver mr2'>
              		<input autocomplete='off' name='_GroupCount' id='_StudCount' class='w-100 ph2 pv1 bn' type='text'  value='' placeholder='Человек в группе'>
              		<div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
              	</div>
              	<div class='w-33 flex justify-between ba b--light-silver'>
              		<input name='_FPSer' class='w-100 ph2 pv1 bn' list='grp_src_service_type_2' type='text'  value='' placeholder='Формат гос. услуги'>
              		<div class='w-10 pt1 tc' style='transform:rotate(90deg);' noselect=''>></div>
              		<div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
              	</div>
            </div>
            <p></p>
            <div class='flex justify-start'>
            	<div class='w-33 flex justify-between ba b--light-silver mr2'>
              		<input autocomplete='off' name='_SocStInp' id='_SocInputCrtGr' class='w-100 ph2 pv1 bn' list='grp_crt_soc_status' type='text'  value='' placeholder='Соц. статус'>
              	</div>
              	<div class='w-33 flex justify-between ba b--light-silver mr2'>
              		<input autocomplete='off' name='_Hours' class='w-100 ph2 pv1 bn' type='text'  value='' placeholder='Кол-во часов обучения'>
              		<div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
              	</div>
              <datalist id='grp_crt_soc_status'>
                <option value='Декрет'></option>
                <option value='Безработный'></option>
                <option value='Инвалид'></option>
                <option value='Пенсионер'></option>
              </datalist>
            </div>
            <p></p>
            <div class='flex justify-around'>
              <div class='tc'>
                Дата создания
              </div>
              <div class='tc'>
                Дата начала обучения
              </div>
              <div class='tc'>
                Дата окончания обучения
              </div>
            </div>
            <p></p>
            <div class='flex justify-around'>
              <input autocomplete='off' name='_CDate' class='w-30 ph2 pv1 mr2' type='date'  value='".date("Y").'-'.date("m").'-'.date("d")."'>
              <input autocomplete='off' name='_SDate' class='w-30 ph2 pv1 mr2' type='date'  value='' min='".date("Y").'-'.date("m").'-'.date("d")."'>
              <input autocomplete='off' name='_EDate' class='w-30 ph2 pv1 mr2' type='date'  value='' min='".date("Y").'-'.date("m").'-'.date("d")."'>
            </div>
            <p></p>
            <div class='flex justify-between w-100'>
	            <div class='w-40 tc'>
	              Формируемая группа
	            </div>
	            <div class='w-40 tc'>
	              Список заявок по специальности
	            </div>
          	</div>
            <div class='flex justify-between w-100 items-center'>
              <table class='w-40 bg-white table_scroll' style='height:200px !important;'>
                
                <tbody id='_CreateGroupTBody'>
                  
                </tbody>
              </table>
              <div>
                <input type='button' value='Добрать' name='' onclick='FillGroup()'>
              </div>
              <table class='w-40 bg-white table_scroll' style='height:200px !important;'>
                
                <tbody id='_GrCrtRequestList'>
                  
                </tbody>
              </table>
            </div>
            <p></p>
            <div class='flex justify-center'>
              <div class='pa1 bg-red'>&nbsp;</div>
              <div class='pa1'>
                - срок истекает
              </div>
              <div class='pa1 bg-yellow'>&nbsp;</div>
              <div class='pa1'>
                - крайний срок
              </div>
              <div class='pa1 bg-green'>&nbsp;</div>
              <div class='pa1'>
                - допустимый срок
              </div>
            </div>
            <p></p>
            <div class='flex justify-end'>
              <input id='_CreateGroupBut' class='ph2 pv1' type='submit'  value='Создать'>
              <input class='ph2 pv1 ml1' type='button' value='Закрыть' onclick='CloseCreateGroup()'>
              <input name='requsts_list' id='_Requsts_list' type='text' style='visibility: hidden; position: absolute;' value=''>
            </div>
                    </form>
                  </div>


           <div onclick='CloseWind(this.id)' name='modalwind' id='_StudSearch' class='flex items-center justify-center modal' style='visibility: hidden;'>
            <form id='_StudSearchForm' onmouseover='this.parentNode.onclick = null' onmouseout='this.parentNode.setAttribute(`onclick`,`CloseWind(this.id)`)' class='w-60 ph3 pv3 mt1 br2 ba bg-white' action='php/student/sSStudent.php' method='post' tablename='#content' clearflag='_clearned'>
            <div  class='pb1 tc'>Поиск студента</div>
            <p></p>
            <div class='flex justify-around'>
            	<div class='w-33 flex justify-between ba b--light-silver mr2'>
              		<input autocomplete='off' name='Ser' class='w-100 ph2 pv1 bn' type='text'  value='' placeholder='Фамилия'>
              		<div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
              	</div>
              	<div class='w-33 flex justify-between ba b--light-silver mr2'>
              		<input autocomplete='off' name='Name' class='w-100 ph2 pv1 bn' type='text'  value='' placeholder='Имя'>
              		<div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
              	</div>
              	<div class='w-33 flex justify-between ba b--light-silver mr2'>
              		<input autocomplete='off' name='Pant' class='w-100 ph2 pv1 bn' type='text'  value='' placeholder='Отчество'>
              		<div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
              	</div>
            </div>
            <p></p>
            <div class='flex justify-around'>
            	<div class='w-33 flex justify-between ba b--light-silver mr1'>
              		<input autocomplete='off' name='Soc' class='w-100 ph2 pv1 bn' list='social_status' type='text'  value='' placeholder='Соц. статус'>
              		<div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
              	</div>
              	<div class='w-33 flex justify-between ba b--light-silver mr1'>
              		<input autocomplete='off' name='Spec' class='w-100 ph2 pv1 bn' type='text' list='speciality' value='' placeholder='Специальность'>
              		<div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
              	</div>
              	<div class='w-33 flex justify-between ba b--light-silver'>
              		<input autocomplete='off' name='Date' class='w-100 ph2 bn' type='date'  value='' placeholder='дд.мм.гггг'>
              	</div>
            </div>
            <p></p>
            <div class='flex justify-around'>
            	<div class='w-33 flex justify-between ba b--light-silver mr2'>
              		<input autocomplete='off' name='Group_ID' class='w-100 ph2 pv1 bn' type='text'  value='' placeholder='Группа'>
              		<div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
              	</div>
              	<div class='w-33 flex justify-between ba b--light-silver mr2'>
              		<input autocomplete='off' name='PSer' class='w-100 ph2 pv1 bn' type='text'  value='' placeholder='Пасп. серия'>
              		<div class='w-10 pv1 tc' noselect onclick='ClearField(this)'>x</div>
              	</div>
              	<div class='w-33 flex justify-between ba b--light-silver mr2'>	
              		<input autocomplete='off' name='PNum' class='w-100 ph2 pv1 bn' type='text'  value='' placeholder='Пасп. номер'>
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
              Адрес проживания
            </div>
            <p></p>
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
            <div class='flex justify-around'>
            	<div class='w-33 flex justify-between ba b--light-silver mr2'>
              		<input autocomplete='off' name='Mail' class='w-100 ph2 pv1 bn' type='text'  value='' placeholder='Адрес эл. почты'>
              		<div class='w-10 pv1 tc' noselect onclick='ClearField(this'>x</div>
            	</div>
            	<div class='w-33 flex justify-between ba b--light-silver mr2'>
              		<input autocomplete='off' name='Phone' class='w-100 ph2 pv1 bn' type='text'  value=''oninput='mask(event);' defaultValue='+7(___)___-__-__' placeholder='Номер моб. телефона'>
              		<div class='w-10 pv1 tc' noselect onclick='ClearField(this'>x</div>
            	</div>
            	<div class='w-33 flex justify-between ba b--light-silver'>
              		<input autocomplete='off' name='GoundName' class='w-100 ph2 pv1 bn' type='text'  value='' placeholder='Площадка' list='grp_src_area'>
              		<div class='w-10 pv1 tc' noselect onclick='ClearField(this'>x</div>
            	</div>
            </div>
            <p></p>
            <div class='flex justify-end'>
              <input class='ph2 pv1' type='submit'  value='Поиск' onclick='document.getElementById(`_StudSearch`).style.visibility = `hidden`'>
              <input class='ph2 pv1 ml1' type='button'  value='Сбросить' onclick='ClearForm(`_StudSearch`)'>
              <input class='ph2 pv1 ml1' type='button'  value='Закрыть' onclick='CloseWind(`_StudSearch`)'>
            </div>
          </form>
        </div>
        <div name='modalwind' onclick='CloseWind(this.id)' id='_StudInfo' class='flex items-center justify-center modal' style='visibility: hidden;'>
          <form onmouseover='this.parentNode.onclick = null' onmouseout='this.parentNode.setAttribute(`onclick`,`CloseWind(this.id)`)' class='w-60 ph3 pv3 mt1 br2 ba bg-white'>
            <div class='pb1 tc'>Информация о студенте</div>
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
              Группа
            </div>
            <p></p>
            <div class='' style=''>
              <input class='w-30 ph2 pv1 mr2' disabled='true' type='text'  value=''>
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
              <input class='ph2 pv1 ml1' type='button'  value='Закрыть' onclick='CloseWind(`_StudInfo`)'>
            </div>
          </form>
        </div>

        <div onclick='CloseWind(this.id)' id='addstuddoc' class='flex items-center justify-center modal pv2' style='visibility:hidden;'>
        <div onmouseover='this.parentNode.onclick = null' onmouseout='this.parentNode.setAttribute(`onclick`,`CloseWind(this.id)`)' class='bg-white w-90 h-100'>
          <div class='pv1 pb1 tc bb'>Просмотр документа о зачислении</div>
          <div class='div_scroll' style='height:90%;'>
            <div id='studdoc'>
              <p style='text-align:center;white-space:pre-wrap;margin:0 0;'>
                <b>
                  ГОСУДАРСТВЕННОЕ АВТОНОМНОЕ ОБРАЗОВАТЕЛЬНОЕ УЧРЕЖЕНИЕ
                  ДОПОЛНИТЕЛЬНОГО ОБРАЗОВАНИЯ ЛЕНИНГРАДСКОЙ ОБЛАСТИ
                  «УЧЕБНО-МЕТОДИЧЕСКИЙ ЦЕНТР»
                </b>
                <div style='display:flex;justify-content:center;'>
                  <p style='text-align:center;border:0.5px black solid;width:50%;margin:0 0;'></p>
                </div>
                <p style='text-align:center;'>
                  <b>
                    ПРИКАЗ
                  </b>
                </p>
              </p>
              <div style='display:flex;justify-content:space-around;'>
                <b>
                  «28» апреля 2019г.
                </b>
                <b>
                  № 250/1-уг
                </b>
              </div>
              <p style='margin-left:5%;margin-bottom:0;'>
                <b>
                  О зачислении на обучение в группу № 144/УКин-14
                </b>
              </p>
              <p style='margin:0 0 0 6%;white-space:pre-line;'>В соответствии с утвержденной учебной программой
                и сметой расходов на обучение
              </p>
              <p style='margin-left:5%;margin-bottom:0;'>
                <b>Приказываю:</b>
              </p>
              <p style='margin-left:5%;margin-bottom:0;white-space:pre-line;text-indent:2%;'>1. Зачислить на обучение по профессии <b>«Маникюрша»</b> с 28 апреля 2019 года в
                 учебную группу № <b>144/УКин-14</b> со сроком обучения с <b>28.04.2019г.</b> по <b>01.09.2019г.</b> следующих граждан:
              </p>
              <div style='display:flex;justify-content:center;'>
                <table style='border:0.5px black solid;border-collapse:collapse;text-align:center;width:90%;'>
                  <thead>
                    <tr>
                      <th style='border:0.5px black solid;padding:0 10px;'>
                        № п/п
                      </th>
                      <th style='border:0.5px black solid;padding:0 10px;'>
                        Ф.И.О.
                      </th>
                      <th style='border:0.5px black solid;padding:0 10px;'>
                        Наименование филиала <br>ГКУ ЦЗН ЛО
                      </th>
                      <th style='border:0.5px black solid;padding:0 10px;'>
                        Рег.номер
                      </th>
                      <th style='border:0.5px black solid;padding:0 10px;'>
                        Номер договора
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td style='border:0.5px black solid;padding:0 10px;'>1.</td>
                      <td style='border:0.5px black solid;padding:0 10px;' id='studname'>Воронова Екатерина Владимировна</td>
                      <td style='border:0.5px black solid;padding:0 10px;' id='groundname'>Кингисеппский илиал ГКУ ЦЗН ЛО</td>
                      <td style='border:0.5px black solid;padding:0 10px;'>2290086/1807</td>
                      <td style='border:0.5px black solid;padding:0 10px;'>01-ГЗ-ЦЗН от 28.04.19</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <p style='margin-left:5%;margin-top:0;text-indent:2%;'>
                2. Контроль за исполнением приказа оставляю за собой
              </p>
              <div style='display:flex;justify-content:space-around;'>
                <b>
                 И.о директора
                </b>
                <b>
                  И.А.Рахова
                </b>
              </div>
            </div>
          </div>
          <div class='flex justify-end bt pv1'>
            <input class='ph2 pv1' type='button' name='' value='Скачать' onclick='Export2Doc(`studdoc`);'>
            <input class='ph2 pv1 mh1' type='button' name='' value='Закрыть' onclick='CloseWind(`addstuddoc`)'>
          </div>
        </div>
      </div>
      </div>
      <datalist id='social_status'>
        <option value='Безработный'></option>
        <option value='Пенсионер'></option>
        <option value='Инвалид'></option>
        <option value='Декрет'></option>
      </datalist>
      <datalist id='speciality'>";
        $query = "SELECT * FROM speciality";
        $query_result = mysqli_query($link,$query);
        while($row = mysqli_fetch_assoc($query_result)){
            $tb .= "<option value='".$row["SpecName"]."'></option>";
        }
        $tb.="
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
    </body>
  <script type='text/javascript' src='js/but_actions.js' charset='utf8'></script>
  <script type='text/javascript' src='js/jquery.js' charset='utf8'></script>
  <script id='_formscr' type='text/javascript' src='js/form.js' charset='utf8'></script>
</html>";
echo $tb;
?>