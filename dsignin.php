<!doctype html>
<html lang="en">

<head>
    <title>Sign In</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="index.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
    body {
        background-color: rgba(76, 175, 80, 0.5);

    }

    .container {
        max-width: 30em;
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
    session_start();
    require 'database.php';
    if (isset($_POST['submit'])) {
        $pass = md5($_POST['password']);
        $sql = "SELECT * from doctor where email='$_POST[email]' && password = '$pass' ";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);

        if ($count > 0) {
            $docinfo = mysqli_fetch_assoc($result);
            $_SESSION['id'] = $docinfo['id'];
            $_SESSION['doc_name'] = $docinfo['doc_name'];
            $_SESSION['email'] = $docinfo['email'];
            header('Location: dashboard.php');
        } else {
            $conn->close();
            echo "<script>";
            echo "alert('Email or Password is not matched');";
            echo "</script>";
        }
    }
    ?>
    <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="container" align="center">

                <div class="card text-center">
                    <div class="card-header text-muted">
                        <h3><strong>Sign In</strong></h3>
                    </div>
                </div>

                <table class="tb">
                    <tr>
                        <td>Email:</td>
                        <td class="bo"><input class="input-group-text" type="email" name="email"
                                placeholder="your@email.com"
                                value="<?php if (isset($_POST['email'])) {
                                                                                                                                            echo $_POST['email'];
                                                                                                                                        } ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td class="bo"><input class="input-group-text" type="password" id="new_pass" name="password"
                                placeholder="Password"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="checkbox" onclick="showpass()"> Show Password</td>
                    </tr>
                </table>

                <p style="padding-top: 10px;"><a href="dsignup.php">Don't have an account? Register Now</a></p>
                <a><button type="submit" name="submit" class="btn btn-outline-success btn-lg">Sign In</button></a>

            </div>
        </form>
    </div>







    <script>
    function showpass() {
        var x = document.getElementById("new_pass");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    </script>
</body>

</html>