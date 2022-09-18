<?php 
    session_start();
    include ('../../database/config.php');
    if(isset($_SESSION['admin'])){
        header('location:../index.php');
    }
    $errors = [] ;
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$username = htmlspecialchars($_POST['username']);
		$password = htmlspecialchars($_POST['password']);
		// Get username and password from client
		$username = $conn->real_escape_string($username);
		$password = $conn->real_escape_string($password);
		// Validate username
		if(empty(trim($username))){
			$errors['username'] = 'Username cannot empty !' ;
		}elseif (strlen(trim($username)) < 5 ) {
			$errors['username'] = 'Username need more than 5 character !' ;
		}
		// Validate password
		if(empty(trim($password))){
			$errors['password'] = 'Password cannot empty !' ;
		}elseif (strlen(trim($password)) < 6 ) {
			$errors['password'] = 'Password need more than 6 character !' ;
		}
		// Check username and password
		if(empty($errors)){
			if(isset($_COOKIE['username']) && isset($_COOKIE['password'])){
				$checkusername = $_COOKIE['username'];
				$checkpassword = $_COOKIE['password'];
			}else{
				$checkusername = strtolower($username);
				$checkpassword = sha1($password);
			}
			$check = "SELECT id FROM adminuser WHERE username = '$checkusername' AND hash_password = '$checkpassword' " ;
			$result = $conn->query($check) ;
			$row = mysqli_num_rows($result);
			if($row > 0){
				$fet = mysqli_fetch_array($result);
				// Process remember
				if(isset($_POST['remember'])){
					setcookie('username' , $username , time()+3600);
					setcookie('password' , $checkpassword , time()+3600);
				}else{
					setcookie('username' , '' , time()-3600);
					setcookie('password' , '' , time()-3600);
				}
				$_SESSION['admin'] = $fet['id'];
				header('location:../');
			}else{
				$errors['username'] = 'Username or Password wrong !' ;
				$errors['password'] = 'Username or Password wrong !' ;
			}
		}

	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FLAVOR Manager Site</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../assets/dist/css/admin-login.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a class="text-white" href=""><b class="text-warning">FLAVOR</b> Manager</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="" method="post">
          <!-- Username -->
          <div class="input-group">
            <input type="text" class="form-control" placeholder="User Name" name="username" value="<?php if (isset($_POST['username'])) {
                                                                                                      echo $_POST['username'];
                                                                                                    } elseif (isset($_COOKIE['username'])) {
                                                                                                      echo $_COOKIE['username'];
                                                                                                    } ?>">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <!-- Error username -->
          <div class="mb-3">
              <?php
              if (isset($errors['username'])) {
                echo '<span class="text-danger">' . $errors['username'] . '</span>';
              }
              ?>
            </div>
          <!-- Password -->
          <div class="input-group">
            <input type="password" class="form-control" placeholder="Password" name="password" value="<?php if (isset($_POST['password'])) {
                                                                                                        echo $_POST['password'];
                                                                                                      } elseif (isset($_COOKIE['password'])) {
                                                                                                        echo $_COOKIE['password'];
                                                                                                      } ?>">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <!-- Error password -->
          <div class="mb-3">
            <?php
            if (isset($errors['password'])) {
              echo '<span class="text-danger">' . $errors['password'] . '</span>';
            }
            ?>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember" name="remember" <?php if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
                                                                        echo 'checked';
                                                                      } ?>>
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-warning btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <p class="mb-1">
          <a class="text-warning" href="forgot-password.html">I forgot my password</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->
  <!-- jQuery -->
  <script src="../assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../assets/dist/js/adminlte.min.js"></script>
</body>

</html>