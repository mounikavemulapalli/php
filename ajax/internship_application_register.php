<?php
require "../config.php";

print_r($_POST);

if (isset($_POST)){

    $id = $_POST["id"];
    $tc = $_POST["tc"];
    $tel = $_POST["tel"];

    $internship_date = $_POST["staj_tarih"];
    $insurance = $_POST["sigorta"];
    $address = $_POST["adres"];

    //Institution
    $institution_name = $_POST["k_ad"];
    $institution_address = $_POST["k_adres"];
    $service_area = $_POST["k_hizmet_alan"];
    $institution_number = $_POST["k_no"];
    $fax_number = $_POST["k_faks_no"];
    $email = $_POST["k_eposta"];
    $website = $_POST["k_webadres"];


    $query=$db->prepare("INSERT INTO internship_application (student_id, tc, phone, internship_date_id, insurance, address, institution_name, institution_address, service_area, institution_number, fax_number, email, website) 
    VALUES (:student_id, :tc, :phone, :internship_date_id, :insurance, :address, :institution_name, :institution_address, :service_area, :institution_number, :fax_number, :email, :website)");

    $query->execute([
        "student_id"=>$id,
        "tc"=>$tc,
        "phone"=>$tel,

        "internship_date_id"=>$internship_date,
        "insurance"=>$insurance,
        "address"=>$address,

        "institution_name"=>$institution_name,
        "institution_address"=>$institution_address,
        "service_area"=>$service_area,
        "institution_number"=>$institution_number,
        "fax_number"=>$fax_number,
        "email"=>$email,
        "website"=>$website,
    ]);

    header("Location:../student/application-status.php");
}
?>
