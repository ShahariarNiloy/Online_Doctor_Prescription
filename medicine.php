<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Medicine</title>
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
include 'nav.php';

require 'database.php';
if (isset($_POST['submit'])) {
    $doc = $_SESSION['email'];
    $doc_id = $_SESSION['id'];
    $sql = "INSERT INTO medicine (`doc_id`, `gen_name`, `med_name`, `type`, `dose`, `indication`, `instruction`) 
                VALUES ('$doc_id','$_POST[gen_name]', '$_POST[med_name]', '$_POST[type]', '$_POST[dose]', '$_POST[indication]', '$_POST[instruction]')";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
        echo "Medicine Inserted";
        echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
        echo "</div>";
    } else {
        echo "<script> alert('Error updating data: ' . $conn->error); </script>";
    }
}
if (isset($_COOKIE['count'])) {
    $count = $_COOKIE['count'];
    $c = 0;
    for ($i = 1; $i <= $count; $i++) {
        $del = "del" . $i;
        $doc_id = $_SESSION['id'];
        $med_id = $_COOKIE[$del];
        $sql = "DELETE FROM `medicine` WHERE doc_id = '$doc_id' && med_id = '$med_id'";

        if ($conn->query($sql) === TRUE) {
            $c++;
            echo "<script>document.cookie='" . $del . "=0;Expires=Thu, 01 Jan 1970 00:00:01 GMT;'</script>";
        } else {
            echo "<script> alert('Error updating data: ' . $conn->error); </script>";
        }
    }
    if ($c > 0) {
        echo "<div class='alert alert-dange alert-dismissible fade show' role='alert'>";
        echo "Medicine Deleted";
        echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
        echo "</div>";
        echo "<script>document.cookie='count=1;Expires=Thu, 01 Jan 1970 00:00:01 GMT;'</script>";
    }
}
?>

<body>
    <div class="container">
        <div class="card text-center">
            <div class="card-header text-muted">
                <h3><strong>Add Medicine</strong></h3>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-4">
                            <input class="form-control me-2" type="search" placeholder="Generic Name" name="gen_name">
                        </div>
                        <div class="col-4">
                            <input class="form-control me-2" type="search" placeholder="Medicine Name" name="med_name">

                        </div>
                        <div class="col-2">
                            <select class="form-select" id="inputGroupSelect01" name="type" placeholder="Type">
                                <option value="" disabled selected>Type</option>
                                <option value="Tab.">Tab</option>
                                <option value="Cap.">Cap</option>
                                <option value="Inj.">Inj.</option>
                            </select>
                        </div>
                        <div class="col-2">
                            <input type="text" class="form-control" name="dose" placeholder="Usage" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" name="indication" placeholder="Indication" value="">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" name="instruction" placeholder="Instruction"
                                value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col" style="margin-top : 10px">
                            <button type="submit" class="btn btn-secondary btn-lg" value="submit"
                                name="submit">Submit</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>

    </div>
    <div class="container">
        <div class="form-actions">
            <div class="card text-center">
                <div class="card-header text-muted">
                    <h3><strong>Search Medicine</strong></h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="col-6">

                            <form action="" method="POST">
                                <div class="input-group mb-3">
                                    <input type="text" name="search" required value="<?php if (isset($_GET['search'])) {
                                                                                            echo $_GET['search'];
                                                                                        } ?>" class="form-control"
                                        placeholder="Search data">
                                    <button type="submit" class="btn btn-secondary">Search</button>
                                </div>
                            </form>

                        </div>
                        <div class="col-3">
                            <p class="fs-6">** To Show All Medicine List, Search "All"</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-12">
            <div class="card mt-4">

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Type</th>
                                <th scope="col">Medicine Name</th>
                                <th scope="col">Generic Name</th>
                                <th scope="col">Usage</th>
                                <th scope="col">Indication</th>
                                <th scope="col">Instruction</th>
                                <th></th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            if (isset($_POST['search'])) {
                                $filtervalues = $_POST['search'];
                                $doc_id = $_SESSION['id'];
                                if ($filtervalues == 'All' || $filtervalues == 'all') {
                                    $query = "SELECT * FROM medicine WHERE doc_id = '$doc_id'";
                                } else {
                                    $query = "SELECT * FROM medicine WHERE doc_id = '$doc_id' && med_name LIKE '%$filtervalues%' ";
                                }

                                $query_run = mysqli_query($conn, $query);
                                $a = 1;
                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $row) {
                            ?>

                            <tr id="row1">
                                <th scope="row"><?php echo $a; ?></th>
                                <td><input class="form-control-plaintext" type="text"
                                        value="<?php echo $row['type']; ?>"></td>
                                <td><input class="form-control-plaintext" type="text"
                                        value="<?php echo $row['med_name']; ?>"></td>
                                <td><input class="form-control-plaintext" type="text"
                                        value="<?php echo $row['gen_name']; ?>"></td>
                                <td><input class="form-control-plaintext" type="text"
                                        value="<?php echo $row['dose']; ?>"></td>
                                <td><input class="form-control-plaintext" type="text"
                                        value="<?php echo $row['indication']; ?>"></td>
                                <td><input class="form-control-plaintext" type="text"
                                        value="<?php echo $row['instruction']; ?>"></td>
                                <form action="updatemed.php" method="get">
                                    <td>
                                        <button type="submit" class="btn btn-secondary btn-sm"
                                            value="<?php echo $row['med_id']; ?>" name="edit">Edit</button>
                                    </td>
                                </form>
                                <td><input type="button" id="<?php echo $row['med_id']; ?>" class="btn-close"
                                        onclick="deleteRow(this)">
                                </td>
                            </tr>
                            <?php
                                        $a++;
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
                    <div class="row">
                        <div class="col-5"></div>
                        <div class="col" style="margin-top : 10px">
                            <a href="medicine.php"><button type="submit" class="btn btn-secondary btn-lg" value="submit"
                                    name="submit">Submit</button></a>
                        </div>
                        <div class="col-4">
                            <p class="fs-6"> ** To save your work, please hit submit button</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>
<script>
var count = 0;

function deleteRow(btn) {
    count++;
    var row = btn.parentNode.parentNode;
    var val = btn.id;
    row.parentNode.removeChild(row);
    document.cookie = "del" + count + "=" + val;
    document.cookie = "count=" + count;
}
</script>
<?php


?>

</html>