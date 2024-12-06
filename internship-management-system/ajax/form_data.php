<?php
require "../config.php";

if (isset($_POST["datas"])){
    $hafta_saat = $_POST["datas"]["hafta_saat"];
    $donem_id = $_POST["datas"]["yil"];

    $query= $db->prepare("SELECT id,DATE_FORMAT(staj_baslangic, \"%d.%m.%Y\") as staj_baslangic,DATE_FORMAT(staj_bitis, \"%d.%m.%Y\") as staj_bitis FROM Internship_date WHERE Internship_date.donem_id=:donem_id AND Internship_date.haftalik_gun_sayi=:hafta_sayi;");
    $query->execute([
        "donem_id"=>$donem_id,
        "hafta_sayi"=>$hafta_saat,
    ]);

    $tarihler = $query->fetchAll();

    echo "<option value='err'>Başlangıç Tarihi Seçiniz</option>";
    foreach ($tarihler as $tarih){
        echo "<option value={$tarih["id"]}>{$tarih["staj_baslangic"]}</option>";
    }

}


if (isset($_POST["Internship_date_id"])){
    $id = $_POST["Internship_date_id"];

    $query= $db->prepare("SELECT id,DATE_FORMAT(staj_baslangic,\"%d.%m.%Y\") as staj_baslangic,DATE_FORMAT(staj_bitis,\"%d.%m.%Y\") as staj_bitis FROM Internship_date WHERE Internship_date.id=:id;");
    $query->execute([
        "id"=>$id,
    ]);

    $tarihler = $query->fetchAll();

    foreach ($tarihler as $tarih){
        echo "<option value={$tarih["id"]}>{$tarih["staj_bitis"]}</option>";
    }

}


if (isset($_POST["bolum_id"])){
    $bolum_id= $_POST["bolum_id"];

    $query=$db->prepare("SELECT concat(titles.unvan_ad,\" \",users.ad,\" \",users.soyad) as ad_soyad,users.id FROM advisor_details INNER JOIN users ON advisor_details.danisman_id=users.id INNER JOIN titles ON titles.id=advisor_details.title_id  WHERE bolum_id=:id");

    $query->execute([
        "id"=>$bolum_id
    ]);


    $danismanlar=$query->fetchAll();


    foreach ($danismanlar as $danisman){
        echo "<option value={$danisman["id"]}>{$danisman["ad_soyad"]}</option>";
    }



};






