<!doctype html>
<html lang="us">
<head>
	<meta charset="utf-8">
	<title><?php echo $settings['site_name'];?></title>
	<link href="css/site.css" rel="stylesheet">
	<link href="css/tablesorter.css" rel="stylesheet">
	<script src="js/jquery-1.9.1.js"></script>
	<script src="js/common.js"></script>
	<script src="js/jquery.tablesorter.min.js"></script>
	<script src="js/ddaccordion.js"></script>
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	
	<script type="text/javascript">

		ddaccordion.init({
			headerclass: "headerbar", //Shared CSS class name of headers group
			contentclass: "submenu", //Shared CSS class name of contents group
			revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
			mouseoverdelay: 50, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
			collapseprev: true, //Collapse previous content (so only one open at any time)? true/false
			defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
			onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
			animatedefault: false, //Should contents open by default be animated into view?
			persiststate: true, //persist state of opened contents within browser session?
			toggleclass: ["", "selected"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
			togglehtml: ["", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
			animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
			oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
				//do nothing
			},
			onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
				//do nothing
			}
		})
		
	</script>
	
	<script>
		$(document).ready(function () {
			$("#myTable").tablesorter({ sortList:[[0,0]], headers: {0:{sorter:"ipAddress"}, 4:{sorter:false}}}); 
		});
		
		$(document).ready(function () {
                        $("#networks").tablesorter({ sortList:[[1,0]], headers: {3:{sorter:false}, 6:{sorter:false}}});
                });
                $(document).ready(function () {
                        $("#netgroups").tablesorter({ sortList:[[0,0]], headers: {2:{sorter:false}}});
                });

	</script>
	

		
</head>

<body>

	<div id="header">
		<div id="logo"><img src="<?php echo $settings['logo'];?>" /></div>
		<div id="head-title"><?php echo $settings['site_title'];?></div>
	</div>
