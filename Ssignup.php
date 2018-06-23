<?php
  ob_start();
  require_once('check.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>InternStudent | VPNMAHAWAR</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/offcanvas.css">
  <link href="css/signup.css" rel="stylesheet">
</head>
  <body class="bg-light">

    <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
      <a class="navbar-brand" href="#">Intern Student</a>
      <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Internships <span class="sr-only">(current)</span></a>
          </li>
          <?php
            if($check){
              if($_SESSION['User'] == 'E'){
                echo
                  '<li class="nav-item">
                    <a class="nav-link" href="ep.php">Profile</a>
                  </li>';
                echo
                  '<li class="nav-item">
                    <a class="nav-link" href="PostInternship.php">Post Internship</a>
                  </li>';
                echo
                  '<li class="nav-item">
                    <a class="nav-link" href="allIn.php">Your Internships</a>
                  </li>';
              }
              else{
                echo
                '<li class="nav-item">
                  <a class="nav-link" href="sp.php">Profile</a>
                </li>';
              }
              echo '<li class="nav-item">
                <a class="nav-link" href="logout.php">Sign Out</a>
              </li>';
            }
            else {
              echo
              '<li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sign In</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                  <a class="dropdown-item" href="Esignin.php">Employer</a>
                  <a class="dropdown-item" href="Ssignin.php">Student</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sign Up</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                  <a class="dropdown-item" href="Esignup.php">Employer</a>
                  <a class="dropdown-item" href="Ssignup.php">Student</a>
                </div>
              </li>';
            }
          ?>
        </ul>
        <?php
            if($check){
              echo 
                '<div class="collapse navbar-collapse justify-content-end">
                  <ul class="navbar-nav">
                    <li class="nav-item">
                      <a class="nav-link" href="#">Welcome, ';
                      echo "$email";
                      echo  "</a></li></ul></div>";
            }
        ?>
      </div>
    </nav><br><br>
    <div class="container text-center">
        <br><br><br><Br><img class="mb-4" src="img/sign-up.png" alt="Plaese Sign Up" style="max-width: 360px; max-height: 100 ; width: 60%">

        <form class="form-signup" method="POST" action="Ssignup.php">

            <h1 class="h3 mb-3 font-weight-normal">Student Sign Up</h1>

            <label for="Name" class="sr-only">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Your Good Name" maxlength="50" required autofocus>

            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" name="email" class="form-control" placeholder="Email address" required autofocus>

            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name="pass" class="form-control" placeholder="Password" required>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign Up</button>
<?php

  
  if (isset($_POST['email'])){
    require_once('conn.php');

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['pass'];

    $name = stripcslashes($name);
    $email = stripcslashes($email);
    $password = stripcslashes($password);

    $name = mysqli_real_escape_string($dbc, $name);
    $email = mysqli_real_escape_string($dbc, $email);
    $password = mysqli_real_escape_string($dbc, $password);

    $q1 = "SELECT * FROM students WHERE email = '$email';";
    $r1 = mysqli_query($dbc, $q1);

    $rw1 = mysqli_num_rows($r1);
    if ($rw1 > 0){
      echo '<p>Already Signed Up with this email<br>
      Try different email or
            <a class="btn btn-lg btn-primary btn-block" href="Ssignin.php">Sign In</a> <br>'; 
    }
    else{
      $query1 = "INSERT INTO students (name, email, password) VALUES ('$name', '$email', '$password');";
      $response1 = @mysqli_query($dbc, $query1);
      $query2 = "INSERT INTO interns (name) VALUES ('$name');";
      $response2 = @mysqli_query($dbc, $query2);
      if($response1){
        $q2 = "SELECT * FROM students WHERE email = '$email' AND password = '$password';";
        $r2 = mysqli_query($dbc, $q2);
        if(!$r2){
          echo "Sign Up Unsuccessfull!!!";
          echo mysqli_error($dbc);
        }
        $row = mysqli_fetch_array($r2);
        $_SESSION['User'] = 'S';
        $_SESSION['Username']=$email;
        $_SESSION['id'] = $row['sid'];
        header("location:sp.php");
      }
    }
  }
?>

        </form>
      <p class="mt-5 mb-3 text-muted text-center">&copy; <a href="http://vpnmahawar.site" target="_blank">VPNMAHAWAR</a></p>    
    </div>
    <br><br><br>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="js/offcanvas.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>