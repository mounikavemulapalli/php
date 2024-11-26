<?php

require "../config.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    
    // Prepare and execute the query to delete the user with the provided id
    $query = $db->prepare("DELETE FROM users WHERE id=:user_id");
    $query->execute([
        "user_id" => $id
    ]);

    // Redirect to the student management page after deletion
    header("Location:../personnel/student-management.php");
}
?>
