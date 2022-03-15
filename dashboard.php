<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Dashboard</title>
    <style>
    .container {
        padding: 70px 0;
        position: relative;
        border: 3px solid green;
        text-align: center;
    }
    </style>
</head>
<?php
include 'nav.php';
?>

<body>
    <div class="container mt-5" align="center">
        <div class="row ">
            <div class="col-3"></div>
            <div class="col-sm-3">
                <div class="card text-center">
                    <div class="card-header bg-secondary ">
                        <h3 class="text-light"><strong>Profile</strong></h3>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">See & Edit Profile Content</h6>

                    </div>
                    <div class="card-footer">
                        <a href="profile.php"><button class="btn btn-secondary btn-sm">Profile</button></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card text-center">
                    <div class="card-header bg-secondary">
                        <h3 class="text-light"><strong>Medicine</strong></h3>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">Add Search And Edit Medicine</h6>

                    </div>
                    <div class="card-footer">
                        <a href="medicine.php"><button class="btn btn-secondary btn-sm">Medicine</button></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 10px;">
            <div class="col-3"></div>
            <div class="col-sm-3">
                <div class="card text-center">
                    <div class="card-header bg-secondary">
                        <h3 class="text-light"><strong>Patient</strong></h3>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">See & Edit Patient Info</h6>

                    </div>
                    <div class="card-footer">
                        <a href="patient.php"><button class="btn btn-secondary btn-sm">Patient</button></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card text-center">
                    <div class="card-header bg-secondary">
                        <h3 class="text-light"><strong>Prescription</strong></h3>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">Prescription Center</h6>

                    </div>
                    <div class="card-footer">
                        <a href="check.php"><button class="btn btn-secondary btn-sm">Prescription</button></a>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>

</html>