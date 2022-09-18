<?php
if (isset($_SESSION['login'])) {
    echo '
      <script>
        $(document).ready(function(){
          window.location="?page=home";
        })
      </script>
    ';
    exit();
}

$errors = [];
if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty(trim($username))) {
        $errors['username'] = 'Username cannot empty !';
    } elseif (strlen(trim($username)) < 5) {
        $errors['username'] = 'Username need more than 5 characters !';
    }

    if (empty(trim($password))) {
        $errors['password'] = 'Password cannot empty !';
    } elseif (strlen(trim($username)) < 5) {
        $errors['password'] = 'Password need more than 5 characters !';
    }

    if (empty($errors)) {
        $pass_hash = sha1($password);
        $sql_selectuser = "SELECT * FROM users WHERE username = '$username' && password_hash = '$pass_hash'";
        $check_account = mysqli_num_rows($conn->query($sql_selectuser));
        if ($check_account > 0) {
            $result_user = mysqli_fetch_array($conn->query($sql_selectuser));
            $_SESSION['login'] = $result_user['id'];
            echo '
            <script>
                $(document).ready(function(){
                    window.location="?page=home";
                })
            </script>
            ';
        } else {
            $errors['username'] = 'Usernamme or Password wrong !';
            $errors['password'] = 'Usernamme or Password wrong !';
        }
    }
}
?>




<section class="mt-5" style="display:flex; flex-direction:column; min-height: 79vh ;">
    <div class="container">
        <div style="width:40%;margin:auto;">
            <form method="post">
                <div>
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" value="<?php if (isset($_POST['username'])) {
                                                                                        echo $_POST['username'];
                                                                                    } ?>">
                </div>
                <div class="mb-3">
                    <?php
                    if (isset($errors['username'])) {
                        echo '<span class="text-danger">' . $errors['username'] . '</span>';
                    }
                    ?>
                </div>
                <div>
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" value="<?php if (isset($_POST['password'])) {
                                                                                            echo $_POST['password'];
                                                                                        } ?>">
                </div>
                <div class="mb-3">
                    <?php
                    if (isset($errors['password'])) {
                        echo '<span class="text-danger">' . $errors['password'] . '</span>';
                    }
                    ?>
                </div>
                
                <div class="mb-3">
                    <a href="?page=forgotpassword">Forgot password</a>
                </div>
                <div class="mb-3">
                    If you not a member ? <a href="?page=register">Register now !</a>
                </div>
                <div class="text-center">
                    <button class="btn btn-warning" name="login">Login</button>
                </div>
            </form>
        </div>
    </div>
</section>