<?php require_once('../../private/initialize.php');

require_login();

if (!isset($_GET['id'])) {
    redirect_to(url_for('/index.php'));
}
$id = $_GET['id'];


$provider_id = $_SESSION['provider_id'] ?? '';


$user = find_user_by_id($id);

$booking_set = find_bookings($id, $provider_id);
$booking = mysqli_fetch_assoc($booking_set)


?>

<?php include(SHARED_PATH . '/header.php'); ?>


<section class="ftco-section bg-light">
    <div class="container-fluid">
    <a class="text-danger" href="<?php echo url_for('/booking/show_booking_provider.php'); ?>">&lt; Go Back</a>

        <div class="row">

            <!-- <div class="col-lg-1 mb-5"></div> -->

            <div class="col-md-12 col-lg-12 ml-5">
                <div class="row mb-5">
                    <div class="col-md-12 col-lg-12 mt-2">
                        <h1><label class="text-dark" for="business_name">Appointment with: </label></h1>
                    </div>
                </div>
                <div class="row form-group h4">
                    <div class="col-md-4 col-lg-2 mb-2">
                        <label class="font-weight-bold text-dark" for="name">Name: </label>
                    </div>
                    <div class="col-md-4 col-lg-4 mb-2">
                        <label class="font-weight-bold text-primary" for="name"><?php echo h($user['first_name']) ?></label>
                        <label class="font-weight-bold text-primary" for="name"><?php echo h($user['last_name']) ?></label>
                    </div>
                </div>
                <div class="row form-group h4">
                    <div class="col-md-4 col-lg-2 mb-2">
                        <label class="font-weight-bold text-dark" for="phone_number">Phone Number: </label>
                    </div>
                    <div class="col-md-4 col-lg-4 mb-2">
                        <label class="font-weight-bold text-primary" for="phone_number"><?php echo h($user['phone_number']) ?></label>
                    </div>
                </div>
                <div class="row form-group h4">
                    <div class="col-md-4 col-lg-2 mb-2">
                        <label class="font-weight-bold text-dark" for="phone_number">Address: </label>
                    </div>
                    <div class="col-md-4 col-lg-8 mb-2">
                        <label class="font-weight-bold text-primary" for="phone_number"><?php echo h($user['street']) . ", " . h($user['city']) . ", " .  h($user['province']) . ", " .  h($user['postal_code']) ?></label>
                    </div>
                </div>
                <div class="row form-group h4">
                    <div class="col-md-4 col-lg-2 mb-4">
                        <label class="font-weight-bold text-dark" for="phone_number">Email: </label>
                    </div>
                    <div class="col-md-4 col-lg-4 mb-4">
                        <label class="font-weight-bold text-primary" for="phone_number"><?php echo h($user['email']) ?></label>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<?php include(SHARED_PATH . '/footer.php'); ?>