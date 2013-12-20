<?php

include('config.php');

require('controllers/mainController.php');	

include($settings['site_path'] . 'inc/header.php');

getView();

include($settings['site_path'] . 'inc/footer.php');

?>
