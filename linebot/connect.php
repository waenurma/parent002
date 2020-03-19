<?php 
include 'pgconfiq.php';

 $strSQL=('SELECT * FROM public.login WHERE id_card=:id_card' );
 $stmt = $dbConnection->prepare($strSQL);
 $stmt->bindValue(":id_card", $data->id_card,PDO::PARAM_STR);
 $stmt->execute();
 $result = $stmt -> fetch();

 if($data->id_card == $result['id_card']){
 
    // $id_card = $_REQUEST["pass"];
    $user_id = $_REQUEST["user_id"];
         $sql1="INSERT INTO public.linebot(user_id,id_card)values('$user_id','$data->id_card')";
         $stmt = $dbConnection->prepare($sql1);
         // $stmt->bindValue($data->id_card,PDO::PARAM_STR);
         $stmt->execute();
         $result = $stmt -> fetch();}


?>