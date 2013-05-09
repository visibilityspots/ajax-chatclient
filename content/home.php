<div class='box'>
	<div class='boxtop'>
		<div></div>
	</div>
  	<div class='boxcontent' align="center">
  	<div id="login">
  	<table>			
	  		<tr>
	  			<td colspan="2"><h6>Inloggen</h6></td>
	  		</tr>
	  		<tr>
	  			<td>Naam:</td>
	  			<td><input type="text" id="name"></td>
	  		</tr>
	  		<tr>
	  			<td>Wachtwoord:</td>
	  			<td> <input type="password" id="pass"></td>
	  		</tr>
	  		<tr>
	  			<td colspan="2"><input type="button" id="btnLogin" value="Login" onclick="login()"></td>

	  		</tr>
	  		<tr>
	  			<td colspan="2"><p id="paraReg" onclick="activateRegister()">Registreer</p></td>
	  		</tr>
	</table>
	</div>
	<div id="register" style="visibility: collapse">
  	<table>			
	  		<tr>
	  			<td colspan="2"><h6>Registreren</h6></td>
	  		</tr>
	  		<tr>
	  			<td>Naam:</td>
	  			<td><input type="text" id="nameNew"></td>
	  		</tr>
	  		<tr>
	  			<td>Wachtwoord:</td>
	  			<td> <input type="password" id="passNew"></td>
	  		</tr>
	  		<tr>
	  			<td colspan="2"><input type="button" id="btnRegister" value="Register" onclick="register()"></td>
	  		</tr>
	</table>
	</div>
	<div id="chat" style="visibility: collapse;"  >
		<TABLE RULES=COLS FRAME=VSIDES>
			<TR>
   			  	<td>
   			  		<div id="testing"></div>
   			  	
   			  	</td>
   			  	<TD align="center">
  					<h6>Buddies</h6>
  					<hr>
  					<div id="deelnemers" align="left"></div>
  					<hr>  					
  					<div id="buddiesToevoegen"><p onclick="toevoegen()">Toevoegen</p></div>
  				</TD>
   			  	<td id="status" align="center">
   			  		<h6>Eigen status</h6>
   			  		<hr>
   			  		<div align="left">
   			  		<ul>
   			  			<li onclick="statusWijzigen('online')">Online</li>
   			  			<li style="font-style: italic" onclick="statusWijzigen('afwezig')">Afwezig</li>
   			  			<li style="text-decoration: line-through" onclick="statusWijzigen('offline')">Offline</li>
   			  		</ul>
   			  		</div>
   			  		<hr>
   			  		<div>
   			  		<p style="text-transform: uppercase" id="statusGebruiker"></p>
   			  		</div>
   			  	</td>
   			</TR>
   			<TR>
		      	<TD colspan="4" align="center">
					<hr>
					<Input type="text" id="bericht" readonly="readonly">
					<input type="button" id="btnSend" value="Send" onclick=sendMessage() disabled="disabled">
		        </TD>
			   </TR>
		</TABLE>
	</div>
	<div id="toevoegenDiv" style="visibility: collapse;" align="center">
		<TABLE>
      		<TR>
            	<TD id="knoppen" align="left"></TD>
      		</TR>
      		<tr>
      			<td id="test"><input type="button" id="btnKlaar" value="Klaar" onclick="klaar()"></td>
      		</tr>
		</TABLE>
	</div>
	</div>
	<div class='boxbottom'>
		<div></div>
	</div>
</div>