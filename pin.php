<?php
	require_once('check.php');
	if (!$check) {
		header("location:checkSignIn.php");
    	exit;
	}
	require_once('conn.php');
	$name = $_POST['name'];
	$about = $_POST['about'];

	$name = stripcslashes($name);
	$about = stripcslashes($about);

	$name = mysqli_real_escape_string($dbc, $name);
	$about = mysqli_real_escape_string($dbc, $about);

	$query = "INSERT INTO internships VALUES (NULL, '$id', '$name', '$about');";
	#										 iid, eid, name, about
	$result = @mysqli_query($dbc, $query);

  $q1 = "SELECT * FROM internships WHERE name = '$name' AND about = '$about';";
  $r1 = @mysqli_query($dbc, $q1);
  $row = mysqli_fetch_array($r1);
  $iid = $row['iid'];

  echo 
  $q2 = "ALTER TABLE interns ADD COLUMN `$iid` ENUM('T', 'F') NOT NULL DEFAULT 'F';";
  $r2 = mysqli_query($dbc, $q2);

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

  <div class="container text-center">


	<?php

		if($result && $r2){
			echo '<img src="img/ok.png" alt="Internship Posted Successfully!!!" style="max-width:80%;float: center;">';
			echo '<h1>Internship Posted Successfully!!!</h1>';
		}
		else {
			echo "Couldn't issue database query";
			echo mysqli_error($dbc);
		}

		mysqli_close($dbc);
	?>
  </div>

  <br><br><br><br><footer class="bg-dark fixed-bottom text-white" style="height: 50px;">
      <p class="my-3 text-center">&copy; <a href="http://vpnmahawar.site" target="_blank">VPNMAHAWAR</a></p>    
  </footer>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="js/offcanvas.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>
