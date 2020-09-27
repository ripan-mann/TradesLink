<?php require_once('../../private/initialize.php');
require_login();

$provider_id = $_SESSION['provider_id'];

$provider_set = find_provider_bookings($provider_id);

?>


<?php include(SHARED_PATH . '/header.php'); ?>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="col-md-12 ftco-animate">
                    <?php
                    while ($booking = mysqli_fetch_assoc($provider_set)) {
                        $user = find_user_by_id($booking['user_id']);
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
                                    <h2 class="mr-3 text-black"> Appointment with: <span class="text-primary"><?php echo $user['first_name'] ?></span></h2>
                                </div>
                            </div>
                            <div class="ml-auto  ">
                            <a class="btn btn-primary" href="<?php echo url_for('/booking/user_info.php?id=' . h(u($user['id']))); ?>>">Contact Info</a>
                                <a class="btn btn-danger" href="<?php echo url_for('/booking/delete_booking_provider.php?id=' . h(u($booking['id']))); ?>">Cancel Booking </a>
                            </div>
                        </div><?php
                            }
                                ?>
                </div>
            </div>
        </div>
</section>
<?php include(SHARED_PATH . '/footer.php'); ?>