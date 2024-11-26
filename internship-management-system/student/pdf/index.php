<?php
require_once '../../lib/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

require "../../config.php";

$sql = "SELECT concat(kullanicilar.ad,\" \",kullanicilar.soyad) as full_name, ogrenci_no, tc, tel, email, address, sosyal_guvence.ad, DATE_FORMAT(staj_tarih.staj_baslangic,\"%d.%m.%Y\") as internship_start, DATE_FORMAT(staj_tarih.staj_bitis,\"%d.%m.%Y\") as internship_end, donemler.donem_yil, staj_tarih.weekly_workdays, k_ad, k_adres, k_hizmet_alan, k_no, k_faks_no, k_eposta, k_webadres, department_name FROM internship_registration INNER JOIN users ON users.id=internship_registration.student_id INNER JOIN student_details ON student_details.student_id=internship_registration.student_id INNER JOIN internship_dates ON internship_dates.id=internship_registration.internship_dates_id INNER JOIN social_security ON social_security.id=internship_registration.insurance INNER JOIN departments ON student_details.department_id=departments.id INNER JOIN terms ON internship_dates.term_id=terms.id WHERE student_details.student_id=:id;";

$query = $db->prepare($sql);
$query->execute([
    "id" => $_GET["id"]
]);
$records = $query->fetch();

if (isset($records)){
    $query = $db->prepare("SELECT concat(first_name, \" \", last_name) as advisor_name FROM student_details
INNER JOIN users ON users.id = student_details.advisor_id WHERE student_details.student_id=:id");
    $query->execute([
        "id" => $_GET["id"]
    ]);
    $advisor = $query->fetch();

    // instantiate and use the dompdf class
    $dompdf = new Dompdf();

    ob_start();
    require ("application.php");
    $html = ob_get_contents();
    ob_get_clean();
    $dompdf->loadHtml($html);

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream("application-form", array("Attachment" => false));
}
