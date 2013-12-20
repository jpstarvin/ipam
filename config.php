<?php

/************************************************************
 * filename = config.php
 * 
 * This file contains the global site settings not stored in
 * the database. These settings are loaded into APC Cache.
 ************************************************************/
 
 //General Settings
 $settings['site_name'] = "IPAMTest";
 $settings['site_title'] = "MVC IP Address Management";
 $settings['site_path'] = "./";
 $settings['logo'] =  "./images/logo.png"; //image should be within 80px X 140px
 
 //Database settings
 $settings['dbhost'] = "localhost";
 $settings['dbname'] = "ipam";
 $settings['dbuser'] = "ipam";
 $settings['dbpass'] = "ip12#4";
 //Authentication settings
 
$settings['auth_method'] = "local";
//AD Specific settings
$settings['ad_domain_controller'] = "";
$settings['ad_domain_suffix'] = "";
$settings['ad_base_dn'] = "";
$settings['ad_user'] = "";
$settings['ad_pass'] = "";
$settings['ad_admin_group'] = "";
$settings['ad_manager_group'] = "";
$settings['ad_view_group'] = "";
?>