$("#_ReqSearchForm, #_GroupSearchForm, #_StudSearchForm").submit(function(event) {
	AddingForm(event,event.target.attributes.tablename,event.target.attributes.action,event.target.attributes.method,event.target,event.target.attributes.clearflag.nodeValue);
});
$("#_ReqBut, #_TeachBut, #_StudBut, #_Soc0, #_Soc1, #_Soc2, #_Soc3, #_Soc4, #_Soc5, #_NotifBut").on("click",function(event){
	Adding(event,$(this).attr('tablename'),$(this).attr('action'),$(this).attr('clearflag'));
});
function SubForm(event){
	event.preventDefault();
	event.stopImmediatePropagation();
	allinput = event.currentTarget.getElementsByTagName("input");
	var flag = false;
	var SubAttrs;
	if(event.currentTarget.id=="_CrRequestForm"){
		SubAttrs = document.getElementsByName("Ser")[0].value;
		SubAttrs += " " + document.getElementsByName("Name")[0].value;
		SubAttrs += " " + document.getElementsByName("Pant")[0].value;
	}
	for(var i=0; i<allinput.length;  i++){
		if((allinput[i].value.length <= 0)||(allinput[i].value.includes("+7(___)___-__-__"))){
			flag = true;
			allinput[i].trueplaysholder = allinput[i].placeholder;
			allinput[i].placeholder = "Заполните " + allinput[i].placeholder.replace("Заполните ","");
			allinput[i].classList.add("erroplaceholder");
		}
	}
	if(flag == false){
		var t = event.currentTarget.getAttribute('tablename');
		var flag = event.currentTarget.getAttribute('clearflag');
		$.ajax({
			type: "post",
			url: event.currentTarget.getAttribute('action'),
			data: new FormData(event.currentTarget),
			dataType: "html",
			contentType: false,
			cache: false,
			processData: false,
			success: function(result){
				if(event.target.id=="_CrRequestForm"){
					document.getElementById("NotifMess").childNodes[3].innerHTML = SubAttrs;
					document.getElementById("NotifMess").style.visibility = "visible";
					ClearForm("_CrRequestForm");
				}
				if(event.target.id=="_CreateGroupFormSub"){
					CloseCreateGroup();
					document.getElementById("NotifMess").getElementsByTagName("div")[1].innerHTML = event.target.getElementsByTagName("input")[0].value;
					document.getElementById("NotifMess").style.visibility = "visible";
				}
				if(t != "0"){
					if(flag == "1"){
						$(t).empty();
					}else{
						var group = document.getElementsByName(flag);
						for(var j=group.length-1; j>-1 ;j--){
							group[j].parentNode.removeChild(group[j]);
						}
					}
				}
				$(t).append(result);
			}
		});
	}
}/*
$("#_CreateGroupFormSub, #_CrTeacherForm, #_CrRequestForm").submit(function(event){
	event.preventDefault();
	event.stopImmediatePropagation();
	var t = $(this).attr('tablename');
	var flag = $(this).attr('clearflag');
	$.ajax({
		type: "post",
		url: $(this).attr('action'),
		data: new FormData(this),
		dataType: "html",
		contentType: false,
		cache: false,
		processData: false,
		success: function(result){
			if(t != "0"){
				if(flag == "1"){
					$(t).empty();
				}else{
					var group = document.getElementsByName(flag);
					for(var j=group.length-1; j>-1 ;j--){
						group[j].parentNode.removeChild(group[j]);
					}
				}
			}
			$(t).append(result);
		}
	});
});*/
function Adding(event,tablename,action,flag){
	event.preventDefault();
	event.stopImmediatePropagation();
	var formdata = new FormData();
	if(this.tagName == "form"){
		formdata = new FormData(this);
	}
	$.ajax({
		type: "post",
		url: action,
		data: formdata,
		dataType: "html",
		contentType: false,
		cache: false,
		processData: false,
		success: function(result){
			if(tablename != "0"){
				if(flag == "1"){
					$(tablename).empty();
				}else{
					var group = document.getElementsByName(flag);
					for(var j=group.length-1; j>-1 ;j--){
						group[j].parentNode.removeChild(group[j]);
					}
				}
				$(tablename).append(result);
				var ButCollect2 = document.getElementsByTagName("ButCls2");
				for(var i=0; i<ButCollect2.length; i++){
					$(ButCollect2[i]).on("click",function(event){
						Adding(event,$(this).attr('tablename'),$(this).attr('action'),$(this).attr('clearflag'));
					});
				}
				var FormCollect = document.getElementsByTagName("form");
				for(var i=0; i<FormCollect.length; i++){
					$(FormCollect[i]).submit(function(event) {
						AddingForm(event,event.target.attributes.tablename,event.target.attributes.action,event.target.attributes.method,event.target,event.target.attributes.clearflag.nodeValue);
					});
				}
				var ButCollect = document.getElementsByName("ButCls");
				for(var i=0; i<ButCollect.length; i++){
					$(ButCollect[i]).on("click",function(event){
						Adding(event,$(this).attr('tablename'),$(this).attr('action'),$(this).attr('clearflag'));
					});
				}
			}
		},
	});
}
function AddingForm(event,tablename,action, method, fdata, flag){
	event.preventDefault();
	event.stopImmediatePropagation();
	$.ajax({
		type: method.nodeValue,
		url: action.nodeValue,
		data: new FormData(fdata),
		dataType: "html",
		contentType: false,
		cache: false,
		processData: false,
		success: function(result){
			if(tablename.nodeValue != "0"){
				if(flag == "1"){
					$(tablename.nodeValue).empty();
				}else{
					var group = document.getElementsByName("_clearned");
					for(var j=group.length-1; j>-1 ;j--){
						group[j].parentNode.removeChild(group[j]);
					}
				}
				$(tablename.nodeValue).append(result);
				var ButCollect2 = document.getElementsByTagName("ButCls2");
				for(var i=0; i<ButCollect2.length; i++){
					$(ButCollect2[i]).on("click",function(event){
						Adding(event,$(this).attr('tablename'),$(this).attr('action'),$(this).attr('clearflag'));
					});
				}
				var FormCollect = document.getElementsByTagName("form");
				for(var i=0; i<FormCollect.length; i++){
					$(FormCollect[i]).submit(function(event) {
						AddingForm(event,event.target.attributes.tablename,event.target.attributes.action,event.target.attributes.method,event.target,event.target.attributes.clearflag.nodeValue);
					});
				}
				var ButCollect = document.getElementsByName("ButCls");
				for(var i=0; i<ButCollect.length; i++){
					$(ButCollect[i]).on("click",function(event){
						Adding(event,$(this).attr('tablename'),$(this).attr('action'),$(this).attr('clearflag'));
					});
				}
			}
		},
	});
}
function AddingBut(event,tablename,action,flag){
	event.preventDefault();
	event.stopImmediatePropagation();
	$.ajax({
		type: "post",
		url: action,
		data: new FormData(this),
		dataType: "html",
		contentType: false,
		cache: false,
		processData: false,
		success: function(result){
			if(tablename != "0"){
				if(flag == "1"){
					$(tablename).empty();
				}else{
					var group = document.getElementsByName(flag);
					for(var j=group.length-1; j>-1 ;j--){
						group[j].parentNode.removeChild(group[j]);
					}
				}
				$(tablename).append(result);
				var ButCollect2 = document.getElementsByTagName("ButCls2");
				for(var i=0; i<ButCollect2.length; i++){
					$(ButCollect2[i]).on("click",function(event){
						Adding(event,$(this).attr('tablename'),$(this).attr('action'),$(this).attr('clearflag'));
					});
				}
				var FormCollect = document.getElementsByTagName("form");
				for(var i=0; i<FormCollect.length; i++){
					$(FormCollect[i]).submit(function(event) {
						AddingForm(event,event.target.attributes.tablename,event.target.attributes.action,event.target.attributes.method,event.target,event.target.attributes.clearflag.nodeValue);
					});
				}
				var ButCollect = document.getElementsByName("ButCls");
				for(var i=0; i<ButCollect.length; i++){
					$(ButCollect[i]).on("click",function(event){
						Adding(event,$(this).attr('tablename'),$(this).attr('action'),$(this).attr('clearflag'));
					});
				}
			}
		}
	});
}
function onbuttonclick(elem,event){
	event.preventDefault();
	event.stopImmediatePropagation();
	groupid = null;
	if((elem.parentNode.getElementsByTagName("input").length>0)){
		if(!(elem.parentNode.getElementsByTagName("input")[0].value === undefined)){
			groupid=elem.parentNode.getElementsByTagName("input")[0].value;
		}
	}
	var t = $(elem).attr('tablename');
	var flag = $(elem).attr('clearflag');
	$.ajax({
		type: "post",
		url: $(elem).attr('action'),
		data: ({
        	Target: groupid,
        	TargetContent: $(elem).attr('TargetContent')
    	}),
		success: function(result){
			if(t != "0"){
				if(flag == "1"){
					$(t).empty();
				}else{
					var group = document.getElementsByName(flag);
					for(var j=group.length-1; j>-1 ;j--){
						group[j].parentNode.removeChild(group[j]);
					}
				}
			}
			$(t).append(result);
		}
	});
}