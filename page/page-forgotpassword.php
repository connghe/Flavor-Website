<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if (isset($_POST['forgotpassword'])) {
    $errors = [];

    $forgotusername = $_POST['forgotusername'];
    $forgotemail = $_POST['forgotemail'];

    if (empty(trim($forgotusername))) {
        $errors['forgotusername'] = "Username cannot empty !";
    } elseif (strlen(trim($forgotusername)) < 5) {
        $errors['forgotusername'] = "Username need more than 5 characters !";
    }

    if (empty(trim($forgotemail))) {
        $errors['forgotemail'] = "Email cannot empty !";
    } elseif (!filter_var($forgotemail, FILTER_VALIDATE_EMAIL)) {
        $errors['forgotemail'] = "Pls re-check type Email !";
    }

    if (empty($errors)) {
        $sql_checkforgot = "SELECT * FROM users WHERE username = '$forgotusername' AND email = '$forgotemail'";
        $result_checkforgot = $conn->query($sql_checkforgot);
        if (mysqli_num_rows($result_checkforgot) > 0) {
            $pasword_new = "flavorshop";
            $sha_passwordnew = sha1($pasword_new);
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
                $mail->setFrom('duc.nt.2081@aptechlearning.edu.vn', 'Flavor Mail Reset Password');
                $mail->addAddress($forgotemail, $forgotusername);
                $mail->isHTML(true);
                $mail->Subject = 'Email verification';
                $mail->Body    = '<p>Your password is: <b style="font-size: 30px;">' . $pasword_new . '</b></p>';

                $mail->send();

                $sql = "UPDATE users SET password_hash = '$sha_passwordnew' WHERE username = '$forgotusername'";
                mysqli_query($conn, $sql);

                exit('
                    <div class="container mx-auto" style="Width: 50% ;">
                        <h1 class="mb-3">Reset password successfully !</h1>
                        <a class="btn btn-warning" href="?page=login">Login now</a>
                    </div>
                ');
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            $errors['forgotusername'] = "Pls re-check Username and Email . Because Username and Email does not match !";
            $errors['forgotemail'] = "Pls re-check Username and Email . Because Username and Email mismatched !";
        }
    }
}
?>
<section style="display:flex; flex-direction:column; min-height: 85vh">
    <div class="container">
        <div class="mx-auto" style="width: 50% ;">
            <h1>Forgot password</h1>
            <form method="post">
                <div>
                    <label>Username</label>
                    <input type="text" class="form-control" name="forgotusername" value="<?php if (isset($_POST['forgotusername'])) echo $_POST['forgotusername'] ?>">
                </div>
                <div class="mb-3">
                    <?php
                    if (isset($errors['forgotusername'])) {
                        echo '
                                <span class="text-danger">' . $errors['forgotusername'] . '</span>
                            ';
                    }
                    ?>
                </div>
                <div>
                    <label>Email</label>
                    <input type="text" class="form-control" name="forgotemail" value="<?php if (isset($_POST['forgotemail'])) echo $_POST['forgotemail'] ?>">
                </div>
                <div class="mb-3">
                    <?php
                    if (isset($errors['forgotemail'])) {
                        echo '
                                <span class="text-danger">' . $errors['forgotemail'] . '</span>
                            ';
                    }
                    ?>
                </div>
                <div>
                    <button class="btn btn-warning" name="forgotpassword">Send</button>
                </div>
            </form>
        </div>
    </div>
</section>