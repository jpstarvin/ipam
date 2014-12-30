<?php

session_start();
if ($_SESSION['isLoggedIn'] <> 'yes'){
	echo'<script>window.close();</script>';
}

require('config.php');

include($settings['site_path'] . 'inc/modal_header.php');
include($settings['site_path'] . 'controllers/listController.php');

if ($_REQUEST['a'] <> ''){
	echo'<script>
		window.opener.location.reload();
		window.close();
		</script>';
}

?>

<div id="wrapper">
		<div class="clear"></div>
		<div class="content">
			<div id="formbox">
			<?php
				echo '
					<form name="update" method="post" action="' . $settings['site_path'] .'ipfunctions.php?a=' . $form . '">
					<input type="hidden" name="id" value="'.$ip['id'] .'">
					<input type="hidden" value="0" name="assigned">
					<input type="hidden" name="netid" value="'.$ip['netid'] .'">';
					
				echo'<label for="ipadd">IP Address</label><br />';
				if ($_REQUEST['id'] <> ''){
					echo '<input type="text" name="ipadd" class="ui-corner-all" value="' . $ip['ipaddress'] .'" readonly>';
				}else{
					echo '<select name="ipadd" class="ui-corner-all">';
					
					foreach($ipaddr as $ip){
						if($ip['used']==0){
							echo '<option value="' . $ip['id'] .'">' . $ip['ipaddress'] .'</option>';
						}
					}
					echo '</select>';
				}
				echo'
					<br />					
					<label for="devname">Device Name</label><br />
					<input type="text" name="devname" class="ui-corner-all" value="' . $ip['devicename'] .'">
					<br />
					<label for="devtype">Device Type</label><br />
					<select name="devtype" class="ui-corner-all">';
					switch($ip['devicetype']){
						case "Router": $s1 = "selected='selected'";
										break;
						case "Switch": $s2 = "selected='selected'";
										break;
						case "AP": $s3 = "selected='selected'";
										break;
						case "Server": $s4 = "selected='selected'";
										break;
						case "Desktop": $s5 = "selected='selected'";
										break;
						case "Printer": $s6 = "selected='selected'";
										break;
						case "Laptop": $s7 = "selected='selected'";
										break;
						case "Camera": $s8 = "selected='selected'";
										break;
						case "Video": $s9 = "selected='selected'";
										break;							
						case "Other": $s10 = "selected='selected'";
										break;
										
					}
					echo'
						<option value="Router" ' . $s1 . '>Router</option>
						<option value="Switch" ' . $s2 . '>Switch</option>
						<option value="AP" ' . $s3 . '>AP</option>
						<option value="Server" ' . $s4 . '>Server</option>
						<option value="Desktop" ' . $s5 . '>Desktop</option>
						<option value="Printer" ' . $s6 . '>Printer</option>
						<option value="Laptop" ' . $s7 . '>Laptop</option>
						<option value="Camera" ' . $s8 . '>Camera</option>
						<option value="Video" ' . $s9 . '>Video</option>
						<option value="Other" ' . $s10 . '>Other</option>
					</select>
					<br />
					<label for="desc">Description</label><br />
					<textarea name="desc" class="ui-corner-all">' . $ip['desc'] .'</textarea>
					<br />
					<label for="notes">Notes</label><br />
					<textarea name="notes" class="ui-corner-all" >' . $ip['notes'] .'</textarea>
					<br />
					<label for="assign">Assigned?</label>';
					
					if($ip['used']==1){
						echo '<input type="checkbox" name="assigned" value="1" checked="checked">';
					}else{
						echo '<input type="checkbox" name="assigned" value="1">';
					}
					echo'
					<br />
					<input type="submit" name="Submit" class="submit" value="' . ucfirst($form) . '">
					<input type="button" name="Cancel" value="Cancel" class="cancel" onClick="window.close();">
					</form>'; 
				
			?>
		</div></div>		



</div>

</body>
</html>
