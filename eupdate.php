<?php
    require_once('check.php');
    if(!$check){
        header("location:Esignin.php");
        exit;
    }
    if(!($type == 'E')){
        header("location:us.php");
        exit;
    }
    require_once('conn.php');

    $name = $_POST['name'];
    $mail = $_POST['email'];
    $pass = $_POST['pass'];
    $cname = $_POST['cname'];
    $caddress = $_POST['caddress'];

    $name = stripcslashes($name);
    $mail = stripcslashes($mail);
    $pass = stripcslashes($pass);
    $cname = stripcslashes($cname);
    $caddress = stripcslashes($caddress);

    $name = mysqli_real_escape_string($dbc, $name);
    $mail = mysqli_real_escape_string($dbc, $mail);
    $pass = mysqli_real_escape_string($dbc, $pass);
    $cname = mysqli_real_escape_string($dbc, $cname);
    $caddress = mysqli_real_escape_string($dbc, $caddress);

    $query = "UPDATE employers SET name='$name', email='$mail', password='$pass', cname='$cname', caddress='$caddress'
    WHERE eid='$id' AND email='$email';";

    $r = mysqli_query($dbc, $query);

    if ($r) {
        header("location:ep.php");
        exit;
    }
    else {
        echo '<h1>Profile Update Failed</h1><br>';
        echo mysqli_error($dbc);
    }
    mysqli_close($dbc);
?>