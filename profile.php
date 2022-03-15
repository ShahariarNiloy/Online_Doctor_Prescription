<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

    <style>
    .container2 {
        width: 50%;
        padding: 1em 3em 2em 3em;
        margin: 0em auto;
        background-color: #fff;
        border-radius: 4.2px;
        box-shadow: 0px 3px 10px -2px rgba(0, 0, 0, 0.2);
        margin-top: 10%;
        margin-bottom: 10%;
    }

    .container1 {
        padding-top: 15px;
        position: relative;
        text-align: center;
    }

    img {

        left: 0px;
        top: 0px;
        z-index: -5;
        position: relative;
        text-align: center;
        border-radius: 50%;
        height: 200px;
        width: 200px;
    }
    </style>
</head>
<?php
require 'database.php';
include 'nav.php';
if (isset($_FILES['image'])) {
    $errors = array();
    $file_name = $_FILES['image']['name'];

    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $file_explode = explode('.', $file_name);
    $file_ext = strtolower(end($file_explode));

    $extensions = array("jpeg", "jpg", "png");

    if (in_array($file_ext, $extensions) == false) {
        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
    }

    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "images/" . $file_name);
        $file = "images/" . $file_name;
        $doc = $_SESSION['email'];
        $sql = "UPDATE doctor SET picture = '$file' WHERE email = '$doc'";
        if ($conn->query($sql) === TRUE) {
            echo "<script>";
            echo "alert('Profile image Updated');";
            echo "window.location = 'profile.php';";
            echo "</script>";
        } else {
            echo "false";
            echo "Error updating data: ' . $conn->error";
        }
    } else {
        print_r($errors);
    }
}
if (isset($_POST['submit'])) {
    $doc = $_SESSION['email'];
    $sql = "UPDATE doctor SET doc_name ='$_POST[name]',types='$_POST[types]',dob='$_POST[dob]',phone='$_POST[phone]',designation='$_POST[designation]',experience='$_POST[experience]',bloodgroup='$_POST[bloodgroup]',address='$_POST[address]',degree='$_POST[degree]' Where email = '$doc'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>";
        echo "alert('Profile Info Updated');";
        echo "window.location = 'profile.php';";
        echo "</script>";
    } else {
        echo "<script> alert('Error updating data: ' . $conn->error); </script>";
    }
}
?>

<body>
    <div class="container1" align="center" style="margin-bottom: -150px;">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            <?php
            $doc = $_SESSION['email'];
            $sql = "SELECT * from doctor where email = '$doc'";
            $result = mysqli_query($conn, $sql);
            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_array($result)) {
            ?>
            <img class="" src="<?php echo $row['picture'] ?>" alt="<?php echo $row['picture'] ?>">;
            <?php
                }
            }
            ?>
            <input type="file" name="image" />
            <button type="submit" class="btn btn-secondary" value="Upload" name="submitt">Submit</button>
        </form>
    </div>
    <div class="container2">


        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <?php
            $doc = $_SESSION['email'];
            $sql = "SELECT * from doctor where email = '$doc'";
            $result = mysqli_query($conn, $sql);
            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_array($result)) {
            ?>
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control" name="name" value="<?php echo $row['doc_name']; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Specialist</label>
                <select class="form-control" name="types">
                    <option value="<?php echo $row['types']; ?>" selected> <?php echo "" . $row['types']; ?>
                    </option>
                    <option value="Cardiologist">Cardiologist</option>
                    <option value="Dentist">Dentist</option>
                    <option value="ENT">ENT specialist</option>
                    <option value="Gynaecologist">Gynaecologist</option>
                    <option value="Paediatrician">Paediatrician</option>
                    <option value="Psychiatrists">Psychiatrists</option>
                    <option value="Oncologist">Oncologist</option>
                    <option value="Hematlogis">Hematologist</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Designation</label>
                <select class="form-control" aria-label="Default select example" name="designation">
                    <option value="<?php echo $row['designation']; ?>" selected> <?php echo "" . $row['designation']; ?>
                    </option>
                    <option value="Medical Student">Medical Student</option>
                    <option value="Intern">Intern</option>
                    <option value="Fellow">Fellow</option>
                    <option value="Head of Dept.">Head od Dept.</option>
                    <option value="Chief Resident">Chief Resident</option>
                    <option value="Senior Resident">Senior Resident</option>
                    <option value="Junior Resident">Junior Resident</option>
                    <option value="Medical Director">Medical Director</option>
                    <option value="Attending Physician">Attending Physician</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Degrees</label>
                <input type="text" class="form-control" name="degree" value="<?php echo $row['degree']; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Experience</label>
                <input type="text" class="form-control" name="experience" value="<?php echo $row['experience']; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Date of Birth</label>
                <input type="date" class="form-control" name="dob" value="<?php echo $row['dob']; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Gender</label>
                <input type="text" class="form-control" name="gender" value="<?php echo $row['gender']; ?>" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">Phone No</label>
                <input type="text" class="form-control" name="phone" value="<?php echo $row['phone']; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Blood Group</label>
                <select class="form-control" aria-label="Default select example" name="bloodgroup">
                    <option value="<?php echo $row['bloodgroup']; ?>" selected><?php echo "" . $row['bloodgroup']; ?>
                    </option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Address</Address></label>
                <input type="text" class="form-control" name="address" value="<?php echo $row['address']; ?>">
            </div>
            <?php
                    $conn->close();
                }
            }
            ?>


            <button type="submit" class="btn btn-secondary" value="Upload" name="submit">Submit</button>
        </form>
    </div>


</body>

</html>