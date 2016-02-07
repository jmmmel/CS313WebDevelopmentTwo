<?php
$openShiftVar = getenv('OPENSHIFT_MYSQL_DB_HOST');
$host="";
$port=0;
$socket="";
$user="";
$password="";
$dbname="";
if ($openShiftVar === null || $openShiftVar == "")
{
    include("localUser.php");
}
else
{
    // In the openshift environment
    $host= getenv('OPENSHIFT_MYSQL_DB_HOST');
    $port= getenv('OPENSHIFT_MYSQL_DB_PORT');
    $user= getenv('OPENSHIFT_MYSQL_DB_USERNAME');
    $password= getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
    $dbname = 'php';
    // …
}
$db = new PDO("mysql:host=$host:$port;dbname=$dbname", $user, $password)
    or die ('Could not connect to the database server');
?>