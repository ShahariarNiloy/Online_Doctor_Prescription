<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Patient Prescription</title>
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
include "nav.php";
$_SESSION['p_id'] = rand(time(), 1000000);
$_SESSION['pres_id'] = rand(time(), 10000000);
?>

<body>
    <form action="pdf.php" method="POST" id="printableArea">
        <div class="container">
            <div class="card text-center ">
                <div class="card-header text-muted">
                    <h3><strong>Patient Info</strong></h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <div class="form-floating">
                                <input class="form-control me-2" id="floatingTextarea" type="text"
                                    placeholder="Patient Name" name="patient_name" required>
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
                                    placeholder="Phone No." name="patient_phone">
                                <label for="floatingTextarea" class="text-muted">Phone No.</label>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-floating" style="margin-top: 15px;">
                                <input class="form-control me-2" id="floatingTextarea" type="text" placeholder="Address"
                                    name="patient_address">
                                <label for="floatingTextarea" class="text-muted">Address</label>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="card-footer text-muted">
                    <br>
                </div>
            </div>
            <div class="card text-center ">
                <div class="card-header text-muted">
                    <h3><strong>Condition</strong></h3>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-3"></div>
                        <div class="col-2">
                            <div class="form-floating">
                                <input class="form-control me-2" id="floatingTextarea" type="search"
                                    placeholder="Blood Pressure" name="bp">
                                <label for="floatingTextarea" class="text-muted">Blood Pressure</label>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-floating">
                                <input class="form-control me-2" id="floatingTextarea" type="number"
                                    placeholder="Temperature" name="temp">
                                <label for="floatingTextarea" class="text-muted">Temperature</label>
                            </div>

                        </div>
                        <div class="col-2">
                            <div class="form-floating">
                                <input class="form-control me-2" id="floatingTextarea" type="number"
                                    placeholder="Weight" name="weight">
                                <label for="floatingTextarea" class="text-muted">Weight</label>
                            </div>

                        </div>
                    </div>


                </div>
                <div class="card-footer text-muted">
                    <br>
                </div>
            </div>

        </div>
        <div class="row" style="margin-top: -12%;">
            <div class="col-6">
                <div class="container">
                    <div class="card text-center">
                        <div class="card-header text-muted">
                            <h3><strong>Symptom</strong></h3>
                        </div>
                        <div class="card-body">
                            <div class="form-floating" style="margin-top: 15px;">
                                <input class="form-control me-2" id="floatingTextarea" type="textarea" cols='100'
                                    rows='15' placeholder="Symptom" name="symptom">
                                <label for="floatingTextarea" class="text-muted">Symptom</label>
                            </div>
                        </div>
                    </div>
                    <div class="card text-center">
                        <div class="card-header text-muted">
                            <h3><strong>Test</strong></h3>
                        </div>

                        <div class="card-body">
                            <div class="form-floating" style="margin-top: 15px;">
                                <div class="input-row">
                                    <input class="form-control" list="datalistOptions" id="testid" name="test[]"
                                        placeholder="Test List">
                                    <datalist id="datalistOptions">

                                        <option value="CBC">
                                        <option value="RBC">
                                        <option value="Lipid Profile">
                                        <option value="X-Ray">
                                        <option value="Urine R/E">
                                        <option value="Urine C/S">
                                        <option value="HBs Ag ">
                                        <option value="Blood C/S">
                                        <option value="	S. Cholesterol">
                                        <option value="Blood Sugar">
                                        <option value="Creatinine">
                                        <option value="Platelet">
                                        <option value="Blood Film">
                                    </datalist>
                                    <button class="btn btn-secondary" id="myBtn1">Add</button>

                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <table id='3' style="margin: auto;">
                                    <thead>
                                        <tr>
                                            <th>Test List</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id='1'></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card text-center">
                            <div class="card-header text-muted">
                                <h3><strong>Advice</strong></h3>
                            </div>
                            <div class="card-body">
                                <div class="form-floating" style="margin-top: 15px;">
                                    <input class="form-control me-2" id="floatingTextarea" type="textarea" cols='100'
                                        rows='15' placeholder="Advice" name="advice">
                                    <label for="floatingTextarea" class="text-muted">Advice</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-6">
                <div class="container">
                    <div class="card text-center">
                        <div class="card-header text-muted">
                            <h3><strong>Medicine</strong></h3>
                        </div>
                        <div class="card-body">
                            <div class="form-floating" style="margin-top: 15px;">
                                <div class="input-row">
                                    <div class="row">
                                        <div class="col-2">
                                            <select class="form-select" id="typeid" name="type[]" placeholder="Type">
                                                <option value="" disabled selected>Type</option>
                                                <option value="Tab.">Tab</option>
                                                <option value="Cap.">Cap</option>
                                                <option value="Inj.">Inj.</option>
                                            </select>
                                        </div>
                                        <div class="col-10">
                                            <input class="form-control" list="medlist" id="medid" name="med[]"
                                                placeholder="Medicine Name" autocomplete="off">
                                            <datalist id="medlist">
                                                <?php
                                                require 'database.php';
                                                $doc_id = $_SESSION['id'];
                                                $sql = "SELECT * from medicine WHERE doc_id = '$doc_id'";
                                                $result = mysqli_query($conn, $sql);
                                                if ($result->num_rows > 0) {
                                                    while ($row = mysqli_fetch_array($result)) {
                                                ?>

                                                <option value="<?php echo $row['med_name']; ?>">
                                                    <?php }
                                                }
                                                $conn->close();
                                                    ?>
                                            </datalist>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-4">
                                            <input type="text" class="form-control" list="doselist" id="doseid"
                                                placeholder="Dose">
                                            <datalist id="doselist">
                                                <option value="_+_+_">
                                                <option value="_+_+_+_">
                                            </datalist>
                                        </div>
                                        <div class="col-6">
                                            <input type="text" class="form-control" id="instid"
                                                placeholder="Instruction">
                                        </div>
                                        <div class="col-2">
                                            <input type="text" class="form-control" id="dayid" placeholder="Days">
                                        </div>
                                    </div>
                                    <button class="btn btn-secondary" id="myBtn2">Add</button>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <table id='5'>
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Med Name</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id='6' style="margin: auto;"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-grid gap-2 col-6 mx-auto">
            <input class="btn btn-secondary" type="submit" name="submit">

        </div>

    </form>
