<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <style>
    body {
        background-color: rgba(76, 175, 80, 0.5);
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <?php
                        session_start();
                        error_reporting(E_ALL ^ E_WARNING);
                        if (empty($_SESSION['id'])) {
                            header('Location:dsignin.php');
                        }
                        ?>
                        <a class="nav-link" href="dashboard.php"><span><b>Dr.
                                    <?php echo $_SESSION['doc_name'] ?></b></span></a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="profile.php"><span><b>Profile</b></span></a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="medicine.php"><span><b>Medicine</b></span></a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="patient.php"><span><b>Patient</b></span></a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="check.php"><span><b>Prescription</b></span></a>
                    </li>
                </ul>
                <span class="navbar-text">
                    <a class="nav-link" href="logout.php">Sign Out</a>

                </span>

            </div>
        </div>
    </nav>


</body>

<script>
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}
</script>

</html>