<?php
  include "connection.php";
  include "navbar.php";

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html>
<head>

  <title>Admin Registration</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

  <style type="text/css">
    section {
      margin-top: -20px;
    }
  </style>   

  <script type="text/javascript">
    function validatePassword() {
      const password = document.forms["Registration"]["password"].value;
      const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

      if (!passwordRegex.test(password)) {
        alert("Password must be at least 8 characters long, include at least one uppercase letter, one number, and one symbol.");
        return false;
      }
      return true;
    }
  </script>
</head>
<body>

<section>
  <div class="reg_img">

    <div class="box2">
        <h1 style="text-align: center; font-size: 35px;font-family: Lucida Console;"> Library Management System</h1>
        <h1 style="text-align: center; font-size: 25px;">Admin Registration Form</h1>
      <form name="Registration" action="" method="post" onsubmit="return validatePassword();">
        
        <div class="login">
          <input class="form-control" type="text" name="first" placeholder="First Name" required=""> <br>
          <input class="form-control" type="text" name="last" placeholder="Last Name" required=""> <br>
          <input class="form-control" type="text" name="username" placeholder="Username" required=""> <br>
          <input class="form-control" type="password" name="password" placeholder="Password" required=""> <br>
          <input class="form-control" type="text" name="email" placeholder="Email" required=""><br>
          <input class="form-control" type="text" name="contact" placeholder="Phone No" required=""><br>

          <input class="btn btn-default" type="submit" name="submit" value="Sign Up" style="color: black; width: 70px; height: 30px"> 
        </div>
      </form>
   </div>
  </div>
</section>

<?php
  if (isset($_POST['submit'])) {
    $count = 0;
    $sql = "SELECT username FROM admin";
    $res = mysqli_query($db, $sql);

    if (!$res) {
        die("Error querying database: " . mysqli_error($db));
    }

    while ($row = mysqli_fetch_assoc($res)) {
      if ($row['username'] == $_POST['username']) {
        $count++;
      }
    }

    $password = htmlspecialchars($_POST['password']); // Sanitize input
    $passwordRegex = "/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";

    if (!preg_match($passwordRegex, $password)) {
      echo "<script>alert('Password must be at least 8 characters long, include at least one uppercase letter, one number, and one symbol.');</script>";
    } else if ($count == 0) {
      $query = "INSERT INTO `admin` (`id`, `first`, `last`, `username`, `password`, `email`, `contact`, `pic`, `status`) 
                VALUES ('', '{$_POST['first']}', '{$_POST['last']}', '{$_POST['username']}', '{$password}', 
                        '{$_POST['email']}', '{$_POST['contact']}', '234.jpg', '');";

      if (mysqli_query($db, $query)) {
        echo "<script type='text/javascript'>window.location = '../login.php';</script>";
      } else {
        echo "Error inserting data: " . mysqli_error($db);
      }
    } else {
      echo "<script>alert('The username already exists');</script>";
    }
  }
?>

</body>
</html>

