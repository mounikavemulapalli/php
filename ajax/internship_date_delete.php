<?php

require "../config.php";

if (isset($_GET["id"])){
    $id = $_GET["id"];
    $query = $db->prepare("DELETE FROM internship_dates WHERE id=:kid");
    $query->execute([
        "kid" => $id
    ]);

   header("Location:../management/internship-date-process.php");
}
?>