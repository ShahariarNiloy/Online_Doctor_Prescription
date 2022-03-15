<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription</title>
    <style>
    .container {
        max-width: 80em;
        padding: 1em 1em 1em 1em;
        margin: 0em auto;
        /* background-color: #fff; */
        border-radius: 10px;
        box-shadow: 0px 3px 10px -2px rgba(0, 0, 0, 0.2);
        margin-top: 5%;
        margin-bottom: 10%;
    }
    </style>
</head>
<?php
include 'nav.php';
?>

<body>
    <div class="container">

        <div class="row">
            <div class="col-4">
            </div>
            <div class="col-4">

                <form action="" method="POST">
                    <div class="input-group mb-3" style="margin-top: -40px;">
                        <input type="text" name="search" required value="<?php if (isset($_GET['search'])) {
                                                                                echo $_GET['search'];
                                                                            } ?>" class="form-control"
                            placeholder="Search data">
                        <button type="submit" class="btn btn-secondary">Search</button>
                    </div>
                </form>
            </div>
            <div class="col-4">
                <p class="fs-5">Search Patient By Patient ID or Phone No.</p>
            </div>

        </div>

    </div>
    <div class="container">
        <div class="col-md-12">
            <div class="card mt-4" style="margin-top: -40px;">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Age</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Prescription Date</th>
                                <th scope="col"> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require "database.php";

                            if (isset($_POST['search'])) {
                                $values = $_POST['search'];
                                $doc_id = $_SESSION['id'];

                                $sql = "SELECT * FROM patient WHERE doc_id = '$doc_id' and (p_number = '$values' or p_phone = '$values')";
                                $query_run = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $row) {
                                        $patient = $row;
                                    }


                                    $query = "SELECT * FROM prescription WHERE p_id = '$patient[p_number]'";
                                    $query_run = mysqli_query($conn, $query);
                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $row) {
                            ?>
                            <form action="oldprescription.php" method="post">
                                <tr id="row1">
                                    <td><?php echo $patient['p_name']; ?></td>
                                    <td><?php echo $patient['p_age']; ?></td>
                                    <td><?php echo $patient['p_gender']; ?></td>
                                    <td><?php echo $patient['p_phone']; ?></td>
                                    <td><?php echo $row['pres_time'];
                                                        $_SESSION['old_patient'] = $row['p_id']; ?></td>
                                    <td><button type="submit" class="btn btn-secondary"
                                            value="<?php echo $row['press_number']; ?>" name="findpres">Show</button>


                                </tr>
                            </form>
                            <?php
                                        }
                                    } else {
                                        $_SESSION['old_patient'] = $patient['p_number'];
                                        ?>
                            <form action="oldprescription.php" method="post">
                                <tr id="row1">
                                    <td><?php echo $patient['p_name']; ?></td>
                                    <td><?php echo $patient['p_age']; ?></td>
                                    <td><?php echo $patient['p_gender']; ?></td>
                                    <td><?php echo $patient['p_phone']; ?></td>
                                    <td> No Prescription
                                    </td>
                                    <td><button type="submit" class="btn btn-secondary" value="nothing"
                                            name="findpres">Add</button>


                                </tr>
                            </form>
                            <?php
                                    }
                                } else {
                                    ?>
                            <tr>
                                <td colspan="4">No Record Found</td>
                            </tr>
                            <?php
                                }
                            }

                            ?>





                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>


</html>