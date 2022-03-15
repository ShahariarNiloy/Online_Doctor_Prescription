<?php
require "database.php";


session_start();


$doc_id = $_SESSION['id'];
if (isset($_POST['submit'])) {
    $sql = "INSERT INTO patient (p_number,doc_id,p_name,p_age,p_gender,p_phone,p_address) VALUE ('$_SESSION[p_id]','$doc_id','$_POST[patient_name]','$_POST[patient_age]','$_POST[patient_gender]','$_POST[patient_phone]','$_POST[patient_address]')";
    if ($conn->query($sql)) {
    } else {
    }

    $pres = $_SESSION["pres_id"];
    $sql1 = "INSERT INTO `prescription`( `press_number`,`doc_id`, `p_id`, `p_weight`, `p_bp`, `p_temp`, `p_symptom`, `p_advice`) VALUES ('$pres','$doc_id','$_SESSION[p_id]','$_POST[weight]','$_POST[bp]','$_POST[temp]','$_POST[symptom]','$_POST[advice]')";
    if ($conn->query($sql1)) {
    } else {
    }
    if (isset($_POST['test'])) {
        $test = $_POST['test'];
        $a = 0;
        foreach ($test as $key => $val) {
            if ($a == 0) {
                $a++;
                continue;
            }
            $sql2 = "INSERT INTO `test`(`press_number`, `p_id`, `test_name`) VALUES ('$pres','$_SESSION[p_id]','$val')";
            if ($conn->query($sql2)) {
            } else {
            }
        }
    }
    if (isset($_POST['med'])) {
        $type = $_POST['type'];
        $med = $_POST['med'];
        $dose = $_POST['dose'];
        $inst = $_POST['inst'];;
        $day = $_POST['day'];
        $j = count($type);
        for ($i = 0; $i < $j; $i++) {
            $a = $i + 1;
            $sql3 = "INSERT INTO `pres_medicine`(`press_number`, `p_id`, `med_type`, `med_name`, `med_dose`, `med_inst`, `med_day`) 
                VALUES ('$pres','$_SESSION[p_id]','$type[$i]','$med[$a]','$dose[$i]','$inst[$i]','$day[$i]')";
            if ($conn->query($sql3)) {
                $sql = "SELECT * from medicine WHERE doc_id = '$_SESSION[id]' && med_name LIKE '%$med[$a]%'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) == 0) {
                    $sql5 = "INSERT INTO `medicine`( `doc_id`, `med_name`, `type`, `dose`, `instruction`) 
                    VALUES ('$_SESSION[id]','$med[$a]','$type[$i]','$dose[$i]','$inst[$i]')";
                    if ($conn->query($sql5)) {
                    }
                }
            } else {
            }
        }
    }
}


if (isset($_POST['old_submit'])) {
    $pres = $_SESSION["pres_id"];
    $sql1 = "INSERT INTO `prescription`( `press_number`,`doc_id`, `p_id`, `p_weight`, `p_bp`, `p_temp`, `p_symptom`, `p_advice`) VALUES ('$pres','$doc_id','$_SESSION[p_id]','$_POST[weight]','$_POST[bp]','$_POST[temp]','$_POST[symptom]','$_POST[advice]')";
    if ($conn->query($sql1)) {
    } else {
    }
    if (isset($_POST['test'])) {
        $test = $_POST['test'];
        foreach ($test as $key => $val) {
            $sql2 = "INSERT INTO `test`(`press_number`, `p_id`, `test_name`) VALUES ('$pres','$_SESSION[p_id]','$val')";
            if ($conn->query($sql2)) {
            } else {
            }
        }
    }
    if (isset($_POST['med'])) {
        $type = $_POST['type'];
        $med = $_POST['med'];
        $dose = $_POST['dose'];
        $inst = $_POST['inst'];;
        $day = $_POST['day'];
        $j = count($type);
        for ($i = 0; $i < $j; $i++) {
            $a = $i + 1;
            $sql3 = "INSERT INTO `pres_medicine`(`press_number`, `p_id`, `med_type`, `med_name`, `med_dose`, `med_inst`, `med_day`) 
                VALUES ('$pres','$_SESSION[p_id]','$type[$i]','$med[$a]','$dose[$i]','$inst[$i]','$day[$i]')";
            if ($conn->query($sql3)) {
                $sql = "SELECT * from medicine WHERE doc_id = '$_SESSION[id]' && med_name LIKE '%$med[$a]%'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) == 0) {
                    $sql5 = "INSERT INTO `medicine`( `doc_id`, `med_name`, `type`, `dose`, `instruction`) 
                    VALUES ('$_SESSION[id]','$med[$a]','$type[$i]','$dose[$i]','$inst[$i]')";
                    if ($conn->query($sql5)) {
                    }
                }
            } else {
            }
        }
    }
}
?>
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
    <title>Document</title>
    <style type="text/css" media="print">
    @page {
        size: auto;
        margin: 0mm;
    }

    html {
        background-color: #FFFFFF;
        margin: 0px;
    }
    </style>
