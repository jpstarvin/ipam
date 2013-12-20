<?php

include($settings['site_path'] . 'inc/nav.php');
include($settings['site_pathe'] . 'controllers/dashController.php');

?>
	<div id="wrapper">
		<div class="clear"></div>
		<div class="nav-left">
			<?php include($settings['site_path'] . 'inc/left-nav.php');?>
		</div>
		<div class="content">
			<h3>Welcome, <font color="#990000"><?php echo $_SESSION['username'];?></font></h3>
			<hr />
			<div><table class="dash-info formcolumn">
				<tr>
					<th width="250px">Networks</td>
					<th>Used IPs</td>
				</tr>
				<?php //loop through networks to print in table
					foreach($nets as $net){
						echo '<tr>';
						echo '<td><a href="?v=listIP&netid=' . $net['id'] . '">' . $net['name'] . '</a></td>';
						echo '<td align="center">' . $ipcount[$net['id']] . '</td>';
						echo '</tr>';
					}
					?>
			</table>
			<table class="dash-info formcolumn">
				<tr>
					<th colspan="2">Last 5 Logins</th>
				</tr>
				<tr>
					<th>Username</th>
					<th>IP Address</th>
				</tr>
				<?php
					foreach($latest as $l){
						echo "<tr><td>" . $l['user'] . "</td><td>" . $l['ipaddress'] . "</td></tr>";
					}
				?>
			</table></div>
			<br />
			<!-- START CHART CREATION SCRIPT -->
			<script type="text/javascript">

			      // Load the Visualization API and the piechart package.
			      google.load('visualization', '1.0', {'packages':['corechart']});
			
			      // Set a callback to run when the Google Visualization API is loaded.
			      google.setOnLoadCallback(drawChart);
			
			      // Callback that creates and populates a data table,
			      // instantiates the pie chart, passes in the data and
			      // draws it.
			      function drawChart() {
			
			        // Create the data table.
			        var data = google.visualization.arrayToDataTable([
					  ['Stat', 'Visitors', { role: 'style' }],
					  ['Current Visitors', <?=$current?>, 'blue'],
					  ['Total Visitors', <?=$total?>, '#993300']
					]);

			
			        // Set chart options
			        var options = {'title':'Site Stats',
			                       'width':600,
			                       'height':250};
			
			        // Instantiate and draw our chart, passing in some options.
			        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
			        chart.draw(data, options);
			      }
			</script>
			<!--Div that will hold the pie chart-->
    		<div id="chart_div" align="center"></div>
		</div>
