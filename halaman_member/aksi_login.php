<?php
$username = $_POST['username'];
$pass = md5($_POST['password']);
$role = $_POST['role'];
session_start();

include 'config/config.php';

$query1 = "SELECT * FROM member where username = '$username' AND password = '$pass' AND level ='$role'";
$query = $conn->query($query1);
if (mysqli_num_rows($query) == 1) {
    $data = $query->fetch_array();
    // $_SESSION['id_user'] = $data['id_user'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['level'] = $data['level'];
    if ($data['level'] == "Admin") {
        header("location:../admin pages/home.php");
    } else if ($data['level'] == "Member") {
        header("location:home.php");
    } else {
        echo "<script>
                    alert('Login Gagal, Username atau Password Salah!!!');
                    window.location.href = ('login.html');
                </script>";
    }
}
