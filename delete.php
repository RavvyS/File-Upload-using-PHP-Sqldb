<?php
$id = $_GET['id'];
//$con = mysqli_connect("localhost","root","","codeaddict");
$con = new mysqli("localhost", "root", "", "Boat_Safari_Trip_Management_System");

if ($con->connect_error) {
    die("connection fail " . $con->connect_error);
}
$sql = "DELETE FROM `images` WHERE `id`='$id'";
$result = mysqli_query($con, $sql);
if ($result) {
    header("location: index.php");
}

?>