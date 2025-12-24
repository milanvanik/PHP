<?php
include("config/config.php");
$config = new Config();

$result = $config->fetchAllStudents();
// while ($data = mysqli_fetch_assoc($result)) {
//     print_r($data);
//     echo "<br>";
// }

if (isset($_POST['btn-delete'])) {
    $deleteId = $_POST['delete_id'];
    $res = $config->deleteStud($deleteId);

    if ($res) {
        echo '<div class="container col-6 mt-2">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>success! </strong>Student deleted successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        </div>';
        $result = $config->fetchAllStudents();
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Failed!</strong>Student deletion failed.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: black;
            color: powderblue;
        }
    </style>
</head>

<body>
    <a href="index.php">Home</a> | <a href="dashboard.php">Dashboard</a>

    <div class="container mt-5">
        <div class="col-8">
            <table class="table table-striped table-dark table-hover text-center">
                <thead class="text-center">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">NAME</th>
                        <th scope="col">AGE</th>
                        <th scope="col">COURSE</th>
                        <th scope="col " colspan="2">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($data = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <th scope="row"><?php echo $data['id'] ?></th>
                            <td><?php echo $data['name'] ?></td>
                            <td><?php echo $data['age'] ?></td>
                            <td><?php echo $data['course'] ?></td>
                            <td>
                                <form method="POST">
                                    <button name="btn-delete" class="btn btn-danger">DELETE</button>
                                    <input type="hidden" name="delete_id" value="<?php echo $data['id'] ?>">
                                </form>

                            </td>
                            <td>
                                <button class="btn btn-warning">EDIT</button>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>