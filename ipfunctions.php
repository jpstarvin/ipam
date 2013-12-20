<?php

require('config.php');
include($settings['site_path'] . 'controllers/listController.php');

include($settings['site_path'] . 'inc/modal_header.php');

if ($_REQUEST['a'] <> ''){
	echo'<script>window.close();</script>';
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
					<label for="netid">Network</label><br />
					<select name="netid" class="ui-corner-all" >';
					
					$netname = '';
					//Loop through the query results
					foreach($navs as $nav){
						if ($netname <> $nav['netname']){
							$netname = $nav['netname'];
							echo '<optgroup label="' . $netname . '">';
						}
						if($nav['id'] == $ip['netid']){
							echo '<option value="' . $nav['id']. '" selected="selected">' . $nav['name'] .'</option>';
						}elseif ($nav['id'] == $netid){
							echo '<option value="' . $nav['id']. '" selected="selected">' . $nav['name'] .'</option>';	
						}else{
							echo '<option value="' . $nav['id']. '">' . $nav['name'] .'</option>';
						}
					}
					
				echo'
					</select>
					<br />
					<label for="ipadd">IP Address</label><br />
					<input type="text" name="ipadd" class="ui-corner-all" value="' . $ip['ipaddress'] .'">
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
					<button class="submit" onClick="this.submit();">' . ucfirst($form) . '</button>
					<input type="button" name="Cancel" value="Cancel" class="cancel" onClick="window.close();">
					</form>'; 
				
			?>
		</div></div>		



</div>

</body>
</html>
