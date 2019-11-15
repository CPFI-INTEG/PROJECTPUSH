<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'sql5019.site4now.net');
define('DB_USERNAME', 'db_9e5097_s3056_1_admin');
define('DB_PASSWORD', 'cpfi2015');
define('DB_NAME', 'db_9e5097_s3056_1');
 
/* Attempt to connect to MySQL database */
$link = sqlsrv_query(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . sqlsrv_query_error());
}
?>