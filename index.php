<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Search</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body class="bg-secondary">
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="#">Navbar</a>
      
        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
          </ul>
        </div>
      </nav>
      <div class="container-fluid">
          <div class="row justify-content-center">
              <div class="col-md-10 bg-light mt-2 rounded pb-3">
                  <h1 class="text-primary p-2 text-center">Live Search Using PHP, MYSQLI & AJAX</h1>
                  <hr>
                  <div class="form-inline">
                      <label for="search" class="font-weight-bold lead text-dark">Search Record</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <input type="text" name="search" id="search_text" class="form-control form-control-lg rounded-0 border-primary" placeholder="Search...">
                  </div>
                  <hr>
                  <?php
                    include 'dbconnect.php';
                    $query = "SELECT * FROM live_search";
                    $stmt = $connection->prepare($query);
                    $stmt->execute();
                    $result = $stmt->get_result();
                  ?>
                  <table class="table table-hover table-light table-striped" id="table-data">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php                 
                      while($row = $result->fetch_assoc()){
                      ?> 
                      <tr>
                        <td><?= $row['id'];?></td>
                        <td><?= $row['first_name'];?></td>
                        <td><?= $row['last_name'];?></td>
                        <td><?= $row['email'];?></td>
                        <td><?= $row['gender'];?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
              </div>
          </div>
      </div>
      <script type="text/javascript">
        $(document).ready(function(){
          $("#search_text").keyup(function(){
            var search = $(this).val();
            $.ajax({
              url:'action.php',
              method:'post',
              data:{query:search},
              success:function(response){
                $("#table-data").html(response);
              }
            });
          });
        });

      </script>
</body>
</html>