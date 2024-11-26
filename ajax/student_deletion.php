<?php

require "../config.php";

if (isset($_GET["id"])){
    $id = $_GET["id"];
    $query = $db->prepare("DELETE FROM users WHERE id = :user_id");
    $query->execute([
        "user_id" => $id
    ]);

   header("Location: ../admin/student-operation.php");
}
