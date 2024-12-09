<?php

require "../config.php";

if (isset($_GET["id"])){
    $id=$_GET["id"];
    $query = $db->prepare("DELETE FROM Internship_date WHERE id=:kid");
    $query->execute([
        "kid"=>$id
    ]);

   header("Location:../Management/staj-tarih-islem.php");
}