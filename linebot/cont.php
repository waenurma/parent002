<?php 
include 'pgconfiq.php';

 $strSQL=('SELECT * FROM public.linebot where user_id = "'.$_REQUEST["user_id"].'" ' );
 $stmt = $dbConnection->prepare($strSQL);
 $stmt->execute();
 $result = $stmt -> fetch();
 
 print_r($stmt);
         
?>