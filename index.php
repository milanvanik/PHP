<?php
include("config/config.php");
$config = new config();

$res = $config->connectDB();

// if ($res) {
//     echo "<h2> DATABASE SUCCESSFULLY CONNECTED! </h2>";
// } else {
//     echo "<h2> UNABLE TO CONNECT DATABASE. </h2>";
// }

/*
super global variable
Use this as per the method you use in your form but request is compatible with both.
$_GET
$_POST
$_REQUEST
@ => error control operator / ignores warning.
*/

if (isset($_REQUEST["btn_submit"])) {
    $name = @$_POST["name"];
    $age = @$_POST["age"];
    $course = @$_POST["course"];

    // echo "<br> Name: $name <br>";
    // echo "Age: $age <br>";
    // echo "Course: $course <br>";

    $resSTUD = $config->insertStudent($name, $age, $course);

    if ($resSTUD) {
        // header("Location: dashboard.php");
        echo '<div class="container col-6 mt-2">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>success! </strong>Student Inserted successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        </div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Failed!</strong>Student insertion failed.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
}
?>

<html>

<head>
    <title>Student Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <a href="index.php">Home</a> | <a href="dashboard.php">Dashboard</a>
    <div class="container mt-5">
        <div class="col-4">
            <h1>Add Student</h1>

            <form method="POST" class="pt-2">

                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
                <br> <br>
                <label>Age</label>
                <input type="number" name="age" class="form-control" required>
                <br> <br>
                <label>Course</label>
                <input type="text" name="course" class="form-control" required>
                <br> <br>
                <button name="btn_submit" class="btn btn-primary">Add Student</button>

            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>