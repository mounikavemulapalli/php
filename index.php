<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <script src="https://kit.fontawesome.com/75e0b79c22.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="dist/css/main.css">

    <title>Internship Management System</title>


</head>

<body>
    <div class="container mt-3">
        <div class="header d-flex flex-row justify-content-between align-items-center ">
            <a href="index.html" class="header_logo d-inline-flex text-decoration-none align-items-center text-white">
                <img src="dist/img/the-entrepreneurship-network-cover.jpg" alt="" width="110" height="110" />
                <div class="ms-2">
                    <h1 class="text-uppercase fw-bold fs-6">
                        TEN Network
                    </h1>
                    <span class="text-capitalize">Internship Tracking System</span>
                </div>
            </a>
            <nav class="menu">
                <ul class="d-flex list-unstyled">
                    <li class="nav-item">
                        <a href="#" class="nav-link text-white">I Forgot My Password?</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link text-white">Help </a>
                    </li>
                </ul>
            </nav>
        </div>

    </div>

    <div class="container">
        <div class="login-section d-flex align-items-center justify-content-center my-1">

                <div class="card px-2 py-3" style="width: 22rem;">
                    <div class="card-body">
                        <?php
                        require ("config.php");

                        if (isset($_POST["email"]) || isset($_POST["Password"]) ){

                            $email= $_POST["email"];
                            $Password= md5($_POST["Password"]);

                            $query = $db->prepare("SELECT users.id,ad,soyad,email,role_ad FROM users INNER JOIN roles ON users.rol_id = roles.id WHERE email=:kemail AND PasswordHash=:kPasswordHash");
                            $query->execute([
                                    "kemail" =>$email,
                                    "kPasswordHash" =>$Password
                            ]);
                            $data = $query->fetch(PDO::FETCH_ASSOC);

                            $kontrol = $query->rowCount();
                            //print_r($data);

                            if($kontrol==0){
                                // Giriş Başarısız İse Yönlendir;
                                header("Location:index.php");
                            }else{
                                session_start();
                                $_SESSION["users"] = $data;
                                $_SESSION["login"] = true;

                                // Giriş Başarılı ise;
                                switch ($data["role_ad"]){
                                    case "manager":
                                        header("Location:Management/index.php");
                                        break;
                                    case "danışman":
                                        header("Location:Consultant/index.php");
                                        break;
                                    case "personel":
                                        header("Location:personel/index.php");
                                        break;
                                    default:
                                        header("Location:ogrenci/index.php");

                                }

                            }




                        }



                        //print_r($data);
                        ?>
                        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                            <div class="mb-3 d-flex justify-content-center">
                                <img src="dist/img/the-entrepreneurship-network-cover.jpg" alt="" class="" width="125" height="125">
                            </div>
                            <div class="mb-3">
                                <label for="mail" class="form-label">Email Address:</label>
                                <input type="text" class="form-control" id="mail" name="email" required
                                       placeholder="öğrencinumarası@ogr.comu.edu.tr">
                            </div>
                            <div class="mb-3">
                                <label for="Password" class="form-label">Password:</label>
                                <input type="password" class="form-control" id="Password" name="Password" required
                                       placeholder="Enter Password">
                            </div>
                            <button type="submit"  class="btn btn-primary">Submit</button>
                        </form>

                    </div>
                </div>

        </div>
    </div>

    <div class="container">

        <div class="my-5">
            <h1 class="fs-3 header-color fw-bold">Internship Tracking Management System ? </h1>
            <div class="card w-75">
                <p>
                    ÇOMÜ akademisyenlerine ve personeline sunulan ubys, eduroam, kütüphane ve dosya paylaşım sistemi
                    gibi
                    hizmetlere erişim için kullanabileceğiniz bir hesap yönetim sistemidir.
                </p>
                <p>
                    ÇOMÜ Tek Hesap sayesinde parolanızı değiştirebilir ve yeni servislere Tek Hesap servisi üzerinden
                    ulaşabilirsiniz. Tek kullanıcı adı ve parola ile ÇOMÜ’nün tüm dijital hizmetlerinden
                    faydalanabilirsiniz.
                </p>
            </div>

        </div>
    </div>

    <div class="container">
        <div class="footer">
            <span class="text-white small">All Rights Reserved. Gizlilik, Kullanım ve Telif Hakları bildiriminde
                belirtilen kurallar
                çerçevesinde hizmet sunulmaktadır.</span>
        </div>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>