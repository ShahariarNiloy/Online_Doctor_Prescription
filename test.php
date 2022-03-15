<?php
if (isset($_POST['submit'])) {
    $errors = array();
    $file_name = $_FILES['image']['name'];

    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));

    $extensions = array("jpeg", "jpg", "png");

    if (in_array($file_ext, $extensions) === false) {
        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
    }



    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "images/" . $file_name);
        echo "$file_name<br>";
        print($_FILES['image']['tmp_name']);
    } else {
        print_r($errors);
    }
}
?>
<html>

<body>
    <?php if (isset($_POST['submit'])) {
        $price = $_POST['name'];
        foreach ($price as $key => $val) {
            echo $val;
            echo "<br>";
        }
        echo $_POST['list'];
    } ?>
    <form action="" method="post">



        <div class="input-group">
            <span class="input-group-text">First and last name</span>
            <input type="text" aria-label="First name" class="form-control" name="name[]">
            <input type="text" aria-label="Last name" class="form-control" name="name[]">
            <button type="submit" class="btn btn-secondary" value="Upload" name="submit">Submit</button>
        </div>
    </form>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="image" />
        <button type="submit" class="btn btn-secondary" value="Upload" name="submit">Submit</button>
    </form>
    <input type='text' list='listid'>
    <datalist id='listid'>
        <option label='label1' value='napa'>
        <option label='label2' value='nama'>
        <option label='label1' value='ace'>
        <option label='label2' value='diclofen'>
        <option label='label1' value='napa extra'>
        <option label='label2' value='shsh'>

    </datalist>
    <img src="images/bg.png" alt="">;
</body>

</html>

<?php
/*$doc = $_SESSION['email'];
$sql = "SELECT * from doctor where email = '$doc'";
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        echo "hi";
    }
}*/
?>