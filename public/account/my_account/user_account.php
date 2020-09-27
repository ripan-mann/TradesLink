<?php require_once('../../../private/initialize.php');

require_login();

if (!isset($_GET['id'])) {
    redirect_to(url_for('/index.php'));
}
$id = $_GET['id'];

if (is_post_request()) {
    $user = [];
    $user['id'] = $id;
    $user['first_name'] = $_POST['first_name'] ?? '';
    $user['last_name'] = $_POST['last_name'] ?? '';
    $user['email'] = $_POST['email'] ?? '';
    $user['phone_number'] = $_POST['phone_number'] ?? '';
    $user['password'] = $_POST['password'] ?? '';
    $user['street'] = $_POST['street'] ?? '';
    $user['city'] = $_POST['city'] ?? '';
    $user['province'] = $_POST['province'] ?? '';
    $user['postal_code'] = $_POST['postal_code'] ?? '';

    $result = update_user($user);
    if ($result === true) {
        $_SESSION['message'] = 'Information updated.';
        redirect_to(url_for('/account/my_account/user_account.php?id=' . h(u($id))));
    } else {
        $errors = $result;
    }
} else {
    $user = find_user_by_id($id);
}

?>

<?php include(SHARED_PATH . '/header.php'); ?>


<section class="ftco-section bg-light">
    <div class="container-fluid">
        <div class="row">

            <!-- <div class="col-lg-1 mb-5"></div> -->

            <div class="col-md-12 col-lg-12 mt-5">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <h1><label class="text-primary ml-5">Edit Account Information</label></h1>
                    </div>

                    <div class="col-md-6 col-lg-6 ">
                        <?php echo display_errors($errors); ?>
                    </div>
                </div>

                <form action="<?php echo url_for('/account/my_account/user_account.php?id=' . h(u($id))); ?>" method="post" class="ml-5 p-5">
                    <div class="row form-group">
                        <div class="col-md-4 col-lg-4 mb-2">
                            <label class="font-weight-bold text-primary" for="first_name">First Name</label>
                            <input type="text" class="form-control" name="first_name" value="<?php echo h($user['first_name']) ?>">
                        </div>
                        <div class="col-md-4 col-lg-4 mb-2">
                            <label class="font-weight-bold text-primary" for="last_name">Last Name</label>
                            <input type="text" class="form-control" name="last_name" value="<?php echo h($user['last_name']) ?>">
                        </div>
                        <div class="col-md-4 col-lg-4 mb-2">
                            <label class="font-weight-bold text-primary" for="phone_number">Phone Number</label>
                            <input type="text" name="phone_number" class="form-control" value="<?php echo h($user['phone_number']) ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-4 col-lg-3 mb-2">
                            <label class="font-weight-bold text-primary" for="street">Address</label>
                            <input type="text" name="street" class="form-control" value="<?php echo h($user['street']) ?>">
                        </div>
                        <div class="col-md-2 col-lg-3 mb-2">
                            <label class="font-weight-bold text-primary" for="city">City</label>
                            <input type="text" name="city" class="form-control" value="<?php echo h($user['city']) ?>">
                        </div>
                        <div class="col-md-4 col-lg-3 mb-2">
                            <label class="font-weight-bold text-primary" for="province">Province</label>
                            <input type="text" name="province" class="form-control" value="<?php echo h($user['province']) ?>">
                        </div>
                        <div class="col-md-2 col-lg-3 mb-2">
                            <label class="font-weight-bold text-primary" for="postal_code">Postal Code</label>
                            <input type="text" name="postal_code" class="form-control" value="<?php echo h($user['postal_code']) ?>">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6 col-lg-6 mb-2">
                            <label class="font-weight-bold text-primary" for="email">Email Address</label>
                            <input type="text" name="email" class="form-control" value="<?php echo h($user['email']) ?>">
                        </div>
                        <div class="col-md-6 col-lg-6 mb-2">
                            <label class="font-weight-bold text-primary" for="password">Password</label>
                            <input type="password" name="password" class="form-control" value="">
                        </div>
                    </div>

                    <div class="row form-group mt-5">
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