<?php

require "../config.php";

if (isset($_GET["id"])){
    $id = $_GET["id"];
    $query = $db->prepare("DELETE FROM terms WHERE id = :tid");
    $query->execute([
        "tid" => $id
    ]);

   header("Location: ../admin/internship-date-operation.php");
}
