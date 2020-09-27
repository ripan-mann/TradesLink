<?php
require_once('../../private/initialize.php');

if (is_post_request()) {
    $provider = [];
    $provider['first_name'] = $_POST['first_name'] ?? '';
    $provider['last_name'] = $_POST['last_name'] ?? '';
    $provider['phone_number'] = $_POST['phone_number'] ?? '';
    $provider['email'] = $_POST['email'] ?? '';
    $provider['password'] = $_POST['password'] ?? '';
    $provider['business_name'] = $_POST['business_name'] ?? '';
    $provider['street'] = $_POST['street'] ?? '';
    $provider['city'] = $_POST['city'] ?? '';
    $provider['province'] = $_POST['province'] ?? '';
    $provider['postal_code'] = $_POST['postal_code'] ?? '';
    $provider['profession'] = $_POST['profession'] ?? '';
    $provider['preferred_area'] = $_POST['preferred_area'] ?? '';
    $provider['available'] = $_POST['available'] ?? '';
    $provider['price_per_hour'] = $_POST['price_per_hour'] ?? '';

    $result = insert_provider($provider);
    if ($result === true) {
        $new_id = mysqli_insert_id($db);
        $_SESSION['message'] = 'Signup as a provider Successful.';
        redirect_to(url_for('/index.php'));
    } else {
        $errors = $result;
    }
} else {
    // display the blank form
    $provider = [];
    $provider['first_name'] = '';
    $provider['last_name'] = '';
    $provider['phone_number'] = '';
    $provider['email'] = '';
    $provider['password'] = '';
    $provider['business_name'] = '';
    $provider['street'] = '';
    $provider['city'] = '';
    $provider['province'] = '';
    $provider['postal_code'] = '';
    $provider['profession'] = '';
    $provider['preferred_area'] = '';
    $provider['available'] = '';
    $provider['price_per_hour'] = '';
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
                    <form action="signup_provider.php" method="post" class="p-5 bg-light">
                        <div class="row form-group">
                            <label class="font-weight-bold text-primary display-4 mb-5">Sign Up</label>&nbsp;<span class="font-weight-bold text-primary mt-4">as a Service provider</span>
                            <div id="slider">
                                <a href="#" class="control_next btn btn-primary">Next</a>
                                <a href="#" class="control_prev btn btn-primary">Back</a>
                                <ul>
                                    <li>
                                        <div class="col-md-12 col-lg-12 mb-3">
                                            <input type="text" class="form-control" value="<?php echo h($provider['first_name']); ?>" name="first_name" placeholder="First Name">
                                        </div>
                                        <div class="col-md-12 col-lg-12 mb-3">
                                            <input type="text" class="form-control" value="<?php echo h($provider['last_name']); ?>" name="last_name" placeholder="Last Name">
                                        </div>
                                        <div class="col-md-12 col-lg-12 mb-3">
                                            <input type="text" class="form-control" value="<?php echo h($provider['phone_number']); ?>" name="phone_number" placeholder="Phone Number">
                                        </div>
                                        <div class="col-md-12 col-lg-12 mb-3">
                                            <input type="text" class="form-control" value="<?php echo h($provider['business_name']); ?>" name="business_name" placeholder="Company Name">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-md-12 col-lg-12 mb-3">
                                            <input type="text" class="form-control" value="<?php echo h($provider['street']); ?>" name="street" placeholder="Adresss">
                                        </div>

                                        <div class="col-md-12 col-lg-12 mb-3">
                                            <input type="text" class="form-control" value="<?php echo h($provider['postal_code']); ?>" name="postal_code" placeholder="postal">
                                        </div>
                                        <div class="col-md-12 col-lg-12 mb-3">
                                            <input type="text" class="form-control" value="<?php echo h($provider['city']); ?>" name="city" placeholder="City">
                                        </div>
                                        <div class="col-md-12 col-lg-12 mb-3">
                                            <input type="text" class="form-control" value="<?php echo h($provider['province']); ?>" name="province" placeholder="Province">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-md-12 col-lg-12 mb-3">
                                            <input type="text" class="form-control" value="<?php echo h($provider['profession']); ?>" name="profession" placeholder="Profession">
                                        </div>

                                        <div class="col-md-12 col-lg-12 mb-3">
                                            <input type="text" class="form-control" value="<?php echo h($provider['preferred_area']); ?>" name="preferred_area" placeholder="Preferred Area">
                                        </div>
                                        <div class="col-md-12 col-lg-12 mb-3">
                                            <input type="text" class="form-control" value="<?php echo h($provider['available']); ?>" name="available" placeholder="Availability">
                                        </div>
                                        <div class="col-md-12 col-lg-12 mb-3">
                                            <input type="text" class="form-control" value="<?php echo h($provider['price_per_hour']); ?>" name="price_per_hour" placeholder="Price pre hour">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-md-12 col-lg-12 mb-5">
                                            <input type="email" class="form-control" value="<?php echo h($provider['email']); ?>" name="email" placeholder="Email Address">
                                        </div>
                                        <div class="col-md-12 col-lg-12 mb-5">
                                            <input type="password" class="form-control" name="password" placeholder="Password">
                                        </div>
                                        <div class="col-md-12 col-lg-12 mb-5">
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