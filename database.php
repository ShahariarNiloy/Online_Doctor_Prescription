<?php
$conn = mysqli_connect("localhost", "root", "", "dummy");
if ($conn->connect_error) {
    echo ("error connection" . mysqli_connect_error());
    exit();
}