	<nav>
		<ul class="navbar">
			<li><a href="?v=dash">Home</a></li>
			<?php if ($_SESSION['role'] == 'Administrator'){ //Display menu only for Admins?>
			<li><a href="#">Admin</a>
				<ul>
					<li><a href="?v=admin&m=netgroup">Manage Netgroups</a></li>
					<li><a href="?v=admin&m=network">Manage Networks</a></li>
					<li><a href="?v=admin&m=users">Manage Users</a></li>
					<li><a href="?v=admin&m=site">Site Settings</a></li>
					<hr>
					<li><a href="?logout=logout">Logout</a></li>
				</ul>
			</li>
			<? }else{?>
			<li><a href="?logout=logout">Logout</a></li>	
			<?php }?>
			<li class="nav-search">
				<form name="search" method="post" action="<?php echo $settings['site_path'];?>?v=listIP&a=search">
					<nobr></nobr><input type="text" name="keyword" placeholder="Search..."><input type="image" src="<?php echo $settings['site_path'];?>images/search.png" height="20px" width="20px"/></nobr>
				</form>
			</li>
			
	
		</ul>
	</nav>
	<div id="navspacer"></div>
