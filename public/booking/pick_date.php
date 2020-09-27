<?php require_once('../../private/initialize.php');

require_login();

if (!isset($_GET['id'])) {
    redirect_to(url_for('/index.php'));
}
$id = $_GET['id'];

?>


<?php include(SHARED_PATH . '/header.php'); ?>

<div class="overlay"></div>
<section class="ftco-section bg-light">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a class="text-danger" href="<?php echo url_for('/booking/provider_info.php?id=' . h(u($id))); ?>">&lt; Go Back</a>
                <?php
                $dateComponents = getdate();
                if (isset($_GET['month']) && isset($_GET['year'])) {
                    $month = $_GET['month'];
                    $year = $_GET['year'];
                } else {
                    $month = $dateComponents['mon'];
                    $year = $dateComponents['year'];
                }
                echo build_calendar($month, $year, $id);
                ?>
            </div>
        </div>
    </div>
    </div>

    <?php include(SHARED_PATH . '/footer.php'); ?>