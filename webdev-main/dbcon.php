<?php
//step1 : create connect to DB
$server='localhost'; //128.0.0.1
$user='root'; //default user
$password='';
$database='petshell';

$conn= mysqli_connect($server, $user, $password, $database);

if($conn===False){
    die('Database connection failed'. mysqli_connect_error($conn));
}
