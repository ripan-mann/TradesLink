<footer class="ftco-footer ftco-bg-dark ftco-section">
  <div class="container">
    <div class="row mb-5">
      <div class="col-md">
        <div class="ftco-footer-widget mb-4">
          <h2 class="ftco-heading-2">About</h2>
          <p>TradesLink is an up and coming service that allows users can browse for different services and make an appoitment with their chosen service provider. If you are interested, signup for free today.</p>
          <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-3">
            <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
            <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
            <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
          </ul>
        </div>
      </div>
      <div class="col-md">
        <div class="ftco-footer-widget mb-4">
          <h2 class="ftco-heading-2">Usefull Links</h2>
          <ul class="list-unstyled">
            <li><a href="<?php echo url_for('/index.php') ?>" class="py-2 d-block">Homepage</a></li>
            <li><a href="<?php echo  url_for('/account/login.php') ?>" class="py-2 d-block">Sign In</a></li>
            <li><a href="<?php echo url_for('/account/login_provider.php') ?>" class="py-2 d-block">Sign In as a Provider</a></li>
          </ul>
        </div>
      </div>
      <div class="col-md">
        <div class="ftco-footer-widget mb-4">
          <h2 class="ftco-heading-2">Have a Questions?</h2>
          <div class="block-23 mb-3">
            <ul>
              <li><span class="icon icon-map-marker"></span><span class="text">12666 72 Ave, Surrey, BC V3W 2M8</span></li>
              <li><a href="#"><span class="icon icon-phone"></span><span class="text">+1 604 599 2100</span></a></li>
              <li><a href="#"><span class="icon icon-envelope"></span><span class="text">TradesLink@gmail.com</span></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 text-center">

        <p> TradesLink &copy; <?php echo date('Y'); ?> | All rights reserved</p>
      </div>
    </div>
  </div>
</footer>



<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
    <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
    <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" /></svg></div>

<script src="<?php echo url_for('/js/jquery.min.js') ?>"></script>
<script src="<?php echo url_for('/js/jquery-migrate-3.0.1.min.js') ?>"></script>
<script src="<?php echo url_for('/js/popper.min.js') ?>"></script>
<script src="<?php echo url_for('/js/bootstrap.min.js') ?>"></script>
<script src="<?php echo url_for('/js/jquery.easing.1.3.js') ?>"></script>
<script src="<?php echo url_for('/js/jquery.waypoints.min.js') ?>"></script>
<script src="<?php echo url_for('/js/jquery.stellar.min.js') ?>"></script>
<script src="<?php echo url_for('/js/owl.carousel.min.js') ?>"></script>
<script src="<?php echo url_for('/js/jquery.magnific-popup.min.js') ?>"></script>
<script src="<?php echo url_for('/js/aos.js') ?>"></script>
<script src="<?php echo url_for('/js/jquery.animateNumber.min.js') ?>"></script>
<script src="<?php echo url_for('/js/bootstrap-datepicker.js') ?>"></script>
<script src="<?php echo url_for('/js/jquery.timepicker.min.js') ?>"></script>
<script src="<?php echo url_for('/js/scrollax.min.js') ?>"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="<?php echo url_for('/js/google-map.js') ?>"></script>
<script src="<?php echo url_for('/js/main.js') ?>"></script>
<script>
  jQuery(document).ready(function($) {

    var slideCount = $('#slider ul li').length;
    var slideWidth = $('#slider ul li').width();
    var slideHeight = $('#slider ul li').height();
    var sliderUlWidth = slideCount * slideWidth;

    $('#slider').css({
      width: slideWidth,
      height: slideHeight
    });

    $('#slider ul').css({
      width: sliderUlWidth,
      marginLeft: -slideWidth
    });

    $('#slider ul li:last-child').prependTo('#slider ul');

    function moveLeft() {
      $('#slider ul').animate({
        left: +slideWidth
      }, 200, function() {
        $('#slider ul li:last-child').prependTo('#slider ul');
        $('#slider ul').css('left', '');
      });
    };

    function moveRight() {
      $('#slider ul').animate({
        left: -slideWidth
      }, 200, function() {
        $('#slider ul li:first-child').appendTo('#slider ul');
        $('#slider ul').css('left', '');
      });
    };

    $('a.control_prev').click(function() {
      moveLeft();
    });

    $('a.control_next').click(function() {
      moveRight();
    });

  });
</script>
<script>
        $(".book").click(function(){
            var timeslot = $(this).attr('data-timeslot');
            $("#timeslot").val(timeslot);
        });
    </script>

</body>

</html>

<?php
  db_disconnect($db);
?>
