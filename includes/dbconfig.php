<?php
$dbuser="root";
$dbpass="doggy12345";
$host="localhost";
$dbname = "srms";
mysql_connect($dbhost,$dbuser,$dbpass) or die('cannot connect to the server'); 
mysql_select_db($dbname) or die('database selection problem');
?>