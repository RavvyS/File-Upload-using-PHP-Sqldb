<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Upload Image</title>
</head>

<body>
    <div class="alert alert-secondary" role="alert">
        <h4 class="text-center">Upload Image</h4>
    </div>
    <div class="container col-12 m-5">
        <div class="col-6 m-auto">
            <?php

            error_reporting(E_ALL);
            ini_set('display_errors', 1);


            $con = new mysqli("localhost", "root", "", "Boat_Safari_Trip_Management_System");
            if ($con->connect_error) {
                die("Connection failed: " . $con->connect_error);
            }
            if (isset($_POST['btn_img'])) {
                $filename = $_FILES["choosefile"]["name"];
                $tempfile = $_FILES["choosefile"]["tmp_name"];
                $folder = "image/" . $filename;
                $sql = "INSERT INTO `images`(`image`) VALUES (?)";
                if ($filename == "") {
                    echo "<div class='alert alert-danger' role='alert'>
                            <h4 class='text-center'>Blank not Allowed</h4>
                        </div>";
                } else {
                    $stmt = $con->prepare($sql);
                    $stmt->bind_param("s", $filename);
                    $stmt->execute();
                    move_uploaded_file($tempfile, $folder);
                    echo "<div class='alert alert-success' role='alert'>
                            <h4 class='text-center'>Image uploaded</h4>
                        </div>";
                }
            }
            ?>
            <form action="index.php" method="post" enctype="multipart/form-data">
                <input type="file" name="choosefile" id="">
                <div class="col-6 m-auto ">
                    <button type="submit" name="btn_img" class="btn btn-outline-success m-4">
                        Submit
                    </button>
                </div>
            </form>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>image</th>
                        <th>button</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql2 = "SELECT * FROM `images`";
                    $result2 = $con->query($sql2);
                    if ($result2->num_rows > 0) {
                        while ($fetch = $result2->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $fetch['id'] . "</td>
                                    <td><img src='./image/" . $fetch['image'] . "' width='100px' alt=''></td>
                                    <td><a href='delete.php?id=" . $fetch['id'] . "' class='btn btn-outline-danger'>Delete</a></td>
                                </tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>