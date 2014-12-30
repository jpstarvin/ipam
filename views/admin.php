<?php

include($settings['site_path'] . 'inc/nav.php');
include($settings['site_path'] . 'controllers/adminController.php');

?>
	<div id="wrapper">
		<div class="clear"></div>
		<div class="nav-left">
			<?php include($settings['site_path'] . 'inc/admin-left-nav.php');?>
		</div>
		<div class="content">
			<div id="adminformbox">
			<?php if($manage == 'netgroup') {
				//BEGIN NETGROUP DISPLAY
				?>
				<form name="update" method="post" action="<?php echo $settings['site_path'];?>?v=admin&m=netgroup&a=<?php echo $form;?>">
					<input type="hidden" name="id" value="<?php echo $netgroup['id'];?>" >
					<div class="formcolumn">
					<label for="name">Netgroup Name</label>
					<input type="text" name="name" class="ui-corner-all" value="<?php echo $netgroup['name'];?>" placeholder="Netgroup Name" required>
					<br />
					<label for="desc">Description</label>
					<textarea name="desc" class="ui-corner-all"><?php echo $netgroup['desc'];?></textarea>
					</div><br />
					<button type="submit" class="submit"><?php echo ucfirst($form);?></button>
					<input type="button" name="Cancel" value="Cancel" class="cancel" onClick="window.location='?v=admin&m=netgroup';">					
				</form></div>
				<div class="ipTable">
					<table id="netgroups" class="tablesorter">
						<thead>
							<tr>
								<th>Name</th>
								<th>Descrition</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach ($netgroups as $netgroup){
									echo "<tr>";
									echo "<td>" . $netgroup['name'] . "</td>";
									echo "<td>" . $netgroup['desc'] . "</td>";
									echo "<td align='right' width='80px'>
										<a href='". $settings['site_path'] . "?v=admin&m=" . $manage ."&a=update&id=" . $netgroup['id'] . "' title='Edit' ><img src='" . $settings['site_path'] . "images/edit.png' /></a>
										<a style='cursor:pointer;' onClick='confirmNetgroupDelete(\"" . $settings['site_path'] . "?v=admin&m=" . $manage ."&a=delete&id=" . $netgroup['id'] . "\")' title='Delete'><img src='" . $settings['site_path'] . "images/delete.png' /></a>
										</td>";
									echo "</tr>";
								}
							?>
						</tbody>
					</table>
				</div>
			<?php } //END NETGROUPS DISPLAY
			elseif($manage == 'network') { 
				//START NETWORKS DISPLAY
				?>
				<form name="update" method="post" action="<?php echo $settings['site_path'];?>?v=admin&m=network&a=<?php echo $form;?>">
					<input type="hidden" name="id" value="<?php echo $net['id'];?>" >
					<div class="formcolumn">
					<label for="netgroup">Network Group</label>
					<select name="netgroup" class="ui-corner-all" >';
					<?php
					//Loop through the query results
					foreach($netgroups as $group){
						if($net['netgroup'] == $group['id']){
							echo '<option value="' . $group['id']. '" selected="selected">' . $group['name'] .'</option>';	
						}else{
							echo '<option value="' . $group['id']. '">' . $group['name'] .'</option>';
						}
					}
					?>
					</select>
					<br />
					<label for="name">Name</label>
					<input type="text" name="name" class="ui-corner-all" value="<?php echo $net['name'];?>" placeholder="Network Name" required>
					<br />
					<label for="network">Network</label>
					<input type="text" name="network" class="ui-corner-all" value="<?php echo $net['network'];?>" placeholder="192.168.1.0/24" required>
					</div>
					<div class="formcolumn">
                                        <label for="vlan">Vlan ID</label>
                                        <input type="text" name="vlan" class="ui-corner-all" value="<?php echo $net['vlan'];?>" placeholder="Vlan ID" required>
                                        <br />
					<label for="exclusion">Exclusion List</label>
					<textarea name="exclusion" class="ui-corner-all"><?php echo $net['exclusion_list'];?></textarea>
					<br />
					<label for="snmp">SNMP Communities</label>
					<textarea name="snmp" class="ui-corner-all"><?php echo $net['snmp'];?></textarea>
					</div><br />
					<button type="submit" class="submit"><?php echo ucfirst($form);?></button>
					<input type="button" name="Cancel" value="Cancel" class="cancel" onClick="window.location='?v=admin&m=network';">					
				</form></div>
				<div class="ipTable">
					<table id="networks" class="tablesorter">
						<thead>
							<tr>
								<th>Name</th>
								<th>Netgroup</th>
								<th>Network</th>
								<th>Vlan ID</th>
								<th>Exclusions</th>
								<th>SNMP</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach ($networks as $net){
									if($net['name']<>''){
										echo "<tr>";
										echo "<td>" . $net['name'] . "</td>";
										echo "<td>" . $net['netname'] . "</td>";
										echo "<td>" . $net['network'] . "</td>";
										echo "<td>" . $net['vlan'] . "</td>";
										echo "<td>" . $net['exclusion_list'] . "</td>";
										echo "<td>" . $net['snmp'] . "</td>";
										echo "<td align='right' width='80px'>
											<a href='". $settings['site_path'] . "?v=admin&m=" . $manage ."&a=scan&id=" . $net['id'] . "' title='Scan' ><img src='" . $settings['site_path'] . "images/scan.png' /></a>
											<a href='". $settings['site_path'] . "?v=admin&m=" . $manage ."&a=update&id=" . $net['id'] . "' title='Edit' ><img src='" . $settings['site_path'] . "images/edit.png' /></a>
											<a style='cursor:pointer;' onClick='confirmNetworkDelete(\"" . $settings['site_path'] . "?v=admin&m=" . $manage ."&a=delete&id=" . $net['id'] . "\")' title='Delete'><img src='" . $settings['site_path'] . "images/delete.png' /></a>
											</td>";
										echo "</tr>";
									}
								}
							?>
						</tbody>
					</table>
				</div>
				<?php } //END NETWORKS DISPLAY
			elseif($manage == 'users') { 
				//START USERS DISPLAY
				?>
				<form name="update" method="post" action="<?php echo $settings['site_path'];?>?v=admin&m=users&a=<?php echo $form;?>">
					<input type="hidden" name="id" value="<?php echo $user['id'];?>" >
					<div class="formcolumn">
					<label for="username">Username</label>
					<input type="text" name="username" class="ui-corner-all" value="<?php echo $user['username'];?>" placeholder="Username" required>
					<br />
					<label for="password">Password</label>
					<?php if($form=='add'){
						echo '<input type="password" name="password" class="ui-corner-all" placeholder="Password" pattern=".{2,}" title="Password Required" required>';
					}else{
						echo '<input type="password" name="password" class="ui-corner-all" placeholder="Password">';
					}?>
					</div>
					<div class="formcolumn">
					<label for="fname">First Name</label>
					<input type="text" name="fname" class="ui-corner-all" value="<?php echo $user['fname'];?>" placeholder="First Name">
					<br />
					<label for="lname">Last Name</label>
					<input type="text" name="lname" class="ui-corner-all" value="<?php echo $user['lname'];?>" placeholder="Last Name">
					</div>
					<br />
					<div class="formcolumn">
					<label for="role">Role</label>
					<select name="role" class="ui-corner-all">
						<?php 
						if ($user['role'] == 'Administrator'){
							echo '
								<option value="Administrator" selected="selected">Administrator</option>
								<option value="Manager">Manager</option>
								<option value="View-Only">View-Only</option>';
						}elseif ($user['role'] == 'Manager'){
							echo '
								<option value="Administrator">Administrator</option>
								<option value="Manager" selected="selected"">Manager</option>
								<option value="View-Only">View-Only</option>';
						}else{
							echo '
								<option value="Administrator">Administrator</option>
								<option value="Manager">Manager</option>
								<option value="View-Only">View-Only</option>';
						}
						?>
					</select></div><br />
					<button type="submit" class="submit"><?php echo ucfirst($form);?></button>
					<input type="button" name="Cancel" value="Cancel" class="cancel" onClick="window.location='?v=admin&m=users';">	
					<p style="font-size:8pt;"><strong>Note:</strong>&nbsp;This is only used for local user authentication.</p>				
				</form></div>
				<div class="ipTable">
					<table id="myTable" class="tablesorter">
						<thead>
							<tr>
								<th>Username</th>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Role</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach ($users as $user){
									echo "<tr>";
									echo "<td>" . $user['username'] . "</td>";
									echo "<td>" . $user['fname'] . "</td>";
									echo "<td>" . $user['lname'] . "</td>";
									echo "<td>" . $user['role'] . "</td>";
									echo "<td align='right' width='80px'>
										<a href='". $settings['site_path'] . "?v=admin&m=" . $manage ."&a=update&id=" . $user['id'] . "' title='Edit' ><img src='" . $settings['site_path'] . "images/edit.png' /></a>
										<a style='cursor:pointer;' onClick='confirmDelete(\"" . $settings['site_path'] . "?v=admin&m=" . $manage ."&a=delete&id=" . $user['id'] . "\")' title='Delete'><img src='" . $settings['site_path'] . "images/delete.png' /></a>
										</td>";
									echo "</tr>";
								}
							?>
						</tbody>
					</table>
				</div>
				<?php } //END USERS DISPLAY
			elseif($manage == 'site') { 
				//START SITE SETTINGS DISPLAY
				?>
				<form name="update" method="post" action="<?php echo $settings['site_path'];?>?v=admin&m=site&a=update">
					<div class="formsection">
					<h4>General Settings</h4>
					<hr />
					<label for="sname">Site Name</label>
					<input type="text" name="sname" class="ui-corner-all" value="<?php echo $settings['site_name'];?>">
					<br />
					<label for="stitle">Site Title</label>
					<input type="text" name="stitle" class="ui-corner-all" size="50" value="<?php echo $settings['site_title'];?>">
					<label for="spath">Site Path</label>
					<input type="text" name="spath" class="ui-corner-all" value="<?php echo $settings['site_path'];?>">
					<label for="slogo">Site Logo</label>
					<input type="text" name="slogo" class="ui-corner-all" size="50" value="<?php echo $settings['logo'];?>">
					</div><br />
					<div class="formsection">
					<h4 align="center">Database Settings</h4>
					<hr />
					<label for="dbhost">Database Host</label>
					<input type="text" name="dbhost" class="ui-corner-all" value="<?php echo $settings['dbhost'];?>">
					<br />
					<label for="dbname">Database Name</label>
					<input type="text" name="dbname" class="ui-corner-all" value="<?php echo $settings['dbname'];?>">
					<label for="dbuser">Database User</label>
					<input type="text" name="dbuser" class="ui-corner-all" value="<?php echo $settings['dbuser'];?>">
					<label for="dbpass">Database Password</label>
					<input type="text" name="dbpass" class="ui-corner-all" value="<?php echo $settings['dbpass'];?>">
					</div><br />
					<div class="formsection">
					<h4 align="center">Authentication Settings</h4>
					<hr />
					<label for="auth_method">Authentication Method</label>
					<select name="auth_method">
						<?php 
						if ($settings['auth_method'] == 'local'){
							echo '<option value="local" selected="selected">Local</option>';
							echo '<option value="ldap">LDAP</option>';
						}else{
							echo '<option value="local">Local</option>';
							echo '<option value="ldap" selected="selected">LDAP</option>';
						}
						?>
						
					</select>
					<br/>
					<p>LDAP Settings</p>
					<label for="addc">Domain Controller</label>
					<input type="text" name="addc" class="ui-corner-all" size="50" value="<?php echo $settings['ad_domain_controller'];?>" placeholder="dc1.example.com,dc2.example.com">
					<label for="dsuffix">Domain Suffix</label>
					<input type="text" name="dsuffix" class="ui-corner-all" size="50" value="<?php echo $settings['ad_domain_suffix'];?>" placeholder="@example.com">
					<label for="bdn">Base DN</label>
					<input type="text" name="bdn" class="ui-corner-all" size="50" value="<?php echo $settings['ad_base_dn'];?>" placeholder="dc=example,dc=com">
					<label for="ldapuser">LDAP User</label>
					<input type="text" name="ldapuser" class="ui-corner-all" size="50" value="<?php echo $settings['ad_user'];?>" placeholder="administrator">
					<label for="ldappass">LDAP Pass</label>
					<input type="text" name="ldappass" class="ui-corner-all" size="50" value="<?php echo $settings['ad_pass'];?>" placeholder="password">
					<label for="adadmin">Administrators LDAP Group</label>
					<input type="text" name="adadmin" class="ui-corner-all" size="50" value="<?php echo $settings['ad_admin_group'];?>" placeholder="Admins">
					<label for="admanage">Manager LDAP Group</label>
					<input type="text" name="admanage" class="ui-corner-all" size="50" value="<?php echo $settings['ad_manager_group'];?>" placeholder="Managers">
					<label for="adview">View Only LDAP Group</label>
					<input type="text" name="adview" class="ui-corner-all" size="50" value="<?php echo $settings['ad_view_group'];?>" placeholder="Users">
					</div><br />
					<button type="submit" class="submit">Update</button>
					<input type="button" name="Cancel" value="Cancel" class="cancel" onClick="window.location='?v=admin&m=site';">					
				</form></div>
				<?php
				}  //Close the if statement
				?>
			
		</div>
