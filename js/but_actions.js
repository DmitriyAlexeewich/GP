function loadwind(wind_id){
	var loadwind = document.getElementById(wind_id);
	if(loadwind.style.position == "hidden"){
		loadwind.style.position = "fixed";
		loadwind.style.visibility = "visible";
	}else{
		loadwind.style.position = "absolute";
		loadwind.style.visibility = "hidden";
	}
}
function ModalBut(wind_id){
	var MWind = document.getElementsByName("modalwind");
	for(var i=0; i<MWind.length; i++){
		MWind[i].style.visibility = "hidden";
	}
	document.getElementById(wind_id).style.visibility = "visible";
}
function ClearField(node){
	parent = node.parentNode;
	parent.childNodes[1].value = "";
}
function ClearForm(wind_id){
	var Elems = document.getElementById(wind_id).getElementsByTagName('input');
	for(var  i=0; i<Elems.length; i++){
		if((Elems[i].type == "text")||(Elems[i].type == "date")&&(Elems[i].getAttribute("dt")==null))
			Elems[i].value = "";
	}
}
function CloseWind(wind_id){
	ClearForm(wind_id);
	document.getElementById(wind_id).style.visibility = "hidden";
	var childs = document.getElementById("adr_1_street").getElementsByTagName("option");
	for(var i=0; i<childs.length; i++){
		childs[i].disabled = false;
	}
	childs = document.getElementById("adr_1_house").getElementsByTagName("option");
	for(var i=0; i<childs.length; i++){
		childs[i].disabled = false;
	}

}
function ClickOnReq(line){
	if(line.className == "bg-light-blue"){
		line.className = line.trueclass;
		var childs = line.parentNode.getElementsByTagName("tr");
		var flag = false;
		for(var i=0; i<childs.length; i++){
			if(childs[i].className == "bg-light-blue")
				flag = true;
		}
		if(flag == false){
			for(var i=0; i<childs.length; i++){
				if(childs[i].className == "bg-light-gray"){
					childs[i].className = childs[i].trueclass;
				}
			}
			document.getElementById("_Filters").value = "";
		}
		document.getElementById("_Requsts_list").value = document.getElementById("_Requsts_list").value.replace(line.id+" ","");
		if(document.getElementById("_Requsts_list").value.length > 0){
			document.getElementById("_ReqCreateGroupButt").disabled = false;
			document.getElementById("_ReqAddToGroupButt").disabled = false;
			var linescont = document.getElementById("_Requsts_list").value;
			var reqcount = 0;
			for(var i=0; i<linescont.length; i++){
				if(linescont[i]==' ')
					reqcount++;
			}
			if(reqcount == 1){
				document.getElementById("_ReqOpen").disabled = false;
			}else{
				document.getElementById("_ReqOpen").disabled = true;
			}
		}else{
			if(document.getElementById("_ReqCreateGroupButt") != null){
				document.getElementById("_ReqCreateGroupButt").disabled = true;
			}
			document.getElementById("_ReqOpen").disabled = true;
		}
		return;
	}
	if((line.className != "bg-light-gray")&&(!line.className.includes("bg-light-pink"))){
		var childs = line.parentNode.getElementsByTagName("tr");
		for(var i=0; i<childs.length; i++){
			var params = line.getElementsByTagName("td");
			var tparams = childs[i].getElementsByTagName("td");
			if((params[5].innerHTML != tparams[5].innerHTML)||(params[6].innerHTML != tparams[6].innerHTML)||(params[7].innerHTML != tparams[7].innerHTML)){
				switch (childs[i].className) {
					case "bg-light-red hover-bg-light-blue":
						childs[i].className = "bg-light-gray";
						childs[i].trueclass = "bg-light-red hover-bg-light-blue";
					    break;
					case "bg-light-yellow hover-bg-light-blue":
					    childs[i].className = "bg-light-gray";
					    childs[i].trueclass = "bg-light-yellow hover-bg-light-blue";
					    break;
					case "bg-light-green hover-bg-light-blue":
						childs[i].className = "bg-light-gray";
					    childs[i].trueclass = "bg-light-green hover-bg-light-blue";
					    break;
					default:
					    break;
				}
			}
		}
		line.trueclass = line.className;
		line.className = "bg-light-blue";
		document.getElementById("_Requsts_list").value += line.id + " ";
		document.getElementById("_Requsts_list").innerHTML += line.id + " ";
		if(document.getElementById("_Filters").value.length == 0){
			for(var j=5; j<8; j++){
				document.getElementById("_Filters").value += line.getElementsByTagName("td")[j].innerHTML + " ";
			}
		}
		if(document.getElementById("_Requsts_list").value.length > 0){
			if(document.getElementById("_ReqCreateGroupButt") != null){
				document.getElementById("_ReqCreateGroupButt").disabled = false;
				}
			var linescont = document.getElementById("_Requsts_list").value;
			var reqcount = 0;
			for(var i=0; i<linescont.length; i++){
				if(linescont[i]==' ')
					reqcount++;
			}
			if(reqcount == 1){
				document.getElementById("_ReqOpen").disabled = false;
			}else{
				document.getElementById("_ReqOpen").disabled = true;
			}
		}else{
			if(document.getElementById("_ReqCreateGroupButt") != null){
				document.getElementById("_ReqCreateGroupButt").disabled = true;
				document.getElementById("_ReqAddToGroupButt").disabled = true;
			}
			document.getElementById("_ReqOpen").disabled = true;
		}
		return;
	}
}
function CreateReqGroup(event){
	if (event.button==0){
		var lineid = "";
		var linescont = document.getElementById("_Requsts_list").value;
		for (var i = 0; i < linescont.length; i++) {
			if(linescont[i] != ' '){
				lineid += linescont[i];
			}else{
				break;
			}
		} 
		document.getElementById("_CreateGroupForm").style.visibility = "visible";
		var grounds = document.getElementById("grp_src_area").getElementsByTagName("option");
		var linescontelems = document.getElementById(lineid).getElementsByTagName("td");
		for (var i = 0; i < grounds.length; i++) {
			if(grounds[i].value.includes(linescontelems[7].textContent) == false){
				grounds[i].disabled = true;
			}
		} 
		document.getElementById("_SocInputCrtGr").readOnly = true;
		document.getElementById("_SocInputCrtGr").value = linescontelems[6].innerHTML;
		document.getElementById("_SpecInputCrtGr").readOnly = true;
		document.getElementById("_SpecInputCrtGr").value = linescontelems[5].innerHTML;
		var elemid = "";
		for(var i=0; i<linescont.length; i++){
			if(linescont[i] !=' ')
				elemid += linescont[i];
			else{
				InstLine(elemid,false,"_CreateGroupTBody");
				elemid = "";
			}
		}
		var ReqsList = document.getElementById("_MainRequestList").getElementsByTagName("tr");
		for(var i=0; i<ReqsList.length; i++){
			if((ReqsList[i].className!="bg-light-gray")&&(ReqsList[i].className!="bg-light-blue")&&(ReqsList[i].className!="bg-light-pink hover-bg-light-blue")){
				InstLine(ReqsList[i].id,true,"_GrCrtRequestList");
			}
		}
	}
	event.currentTarget.disabled = true;
}
function InstLine(elemid,add,tbodyname){
	var elem = document.getElementById(elemid);
	var elemattr = elem.getElementsByTagName("td");
	var nline = document.createElement('tr');
	var nlinerow1 = document.createElement('td');
	nlinerow1.className = "w-80 tc";
	nlinerow1.innerHTML = elemattr[0].innerHTML + " " + elemattr[1].innerHTML + " " + elemattr[2].innerHTML;
	var nlinerow2 = document.createElement('td');
	nlinerow2.className = "w-10 tc";
	var nlinerow2inp = document.createElement('input');
	nlinerow2inp.type = "button";
	nlinerow2inp.value = "Открыть";
	nlinerow2inp.onclick = function() {OpenReqInfo(this.parentNode.parentNode.rlineid);};
	nline.rlineid = elemid;
	nline.ondblclick = function() {OpenReqInfo(this.rlineid);};
	var nlinerow3 = document.createElement('td');
	nlinerow3.className = "w-10 tc";
	var nlinerow3inp = document.createElement('input');
	nlinerow3inp.type = "button";
	nlinerow3inp.className = "w-100";
	if(add == false){
		nlinerow3inp.value = "x";
		nlinerow3inp.onclick = function() {DeleteReqFromGroup(this);};
		nline.className = elem.trueclass;
	}else{
		nlinerow3inp.value = "+";
		nlinerow3inp.onclick = function() {AddReqToGroup(this);};
		nline.className = elem.className;
	}
	nlinerow2.appendChild(nlinerow2inp);
	nlinerow3.appendChild(nlinerow3inp);
	nline.appendChild(nlinerow1);
	nline.appendChild(nlinerow2);
	nline.appendChild(nlinerow3);
	document.getElementById(tbodyname).appendChild(nline);
}
function DeleteReqFromGroup(line){
	var ReqList = document.getElementById("_GrCrtRequestList");
	var node = line.parentNode.parentNode.cloneNode(true);
	node.rlineid = line.parentNode.parentNode.rlineid;
	document.getElementById("_Requsts_list").value = document.getElementById("_Requsts_list").value.replace(node.rlineid+" ","");
	line.parentNode.parentNode.parentNode.removeChild(line.parentNode.parentNode);
	var Addbut = node.getElementsByTagName("input")[1];
	Addbut.value = "+"
	Addbut.onclick = function() {AddReqToGroup(this);};
	node.getElementsByTagName("input")[0].onclick = function() {OpenReqInfo(this.parentNode.parentNode.rlineid);};
	node.ondblclick = function() {OpenReqInfo(this.rlineid);};
	ReqList.appendChild(node);
}
function AddReqToGroup(line){
	var ReqList = document.getElementById("_CreateGroupTBody");
	var node = line.parentNode.parentNode.cloneNode(true);
	node.rlineid = line.parentNode.parentNode.rlineid;
	document.getElementById("_Requsts_list").value += node.rlineid + " ";
	line.parentNode.parentNode.parentNode.removeChild(line.parentNode.parentNode);
	var Addbut = node.getElementsByTagName("input")[1];
	Addbut.value = "x"
	Addbut.onclick = function() {DeleteReqFromGroup(this);};
	node.getElementsByTagName("input")[0].onclick = function() {OpenReqInfo(this.parentNode.parentNode.rlineid);};
	node.ondblclick = function() {OpenReqInfo(this.rlineid);};
	ReqList.appendChild(node);
}
function OpenReqInfo(id){
	var line;
	if(id == null){
		line = document.getElementById(document.getElementById("_Requsts_list").value.replace(" ",""));
	}else{
		line = document.getElementById(id);
	}
	var attrs = new Array();
	var contattrs2 = line.attributes.secattr.nodeValue;
	var tattr = "";
	for(var i=0; i<line.getElementsByTagName("td").length; i++){
		attrs.push(line.getElementsByTagName("td")[i].innerHTML);
	}
	for(var i=0; i<contattrs2.length; i++){
		if(contattrs2[i] == ":"){
			tattr += contattrs2[i];
		}
		if((tattr.includes(":") == true)&&(contattrs2[i] != ":")&&(contattrs2[i] != ",")){
			tattr += contattrs2[i];
		}
		if(contattrs2[i] == ","){
			attrs.push(tattr.replace(":",""));
			tattr = "";
		}
	}
	var fields = document.getElementById("_ReqInfo").getElementsByTagName("input");
	fields[0].value = attrs[0];
	fields[1].value = attrs[1];
	fields[2].value = attrs[2];
	fields[3].value = attrs[6];
	fields[4].value = attrs[5];
	fields[5].value = attrs[8];
	fields[6].value = attrs[3];
	fields[7].value = attrs[4];
	fields[8].value = attrs[9];
	fields[9].value = attrs[10];
	fields[10].value = attrs[11];
	fields[11].value = attrs[7];
	fields[12].value = attrs[12];
	fields[13].value = attrs[13];
	fields[14].value = attrs[14];
	fields[15].value = attrs[15];
	document.getElementById("_ReqInfo").style.visibility = "visible";
}
function CloseCreateGroup(){
	var wind = document.getElementById("_CreateGroupForm");
	var inputs = wind.getElementsByTagName("input");
	for(var i=0; i<11; i++){
		inputs[i].value = "";
	}
	var tbody = document.getElementById("_CreateGroupTBody");
	while (tbody.firstChild) {
		tbody.removeChild(tbody.firstChild);
	}
	tbody = document.getElementById("_GrCrtRequestList");
	while (tbody.firstChild) {
		tbody.removeChild(tbody.firstChild);
	}
	tbody = document.getElementById("_MainRequestList");
	var childs = tbody.getElementsByTagName("tr");
	for(var i=0; i<childs.length; i++){
		if((childs[i].className == "bg-light-gray")||(childs[i].className == "bg-light-blue")){
			childs[i].className = childs[i].trueclass;
		}
	}
	var tbodyelems = document.getElementById("_MainRequestList").childNodes;
	for(var i=0; i<tbodyelems.length; i++){
		if(tbodyelems[i].className=="bg-light-red hover-bg-light-blue"){
			document.getElementById("_Requsts_list").value = document.getElementById("_Requsts_list").value.replace(tbodyelems[i].id+" ","");
		}
	}
	var grounds = document.getElementById("grp_src_area").getElementsByTagName("option");
	for (var i = 0; i < grounds.length; i++) {
		grounds[i].disabled = false;
	}
	document.getElementById("_Requsts_list").value=null;
	wind.style.visibility = "hidden";

}
function FillGroup(){
	if((document.getElementById("_StudCount").value.length>0)&&(/\d/.test(document.getElementById("_StudCount").value))){
		var tbody = document.getElementById("_GrCrtRequestList").getElementsByTagName("tr");
		var length = 0;
		if(tbody.length < parseInt(document.getElementById("_StudCount").value)){
			length = tbody.length;
		}else{
			length = parseInt(document.getElementById("_StudCount").value);
		}
		for(var i=0; i<length; i++){
			if(document.getElementById("_CreateGroupTBody").getElementsByTagName("tr").length != i){
				AddReqToGroup(tbody[i].getElementsByTagName("input")[1]);
			}else{
				break;
			}
		}
	}else{
		alert("Введите количество человек в группе.");
	}
}
function OpenStudInfo(elem){
	var line;
	if(elem.line != undefined){
		line = elem.line;
	}else{
		line = elem;
	}
	var attrs = new Array();
	for(var i=0; i<line.getElementsByTagName("td").length; i++){
		attrs.push(line.getElementsByTagName("td")[i].innerHTML);
	}
	var contattrs2 = line.attributes.secattr.nodeValue;
	var tattr = "";
	for(var i=0; i<contattrs2.length; i++){
		if(contattrs2[i] == ":"){
			tattr += contattrs2[i];
		}
		if((tattr.includes(":") == true)&&(contattrs2[i] != ":")&&(contattrs2[i] != ",")){
			tattr += contattrs2[i];
		}
		if(contattrs2[i] == ","){
			attrs.push(tattr.replace(":",""));
			tattr = "";
		}
	}
	var fields = document.getElementById("_StudInfo").getElementsByTagName("input");
	fields[0].value = attrs[1];
	fields[1].value = attrs[2];
	fields[2].value = attrs[3];
	fields[3].value = attrs[16];
	fields[4].value = attrs[6];
	fields[5].value = attrs[8];
	fields[6].value = attrs[0];
	fields[7].value = attrs[4];
	fields[8].value = attrs[5];
	fields[9].value = attrs[10];
	fields[10].value = attrs[11];
	fields[11].value = attrs[12];
	fields[12].value = attrs[13];
	fields[13].value = attrs[14];
	fields[14].value = attrs[15];
	fields[15].value = attrs[17];
	fields[16].value = attrs[9];
	document.getElementById("_StudInfo").style.visibility = "visible";
}
function ClickOnStudent(line){
	if(line.className == "bg-light-blue"){
		line.className = line.trueclass;
		document.getElementById("OpenStud").disabled = true;
		document.getElementById("OpenStud").line = null;
	}else{
		line.trueclass = line.className;
		var childs = line.parentNode.getElementsByTagName("tr");
		for(var i=0; i<childs.length; i++){
			if(childs[i].className == "bg-light-blue"){
				childs[i].className = childs[i].trueclass;
				document.getElementById("OpenStud").line = null;
			}
		}
		line.className = "bg-light-blue";
		document.getElementById("OpenStud").line = line;
		document.getElementById("OpenStud").disabled = false;
	}
}
function ClickOnSideMenuElem(elem){
	var icons = document.getElementsByClassName("material-icons");
	for(var i=0; i<icons.length; i++){
		icons[i].style.color = "#357EDD";
		icons[i].style.fontSize = "40px";
	}
	elem.getElementsByClassName("material-icons")[0].style.color = "#FF725C";
	elem.getElementsByClassName("material-icons")[0].fontSize = "40px";
}
function ClearLogin(){
	document.getElementsByName("Login")[0].value = "";
	document.getElementsByName("Pass")[0].value = "";
}
function CheckStreet(elem,adr1,adr2){
	var KladrOptions = document.getElementById(adr1).getElementsByTagName("option");
	var StreetOptions = document.getElementById(adr2).getElementsByTagName("option");
	var streetid;
	for(var i=0; i<KladrOptions.length; i++){
		if(KladrOptions[i].value.includes(elem.value)){
			streetid=KladrOptions[i].attributes[1].nodeValue;
		}
	}
	for(var j=0; j<StreetOptions.length; j++){
		if(!StreetOptions[j].attributes[1].nodeValue.includes(streetid)){
			StreetOptions[j].disabled = true;
		}
	}
}
function ClearKladr(node,adr1){
	parent = node.parentNode;
	parent.childNodes[1].value = "";
	var StreetOptions = document.getElementById(adr1).getElementsByTagName("option");
	for(var j=0; j<StreetOptions.length; j++){
		StreetOptions[j].disabled = false;
	}
}
function OpenCreateTeach(){
	var wind = document.getElementById("CrTeacher");
	wind.style.visibility = "visible";
	wind.style.position = "fixed";
}
function ClickOnGroup(line){
	var childs = line.parentNode.getElementsByTagName("tr");
	var ButtArr = document.getElementsByName("_GroupButts");
	if(line.className == "bg-light-blue"){
		line.className = line.trueclass;
		for(var i=0; i<childs.length; i++){
			if(childs[i].className == "bg-light-gray"){
				childs[i].className = childs[i].trueclass;
			}
		}
		for(var i=0; i<ButtArr.length; i++){
			ButtArr[i].attributes[4].nodeValue=null;
			ButtArr[i].disabled = true;
		}
		
	}else if(line.className != "bg-light-gray"){
		line.trueclass = line.className;
		for(var i=0; i<childs.length; i++){
			childs[i].trueclass = childs[i].className;
			childs[i].className = "bg-light-gray";
		}
		for(var i=0; i<ButtArr.length;i++){
			var  t = ButtArr[i].attributes[4].nodeValue;
			ButtArr[i].attributes[4].nodeValue=$(line).attr('TargetContent');
			ButtArr[i].disabled = false;
			if((ButtArr[i].value=="Завершить обучение")&&(line.true != "bg-light-green")){
				ButtArr[i].disabled = true;
			}
		}
		line.className = "bg-light-blue";
	}
}/*
function ClickOnNotif(elem){
	var parent = elem.parentNode.parentNode;
	var WorkSpace = parent.getElementsByTagName("div");
	if(WorkSpace[1].style.visibility == "hidden"){
		WorkSpace[1].style.visibility = "visible";
		WorkSpace[1].style.position = "fixed";
	}else{
		WorkSpace[1].style.visibility = "hidden";
		WorkSpace[1].style.position = "absolute";
	}
}*/
function onnotifclick(elem){
	document.getElementById("addstuddoc").style.visibility = "visible";
	document.getElementById("studname").innerHTML = elem.attributes[4].nodeValue;
	document.getElementById("groundname").innerHTML = elem.attributes[3].nodeValue;
}
function Export2Doc(element, filename = ''){
    var preHtml = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Export HTML To Doc</title></head><body>";
    var postHtml = "</body></html>";
    var html = preHtml+document.getElementById(element).innerHTML+postHtml;

    var blob = new Blob(['\ufeff', html], {
        type: 'application/msword'
    });
    
    var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);
    
    filename = filename?filename+'.doc':'document.doc';
    
    var downloadLink = document.createElement("a");

    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob ){
        navigator.msSaveOrOpenBlob(blob, filename);
    }else{
        downloadLink.href = url;
        
        downloadLink.download = filename;
        
        downloadLink.click();
    }
    
    document.body.removeChild(downloadLink);
}
function CopareAddr(){
	document.getElementsByName("FAre")[1].value = document.getElementsByName("RAre")[1].value;
	document.getElementsByName("FStr")[1].value = document.getElementsByName("RStr")[1].value;
	document.getElementsByName("FHou")[1].value = document.getElementsByName("RHou")[1].value;
}
function ChangeClass(elem){
	if(elem.className.includes("erroplaceholder")){
		elem.className = elem.className.replace('erroplaceholder', '');
		elem.placeholder = elem.trueplaysholder;
	}
}
function setCursorPosition(pos, elem) {
    elem.focus();
    if (elem.setSelectionRange) elem.setSelectionRange(pos, pos);
    else if (elem.createTextRange) {
        var range = elem.createTextRange();
        range.collapse(true);
        range.moveEnd("character", pos);
        range.moveStart("character", pos);
        range.select()
    }
}

