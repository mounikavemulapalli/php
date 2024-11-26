<?php

require "../config.php";

if(isset($_POST["department_name"])){

    $department_name = $_POST["department_name"];

    $query = $db->prepare("INSERT INTO departments (department_name) VALUES (:dname)");
    $save = $query->execute([
        "dname" => $department_name,
    ]);

    header("Location:../admin/department-operation.php");

}
