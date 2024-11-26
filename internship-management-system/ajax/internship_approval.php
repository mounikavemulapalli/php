<?php

require "../config.php";

if (isset($_GET["id"])){
    $id=$_GET["id"];
    $query = $db->prepare("UPDATE internship_application SET advisor_approval=:approval WHERE id=:app_id");
    $query->execute([
        "approval"=>1,
        "app_id"=>$id
    ]);

    header("Location:../advisor/internship-process.php");
}

if (isset($_GET["manager_approval_id"])){
    $id=$_GET["manager_approval_id"];
    $query = $db->prepare("UPDATE internship_application SET manager_approval=:approval WHERE id=:app_id");
    $query->execute([
        "approval"=>1,
        "app_id"=>$id
    ]);

    header("Location:../management/internship-process.php");
}
?>
