<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>MYO Internship Directive</title>
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
      .text_center{
          text-align: center;
      }
    </style>
  </head>

  <body>
    <img src="logo.png" alt="" width="80" height="80" class="logo" />
    <h2 class="header">
      CANAKKALE ONSEKIZ MART UNIVERSITY <br />
      CANAKKALE SOCIAL SCIENCES VOCATIONAL SCHOOL <br />
      INTERNSHIP APPLICATION AND ACCEPTANCE FORM
    </h2>

    <span>To the Relevant Authority,</span>
    <p>
      Students of our Vocational School are required to complete internships at institutions and enterprises during their education program until the end of their study period.
    </p>
    <p>
      If the internship of our student, who is required to complete an internship, is accepted by your institution, the commencement, termination, and notification obligations regarding social security, as per the "Social Security and General Health Insurance Law No. 5510," will be handled by our Institution.
    </p>

    <table>
      <tr>
        <td>Name Surname</td>
        <td colspan="3"><?=$kayitlar["ad_soyad"]?></td>
      </tr>
      <tr>
        <td>Student Number</td>
        <td><?=$kayitlar["ogrenci_no"]?></td>
        <td>Academic Year</td>
        <td><?=$kayitlar["donem_yil"]?></td>
      </tr>
      <tr>
        <td>Turkish ID Number</td>
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
        <td colspan="3">
            <?=$kayitlar["adres"]?>
        </td>
      </tr>

      <tr>
          <td>Does the student have social security?</td>
          <td colspan="3"><?=$kayitlar["ad"]?></td>
      </tr>

      <tr>
        <td>Internship Start Date</td>
        <td colspan="2"><?=$kayitlar["staj_baslangic"]?></td>
        <td>Weekly Workdays</td>
      </tr>
      <tr>
        <td>Internship End Date</td>
        <td colspan="2"><?=$kayitlar["staj_bitis"]?></td>
        <td><?=$kayitlar["haftalik_gun_sayi"]?></td>
      </tr>
    </table>

    <table>
        <tr>
            <th colspan="4">INTERNSHIP WORKPLACE (TO BE FILLED OUT BY THE WORKPLACE)</th>
        </tr>
        <tr>
            <td>Institution Name</td>
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
            <td>Website Address</td>
            <td><?=$kayitlar["k_webadres"]?></td>
        </tr>

    </table>

    <table>
        <tr>
            <th colspan="4">INSTITUTION AUTHORIZED PERSON (TO BE FILLED OUT BY THE WORKPLACE)</th>
        </tr>
        <tr>
            <td>Name Surname</td>
            <td></td>
            <td rowspan="3" class="text_center">Signature / Seal</td>
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
            <th>INTERNSHIP COMMISSION PRESIDENT</th>
            <th>SOCIAL INSURANCE ENTRY</th>
        </tr>
        <tr>
            <td>
                I hereby commit to completing my internship at the above-mentioned institution/workplace within the specified dates of 30 working days. I agree not to do my internship outside of these dates, and I understand that my internship will be canceled if this condition is violated.
            </td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td>Student Name Surname:</td>
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
