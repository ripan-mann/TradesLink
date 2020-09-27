<?php require_once('../../../private/initialize.php');

require_login();

if (!isset($_GET['id'])) {
    redirect_to(url_for('/index.php'));
}
$id = $_GET['id'];

if (is_post_request()) {
    $provider = [];
    $provider['id'] = $id;
    $provider['first_name'] = $_POST['first_name'] ?? '';
    $provider['last_name'] = $_POST['last_name'] ?? '';
    $provider['email'] = $_POST['email'] ?? '';
    $provider['phone_number'] = $_POST['phone_number'] ?? '';
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

    $result = update_provider($provider);
    if ($result === true) {
        $_SESSION['message'] = 'Information updated.';
        redirect_to(url_for('/account/my_account/provider_account.php?id=' . h(u($id))));
    } else {
        $errors = $result;
    }
} else {
    $provider = find_provider_by_id($id);
}

?>

<?php include(SHARED_PATH . '/header.php'); ?>


<section class="ftco-section bg-light">
    <div class="container-fluid">
        <div class="row">

            <!-- <div class="col-lg-1 mb-5"></div> -->

            <div class="col-md-12 col-lg-12">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <h1><label class="text-primary ml-5">Edit Account Information</label></h1>
                    </div>

                    <div class="col-md-6 col-lg-6 ">
                        <?php
                        echo display_errors($errors);
                        ?>

                    </div>
                </div>
                <form action="<?php echo url_for('/account/my_account/provider_account.php?id=' . h(u($id))); ?>" method="post" class="ml-5 p-5">
                    <div class="row form-group">
                        <div class="col-md-4 col-lg-4 mb-2">
                            <label class="font-weight-bold text-primary" for="first_name">First Name</label>
                            <input type="text" class="form-control" name="first_name" value="<?php echo h($provider['first_name']) ?>">
                        </div>
                        <div class="col-md-4 col-lg-4 mb-2">
                            <label class="font-weight-bold text-primary" for="last_name">Last Name</label>
                            <input type="text" class="form-control" name="last_name" value="<?php echo h($provider['last_name']) ?>">
                        </div>
                        <div class="col-md-4 col-lg-4 mb-2">
                            <label class="font-weight-bold text-primary" for="phone_number">Phone Number</label>
                            <input type="text" name="phone_number" class="form-control" value="<?php echo h($provider['phone_number']) ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-4 col-lg-3 mb-2">
                            <label class="font-weight-bold text-primary" for="street">Address</label>
                            <input type="text" name="street" class="form-control" value="<?php echo h($provider['street']) ?>">
                        </div>
                        <div class="col-md-2 col-lg-3 mb-2">
                            <label class="font-weight-bold text-primary" for="city">City</label>
                            <input type="text" name="city" class="form-control" value="<?php echo h($provider['city']) ?>">
                        </div>
                        <div class="col-md-4 col-lg-3 mb-2">
                            <label class="font-weight-bold text-primary" for="province">Province</label>
                            <input type="text" name="province" class="form-control" value="<?php echo h($provider['province']) ?>">
                        </div>
                        <div class="col-md-2 col-lg-3 mb-2">
                            <label class="font-weight-bold text-primary" for="postal_code">Postal Code</label>
                            <input type="text" name="postal_code" class="form-control" value="<?php echo h($provider['postal_code']) ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-4 col-lg-3 mb-2">
                            <label class="font-weight-bold text-primary" for="profession">Profession</label>
                            <input type="text" name="profession" class="form-control" value="<?php echo h($provider['profession']) ?>">
                        </div>
                        <div class="col-md-2 col-lg-3 mb-2">
                            <label class="font-weight-bold text-primary" for="preferred_area">Preferred Area</label>
                            <input type="text" name="preferred_area" class="form-control" value="<?php echo h($provider['preferred_area']) ?>">
                        </div>
                        <div class="col-md-4 col-lg-3 mb-2">
                            <label class="font-weight-bold text-primary" for="available">Availability</label>
                            <input type="text" name="available" class="form-control" value="<?php echo h($provider['available']) ?>">
                        </div>
                        <div class="col-md-2 col-lg-3 mb-2">
                            <label class="font-weight-bold text-primary" for="price_per_hour">Price/hr</label>
                            <input type="text" name="price_per_hour" class="form-control" value="<?php echo h($provider['price_per_hour']) ?>">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-4 col-lg-4 mb-2">
                            <label class="font-weight-bold text-primary" for="email">Email Address</label>
                            <input type="text" name="email" class="form-control" value="<?php echo h($provider['email']) ?>">
                        </div>
                        <div class="col-md-4 col-lg-4 mb-2">
                            <label class="font-weight-bold text-primary" for="business_name">Email Address</label>
                            <input type="text" name="business_name" class="form-control" value="<?php echo h($provider['business_name']) ?>">
                        </div>
                        <div class="col-md-4 col-lg-4 mb-2">
                            <label class="font-weight-bold text-primary" for="password">Password</label>
                            <input type="password" name="password" class="form-control" value="">
                        </div>
                    </div>

                    <div class="row form-group mt-2">
                        <div class="col-md-12 col-lg-10">
                        </div>
                        <div class="col-md-12 col-lg-2">
                            <input type="submit" value="Update" name="updateUser" class="btn btn-success  py-2 px-5">
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</section>
<?php include(SHARED_PATH . '/footer.php'); ?>