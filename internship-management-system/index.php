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
                <img src="dist/img/comu_logo_4.png" alt="" width="110" height="110" />
                <div class="ms-2">
                    <h1 class="text-uppercase fw-bold fs-6">
                    Canakkale 18 Mart University
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

if (isset($_POST["email"]) || isset($_POST["sifre"])) {

    $email = $_POST["email"];
    $sifre = md5($_POST["sifre"]); // It's still using md5, consider using password_hash() for better security

    // Corrected SQL query with backticks around column names with spaces
    $query = $db->prepare("SELECT users.id, `First Name`, `Last Name`, email, sifreHash, rol_id 
                           FROM users 
                           INNER JOIN roles ON users.rol_id = roles.id 
                           WHERE email=:useremail AND sifreHash=:usersifreHash");

    $query->execute([
        "useremail" => $email,
        "usersifreHash" => $sifre
    ]);

    $data = $query->fetch(PDO::FETCH_ASSOC);

    $control = $query->rowCount();
    // Check if the query returns any rows (if login credentials are valid)
    if ($control == 0) {
        // If no rows are returned (unsuccessful login), redirect to the index page
        header("Location:index.php");
    } else {
        // If rows are returned (successful login), start the session and set session variables
        session_start();
        $_SESSION["user"] = $data; // Store user data in session
        $_SESSION["login"] = true; // Set a flag indicating that the user is logged in

        // Redirect based on the user's role
        switch ($data["rol_id"]) {
            case "manager":
                header("Location:management/index.php");
                break;
            case "consultant":
                header("Location:consultant/index.php");
                break;
            case "staff":
                header("Location:staff/index.php");
                break;
            default:
                header("Location:student/index.php");
        }
    }
}
   //print_r($data);
                        ?>
                        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                            <div class="mb-3 d-flex justify-content-center">
                                <img src="dist/img/comu_logo_4.png" alt="" class="" width="125" height="125">
                            </div>
                            <div class="mb-3">
                                <label for="mail" class="form-label">Email address:</label>
                                <input type="text" class="form-control" id="mail" name="email" required
                                       placeholder="Enter Email Id:">
                            </div>
                            <div class="mb-3">
                                <label for="sifre" class="form-label">Password:</label>
                                <input type="password" class="form-control" id="sifre" name="sifre" required
                                       placeholder="Şifre Giriniz">
                            </div>
                            <button type="submit"  class="btn btn-primary">Login</button>
                        </form>

                    </div>
                </div>

        </div>
    </div>

    <div class="container">

    <div class="my-5">
    <h1 class="fs-3 header-color fw-bold">What is the Internship Tracking Management System?</h1>
    <div class="card w-75">
        <p>
            The system provided to  faculty members and staff for accessing services such as UBYS, Eduroam, the library, and file sharing.
        </p>
        <p>
            With the  Single Account, you can change your password and access new services through the Single Account service. 
            You can benefit from all of digital services with a single username and password.
        </p>
    </div>
</div>

    </div>

    <div class="container">
        <div class="footer">
        <span class="text-white small">All Rights Reserved. Services are provided in accordance with the rules specified in the Privacy, Usage, and Copyright Notice.</span>

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