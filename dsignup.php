<!doctype html>
<html lang="en">

<head>
    <title>Sing Up</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="index.css">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
    body {
        background-color: rgba(76, 175, 80, 0.5);
    }

    .error {
        color: red;
        padding-top: 5px;
        float: left;
    }

    .container {
        max-width: 50em;
        padding: 1em 1em 1em 1em;
        margin: 0em auto;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0px 3px 10px -2px rgba(0, 0, 0, 0.2);
        margin-top: 5%;
        margin-bottom: 10%;
    }

    .bo {
        padding-left: 30px;
    }

    .tb td {
        padding-top: 10px;
    }
    </style>
</head>

<body>

    <?php
    require 'database.php';
    if (isset($_POST['submit'])) {

        $name = $_POST['name'];
        $email = $_POST['email'];
        $pass = ($_POST['password']);
        $conpassword = ($_POST['conpass']);
        $phone = $_POST['phone'];


        if (empty($_POST["name"])) {
            $error_allert['name'] = "* Name is required";
        } else if (strlen($name) < 5 or strlen($name) > 20) {
            $error_allert['name'] = "* Only 5 to 20 characters";
        }


        if (empty($pass)) {
            $error_allert['password'] = "* Password is required";
        } else if (!preg_match("^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{6,32}$^", $pass)) {
            $error_allert['password'] = "* Password must contains at least one number, one upper case letter, one lower case letter and one special character.";
        }
        if (empty($phone)) {
            $error_allert['phone'] = "* Phone number is required";
        } else if (!preg_match("^(\+88)?(01)(4|6|7|8|9)\d{8}$^", $phone)) {
            $error_allert['phone'] = "Not valid phone number";
        }

        $passs = md5($pass);

        if (empty($conpassword)) {
            $error_allert['conpass'] = "* Field is Empty";
        } else if ($pass != $conpassword) {
            $error_allert['conpass'] = "* Password is not matched";
        }

        if ($email == "") {
            $error_allert['email'] = "* Email is required";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_allert['email'] = "* Email is invalid";
        }


        if (isset($_POST['type']) == "") {
            $error_allert['type'] = "* Type is required";
        }

        if (isset($_POST['gender']) == "") {
            $error_allert['gender'] = "* Gender is required";
        }

        if (empty($error_allert)) {

            $sql1 = "SELECT * from doctor WHERE email='$_POST[email]'";
            $result = mysqli_query($conn, $sql1);
            if ($result->num_rows > 0) {
                $conn->close();
                echo "<script>";
                echo "alert('Alreay Registered');";
                echo "window.location = 'test.php';";
                echo "</script>";
            } else {
                $def_pic = "images/default_doc.png";
                $sql = "INSERT INTO doctor (doc_name,types,phone,email,password,gender,picture) 
                VALUES ('$name', '$_POST[type]', '$phone', '$email', '$passs', '$_POST[gender]','$def_pic')";

                if ($conn->query($sql) === TRUE) {
                    $conn->close();
                    echo "<script>";
                    echo "alert('Registration Complete');";
                    echo "window.location = 'dsignin.php';";
                    echo "</script>";
                } else {
                    echo "<script> alert('Error inserting data: ' . $conn->error); </script>";
                }
                $conn->close();
            }
        }
    }
    ?>
    <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="container" align="center">
                <div class="card text-center">
                    <div class="card-header text-muted">
                        <h3><strong>Sign Up Form</strong></h3>
                    </div>
                </div>


                <table class="tb">
                    <tr>
                        <p style="padding-top: 10px;"></p>
                        <td><label for="Name">Full Name: </label></td>
                        <td class="bo"><input type="text" name="name" class="input-group-text" placeholder="Name"
                                autocomplete="off"></td>
                        <td><?php
                            if (isset($error_allert['name'])) {
                                echo "<div class= 'error'>" . $error_allert['name'] . "</div>";
                            }
                            ?><br></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td class="bo"><input type="email" name="email" class="input-group-text"
                                placeholder="your@email.com" autocomplete="off">
                        </td>
                        <td><?php
                            if (isset($error_allert['email'])) {
                                echo "<div class= 'error'>" . $error_allert['email'] . "</div>";
                            }
                            ?><br></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td class="bo"><input type="password" name="password" class="input-group-text"
                                placeholder="Password" autocomplete="off" id="pass">
                        </td>
                        <td><?php
                            if (isset($error_allert['password'])) {
                                echo "<div class= 'error'>" . $error_allert['password'] . "</div>";
                            }
                            ?><br></td>
                    </tr>
                    <tr>
                        <td>Confirm Password:</td>
                        <td class="bo"><input type="password" class="input-group-text" name="conpass"
                                placeholder="Conf. Password" autocomplete="off" id="con_pass"></td>
                        <td><?php
                            if (isset($error_allert['conpass'])) {
                                echo "<div class= 'error'>" . $error_allert['conpass'] . "</div>";
                            }
                            ?><br></td>
                    </tr>
                    <tr>
                        <td>Phone:</td>
                        <td class="bo"><input type="text" name="phone" class="input-group-text"
                                placeholder="Phone Number" autocomplete="off"></td>
                        <td><?php
                            if (isset($error_allert['phone'])) {
                                echo "<div class= 'error'>" . $error_allert['phone'] . "</div>";
                            }
                            ?><br></td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td class="bo">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="male" type="radio" name="gender"
                                    value="male">
                                <label class="form-check-label" for="male">
                                    Male
                                </label>

                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="female" type="radio" name="gender"
                                    value="female">
                                <label class="form-check-label" for="female">
                                    Female
                                </label>
                            </div>

                        </td>
                        <td><?php
                            if (isset($error_allert['gender'])) {
                                echo "<div class= 'error'>" . $error_allert['gender'] . "</div>";
                            }
                            ?><br></td>
                    </tr>
                    <tr>
                        <td>Specialist</td>
                        <td class='bo'>
                            <select name="type" class="input-group-text">
                                <option value="" disabled selected>Special Field</option>
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
                        </td>
                        <td><?php
                            if (isset($error_allert['type'])) {
                                echo "<div class= 'error'>" . $error_allert['type'] . "</div>";
                            }
                            ?><br></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="checkbox" onclick="showpass()"> Show Password</td>
                    </tr>
                </table>

                <p style="padding-top: 10px;"></p>
                <p style="padding-top: 10px;"><a href="dsignin.php">Already have an account?</a></p>
                <div class="row">
                    <div class="col">
                        <a><button type="submit" name="submit" class="btn btn-outline-success btn-lg">Sign
                                Up</button></a>

                    </div>

                </div>
                </p>

            </div>
        </form>
    </div>
</body>
<script>
function showpass() {
    var x = document.getElementById("pass");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
    var x = document.getElementById("con_pass");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
</script>

</html>