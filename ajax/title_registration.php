<?php

require "../config.php";

if (isset($_POST["unvan_ad"])){

    $title_name = $_POST["unvan_ad"];

    $query = $db->prepare("INSERT INTO titles (title_name) VALUES (:btitle_name)");
    $save = $query->execute([
        "btitle_name" => $title_name,
    ]);

    header("Location:../management/advisor-process.php");

}
?>
