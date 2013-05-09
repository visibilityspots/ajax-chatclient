<div class='boxSpace'>
	<div id="navcontainer">
		<ul id="navlist">
			<?php switch ($titel) {
				case "Home":
					echo "<li id=\"active\"><a href=\"#\" id=\"current\">$titel</a></li>";
					?>
					<li style="visibility: hidden" id="chatMenu"><a href="index.php?title=chat">Chat</a></li>
					<?php
					break;
						
				case "chat":
					?>
					<li id="homeMenu"><a href="index.php">Home</a></li>
					<?php
					echo "<li id=\"active\"><a style=\"visibility: hidden\" href=\"#\" id=\"current\">$titel</a></li>";
					break;			
											
				default:
					echo "<li id=\"active\"><a href=\"#\" id=\"current\">$titel</a></li>";
					?>
					<li id="chatMenu"><a style="visibility: hidden" href="index.php?title=chat">Chat</a></li>
					<?php
					break;
			}?>
		</ul>
	</div>
</div>



                                                                
