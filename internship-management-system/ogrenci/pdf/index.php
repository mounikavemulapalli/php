<?php
require_once '../../lib/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

require "../../config.php";


$sql = "SELECT concat(users.ad,\" \",users.soyad) as ad_soyad,ogrenci_no,tc,tel,email,adres,social_security.ad,DATE_FORMAT(internship_date.staj_baslangic,\"%d.%m.%Y\") as staj_baslangic, DATE_FORMAT(internship_date.staj_bitis,\"%d.%m.%Y\") as staj_bitis,terms.donem_yil,internship_date.haftalik_gun_sayi,k_ad,k_adres,k_hizmet_alan,k_no,k_faks_no,k_eposta,k_webadres,bolum_ad FROM internship_registration INNER JOIN users ON users.id=internship_registration.ogrenci_id INNER JOIN student_details ON student_details.ogrenci_id=internship_registration.ogrenci_id INNER JOIN internship_date ON internship_date.id=internship_registration.internship_date_id INNER JOIN social_security ON social_security.id=internship_registration.sigorta INNER JOIN department ON student_details.bolum_id_fk=department.id INNER JOIN terms ON internship_date.donem_id=terms.id WHERE student_details.ogrenci_id=:id;";

$query = $db->prepare($sql);
$query->execute([
    "id"=>$_GET["id"]
]);
$kayitlar=$query->fetch();



if (isset($kayitlar)){
    $query = $db->prepare("SELECT concat(ad,\" \",soyad) as danisman_ad FROM student_details
INNER JOIN users ON users.id = student_details.danisman_id_fk WHERE student_details.ogrenci_id=:id");
    $query->execute([
        "id"=>$_GET["id"]
    ]);
    $danisman=$query->fetch();

    // instantiate and use the dompdf class
    $dompdf = new Dompdf();


    ob_start();
    require ("basvuru.php");
    $html = ob_get_contents();
    ob_get_clean();
    $dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'portrait ');

// Render the HTML as PDF
    $dompdf->render();

// Output the generated PDF to Browser
    $dompdf->stream("basvuru-formu",array("Attachment" => false));
}

