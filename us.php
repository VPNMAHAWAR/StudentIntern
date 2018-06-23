<?php
    ob_start();
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
    <br>
    <div class="container text-left">
       <div class="row">
        <div class="col">
            <br><br>
            <?php
            if($result){
                $row = mysqli_fetch_array($result);
                echo '<h4>Name: ' . $row['name'] . '</h4>';
                echo '<h4>Email: '. $row['email'] . '</h4>';
                echo '<h4>Password: '. $row['password'] . '</h4>';
                echo '<h4>Skills: '. $row['skills'] . '</h4>';
                echo '<h4>Address: '. $row['address']. '</h4>';
            }
        ?><br>
        </div>
        <div class="col">
            <h2 class="text-center">Update Profile</h2>
            <form class="form-signup" method="POST" action="supdate.php">
            <table align="left" cellspacing="5" cellpadding="8">
                <tr>
                   <td><b>Name: </b></td>
                    <td><input type="text" id="Name" name="name" class="form-control" placeholder="Name" maxlength="30" required autofocus></td>
                </tr>
            <tr>    
                <td><b>Email: </b></td>
                <td><input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus></td>
            </tr>
            <tr>
                <td><b>Password: </b></td>
                <td><input type="password" id="inputPassword" name="pass" class="form-control" placeholder="Password" required></td>
            </tr>
            <tr>
                <td><b>Skills: </b></td>
                <td><input type="text" id="Skills" name="skills" class="form-control" placeholder="Skills Sepreted by Semi-Colon" maxlength="60"></td>
            </tr>
            <tr>
                <td><b>Address: </b></td>
                <td><input type="text" id="Add" name="address" class="form-control" placeholder="Address" maxlength="60"></td>
            </tr>
            <tr>
                <td></td>
                <td><button class="btn btn-lg btn-primary btn-block" type="submit">Update</button></td>
            </tr>
        </table>
    </form>
        </div>
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