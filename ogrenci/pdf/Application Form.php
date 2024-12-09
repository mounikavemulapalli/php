<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Vocational School Internship Directive</title>
    <style>
      *,
      *::before,
      *::after {
        box-sizing: border-box;
        padding: 0;
        margin: 0;
        font-family: "DejaVu Sans", sans-serif;
      }

      table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        table-layout: fixed;
        margin-top: 15px;
      }

      body {
        font-size: 0.70rem;
        padding: 0px 35px;
      }

      td {
        border: 1px solid black;
        text-align: left;
        padding: 5px;
      }

      .header {
        text-align: center;
        font-weight: bold;
        font-size: 12px;
        margin-top: 65px;
      }

      .header2 {
        font-weight: bold;
        font-size: 12px;
        padding-left: 50px;
        padding-top: 15px;
      }

      .logo {
        position: absolute;
        top: 10px;
      }

      .text_center {
        text-align: center;
      }
    </style>
  </head>

  <body>
    <img src="logo.png" alt="" width="80" height="80" class="logo" />
    <h2 class="header">
      ÇANAKKALE ONSEKİZ MART UNIVERSITY <br />
      ÇANAKKALE VOCATIONAL SCHOOL OF SOCIAL SCIENCES <br />
      INTERNSHIP APPLICATION AND ACCEPTANCE FORM
    </h2>

    <span>To Whom It May Concern,</span>
    <p>
      It is mandatory for our vocational school students to complete an
      internship in organizations and businesses during the duration of their
      education as per the requirements of our curriculum.
    </p>
    <p>
      If it is approved for our student, who is subject to a compulsory
      internship, to carry out the internship in your organization, all
      procedures related to the commencement, termination, and notification of
      the insurance under Law No. 5510 “Social Insurance and General Health
      Insurance Law” will be carried out by our institution.
    </p>

    <table>
      <tr>
        <td>Full Name</td>
        <td colspan="3"><?=$kayitlar["ad_soyad"]?></td>
      </tr>
      <tr>
        <td>Student Number</td>
        <td><?=$kayitlar["ogrenci_no"]?></td>
        <td>Academic Year</td>
        <td><?=$kayitlar["donem_yil"]?></td>
      </tr>
      <tr>
        <td>National ID Number</td>
        <td><?=$kayitlar["tc"]?></td>
        <td>Phone Number</td>
        <td><?=$kayitlar["tel"]?></td>
      </tr>
      <tr>
        <td>Department</td>
        <td colspan="3"><?=$kayitlar["bolum_ad"]?></td>
      </tr>
      <tr>
        <td>Email Address</td>
        <td colspan="3"><?=$kayitlar["email"]?></td>
      </tr>
      <tr>
        <td>Residential Address</td>
        <td colspan="3"><?=$kayitlar["adres"]?></td>
      </tr>
      <tr>
        <td>Does the student have social security?</td>
        <td colspan="3"><?=$kayitlar["ad"]?></td>
      </tr>
      <tr>
        <td>Internship Start Date</td>
        <td colspan="2"><?=$kayitlar["staj_baslangic"]?></td>
        <td>Weekly Working Days</td>
      </tr>
      <tr>
        <td>Internship End Date</td>
        <td colspan="2"><?=$kayitlar["staj_bitis"]?></td>
        <td><?=$kayitlar["haftalik_gun_sayi"]?></td>
      </tr>
    </table>

    <table>
      <tr>
        <th colspan="4">INTERNSHIP ORGANIZATION DETAILS (TO BE FILLED BY THE ORGANIZATION)</th>
      </tr>
      <tr>
        <td>Organization Name</td>
        <td colspan="3"><?=$kayitlar["k_ad"]?></td>
      </tr>
      <tr>
        <td>Address</td>
        <td colspan="3"><?=$kayitlar["k_adres"]?></td>
      </tr>
      <tr>
        <td>Service Area</td>
        <td colspan="3"><?=$kayitlar["k_hizmet_alan"]?></td>
      </tr>
      <tr>
        <td>Phone Number</td>
        <td><?=$kayitlar["k_no"]?></td>
        <td>Fax Number</td>
        <td><?=$kayitlar["k_faks_no"]?></td>
      </tr>
      <tr>
        <td>Email Address</td>
        <td><?=$kayitlar["k_eposta"]?></td>
        <td>Website</td>
        <td><?=$kayitlar["k_webadres"]?></td>
      </tr>
    </table>

    <table>
      <tr>
        <th colspan="4">ORGANIZATION AUTHORIZED PERSON (TO BE FILLED BY THE ORGANIZATION)</th>
      </tr>
      <tr>
        <td>Full Name</td>
        <td></td>
        <td rowspan="3" class="text_center">Signature/Stamp</td>
        <td rowspan="3"></td>
      </tr>
      <tr>
        <td>Position/Title</td>
        <td></td>
      </tr>
      <tr>
        <td>Date</td>
        <td></td>
      </tr>
    </table>

    <table>
      <tr>
        <th>STUDENT</th>
        <th>ADVISOR</th>
        <th>INTERNSHIP COMMITTEE CHAIR</th>
        <th>INSURANCE ENTRY</th>
      </tr>
      <tr>
        <td>
          I hereby declare that I will carry out my internship at the mentioned
          organization/place during the specified dates and that I will not
          work outside these dates. I accept that my internship will be canceled
          otherwise.
        </td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td>Student's Full Name:</td>
        <td>Approval</td>
        <td>Approval</td>
        <td>Approval</td>
      </tr>
      <tr>
        <td><?=$kayitlar["ad_soyad"]?></td>
        <td><?= $danisman["danisman_ad"] ?></td>
        <td>Ümit Demir</td>
        <td></td>
      </tr>
      <tr>
        <td>Date:</td>
        <td>Date:</td>
        <td>Date:</td>
        <td>Date:</td>
      </tr>
      <tr>
        <td>Signature:</td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </table>
  </body>
</html>