function mask(event) {
    var matrix = event.currentTarget.getAttribute('defaultValue'),
        i = 0,
        def = matrix.replace(/\D/g, ""),
        val = event.currentTarget.value.replace(/\D/g, "");
        def.length >= val.length && (val = def);
    matrix = matrix.replace(/[_\d]/g, function(a) {
        return val.charAt(i++) || "_"
    });
    event.currentTarget.value = matrix;
    i = matrix.lastIndexOf(val.substr(-1));
    i < matrix.length && matrix != event.currentTarget.defaultValue ? i++ : i = matrix.indexOf("_");
    setCursorPosition(i, event.currentTarget)
}
function ChekSymb(input) { 
    var value = input.value; 
    var rep = /[-\.;":'a-zA-Zа-яА-Я]/; 
    if (rep.test(value)) { 
        value = value.replace(rep, ''); 
        input.value = value; 
    } 
}
function onthclick(event){
    if (event.target.tagName == 'TH')
    	sortGrid(event.target.cellIndex, event.target.getAttribute('data-type'),event.target);
}
function sortGrid(colNum, type, elem) {
	var grid = elem.parentNode.parentNode.parentNode;
    var tbody = grid.getElementsByTagName('tbody')[0];
    var rowsArray = [].slice.call(tbody.rows);
    var compare;
    switch (type) {
		case 'number':
	       	compare = function(rowA, rowB) {
	       		return rowA.cells[colNum].innerHTML - rowB.cells[colNum].innerHTML;
	    	};
	       	break;
	    case 'string':
	       	compare = function(rowA, rowB) {
	           	return rowA.cells[colNum].innerHTML.charCodeAt(0) < rowB.cells[colNum].innerHTML.charCodeAt(0);
	       	};
	       	break;
    }
    rowsArray.sort(compare);
    grid.removeChild(tbody);
for (var i = 0; i < rowsArray.length; i++) {
       	tbody.appendChild(rowsArray[i]);
    }
  	grid.appendChild(tbody);
}
function ShowHideReq(hide){
	var table = document.getElementById("_Request").getElementsByTagName("tr");
	for (var i = 0; i < table.length; i++) {
		if(hide==true){
			if(table[i].className.includes('bg-light-pink'))
				table[i].style.display = "none";
		}else{
			if(table[i].className.includes('bg-light-pink'))
				table[i].style.display = "table-row";
		}
	}
}
function BtSideMenu(flag,elem){
	 if(flag==true){
	 	document.getElementById('_CrRequestForm').style.visibility = 'hidden';
	 	document.getElementById('_CrRequestForm').style.position = 'absolute';
	 }else{
	 	var group = document.getElementsByName("_clearned");
		for(var j=group.length-1; j>-1 ;j--){
			group[j].parentNode.removeChild(group[j]);
		}
		document.getElementById('_CrRequestForm').style.visibility = 'visible';
	 	document.getElementById('_CrRequestForm').style.position = 'static';
	 }
} 