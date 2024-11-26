<?php

require "../config.php";

if (isset($_GET["id"])){
    $id=$_GET["id"];
    $query = $db->prepare("DELETE FROM internship_application WHERE id=:app_id");
    $query->execute([
        "app_id"=>$id
    ]);

   header("Location:../student/application-status.php");
}
?>
