<!DOCTYPE html>
<html lang="en">
  <head>
    <title>CSRF Protection</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <script src="public/js/jquery.min.js"></script>
    <script src="public/js/bootstrap.min.js"></script>
  </head>
  <body>
    
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php">CSRF Protection</a>
        </div>
        <ul class="nav navbar-nav">
          <?php
            if (isset($_COOKIE['session_cookie'])) {
              echo "<li class='active'><a href='user-profile.php'>Profile</a></li>";
            }
          ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <?php
            if (!isset($_COOKIE['session_cookie'])) {
              echo "<li><a href='user-login.php'><span class='glyphicon glyphicons-log-in'></span> Login </a></li>";
            }
          ?><?php
            if (isset($_COOKIE['session_cookie'])) {
              echo "<li><a href='user-logout.php'><span class='glyphicon glyphicons-log-out'></span> Logout</a></li>";
            }
          ?>
        </ul>
      </div>
    </nav>
    <!-- navbar end -->
    <div class="container">
    <div class="row" align="center" style="padding-top: 100px;">
        <div class="col-12">

            <div class="card">
              <h5 class="card-header">Update Profile</h5>
              <div class="card-body">
                    <div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8">


                <?php if(isset($_COOKIE['session_cookie'])) {
                echo "
						<form action='csrf-validate.php' method='POST' enctype='multipart/form-data'>
                            	<!-- CSRF Token -->
                            	<input type='hidden' name='csrf_Token' id='csrf_Token' value=''>
                                <!--  -->
                            <div class='form-group row'>
                            	<label for='fname' class='col-sm-2 col-form-label'>First Name</label>
                            <div class='col-sm-10'>
                                <input type='text' class='form-control' id='fname' name='name' placeholder='First Name' required>
                            </div>
                            </div>

                          	<div class='form-group row'>
                                <label for='lname' class='col-sm-2 col-form-label'>Last Name</label>
                            <div class='col-sm-10'>
                                <input type='text' class='form-control' id='lname' name='lname' placeholder='Last Name' required>
                            </div>
                          	</div>

							<div class='form-group row'>
                                <label for='age' class='col-sm-2 col-form-label'>Age</label>
                            <div class='col-sm-10'>
                                <input type='number' class='form-control' id='age' name='age' placeholder='Age' required>
                            </div>
                          	</div>

                          	<div class='form-group row'>
                                <label for='gender' class='col-sm-2 col-form-label'>Year</label>
                            <div class='col-sm-10'>
                                <input type='text' class='form-control' id='gender' name='gender' placeholder='Gender' required>
                            </div>
                          	</div>


                                <button type='submit' class='btn btn-primary' id='submit' name='submit'>Submit</button>
                       </form>";
                }
                ?>

						<script >

						var request="true";
						$.ajax({
						url:"csrf-gen.php",
						method:"POST",
						data:{request:request},
						dataType:"JSON",
						success:function(data)
						{
							document.getElementById("csrf_Token").value=data.token;
						}

						})
						</script>







                        </div>
                        <div class="col-sm-2"></div>
                    </div>
              </div>
            </div>



        </div>
    </div>
</div>
  </body>
</html>
