<?php

require "../config.php";

if(isset($_POST["day"])){

    $day = $_POST["day"];
    $term_id = $_POST["term_id"];
    $internship_start = $_POST["internship_start"];
    $internship_end = $_POST["internship_end"];

    $query = $db->prepare("INSERT INTO internship_dates (term_id, weekly_day_count, internship_start, internship_end) VALUES (:tterm_id, :tday, :tstart, :tend)");
    $save = $query->execute([
        "tterm_id" => $term_id,
        "tday" => $day,
        "tstart" => $internship_start,
        "tend" => $internship_end,
    ]);

    header("Location:../management/internship-date-process.php");

}
?>
