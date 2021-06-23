<?php
// /* pgsql */
$DRIVER = 'pgsql';
$SERVER = 'localhost';
$USER = 'postgres';
$PASS = '12345';
$PORT = '5432';
$DATABASE = 'sistemaweb';
define('URLCONNECTION', $DRIVER.':host='.$SERVER.';port='.$PORT.';dbname='.$DATABASE);
define('USER', $USER);
define('PASS', $PASS);