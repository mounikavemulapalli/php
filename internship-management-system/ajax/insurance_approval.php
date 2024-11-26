<?php

require "../config.php";

if (isset($_GET["insurance_entry"])) {
    $id = $_GET["insurance_entry"];
    $query = $db->prepare("UPDATE internship_registration SET insurance_entry_approval=:approval WHERE id=:kid");
    $query->execute([
        "approval" => 1,
        "kid" => $id
    ]);

    header("Location:../personnel/insurance-entry.php");
}

if (isset($_GET["insurance_exit"])) {
    $id = $_GET["insurance_exit"];
    $query = $db->prepare("UPDATE internship_registration SET insurance_exit_approval=:approval WHERE id=:kid");
    $query->execute([
        "approval" => 1,
        "kid" => $id
    ]);

    header("Location:../personnel/internship-process.php");
}
?>
