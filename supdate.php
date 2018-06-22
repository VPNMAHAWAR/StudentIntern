<?php
    require_once('check.php');
    if(!$check){
        header("location:Esignin.php");
        exit;
    }
    if(!($type == 'S')){
        header("location:ue.php");
        exit;
    }
    require_once('conn.php');

    $name = $_POST['name'];
    $mail = $_POST['email'];
    $pass = $_POST['pass'];
    $skills = $_POST['skills'];
    $address = $_POST['address'];

    $name = stripcslashes($name);
    $mail = stripcslashes($mail);
    $pass = stripcslashes($pass);
    $skills = stripcslashes($skills);
    $address = stripcslashes($address);

    $name = mysqli_real_escape_string($dbc, $name);
    $mail = mysqli_real_escape_string($dbc, $mail);
    $pass = mysqli_real_escape_string($dbc, $pass);
    $skills = mysqli_real_escape_string($dbc, $skills);
    $address = mysqli_real_escape_string($dbc, $address);

    $query = "UPDATE students SET name='$name', email='$mail', password='$pass', skills='$skills', address='$address'
    WHERE sid='$id' AND email='$email';";

    $r = mysqli_query($dbc, $query);

    if ($r) {
        header("location:sp.php");
        exit;
    }
    else {
        echo '<h1>Profile Update Failed</h1><br>';
        echo mysqli_error($dbc);
    }
    mysqli_close($dbc);
?>