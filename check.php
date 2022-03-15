<!doctype html>
<html lang="en">

<head>
    <title>Check</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
    .container {
        width: 30px;
        padding: 1em 1em 1em 1em;
        margin: 0em auto;

        border-radius: 10px;
        box-shadow: 0px 3px 10px -2px rgba(0, 0, 0, 0.2);
        margin-top: 5%;
        margin-bottom: 10%;
    }
    </style>
</head>
<?php
include "nav.php";
?>

<body>
    <div class="container" align="center">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-sm-4">
                <div class="card border-dark " style="max-width: 18rem;">
                    <div class="card-header text-center text-muted">
                        <h3 class="card-title">New Patient</h3>
                    </div>
                    <div class="card-body">
                        <h6><span>Go to prescription section, if a new patient</span></h6>

                    </div>
                    <div class="card-footer">
                        <a href="newprescription.php" class="btn btn-secondary">Prescription</a>
                    </div>
                </div>

            </div>
            <div class="col-sm-4">
                <div class="card border-dark " style="max-width: 18rem;">
                    <div class="card-header text-center text-muted">
                        <h3 class="card-title">Registered Patient</h3>
                    </div>
                    <div class="card-body">
                        <h6><span>Find the info about this registered patient</span></h6>

                    </div>
                    <div class="card-footer">
                        <a href="prescription.php" class="btn btn-secondary">Find Info</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>