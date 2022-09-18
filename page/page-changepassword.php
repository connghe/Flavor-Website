<?php
if (isset($_POST['changepass'])) {
    $errors = [];

    $currentpassword = $_POST['currentpassword'];
    $newpassword = $_POST['newpassword'];
    $confirmpassword = $_POST['confirmpassword'];

    if (empty(trim($currentpassword))) {
        $errors['currentpassword'] = "Current password cannot empty !";
    } elseif (strlen(trim($currentpassword)) < 5) {
        $errors['currentpassword'] = "Current password need more than 5 characters !";
    }

    if (empty(trim($newpassword))) {
        $errors['newpassword'] = "New password cannot empty !";
    } elseif (strlen(trim($newpassword)) < 5) {
        $errors['newpassword'] = "New password need more than 5 characters !";
    }

    if (empty(trim($confirmpassword))) {
        $errors['confirmpassword'] = "Confirm password cannot empty !";
    } elseif (strlen(trim($confirmpassword)) < 5) {
        $errors['confirmpassword'] = "Confirm password need more than 5 characters !";
    } elseif ($newpassword != $confirmpassword) {
        $errors['confirmpassword'] = "Pls re-check confirm password !";
    }

    if(empty($errors)){
        if($result_user['password_hash'] != sha1($currentpassword)){
            $errors['currentpassword'] = "Pls re-check Current password !";
        }else{
            $hash_changepass = sha1($confirmpassword);
            $sql_changepass = "UPDATE users set password_hash = '$hash_changepass' WHERE id = '$user_id' ";
            if($conn->query($sql_changepass)){
                exit('
                    <div class="container mx-auto" style="width:50%;">
                        <h1 class = "mb-3">Change password successfully</h1>
                        <a href="?page=profile" class="btn btn-warning">Go to Profile</a>
                    </div>
                ');
            }
        }
    }
}
?>
<section style="display:flex; flex-direction:column; min-height: 85vh">
    <div class="container">
        <div class="mx-auto" style="width: 50% ;">
            <form method="post">
                <h1>Change Password</h1>
                <div>
                    <label>Current Password</label>
                    <input type="password" class="form-control" name="currentpassword" value="<?php if(isset($_POST['currentpassword'])) echo $_POST['currentpassword'] ?>">
                </div>
                <div class="mb-3">
                    <?php
                    if (isset($errors['currentpassword'])) {
                        echo '
                                <span class="text-danger">' . $errors['currentpassword'] . '</span>
                            ';
                    }
                    ?>
                </div>
                <div>
                    <label>New Password</label>
                    <input type="password" class="form-control" name="newpassword" value="<?php if(isset($_POST['newpassword'])) echo $_POST['newpassword'] ?>">
                </div>
                <div class="mb-3">
                    <?php
                    if (isset($errors['newpassword'])) {
                        echo '
                                <span class="text-danger">' . $errors['newpassword'] . '</span>
                            ';
                    }
                    ?>
                </div>
                <div>
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" name="confirmpassword" value="<?php if(isset($_POST['confirmpassword'])) echo $_POST['confirmpassword'] ?>">
                </div>
                <div class="mb-3">
                    <?php
                    if (isset($errors['confirmpassword'])) {
                        echo '
                                <span class="text-danger">' . $errors['confirmpassword'] . '</span>
                            ';
                    }
                    ?>
                </div>
                <div class="mb-3">
                    <button class="btn btn-warning" name="changepass">Change</button>
                </div>
                <div class="<?php if(isset($errors['currentpassword']) && $errors['currentpassword'] == "Pls re-check Current password !"){echo '';}else{echo 'd-none';} ?>">
                    <span>If you forgot password ! <a href="?page=forgotpassword">Click here !</a></span>
                </div>
            </form>
        </div>
    </div>
</section>