</body>
<script>
const formEl = document.querySelector("form");
const tbodyEl = document.querySelector("[id='1']");
const tableEl = document.querySelector("[id='3']");

function onAddWebsite(e) {
    e.preventDefault();
    const testid = document.getElementById("testid").value;
    document.getElementById("testid").value = "";
    tbodyEl.innerHTML += `
            <tr  border="1">
            <td><b><input class="form-control-plaintext" type='text' value='${testid}' name='test[]'></b></td>
                <td><button class="btn-close"></button></td>
            </tr>
        `;
}

function onDeleteRow(e) {
    if (!e.target.classList.contains("btn-close")) {
        return;
    }

    const btn = e.target;
    btn.closest("tr").remove();
}
document.getElementById("myBtn1").addEventListener("click", onAddWebsite);
tableEl.addEventListener("click", onDeleteRow);



const formE2 = document.querySelector("form");
const tbodyE2 = document.querySelector("[id='6']");
const tableE2 = document.querySelector("[id='5']");

function onAddWebsite2(a) {
    a.preventDefault();
    const typeid = document.getElementById("typeid").value;
    const medid = document.getElementById("medid").value;
    const doseid = document.getElementById("doseid").value;
    const instid = document.getElementById("instid").value;
    const dayid = document.getElementById("dayid").value;

    document.getElementById("typeid").value = "";
    document.getElementById("medid").value = "";
    document.getElementById("doseid").value = "";
    document.getElementById("instid").value = "";
    document.getElementById("dayid").value = "";
    tbodyE2.innerHTML += `
            <tr>
            <td style="width: 5%"><b><input class="form-control-plaintext" type='text' value='${typeid}' name='type[]'></b></td>
            <td style="width: 40%"><b><input class="form-control-plaintext" type='text' value='${medid}' name='med[]'></b></td>
            <td style="width: 15%"><b><input class="form-control-plaintext" type='text' value='${doseid}' name='dose[]'></b></td>
            <td style="width: 20%"><b><input class="form-control-plaintext" type='text' value='${instid}' name='inst[]'></b></td>
            <td style="width: 15%"><b><input class="form-control-plaintext" type='text' value='${dayid}' name='day[]'></b></td>
                <td style="width: 5%"><button class="btn-close"></button></td>
            </tr>
        `;
}

function onDeleteRow2(a) {
    if (!a.target.classList.contains("btn-close")) {
        return;
    }

    const btn = a.target;
    btn.closest("tr").remove();
}
document.getElementById("myBtn2").addEventListener("click", onAddWebsite2);
tableE2.addEventListener("click", onDeleteRow2);

function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
}
</script>

</html>