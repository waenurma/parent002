<?php 
include 'pgconfiq.php';

 $strSQL=('SELECT * FROM public.login ' );
 $stmt = $dbConnection->prepare($strSQL);
 $stmt->execute();
 $result = $stmt -> fetch();
 
 print_r($stmt);
         
?>