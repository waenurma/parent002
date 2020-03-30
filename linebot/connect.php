<?php 
include 'pgconfiq.php';

 $id_card = $_REQUEST["id_card"];
 
   
    $user_id = $_REQUEST["user_id"];
   
    
         $sql1="INSERT INTO public.linebot(user_id,id_card)values('$user_id','$id_card')";
         $stmt = $dbConnection->prepare($sql1);
         // $stmt->bindValue($data->id_card,PDO::PARAM_STR);
         $stmt->execute();
         $result = $stmt -> fetch();
      
         
?>