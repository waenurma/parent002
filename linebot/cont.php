<?php 
include 'pgconfiq.php';

 $strSQL=('SELECT * FROM public.login ' );
 $stmt = $dbConnection->prepare($strSQL);
 $stmt->bindValue(":id_card", $data->id_card,PDO::PARAM_STR);
 $stmt->execute();
 $result = $stmt -> fetch();
 
 print_r($result);
         
?>