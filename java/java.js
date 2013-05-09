var idSender;
var idRecipient;
var stateUser;

setTimeout(checkMessages, 2000);setTimeout('loadDeelnemers(idSender)', 2000);
function createRequestObject() {
	if (window.XMLHttpRequest) {
		xHRObject = new XMLHttpRequest();
	}
	else if (window.ActiveXObject) {
		xHRObject = new ActiveXObject("Microsoft.XMLHTTP");
	}
}

function login() {
	createRequestObject();
	var name = document.getElementById('name').value;
	var pass = document.getElementById('pass').value;
	xHRObject.onreadystatechange=stateLoginChanged 
    xHRObject.open("GET","java/processLogin.php?name="+name+"&pass="+pass,true)
    xHRObject.send(null)
}

function stateLoginChanged() {
	 if (xHRObject.readyState==4) {
	 	if(xHRObject.status == 200) {
	 		var response = xHRObject.responseText;
	 		var response = response.split(";");
	 		
	 		var id = response[0];
	 		stateUser = response[1];
	 		document.getElementById("statusGebruiker").innerHTML = stateUser;
	 		         
	        if (id == "wrong pass") {
	        	alert("Wrong password, try again");
	        } else {
	         	if (id == "") {
	         		alert("Wrong username, try again");
	         	} else {
	         		document.getElementById("login").style.visibility ="collapse";
	         		document.getElementById("chat").style.visibility="visible";
	        		document.getElementById("active").style.visibility ="visible";
	       			idSender = id;
	       			//window.onmouseout = statusWijzigen('afwezig');
	       			loadDeelnemers(id);	         	
	         	} 
	     	} 
	 	}
	}
}

function loadDeelnemers(id) {
	createRequestObject();
	xHRObject.onreadystatechange=stateLoadDeelnemersChanged
    xHRObject.open("GET","java/processDlnList.php?id="+id,true)
    xHRObject.send(null)
    setTimeout('loadDeelnemers(idSender)', 2000);
}

function stateLoadDeelnemersChanged() {
	 if (xHRObject.readyState==4) {
	 	if(xHRObject.status == 200) {
	 		var serverResponse = xHRObject.responseXML;
	 		
	 		var dataArray = serverResponse.getElementsByTagName('id');
	 		var dataArrayNames = serverResponse.getElementsByTagName('name');
	 		var dataArrayStates = serverResponse.getElementsByTagName('state');
	 		
	 		var dataArrayLen = dataArray.length;
	 		
	 		var data = "<ul>";
			for (var i=0; i<dataArrayLen; i++){
				if (dataArrayStates[i].firstChild.nodeValue == "online"){
					data += '<li id="' + dataArray[i].firstChild.nodeValue + '" onclick="activateChat(this.id)">'+ dataArrayNames[i].firstChild.nodeValue + '</li>';
				} else {
					if (dataArrayStates[i].firstChild.nodeValue == "afwezig"){
						data += '<li style="font-style: italic" onclick="activateChat(this.id)" id="' + dataArray[i].firstChild.nodeValue + '">'+ dataArrayNames[i].firstChild.nodeValue + '</li>';
					} else {
						data += '<li style="text-decoration: line-through" id="' + dataArray[i].firstChild.nodeValue + '">'+ dataArrayNames[i].firstChild.nodeValue + '</li>';
					}
			}
			}
			data += "</ul>";
			//window.onmouseout = statusWijzigen('afwezig');
			document.getElementById ('deelnemers').innerHTML = data;
	     } 
	 }  
}

function activateRegister() {
	document.getElementById('login').style.visibility ="collapse";
	document.getElementById('register').style.visibility ="visible";
}

function register() {
	createRequestObject();
	var name = document.getElementById("nameNew").value;
	var pass = document.getElementById("passNew").value;
	xHRObject.onreadystatechange=registred
	xHRObject.open("GET","java/register.php?name="+name+"&pass="+pass,true)
	xHRObject.send(null);
}

function registred() {
	document.getElementById('login').style.visibility ="visible";
	document.getElementById('register').style.visibility ="collapse";
}

function statusWijzigen(status) {
	createRequestObject();
	xHRObject.onreadystatechange=statusWeergeven
	xHRObject.open("GET","java/statusWijzigen.php?id="+idSender+"&status="+status,true)
	xHRObject.send(null);
}

function statusWeergeven(){
	if (xHRObject.readyState==4) {
	 	if(xHRObject.status == 200) {
	 		var serverResponse = xHRObject.responseText;
	 		document.getElementById("statusGebruiker").innerHTML = serverResponse;
	 	}
	 }
}


