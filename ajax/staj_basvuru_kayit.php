<?php
require "../config.php";

print_r($_POST);

if (isset($_POST)){

    $id = $_POST["id"];
    $tc = $_POST["tc"];
    $tel = $_POST["tel"];

    $Internship_date = $_POST["Internship_date"];
    $sigorta = $_POST["sigorta"];
    $adres = $_POST["adres"];

    //Kurum
    $k_ad = $_POST["k_ad"];
    $k_adres = $_POST["k_adres"];
    $k_hizmet_alan = $_POST["k_hizmet_alan"];
    $k_no = $_POST["k_no"];
    $k_faks_no = $_POST["k_faks_no"];
    $k_eposta = $_POST["k_eposta"];
    $k_webadres = $_POST["k_webadres"];


    $query=$db->prepare("INSERT INTO Internship_Registration (ogrenci_id,tc,tel,Internship_date_id,sigorta,adres,k_ad,k_adres,k_hizmet_alan,k_no,k_faks_no,k_eposta,k_webadres) VALUES (:ogrenci_id,:tc,:tel,:Internship_date_id,:sigorta,:adres,:k_ad,:k_adres,:k_hizmet_alan,:k_no,:k_faks_no,:k_eposta,:k_webadres)");

    $query->execute([
        "ogrenci_id"=>$id,
        "tc"=>$tc,
        "tel"=>$tel,

        "Internship_date_id"=>$Internship_date,
        "sigorta"=>$sigorta,
        "adres"=>$adres,

        "k_ad"=>$k_ad,
        "k_adres"=>$k_adres,
        "k_hizmet_alan"=>$k_hizmet_alan,
        "k_no"=>$k_no,
        "k_faks_no"=>$k_faks_no,
        "k_eposta"=>$k_eposta,
        "k_webadres"=>$k_webadres,


    ]);

    header("Location:../ogrenci/basvuru-durum.php");
}