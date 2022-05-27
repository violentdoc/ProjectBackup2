<?php
session_start();
include ("connection.php");
include ("function.php");


if($_SERVER['REQUEST_METHOD'] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if(!empty($username) && !empty($password) && !is_numeric($username)) {

        $query = "SELECT * FROM `user` WHERE `username` LIKE '$username' ";
        $result = mysqli_query($con, $query);

        if ($result) {
            if ($result && mysqli_num_rows($result) > 0) {

                $user_data = mysqli_fetch_assoc($result);
                if ( $user_data['password'] == $password ) {
                    $_SESSION['user_id'] = $user_data['user_id'];
                    //header("Location:".$_SESSION['route']);
                    header("Location: index.php");
                    // echo '<script> alert("Login Successful") </script>';
                    die;
                }
            }
        }
        echo '<script> alert("Invalid username or password") </script>';
    }
    else{
        echo '<script> alert("Invalid username or password") </script>';
    }
}