<?php
include($settings['site_path'] . 'controllers/loginController.php');

?>

<nav>
	<ul class="navbar">
		<li><a>Login</a></li>
	</ul>
</nav>

<div id="wrapper">
	<div class="clear"></div>
	<div class="logincontent">
	<section class="loginform cf">
		<form name="login" action="?v=login&a=login" method="post" accept-charset="utf-8">
				<input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
				<label for="username">Username</label>
				<input type="text" name="username" placeholder="Username" required>
				<br /><br />
				<label for="password">Password</label>
				<input type="password" name="password" placeholder="Password" required>
				<br />				
				<input type="submit" value="Login">
		</form>
	</section>
	</div>
