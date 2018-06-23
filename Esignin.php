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
  <link href="css/signin.css" rel="stylesheet">
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
      <img src="img/sign_in-01.png" alt="Please Sign In" style="max-width: 360px; max-height: 100; width: 60%">
      <form class="form-signin" method="POST" action="Esignin.php">
        <h1 class="h3 mb-3 font-weight-normal">Employer sign in</h1>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="pass" class="form-control" placeholder="Password" required>

<?php
  if (isset($_POST['email'])){

    require_once('conn.php');

    $email = $_POST['email'];
    $password = $_POST['pass'];

    $email = stripcslashes($email);
    $password = stripcslashes($password);

    $email = mysqli_real_escape_string($dbc, $email);
    $password = mysqli_real_escape_string($dbc, $password);

    $query = "SELECT * FROM employers WHERE email = '$email' AND password = '$password';";
    
    $response = mysqli_query($dbc, $query);

    $result = mysqli_num_rows($response);
    if($result==1){
      $row = mysqli_fetch_array($response);
      $_SESSION['User'] = 'E';
      $_SESSION['Username']=$email;
      $_SESSION['id'] = $row['eid'];
      header("location:ep.php");
    }
    else {
      echo "<p>Username/Password Wrong !!!<br>";
      echo '
        Not Signed Up Yet!! Sign Up Now <br><br><a class="btn btn-lg btn-primary btn-block" href="Esignup.php">Sign Up</a> 
       </p>
       ';
    }
    mysqli_close($dbc);
  }
  else {}
?>


        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
      <p class="mt-5 mb-3 text-muted text-center">&copy; <a href="http://vpnmahawar.site" target="_blank">VPNMAHAWAR</a></p>   
    </div>
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="js/offcanvas.js"></script>
  <script src="js/bootstrap.min.js"></script>
  </body>
</html>