<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">

    <title>Update Patient Info</title>
    <style>
    .container {
        max-width: 80em;
        padding: 1em 1em 1em 1em;
        margin: 0em auto;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0px 3px 10px -2px rgba(0, 0, 0, 0.2);
        margin-top: 5%;
        margin-bottom: 10%;
    }
    </style>
</head>
<?php
require "database.php";
include "nav.php";
?>

<body>
    <div class="container">
        <form action="patient.php" method="post">
            <div class="card text-center ">
                <div class="card-header text-muted">
                    <h3><strong>Update Patient Info</strong></h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <div class="form-floating">
                                <?php
                                $sql = "SELECT * from patient WHERE p_number = '$_POST[edit]'";
                                $query_run = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $row) {
                                        $patient = $row;
                                    }
                                }
                                ?>
                                <input class="form-control me-2" id="floatingTextarea" type="text"
                                    placeholder="Patient Name" name="patient_name"
                                    value="<?php echo $patient['p_name']; ?>">
                                <label for="floatingTextarea" class="text-muted">Patient Name</label>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-floating">
                                <input class="form-control me-2" id="floatingTextarea" type="number" placeholder="Age"
                                    name="patient_age" value="<?php echo $patient['p_age']; ?>">
                                <label for=" floatingTextarea" class="text-muted">Age</label>
                            </div>

                        </div>
                        <div class="col-2">
                            <div class="form-floating">
                                <select class="form-select" aria-label="Default select example" id="floatingTextarea"
                                    placeholder="Gender" name='patient_gender'>
                                    <option selected value="<?php echo $patient['p_gender']; ?>">
                                        <?php echo $patient['p_gender']; ?></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                                <label for="floatingTextarea" class="text-muted">Gender</label>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="col-3">
                            <div class="form-floating" style="margin-top: 15px;">
                                <input class="form-control me-2" id="floatingTextarea" type="text"
                                    placeholder="Phone No." name="patient_phone"
                                    value="<?php echo $patient['p_phone']; ?>">
                                <label for="floatingTextarea" class="text-muted">Phone No.</label>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-floating" style="margin-top: 15px;">
                                <input class="form-control me-2" id="floatingTextarea" type="text" placeholder="Address"
                                    name="patient_address" value="<?php echo $patient['p_address']; ?>">
                                <label for="floatingTextarea" class="text-muted">Address</label>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="card-footer text-muted">
                    <button type="submit" class="btn btn-secondary" value="<?php echo $patient['p_number']; ?>"
                        name="edited">Submit</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>