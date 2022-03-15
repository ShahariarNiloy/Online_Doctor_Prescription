<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Update Medicine</title>
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
if (isset($_POST['submit'])) {
    $sql = "UPDATE `medicine` SET `gen_name`='$_POST[gen_name]',`med_name`='$_POST[med_name]',`type`='$_POST[type]',
`dose`='$_POST[dose]',`indication`='$_POST[indication]',`instruction`='$_POST[instruction]' WHERE med_id = '$_POST[submit]'";
    if ($conn->query($sql)) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
        echo "Medicine Inserted";
        echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
        echo "</div>";
        header("Location: medicine.php");
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
                    <h3><strong>Update Medicine Info</strong></h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-floating">
                                <?php
                                $sql = "SELECT * from medicine WHERE med_id = '$_GET[edit]'";
                                $query_run = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $row) {
                                        $med = $row;
                                    }
                                }
                                ?>
                                <input class="form-control me-2" type="search" placeholder="Generic Name"
                                    id="floatingTextarea" name="gen_name" value="<?php echo $med['gen_name']; ?>">
                                <label for="floatingTextarea" class="text-muted">Generic Name</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-floating">
                                <input class="form-control me-2" type="search" placeholder="Medicine Name"
                                    id="floatingTextarea" name="med_name" value="<?php echo $med['med_name']; ?>">
                                <label for="floatingTextarea" class="text-muted">Medicine Name</label>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-floating">
                                <select class="form-select" id="floatingTextarea" name="type" placeholder="Type">
                                    <option value="<?php echo $med['type']; ?>" disabled selected>
                                        <?php echo $med['type']; ?></option>
                                    <option value="Tab.">Tab</option>
                                    <option value="Cap.">Cap</option>
                                    <option value="Inj.">Inj.</option>
                                </select>
                                <label for="floatingTextarea" class="text-muted">Type</label>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="dose" placeholder="Usage"
                                    value="<?php echo $med['dose']; ?>" id="floatingTextarea">
                                <label for="floatingTextarea" class="text-muted">Type</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="indication" placeholder="Indication"
                                    value="<?php echo $med['indication']; ?>" id="floatingTextarea">
                                <label for="floatingTextarea" class="text-muted">Indication</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="instruction" placeholder="Instruction"
                                    value="<?php echo $med['instruction']; ?>" id="floatingTextarea">
                                <label for="floatingTextarea" class="text-muted">Instruction</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col" style="margin-top : 10px">

                            <button type="submit" class="btn btn-secondary" value="<?php echo $med['med_id'];; ?>"
                                name="submit">Submit</button>
                        </div>

                    </div>

                </div>
            </div>
        </form>
    </div>
</body>

</html>