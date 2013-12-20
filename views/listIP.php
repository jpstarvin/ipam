<?php

include($settings['site_path'] . 'inc/nav.php');
include($settings['site_path'] . 'controllers/listController.php');

?>
	<div id="wrapper">
		<div class="clear"></div>
		<div class="nav-left">
			<?php include($settings['site_path'] . 'inc/left-nav.php');?>
		</div>
		<div class="content">
			<br />
			<?php if($_REQUEST['a']<>'search'){?>
			<table id="subnet-info">
				<tr>
					<th>Network Name</th>
					<td><?php echo $network['name'];?></td>
				</tr>
				<tr>
					<th>Network</th>
					<td><?php echo $network['network'];?></td>
				</tr>
				<tr>
					<th>Exclusions</th>
					<td><?php echo $network['exclusion_list'];?></td>
				</tr>
				<tr>
					<th>SNMP</th>
					<td><?php echo $network['snmp'];?></td>
				</tr>
				<?php if ($_SESSION['role'] == 'Manager' || $_SESSION['role'] == 'Administrator'){?>
				<tr>
					<td><?php echo "<a href='#' title='Add IP' onClick='openModal(\"". $settings['site_path'] . "ipfunctions.php?m=modal&netid=". $_REQUEST['netid'] . "\");'><img src='" . $settings['site_path'] . "images/add.png' /></a>";?></td>
				</tr>
				<?php } ?>
			</table>
			<?php } ?>
			
			<div class="ipTable">
			<table id="myTable" class="tablesorter">
				<thead>
					<tr>
						<th>IP Address</th>
						<th>Device Name</th>
						<th>Device Type</th>
						<th>Description</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach ($ipaddr as $ip){
							echo "<tr>";
							echo "<td>" . $ip['ipaddress'] . "</td>";
							echo "<td>" . $ip['devicename'] . "</td>";
							echo "<td>" . $ip['devicetype'] . "</td>";
							echo "<td>" . $ip['desc'] . "</td>";
							echo "<td align='right' width='80px'>
								<a href='#' title='Notes: " . $ip['notes'] . "' class='tooltip'><span title='More'><img src='" . $settings['site_path'] . "images/info.png' /></span></a>";
							if($_SESSION['role'] == 'Manager' || $_SESSION['role'] == 'Administrator'){
								echo " 
								<a href='#' title='Edit' onClick='openModal(\"". $settings['site_path'] . "ipfunctions.php?m=modal&id=" . $ip['id'] . "\",\"" . $_REQUEST['a'] ."\");'><img src='" . $settings['site_path'] . "images/edit.png' /></a>
								<a href='#' onClick='confirmDelete(\"" . $settings['site_path'] . "?v=listIP&netid=" . $ip['netid'] . "&a=delete&id=" . $ip['id'] . "\")' title='Delete'><img src='" . $settings['site_path'] . "images/delete.png' /></a>";
							}
							echo "</td>";
							echo "</tr>";
						}
					?>
				</tbody>
			</table>
			</div>
			</div>
			
