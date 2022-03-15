<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient</title>
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
require 'database.php';
include "nav.php";
if (isset($_POST['edited'])) {
    $sql = "UPDATE `patient` SET p_name = '$_POST[patient_name]',`p_age`='$_POST[patient_age]',`p_gender`='$_POST[patient_gender]',
    `p_phone`='$_POST[patient_phone]',`p_address`='$_POST[patient_address]'  WHERE p_number = '$_POST[edited]'";
    if ($conn->query($sql)) {
        echo "<script>alert('Patient Info Updated');</script>";
    } else {

        echo "<script> alert('Error inserting data: ' . $conn->error); </script>";
    }
}



if (isset($_POST['submit'])) {
    $doc_id = $_SESSION['id'];
    $_SESSION['np_id'] = rand(time(), 10000000);
    $sql = "INSERT INTO patient (p_number,doc_id,p_name,p_age,p_gender,p_phone,p_address) VALUE ('$_SESSION[np_id]','$doc_id','$_POST[patient_name]','$_POST[patient_age]','$_POST[patient_gender]','$_POST[patient_phone]','$_POST[patient_address]')";
    if ($conn->query($sql)) {
        echo "<script>alert('New Patient Added');</script>";
    } else {
        echo "<script> alert('Error inserting data: ' . $conn->error); </script>";
    }
}
?>

<body>
    <div class="container">
        <form action="" method="post">
            <div class="card text-center ">
                <div class="card-header text-muted">
                    <h3><strong>Add Patient</strong></h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <div class="form-floating">
                                <input class="form-control me-2" id="floatingTextarea" type="text"
                                    placeholder="Patient Name" name="patient_name" autocomplete="off" required>
                                <label for="floatingTextarea" class="text-muted">Patient Name</label>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-floating">
                                <input class="form-control me-2" id="floatingTextarea" type="number" placeholder="Age"
                                    name="patient_age">
                                <label for="floatingTextarea" class="text-muted">Age</label>
                            </div>

                        </div>
                        <div class="col-2">
                            <div class="form-floating">
                                <select class="form-select" aria-label="Default select example" id="floatingTextarea"
                                    placeholder="Gender" name='patient_gender'>
                                    <option selected disabled>Select.. </option>
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
                                    placeholder="Phone No." name="patient_phone" autocomplete="off">
                                <label for="floatingTextarea" class="text-muted">Phone No.</label>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-floating" style="margin-top: 15px;">
                                <input class="form-control me-2" id="floatingTextarea" type="text" placeholder="Address"
                                    name="patient_address" autocomplete="off">
                                <label for="floatingTextarea" class="text-muted">Address</label>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="card-footer text-muted">
                    <div class="col" style="margin-top : 10px">
                        <button type="submit" class="btn btn-secondary btn-lg" value="submit"
                            name="submit">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="container">
        <?php
        if (isset($_POST['delete'])) {
            $sql = "DELETE FROM `patient` WHERE p_number = '$_POST[delete]'";
            if ($conn->query($sql)) {
                echo "<script>alert('Patient Has Deleted');</script>";
            } else {

                echo "<script> alert('Error inserting data: ' . $conn->error); </script>";
            }
        }
        ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Age</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Address</th>
                    <th scope="col"> </th>
                    <th scope="col"> </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `patient` WHERE doc_id = '$_SESSION[id]' ";
                $query_run = mysqli_query($conn, $sql);

                if (mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $row) {
                ?>
                <tr>
                    <td><?php echo $row['p_number']; ?></td>
                    <td><?php echo $row['p_name']; ?></td>
                    <td><?php echo $row['p_age']; ?></td>
                    <td><?php echo $row['p_gender']; ?></td>
                    <td><?php echo $row['p_phone']; ?></td>
                    <td><?php echo $row['p_address']; ?></td>
                    <form action="newpatient.php" method="post">
                        <td>
                            <button type="submit" class="btn btn-primary" value="<?php echo $row['p_number']; ?>"
                                name="edit">Edit</button>
                        </td>
                    </form>
                    <form action="" method="post">
                        <td><button type="submit" class="btn btn-danger" value="<?php echo $row['p_number']; ?>"
                                name="delete">Delete</button></td>
                    </form>
                </tr>
                <?php
                    }
                } else {
                    ?>
                <h3>No Patient</h3>

                <?php
                }

                ?>
            </tbody>
        </table>

    </div>
</body>

</html>