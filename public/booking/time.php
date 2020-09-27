<?php require_once('../../private/initialize.php');

require_login();

if (isset($_GET['date'])) {
    $date = $_GET['date'];
}

if (!isset($_GET['id'])) {
    redirect_to(url_for('/index.php'));
}
$provider_id = $_GET['id'];

$user_id = $_SESSION['user_id'];


if (is_post_request()) {
    $booking = [];
    $booking['user_id'] = $user_id ?? '';
    $booking['provider_id'] = $provider_id ?? '';
    $booking['date'] = $date ?? '';
    $booking['time'] = $_POST['time'] ?? '';

    $result = insert_booking($booking);
    if ($result === true) {
        $new_id = mysqli_insert_id($db);
        $_SESSION['message'] = 'Booking created.';
        redirect_to(url_for('/booking/show_booking_user.php'));
    } else {
        $errors = $result;
    }
}

?>

<?php include(SHARED_PATH . '/header.php'); ?>
<div class="overlay"></div>
<section class="ftco-section bg-light">
    <div class="container">
        <a class="text-danger" href="<?php echo url_for('/booking/pick_date.php?id=' . h(u($provider_id))); ?>">&lt; Go Back</a>
        <div class="text-center h1">Book for Date: <?php echo date('F d, Y', strtotime($date)); ?></div>
        <div class="row">
            <?php
            $timeslots = timeslots($duration, $cleanup, $start, $end);

            foreach ($timeslots as $ts) {

                $result = find_booked_time($date);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $bookings[] = $row['time'];
                    }
                }
            ?>
                <div class="col-md-4 mt-5">
                    <div class="form-group">
                        <?php 
                        if (has_inclusion_of($ts, $bookings)) { ?>
                            <button class="btn btn-danger book"><?php echo $ts ?> <br> (Booked!)</button>

                        <?php } else { ?>
                            <button class="btn btn-success book" data-toggle="modal" data-target="#exampleModalCenter" data-timeslot="<?php echo $ts ?>"><?php echo $ts ?></button>

                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form action="<?php echo url_for('/booking/time.php?id=' . h(u($provider_id))) . '&date=' . h(u($date)) . ''; ?>" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Booking: <span><?php echo h(u($date)) ?></span></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="text-dark">Timeslot: </label>
                                            <input required type="text" name="time" value="<?php echo h($booking['time']); ?>" id="timeslot" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input type="submit" value="Confirm Booking" class="btn btn-primary" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include(SHARED_PATH . '/footer.php'); ?>