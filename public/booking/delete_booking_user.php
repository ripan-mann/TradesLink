<?php require_once('../../private/initialize.php');
require_login();

if (!isset($_GET['id'])) {
    redirect_to(url_for('/index.php'));
}
$id = $_GET['id'];
if (is_post_request()) {

    $result = delete_booking($id);
    $_SESSION['message'] = 'The page was deleted successfully.';
    redirect_to(url_for('/booking/show_booking_user.php'));
} else {
    $booking = find_booking_by_id($id);
    $provider = find_provider_by_id($booking['provider_id']);
}
?>


<?php include(SHARED_PATH . '/header.php'); ?>

<div class="js-fullheight" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="ftco-section">
        <div class="container-fluid">
            <div class="row">

                <!-- <div class="col-lg-1 mb-5"></div> -->

                <div class="col-md-12 col-lg-12 ml-5">
                    <form action="<?php echo url_for('/booking/delete_booking_user.php?id=' . h(u($id))); ?>" method="post">

                        <div class="row mb-5">
                            <div class="col-md-12 col-lg-12 mt-2">
                                <h1><label class="text-dark" for="business_name">Are you sure you want to cancel this booking?</label></h1>
                            </div>
                        </div>
                        <div class="row form-group h4">
                            <div class="col-md-4 col-lg-2 mb-2">
                                <label class="font-weight-bold text-dark" for="name">Date: </label>
                            </div>
                            <div class="col-md-4 col-lg-4 mb-2">
                                <label class="font-weight-bold text-primary" for="name"><?php echo h($booking['date']) ?></label>
                            </div>
                        </div>
                        <div class="row form-group h4">
                            <div class="col-md-4 col-lg-2 mb-2">
                                <label class="font-weight-bold text-dark" for="phone_number">Time: </label>
                            </div>
                            <div class="col-md-4 col-lg-4 mb-2">
                                <label class="font-weight-bold text-primary" for="phone_number"><?php echo h($booking['time']) ?></label>
                            </div>
                        </div>
                        <div class="row form-group h4">
                            <div class="col-md-4 col-lg-2 mb-2">
                                <label class="font-weight-bold text-dark" for="phone_number">With: </label>
                            </div>
                            <div class="col-md-4 col-lg-4 mb-2">
                                <label class="font-weight-bold text-primary" for="phone_number"><?php echo h($provider['business_name']) ?></label>
                            </div>
                        </div>

                        <div class="row form-group mt-5">
                            <div class="col-md-12 col-lg-8">
                            </div>
                            <div class="col-md-12 col-lg-2">
                                <input type="submit" value="Cancel Appointment" name="delete" class="btn btn-danger  py-2 px-5">
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>