</head>
<?php
$sql = "SELECT * from doctor where id = $_SESSION[id]";
$query_run = mysqli_query($conn, $sql);
if (mysqli_num_rows($query_run) > 0) {
    foreach ($query_run as $row) {
        $doc = $row;
    }
}

$sql = "SELECT * from patient where p_number = $_SESSION[p_id]";
$query_run = mysqli_query($conn, $sql);
if (mysqli_num_rows($query_run) > 0) {
    foreach ($query_run as $row) {
        $patient = $row;
    }
}

$sql = "SELECT * FROM `prescription` WHERE press_number = $_SESSION[pres_id]";
$query_run = mysqli_query($conn, $sql);
if (mysqli_num_rows($query_run) > 0) {
    foreach ($query_run as $row) {
        $currentinfo = $row;
    }
}
?>

<body>
    <div class="container" id="printableArea">
        <div class="row mt-5" style="border-bottom: 1px solid; width:100%!important">
            <div class="col-md-3 p-1 " style="width:70%!important">
                <p class="fs-3 "><b>Dr. <?php echo $_SESSION['doc_name']; ?></b></p>

                <p class="fs-5 " style="margin-top: -15px;"><?php echo $doc['types']; ?>,
                    <?php echo $doc['degree']; ?>
                <p class="fs-5 " style="margin-top: -25px;"><?php echo $doc['designation']; ?></p>
                <p class="fs-5 " style="margin-top: -25px;"><?php echo $doc['email']; ?></p>

            </div>
            <div class="col-md-3 " style="width:30%!important">
                <p class="fs-6 " style="margin-top: -35px;">Patient ID:
                    <?php echo $patient['p_number']; ?></p>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-8">
                <h3 class="text-center">Patient Info</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Patient Name</th>
                            <th scope="col">Age</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Phone No.</th>
                            <th scope="col">Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row"><?php echo $patient['p_name']; ?></th>
                            <td><?php echo $patient['p_age']; ?></td>
                            <td><?php echo $patient['p_gender']; ?></td>
                            <td><?php echo $patient['p_phone']; ?></td>
                            <td><?php echo $patient['p_address']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4 ">
                <h3 class="text-center">Current Info</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Weight</th>
                            <th scope="col">BP</th>
                            <th scope="col">Temperature</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row"><?php echo $currentinfo['p_weight']; ?></th>
                            <td><?php echo $currentinfo['p_bp']; ?></td>
                            <td><?php echo $currentinfo['p_temp']; ?></td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-5 " style="width: 100%!important;">
            <div class="col-md-4" style="width: 30%!important;">
                <h3 class="text-center border-bottom">Test</h3>
                <ul class="list-group list-group-flush">
                    <?php
                    $sql = "SELECT * from test Where press_number = $_SESSION[pres_id]";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <li class="list-group-item text-center"><?php echo $row['test_name']; ?></li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="col-md-8 border-start" style="width: 70%!important;">
                <h3 class="text-center border-bottom">Medicine</h3>
                <ul class="list-group list-group-flush">
                    <?php
                    $sql = "SELECT * FROM `pres_medicine` Where press_number = $_SESSION[pres_id]";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $med = $row['med_type'] . "    " . $row['med_name'] . "                        (" . $row['med_dose'] . ")    " . $row['med_inst'] . "    ...... " . $row['med_day'];
                    ?>
                    <li class="list-group-item text-center"><?php echo $med; ?></li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div>
            <p> </p>
        </div>
        <div>
            <p> </p>
        </div>
        <div class="text-center">
            <p class="fs-6 ">Advice: <?php echo $currentinfo['p_advice']; ?></p>
        </div>
        <button type="button" class="btn btn-secondary" onclick="printDiv('printableArea')" id="hide"
            value="print a div!">print</button>
    </div>
</body>
<script>
function printDiv(divName) {
    const d = new Date();
    document.title = d.getTime();
    var printContents = document.getElementById('hide').style.display = "none";

    window.print();
    window.location.href = "http://localhost/dummy/dashboard.php";

}
</script>

</html>