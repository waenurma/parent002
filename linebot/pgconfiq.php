<?php
 
 $dbhost='ec2-54-235-180-123.compute-1.amazonaws.com';
 $dbuser='wammqrjxsobuvm';
 $dbpass='817d802129e8aebb1a07b4d7ba1b59f84d01696ed5eddbe84b51ea4d998f8df5';
 $dbname='dejm5cvd928n89';
 $dbConnection = new PDO("pgsql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass); 
 $dbConnection->exec("set names utf8");
 $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 return $dbConnection;
 ?>