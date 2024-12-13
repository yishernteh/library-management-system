<?php
  include "connection.php";
  include "navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
  <title>Books</title>
  <style type="text/css">
    .srch
    {
        padding-left: 1000px;
    }
    body {
  font-family: "Lato", sans-serif;
  transition: background-color .5s;
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
  </style>
</head>
<body>
  <!--______________________________________________sidenav___________________________________________________-->
  

  <!-- ________________________________________________search bar_________________________________________________-->

  <div class="srch">
    <form class="navbar-form" method="post" name="search_form">
        <input class="form-control" type="text" name="search" placeholder="Search books.." required="">
        <button style="background-color: #6db6b9e6;" type="submit" name="search_submit" class="btn btn-default">
            <span class="glyphicon glyphicon-search"></span>
        </button>
    </form>
</div>
<!____________________________________________________request book__________________________________________----_-->

<div class="srch">
    <form class="navbar-form" method="post" name="request_form">
        <input class="form-control" type="text" name="bookid" placeholder="Enter Book ID" required="">
        <button style="background-color: #6db6b9e6;" type="submit" name="submit1" class="btn btn-default">Request</button>
    </form>
</div>

  
  <h2>List Of Books</h2>
  <?php

      if(isset($_POST['search_submit']))
      {
          $q=mysqli_query($db,"SELECT * FROM books where name like '%$_POST[search]%'");

          if (mysqli_num_rows($q)==0)
          {
              echo "Sorry! No book found. Try searching again.";
          }
          else
          {
          echo "<table class='table table-bordered table-hover' >";
          echo "<tr style='background-color: #6db6b9e6;'>";
                //Table header
                echo "<th>"; echo "ID"; echo "</th>";
                echo "<th>"; echo "Book-Name";  echo "</th>";
                echo "<th>"; echo "Authors Name";  echo "</th>";
                echo "<th>"; echo "Edition";  echo "</th>";
                echo "<th>"; echo "Status";  echo "</th>";
                echo "<th>"; echo "Quantity";  echo "</th>";
                echo "<th>"; echo "Department";  echo "</th>";
          echo "</tr>"; 

          while($row=mysqli_fetch_assoc($q))
          {
                echo "<tr>";
                echo "<td>"; echo $row['bookid']; echo "</td>";
                echo "<td>"; echo $row['name']; echo "</td>";
                echo "<td>"; echo $row['authors']; echo "</td>";
                echo "<td>"; echo $row['edition']; echo "</td>";
                echo "<td>"; echo $row['status']; echo "</td>";
                echo "<td>"; echo $row['quantity']; echo "</td>";
                echo "<td>"; echo $row['department']; echo "</td>";

          echo "</tr>";
          }
          echo "</table>"; 
          }
        }
              /* if button is not pressed. */
          else
          {
              $res=mysqli_query($db,"SELECT * FROM `books` ORDER BY `books`.`name` ASC;");

                  echo "<table class='table table-bordered table-hover' >";
                    echo "<tr style='background-color: #6db6b9e6;'>";
                      //Table header
                      echo "<th>"; echo "ID"; echo "</th>";
                      echo "<th>"; echo "Book-Name";  echo "</th>";
                      echo "<th>"; echo "Authors Name";  echo "</th>";
                      echo "<th>"; echo "Edition";  echo "</th>";
                      echo "<th>"; echo "Status";  echo "</th>";
                      echo "<th>"; echo "Quantity";  echo "</th>";
                      echo "<th>"; echo "Department";  echo "</th>";
                    echo "</tr>"; 

                    while($row=mysqli_fetch_assoc($res))
                    {
                      echo "<tr>";
                      echo "<td>"; echo $row['bookid']; echo "</td>";
                      echo "<td>"; echo $row['name']; echo "</td>";
                      echo "<td>"; echo $row['authors']; echo "</td>";
                      echo "<td>"; echo $row['edition']; echo "</td>";
                      echo "<td>"; echo $row['status']; echo "</td>";
                      echo "<td>"; echo $row['quantity']; echo "</td>";
                      echo "<td>"; echo $row['department']; echo "</td>";

                      echo "</tr>";
                    }
                  echo "</table>"; 
                  }

                  if (isset($_POST['submit1'])) {
    if (isset($_SESSION['login_user'])) {
        $query = "INSERT INTO `issue_book`(`username`, `bookid`, `approve`, `issue`, `return`) 
                  VALUES ('$_SESSION[login_user]', '$_POST[bookid]', '', '', '')";
        if (mysqli_query($db, $query)) {
            ?>
            <script type="text/javascript">
                alert("Book Requested Successfully!");
            </script>

            <script type="text/javascript">
              window.location="request.php"
            </script>
            <?php
        } else {
            ?>
            <script type="text/javascript">
                alert("Error requesting book: <?php echo mysqli_error($db); ?>");
            </script>
            <?php
        }
    } else {
        ?>
        <script type="text/javascript">
            alert("You must login to Request a book");
        </script>
        <?php
    }
}

  
              

    
    ?>

</body>
</html>