function toevoegen() {
	document.getElementById('chat').style.visibility = "collapse";
	createRequestObject();
	xHRObject.onreadystatechange=weergeven
	xHRObject.open("GET","java/ophalen.php?id="+idSender,true)
	xHRObject.send(null);
}

function weergeven() {
	if (xHRObject.readyState==4) {
	 	if(xHRObject.status == 200) {
	 		var serverResponse = xHRObject.responseXML;
	 				
	 		var dataArray = serverResponse.getElementsByTagName('id');
	 		var dataArrayNames = serverResponse.getElementsByTagName('name');
	 		var dataArrayChecked = serverResponse.getElementsByTagName('checked');
	 		
	 		var data = "";
	 		var dataArrayLen = dataArray.length;
	 		
			for (var i=0; i<dataArrayLen; i++){
				if (dataArray[i].firstChild.nodeValue == idSender) {
					data += '<INPUT TYPE="checkbox" DISABLED="DISABLED" CHECKED="'+ dataArrayChecked[i].firstChild.nodeValue +'"NAME="buddie" VALUE="'+dataArray[i].firstChild.nodeValue +'">'+ dataArrayNames[i].firstChild.nodeValue+'</br>';
				} else {
					if (dataArrayChecked[i].firstChild.nodeValue == "checked"){
						data += '<INPUT TYPE="checkbox" onchange="buddieOpslaan(this.value,this.checked)" CHECKED="'+ dataArrayChecked[i].firstChild.nodeValue +'"NAME="buddie" VALUE="'+dataArray[i].firstChild.nodeValue +'">'+ dataArrayNames[i].firstChild.nodeValue+'</br>';
					} else {
						data += '<INPUT TYPE="checkbox" onchange="buddieOpslaan(this.value,this.checked)" NAME="' + dataArray[i].firstChild.nodeValue + '" VALUE="'+dataArray[i].firstChild.nodeValue +'">'+ dataArrayNames[i].firstChild.nodeValue+'</br>';
					}
				}
			}
			document.getElementById ('knoppen').innerHTML = data;
			document.getElementById('toevoegenDiv').style.visibility = "visible";		
		}
	}
}

function klaar(){
	document.getElementById('toevoegenDiv').style.visibility = "collapse";
	document.getElementById('chat').style.visibility = "visible";
}
function buddieOpslaan(id,value){
	createRequestObject();
	//xHRObject.onreadystatechange=toevoegen
	xHRObject.open("GET","java/processBuddie.php?id="+idSender+"&idBud="+id+"&value="+value,true)
	xHRObject.send(null);
}

function activateChat(id) {
	idRecipient = id;
	document.getElementById("btnSend").disabled="";
	document.getElementById("bericht").removeAttribute('readOnly');
}

function sendMessage() {
	createRequestObject();
	var message = document.getElementById("bericht").value;
	document.getElementById("bericht").value = "";
	xHRObject.onreadystatechange=check
	xHRObject.open("GET","java/processMessage.php?message="+message+"&idRec="+idRecipient+"&idSen="+idSender,true)
	xHRObject.send(null);	
}	 	

function check(){
	document.getElementById("btnSend").disabled="disabled";
	document.getElementById("bericht").setAttribute('readOnly');
}

function checkMessages(){
	createRequestObject();
	xHRObject.onreadystatechange=showMessages
	xHRObject.open("GET","java/getMessages.php?idSen="+idSender,true);
	xHRObject.send(null);
	setTimeout(checkMessages, 2000);
}

function showMessages(){
	 if (xHRObject.readyState==4) {
	 	if(xHRObject.status == 200) {
			var serverResponse = xHRObject.responseXML;
	 		
	 		var dataArrayVerzender = serverResponse.getElementsByTagName('van');
	 		var dataArrayBoodschap = serverResponse.getElementsByTagName('boodschap');
	 		var dataArrayTijdstippen = serverResponse.getElementsByTagName('tijdstip');
	 		//var lastUpdate = serverResponse.getElementsByTagName('lastupdate');
	 		
	 		var dataArrayLen = dataArrayVerzender.length;
	 		
	 		var data = "";
	 		var verschil = "";
			
			for (var i=0; i<dataArrayLen; i++){
				data += '<p>('+dataArrayTijdstippen[i].firstChild.nodeValue +') ' + dataArrayVerzender[i].firstChild.nodeValue + ': '+ dataArrayBoodschap[i].firstChild.nodeValue + '</p>';				
			}
			
			document.getElementById ('testing').innerHTML = data;
	     } 
	 }  
}