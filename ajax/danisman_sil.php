<?php

require "../config.php";

if (isset($_GET["id"])){
    $id=$_GET["id"];
    $query = $db->prepare("DELETE FROM users WHERE id=:kid");
    $query->execute([
        "kid"=>$id
    ]);

   header("Location:../Management/danisman-islem.php");
}