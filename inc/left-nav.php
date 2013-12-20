<?php 
//Get the menu items from the database
$navs=getNav($dbh);

echo '<div class="urbangreymenu">';
$netname = '';
$lock = 0;
//Loop through the query results
foreach($navs as $nav){
	if ($netname <> $nav['netname']){
		if(($lock==1)){
			echo '</ul>';
		}	
		$netname = $nav['netname'];
		echo '<h3 class="headerbar"><a href="#">' . $netname . '</a></h3>';
		echo '<ul class="submenu">';
	}
	$lock=1;
	echo '<li><a href="?v=listIP&netid=' . $nav['id'] . '">' . $nav['name'] . '</a></li>';
}?>

</div>
