<?php
require "../config.php";

if (isset($_POST["datas"])){
    $week_hour = $_POST["datas"]["hafta_saat"];
    $term_id = $_POST["datas"]["yil"];

    $query = $db->prepare("SELECT id, DATE_FORMAT(internship_start, \"%d.%m.%Y\") as internship_start, DATE_FORMAT(internship_end, \"%d.%m.%Y\") as internship_end FROM internship_dates WHERE internship_dates.term_id = :term_id AND internship_dates.weekly_day_count = :week_hour;");
    $query->execute([
        "term_id" => $term_id,
        "week_hour" => $week_hour,
    ]);

    $dates = $query->fetchAll();

    echo "<option value='err'>Please Select Start Date</option>";
    foreach ($dates as $date){
        echo "<option value={$date["id"]}>{$date["internship_start"]}</option>";
    }

}

if (isset($_POST["internship_date_id"])){
    $id = $_POST["internship_date_id"];

    $query = $db->prepare("SELECT id, DATE_FORMAT(internship_start, \"%d.%m.%Y\") as internship_start, DATE_FORMAT(internship_end, \"%d.%m.%Y\") as internship_end FROM internship_dates WHERE internship_dates.id = :id;");
    $query->execute([
        "id" => $id,
    ]);

    $dates = $query->fetchAll();

    foreach ($dates as $date){
        echo "<option value={$date["id"]}>{$date["internship_end"]}</option>";
    }

}

if (isset($_POST["department_id"])){
    $department_id = $_POST["department_id"];

    $query = $db->prepare("SELECT CONCAT(titles.title_name, \" \", users.first_name, \" \", users.last_name) as full_name, users.id FROM advisor_details INNER JOIN users ON advisor_details.advisor_id = users.id INNER JOIN titles ON titles.id = advisor_details.title_id WHERE department_id = :id");

    $query->execute([
        "id" => $department_id
    ]);

    $advisors = $query->fetchAll();

    foreach ($advisors as $advisor){
        echo "<option value={$advisor["id"]}>{$advisor["full_name"]}</option>";
    }

};
?>
