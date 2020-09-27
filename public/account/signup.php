<?php
require_once('../../private/initialize.php');

if (is_post_request()) {
    $user = [];
    $user['first_name'] = $_POST['first_name'] ?? '';
    $user['last_name'] = $_POST['last_name'] ?? '';
    $user['phone_number'] = $_POST['phone_number'] ?? '';
    $user['email'] = $_POST['email'] ?? '';
    $user['password'] = $_POST['password'] ?? '';
    $user['street'] = $_POST['street'] ?? '';
    $user['city'] = $_POST['city'] ?? '';
    $user['province'] = $_POST['province'] ?? '';
    $user['postal_code'] = $_POST['postal_code'] ?? '';

    $result = insert_user($user);
    if ($result === true) {
        $new_id = mysqli_insert_id($db);
        $_SESSION['message'] = 'Signup Successful.';
        redirect_to(url_for('/index.php'));
    } else {
        $errors = $result;
    }
} else {
    // display the blank form
    $user = [];
    $user['first_name'] = '';
    $user['last_name'] = '';
    $user['phone_number'] = '';
    $user['email'] = '';
    $user['password'] = '';
    $user['street'] = '';
    $user['city'] = '';
    $user['province'] = '';
    $user['postal_code'] = '';
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
                    <form action="signup.php" method="post" class="p-5 bg-light">
                        <div class="row form-group">
                        <div class="col-md-12 col-lg-12 mb-5">
                            <label class="font-weight-bold text-primary display-4" for="fullname">Sign Up</label>
                        </div>

                            <div id="slider">
                                <a href="#" class="control_next btn btn-primary">Next</a>
                                <a href="#" class="control_prev btn btn-primary">Back</a>
                                <ul>
                                    <li>
                                        <div class="col-md-12 col-lg-12 mb-5">
                                            <input type="text" class="form-control" value="<?php echo h($user['first_name']); ?>" name="first_name" placeholder="First Name">
                                        </div>
                                        <div class="col-md-12 col-lg-12 mb-5">
                                            <input type="text" class="form-control" value="<?php echo h($user['last_name']); ?>" name="last_name" placeholder="Last Name">
                                        </div>
                                        <div class="col-md-12 col-lg-12">
                                            <input type="text" class="form-control" value="<?php echo h($user['phone_number']); ?>" name="phone_number" placeholder="Phone Number">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-md-12 col-lg-12 mb-3">
                                            <input type="text" class="form-control" value="<?php echo h($user['street']); ?>" name="street" placeholder="Adresss">
                                        </div>

                                        <div class="col-md-12 col-lg-12 mb-3">
                                            <input type="text" class="form-control" value="<?php echo h($user['postal_code']); ?>" name="postal_code" placeholder="postal">
                                        </div>
                                        <div class="col-md-12 col-lg-12 mb-3">
                                            <input type="text" class="form-control" value="<?php echo h($user['city']); ?>" name="city" placeholder="City">
                                        </div>
                                        <div class="col-md-12 col-lg-12">
                                            <input type="text" class="form-control" value="<?php echo h($user['province']); ?>" name="province" placeholder="Province">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-md-12 col-lg-12 mb-5">
                                            <input type="email" class="form-control" value="<?php echo h($user['email']); ?>" name="email" placeholder="Email Address">
                                        </div>
                                        <div class="col-md-12 col-lg-12 mb-5">
                                            <input type="password" class="form-control" name="password" placeholder="Password">
                                        </div>
                                        <div class="col-md-12 col-lg-12">
                                            <input type="submit" value="Sign Up" class="btn-primary form-control py-2 px-5">
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>