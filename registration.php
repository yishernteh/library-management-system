<?php
  include "connection.php";
  include "navbar.php";
?>

<!DOCTYPE html>
<html>
<head>

  <title>Student Registration</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">




    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

  <style type="text/css">
    section
    {
      margin-top: -20px;
      height: 100vh; /* Full viewport height */
      width: 100%; /* Full viewport width */
      background-image: url("images/0000.webp");
      background-repeat: no-repeat;
      background-size: cover; /* Ensures the image covers the entire section */
      background-position: center; /* Centers the image */
    }
    .box
    {
        height: 400px;
        width: 450px;
        background-color: black;
        margin: 0px auto;
        opacity: .8;
        color: white;
        padding: 50px;
        padding-top: 150px;

    }
    label
    {
      font-weight: 600;
      font-size: 18px;
    }
  </style>   
</head>
<body>
<section><br><br><br><br><br>
    <div class="box">
      <form  name="signup" action="" method="post">
        <b><p style="padding-left: 50px; font-size: 15px; font-weight: 700">Sign Up as:</p></b>
        <input style="margin-left: 50px; width: 18px;" type="radio" name="user" id="admin" value="admin">
        <label for="admin">Admin</label>
        <input style="margin-left: 50px; width: 18px;" type="radio" name="user" id="student" value ="student" checked="">
        <label for="student">Student</label>

        <button class="btn btn-default" type="submit" name="submit1" style= "color: black; font-weight: 700; width: 70px; height: 30px;">Ok</button>

      </form>
    </div>
    <?php 
        if(isset($_POST['submit1']))
        {
          if($_POST['user']=='admin')
          {
            ?>
                <script type="text/javascript">
                    window.location = "Admin/registration.php";
                </script>
            <?php
          }
          else
          {
             ?>
                 <script type="text/javascript">
                    window.location = "Student/registration.php";
                </script>
             <?php
           }

          }
       
     ?>


  </section>

         
</body>
</html>