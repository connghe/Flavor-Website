<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$errors = [];
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    
    $checkspace_username = $_POST['username'] ;
    

    if (empty($username)) {
        $errors['username'] = "Username cannot empty ! ";
    } elseif (strlen($username) < 5) {
        $errors['username'] = "Username need more than 5 characters !";
    }elseif($username == trim($username) && strpos($checkspace_username , ' ') !== false){
        $errors['username'] = "The Username must not contain spaces ";
    }else {
        $sql_checkusername = "SELECT * from users WHERE username = '$username'";
        $checkusername = mysqli_num_rows($conn->query($sql_checkusername));
        if ($checkusername > 0) {
            $errors['username'] = "Duplicate username !";
        }
    }

    if (empty($password)) {
        $errors['password'] = "Password cannot empty ! ";
    } elseif (strlen($password) < 5) {
        $errors['password'] = "Password need more than 5 characters ! ";
    }

    if (empty($firstname)) {
        $errors['firstname'] = "Firstname cannot empty ! ";
    } elseif (strlen($firstname) < 3) {
        $errors['firstname'] = "Firstname is too short ! ";
    }

    if (empty($lastname)) {
        $errors['lastname'] = "Lastname cannot empty ! ";
    } elseif (strlen($lastname) < 2) {
        $errors['lastname'] = "Lastname is too short ! ";
    }

    if (empty($email)) {
        $errors['email'] = "Email cannot empty !";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Pls re-check email !";
    } else {
        $sql_checkemail = "SELECT * from users WHERE email = '$email'";
        $checkemail = mysqli_num_rows($conn->query($sql_checkemail));
        if ($checkemail > 0) {
            $errors['email'] = "Duplicate email !";
        }
    }

    if (empty($phone)) {
        $errors['phone'] = "Phone cannot empty !";
    }

    if (empty($address)) {
        $errors['address'] = "Address cannot empty !";
    } elseif (strlen($address) < 10) {
        $errors['address'] = "Pls re-check address !";
    }

    if (empty($errors)) {
        $mail = new PHPMailer(true);

        try {

            $mail->SMTPDebug = 0;

            $mail->isSMTP();

            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;

            $mail->Username = 'duc.nt.2081@aptechlearning.edu.vn';
            $mail->Password = 'mszlcmherrmlures';

            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->setFrom('duc.nt.2081@aptechlearning.edu.vn', 'Flavor Mail');
            $mail->addAddress($email, $username);
            $mail->isHTML(true);
            $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
            $mail->Subject = 'Email verification';
            $mail->Body    = '<p>Your verification code is: <b style="font-size: 30px;">' . $verification_code . '</b></p>';

            $mail->send();

            $encrypted_password = sha1($password);

            // insert in users table
            $sql = "INSERT INTO users(username,password_hash,firstname,lastname,address,email,phone,verification_code, email_verified_at) VALUES ('$username' , '$encrypted_password','$firstname','$lastname','$address','$email','$phone','$verification_code',NULL)";
            mysqli_query($conn, $sql);

            echo '<script>
                $(document).ready(function(){
                    window.location="?page=success&email=' . $email . '"
                })
            </script>';
            exit();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
?>
<section class="layout_padding" style="display:flex; flex-direction:column; min-height: 85vh">
    <div class="container">
        <div style="width:40%;margin:auto;">
            <form method="post">
                <div>
                    <label>Username</label>
                    <input type="text" class="form-control" name="username">
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
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="mb-3">
                    <?php
                    if (isset($errors['password'])) {
                        echo '<span class="text-danger">' . $errors['password'] . '</span>';
                    }
                    ?>
                </div>
                <div>
                    <label>First Name</label>
                    <input type="text" class="form-control" name="firstname">
                </div>
                <div class="mb-3">
                    <?php
                    if (isset($errors['firstname'])) {
                        echo '<span class="text-danger">' . $errors['firstname'] . '</span>';
                    }
                    ?>
                </div>
                <div>
                    <label>Last name</label>
                    <input type="text" class="form-control" name="lastname">
                </div>
                <div class="mb-3">
                    <?php
                    if (isset($errors['lastname'])) {
                        echo '<span class="text-danger">' . $errors['lastname'] . '</span>';
                    }
                    ?>
                </div>
                <div>
                    <label>Email</label>
                    <input type="text" class="form-control" name="email">
                </div>
                <div class="mb-3">
                    <?php
                    if (isset($errors['email'])) {
                        echo '<span class="text-danger">' . $errors['email'] . '</span>';
                    }
                    ?>
                </div>
                <div>
                    <label>Phone</label>
                    <input type="text" class="form-control" name="phone">
                </div>
                <div class="mb-3">
                    <?php
                    if (isset($errors['phone'])) {
                        echo '<span class="text-danger">' . $errors['phone'] . '</span>';
                    }
                    ?>
                </div>
                <div>
                    <label>Address</label>
                    <input type="text" class="form-control" name="address">
                </div>
                <div class="mb-3">
                    <?php
                    if (isset($errors['address'])) {
                        echo '<span class="text-danger">' . $errors['address'] . '</span>';
                    }
                    ?>
                </div>
                <div class="text-center">
                    <button class="btn btn-warning" name="register">Register</button>
                </div>
            </form>
        </div>
    </div>
</section>