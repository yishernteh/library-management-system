<?php
  include "connection.php";
  include "navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
  <title>Book Request</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <style type="text/css">

    .srch
    {
      padding-left: 850px;

    }
    .form-control
    {
      width: 300px;
      height: 40px;
      background-color: black;
      color: white;
    }
    
   body {
  background-image: url("images/1111.jpeg");
  background-repeat: no-repeat;
  background-size: cover; /* Makes the image cover the entire area */
  background-position: center; /* Centers the image */
  font-family: "Lato", sans-serif;
  transition: background-color .5s;
}


.sidenav {
  height: 100%;
  margin-top: 50px;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #222;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: white;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

#main {
  transition: margin-left .5s;
  padding: 16px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
.img-circle
{
  margin-left: 20px;
}
.h:hover
{
  color:white;
  width: 300px;
  height: 50px;
  background-color: #00544c;
}
.container
{
  height: 600px;
  background-color: black;
  opacity: .8;
  color: white;
}

  </style>

</head>
<body>
<!--_________________sidenav_______________-->
  
  <div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

        <div style="color: white; margin-left: 60px; font-size: 20px;">

                <?php
                if(isset($_SESSION['login_user']))

                {   echo "<img class='img-circle profile_img' height=120 width=120 src='images/".$_SESSION['pic']."'>";
                    echo "</br></br>";

                    echo "Welcome ".$_SESSION['login_user']; 
                }
                ?>
            </div><br><br>

 
  
  <div class="h"> <a href="request.php">Book Request</a></div>
  <div class="h"><a href="expired.php">Expired List</a></div>
  
</div>

<div id="main">
  
  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>


  <script>
  function openNav() {
    document.getElementById("mySidenav").style.width = "300px";
    document.getElementById("main").style.marginLeft = "300px";
    document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
  }

  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
    document.body.style.backgroundColor = "white";
  }
  </script>
  <br>

<div class="container">
  <div class="srch">
    <br>
    <form method="post" action="" name="form1">
      
    </form>
  </div>

  <h3 style="text-align: center;">Request of Book</h3>

  <?php
  
  if (isset($_SESSION['login_user'])) 
  {
    $q = mysqli_query($db,"SELECT * FROM `issue_book` WHERE `username` ='$_SESSION[login_user]' and approve='';");

  

    if (mysqli_num_rows($q) == 0) 
    {
        echo "<h2><b>";
        echo "There's no pending request.";
        echo "</h2></b>";
    } 
    else 
    {
        echo "<table class='table table-bordered' >";
        echo "<tr style='background-color: #6db6b9e6;'>";
      //Table header

        echo "<th>Book ID</th>";
        echo "<th>Approve Status</th>";
        echo "<th>Issue Date</th>";
        echo "<th>Return Date</th>";
       
        echo "</tr>";

        while ($row = mysqli_fetch_assoc($q)) 
        {
            echo "<tr>";
         
            echo "<td>" . $row['bookid'] . "</td>";
            echo "<td>" . $row['approve'] . "</td>";
            echo "<td>" . $row['issue'] . "</td>";
            echo "<td>" . $row['return'] . "</td>";
           
            echo "</tr>";
        }
        echo "</table>";
    }
}

  else
  {
    ?>
    <br>
      <h4 style="text-align: center;color: yellow;">You need to login to see the request.</h4>
      
    <?php
  }

  if(isset($_POST['submit']))
  {
    $_SESSION['name']=$_POST['username'];
    $_SESSION['bookid']=$_POST['bookid'];

    ?>
      <script type="text/javascript">
        window.location="approve.php"
      </script>
    <?php
  }

  ?>
  </div>
</div>
</body>
</html>