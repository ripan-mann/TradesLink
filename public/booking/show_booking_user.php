<?php require_once('../../private/initialize.php');
require_login();

$user_id = $_SESSION['user_id'];

$user_set = find_user_bookings($user_id);

?>


<?php include(SHARED_PATH . '/header.php'); ?>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="col-md-12 ftco-animate">
                    <?php
                    while ($booking = mysqli_fetch_assoc($user_set)) {
                        $provider = find_provider_by_id($booking['provider_id']);
                    ?>
                        <div class="job-post-item bg-white p-4 d-block d-md-flex align-items-center">
                            <div class="mb-4 mb-md-0 mr-5">
                                <div class="job-post-item-header d-flex align-items-center">
                                    <h2 class="mr-3 text-black"> Appointment on: <span class="text-success"><?php echo $booking['date'] ?></span></h2>
                                </div>
                                <div class="job-post-item-header d-flex align-items-center">
                                    <h2 class="mr-3 text-black"> Time: <span class="text-success"><?php echo $booking['time'] ?></span></h2>
                                </div>
                                <div class="job-post-item-header d-flex align-items-center">
                                    <h2 class="mr-3 text-black"> Appointment with: <span class="text-primary"><?php echo $provider['business_name'] ?></span></h2>
                                </div>
                            </div>
                            <div class="ml-auto  ">
                            <a class="btn btn-primary" href="<?php echo url_for('/booking/provider_info_from_booking.php?id=' . h(u($provider['id']))); ?>>">Contact Info</a>
                                <a class="btn btn-danger" href="<?php echo url_for('/booking/delete_booking_user.php?id=' . h(u($booking['id']))); ?>">Cancel Booking </a>
                            </div>
                        </div><?php
                            }
                                ?>
                </div>
            </div>
        </div>
</section>
<?php include(SHARED_PATH . '/footer.php'); ?>