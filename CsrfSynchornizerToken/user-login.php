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
    

    <div class="container">
      <div class="row" align="center" style="padding-top: 100px;">
        <div class="col-12">
          <div class="card">
            <h5 class="card-header">Login</h5>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                      <form action='user-login.php' method='POST' enctype='multipart/form-data'>

                        <div class="form-group row">
                          <label for="Email" class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">

                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">

                          </div>
                        </div>

                        <div class="form-group row">

                          <label for="password" class="col-sm-2 col-form-label">Password</label>
                          <div class="col-sm-10">

                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">

                          </div>
                        </div>

                        <button type="submit" class="btn btn-primary" id="submit" name="submit">Login</button>

                      </form>
                    </div>
                </div>
              </div>
            <div class="col-sm-2"></div>
          </div>
        </div>
      </div>
    </div>
    

  </body>
</html>

<?php
	if(isset($_POST['submit'])){
		userlogin();
	}
?>

<?php

	function userlogin()
	{

		$user_email='test@gmail.com';
		$user_password='1234';


		$email_in = $_POST['email'];
		$password_in = $_POST['password'];


		if(($email_in == $user_email)&&($password_in == $user_password))
		{
			session_set_cookie_params(300);
			session_start();
			session_regenerate_id();


			setcookie('session_cookie', session_id(), time() + 300, '/');

			$_SESSION['CSRF_Token'] = generate_token();


			header("Location:user-profile.php");
   			exit;

		}
		else
		{
			echo "<script>alert('Invalid login, Please try again.')</script>";
		}


	}

function generate_token()
	{

	  return sha1(base64_encode(openssl_random_pseudo_bytes(30)));

	}


?>
