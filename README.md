ipam
====

MVC IPAM Project

Version 2.1

Written by Adam Phillips

ABOUT
=====

This is an IP address management webapp. It uses a database backend to 
keep records of use IPs in the networks that are assigned.

This application features the following (some featurse were provided as open source code from third-parties):

Tablesorter 2.0
adLDAP PHP Class
GoogleCharts
ddaccordion for the left nav menu.
HTML5 

REQUIREMENTS
============

PHP5
Apache2
MySQL
Python
  - libsnmp-python
  - python-ipaddr

PHP-LDAP module is required for using LDAP Active Directory authentication.

INSTALLATION
============
Copy all files to the desired webroot.

Verify that the path for the 'include' statements in the inc/scan.php file is correct for your installation.
Import the ipam_database.sql file into MYSQL.

Open a web browser and point it to the location of index.php

Login with admin/admin

LICENSE
=======

This library is free software; you can redistribute it and/or modify it under the terms of the 
GNU Lesser General Public License as published by the Free Software Foundation; either
version 2.1 of the License, or (at your option) any later version.

This library is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; 
without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
See the GNU Lesser General Public License for more details or LICENSE.txt distributed with
this class.

