<?php
if (isset($_POST["verify"])) {
    $errors = [];
    $email = $_POST["email"];
    $verification_code = $_POST["verification_code"];

    // mark email as verified
    $sql = "UPDATE users SET email_verified_at = NOW() WHERE email = '" . $email . "' AND verification_code = '" . $verification_code . "'";
    $result  = mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) == 0) {
        $errors['code'] = "Verification code failed";
    } else {
        echo '
        <section class="layout_padding" style="display:flex; flex-direction:column; min-height: 85vh">
            <div class="container">
                <h2>Verification success !</h2>
                <a href="?page=login" class="btn btn-warning">Login now</a>
            </div>
        </section>
        ';
        exit();
    }
}
?>
<section class="layout_padding" style="display:flex; flex-direction:column; min-height: 85vh">
    <div class="container">
        <h3>Please enter the verification code !</h3>
        <form method="post">
            <div class="input-group>
                <div class=" input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Verification code</span>
                <input type="number" class="form-control" name="verification_code" aria-label="code" aria-describedby="basic-addon1">
            </div>
            <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>">

            <div class="mb-3">
                <span class="text-danger"><?php if (isset($errors['code'])) {
                                                echo $errors['code'];
                                            } ?></span>
            </div>
            <div>
                <button class="btn btn-warning" name="verify">Send</button>
            </div>
        </form>
    </div>
</section>