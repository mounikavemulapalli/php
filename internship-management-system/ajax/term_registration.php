<?php

require "../config.php";

if(isset($_POST["term_date"])){

    $term_date = $_POST["term_date"];

    $query = $db->prepare("INSERT INTO terms (term_year) VALUES (:tdate)");
    $save = $query->execute([
        "tdate" => $term_date,
    ]);

    header("Location: ../admin/internship-date-operation.php");

}
