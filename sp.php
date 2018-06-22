<?php
  require_once('check.php');
  if(!$check){
    header("location:Ssignin.php");
    exit;
  }
  if(!($type == 'S')){
    header("location:ep.php");
    exit;
  }
  require_once('conn.php');

  $query = "SELECT * FROM students WHERE sid = '$id' AND email = '$email';";
$result = mysqli_query($dbc, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>InternStudent | VPNMAHAWAR</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/offcanvas.css">
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

  <div class="container"><br>
    <div class="jumbotron px-5">
    	<?php
            if($result){
                $row = mysqli_fetch_array($result);
                echo '<h3>Name: ' . $row['name'] . '</h3>';
                echo '<h3>Email: '. $row['email'] . '</h3>';
                echo '<h3>Password: '. $row['password'] . '</h3>';
                echo '<h3>Skills: '. $row['skills'] . '</h3>';
                echo '<h3>Address: '. $row['address']. '</h3>';
            }
        ?><br>
        <a href="us.php" class="btn btn-primary">Update Profile</a>
    </div>
  </div>

  <br><br><br><br><footer class="bg-dark fixed-bottom text-white" style="height: 50px;">
      <p class="my-3 text-center">&copy; <a href="http://vpnmahawar.site" target="_blank">VPNMAHAWAR</a></p>    
  </footer>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="js/offcanvas.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>