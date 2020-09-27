<?php require_once('../../private/initialize.php'); ?>

<?php
$errors = [];
$email = '';
$password = '';

if (is_post_request()) {

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (is_blank($email)) {
        $errors[] = "Email cannot be blank.";
    }
    if (is_blank($password)) {
        $errors[] = "Passowrd cannot be blank.";
    }

    if (empty($errors)) {
        $login_failure_msg = "Log in was unsuccessful.";
        $provider = find_provider_by_email($email);
        if ($provider) {
            if (password_verify($password, $provider['hashed_password'])) {
                log_in_provider($provider);
                redirect_to(url_for('/index.php'));
            } else {
                $errors[] = $login_failure_msg;
            }
        } else {
            $errors[] = $login_failure_msg;
        }
    }
}
?>

<?php include(SHARED_PATH . '/header.php'); ?>
<div class="hero-wrap js-fullheight" style="background-image: url('<?php echo url_for('/images/bg_2.jpg') ?>');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="ftco-section">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-5 col-lg-3  mb-5">
                    <?php echo display_errors($errors); ?>
                </div>

                <div class="col-md-5 col-lg-6 mb-5">
                    <form action="login_provider.php" method="post" class="p-5 bg-light">
                        <div class="row form-group">
                            <label class="font-weight-bold text-primary display-4 mb-5">Sign In </label>&nbsp;<span class="font-weight-bold text-primary mt-4">as a Service Provider</span>

                            <div class="col-md-12 col-lg-12 mb-5">
                                <input type="email" class="form-control" value="<?php echo h($email); ?>" name="email" placeholder="Email Address">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12 col-lg-12 mb-5">
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                        </div>

                        <div class="row form-group mb-4">
                            <div class="col-md-12 col-lg-4">
                                <input type="submit" value="Sign In" class="btn btn-primary  py-2 px-5">
                            </div>
                            <div class="col-md-12 col-lg-4"></div>
                            <div class="col-md-12 col-lg-4">
                                <a class="btn btn-success  py-2 px-5" href="<?php echo url_for('/account/signup_provider.php') ?>">Sign Up</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>